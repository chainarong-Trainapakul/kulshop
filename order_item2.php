<?php
require_once 'library/config.php';
require_once 'library/checkout-functions.php';
require_once 'library/category-functions.php';
//require_once 'process_receipt.php';
 
// if no order id defined in the session
// redirect to main page
/*if (!isset($_SESSION['orderId'])) {
	header('Location: ' . WEB_ROOT);
	exit;
}*/
$order_id = $_GET['od_id']; 
$user_id = $_SESSION['plaincart_customer_id'];
/*    $sql =  "select od_id from tbl_order where user_id= '$user_id' ORDER BY od_id DESC";
    $result = dbQuery($sql);*/
    $od_id = array();
    $pd_id= array();
    $pd_qty = array();
    $pd_price = array();
    $pd_name = array();
    $tran = 0;
    $receipt_no = '';
    $date_od = '';
    /*while($row = mysql_fetch_assoc($result)){
            //$date += $row['od_date'];
            array_push($od_id,$row['od_id']);
            //echo $row['od_date']."<br>" ;
    }*/
    //echo $od_id[0];
    $sql = "SELECT * FROM `tbl_order_item` od_it inner JOIN tbl_product pd on od_it.od_id = '$order_id' and od_it.pd_id = pd.pd_id";
    $result = dbQuery($sql);
    while($row = mysql_fetch_assoc($result)){
           $pd_id[] = $row['pd_id'];
         // echo $row['pd_id'];
        //echo "-";
           $pd_qty[] = $row['od_qty'];
          //echo $row['od_qty'];
       // echo "-";
           $pd_price[] = $row['pd_price'];
          //echo $row['pd_price']."<br>";
            $pd_name[] = $row['pd_name'];
            $tran += $row['od_qty'] ;
            $receipt_no = $row['od_id'];
    }
    $sql = "select od_date from tbl_order where od_id = '$receipt_no'";
    $result = dbQuery($sql);
    while($row = mysql_fetch_assoc($result)){
        $date_od = $row['od_date'];
    }

    $tran = (($tran-1)*40)+100;
    
$pageTitle   = 'Checkout Completed Successfully';
require_once 'include/header.php';
$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;

require_once 'include/nevMenu.php';
//คลาสสำหรับการรับส่งเมล์
require_once 'library/PHPMailer/class.phpmailer.php';
require_once 'library/PHPMailer/class.smtp.php';
require_once 'library/PHPMailer/class.pop3.php';
//$orderId = $_SESSION['orderId'];
//$emailMessage = getOrderTableForMail($orderId);			//รายการสินค้าที่ลูกค้าซื้อ 
	
/*if ($shopConfig['sendOrderEmail'] == 'y') {		//ถ้ากำหนดให้มีการส่งอีเมล
												//ใน shop config
	$shopName = $shopConfig['name'];			//ชื่อร้านค้า
	$shopEmail   = $shopConfig['email'];		//อีเมลของทางร้าน
	//------------------------ส่งอีเมลไปยังลูกค้า---------------------------//
	$customerSubject = "[สั่งสินค้า] รหัสใบสั่งสินค้า: " . $_SESSION['orderId'] . ' จากร้าน:' . $shopName;
	$customerSubject = "=?UTF-8?B?".base64_encode($customerSubject)."?=";
	$customerEmail   = getCustomerEmail($orderId);	//อีเมลของลูกค้า
	$mail             = new PHPMailer();			//สร้าง Object จากคลาส PHPMailer
	$body             = $emailMessage;			//ข้อความที่จะส่งไปให้ลูกค้า
	$mail->IsSMTP(); 							// กำหนดว่าจะใช้เมลแบบ SMTP
	$mail->Host       = "mx1.hostinger.in.th"; 	// SMTP server

	$mail->SMTPAuth   = true; 					//เปิดการใช้งาน SMTP authentication
	$mail->Host       = "mx1.hostinger.in.th"; 	//กำหนดชื่อโฮส
	$mail->Port       = 2525;                   //กำหนดพอร์ต
	$mail->Username   = "webmaster@ioshouse.url.ph"; //ชื่อ SMTP User 
	$mail->Password   = "admin1234";        	//รหัสผ่าน SMTP 
	$mail->SetFrom("$shopEmail", "$shopName");	//กำหนดอีเมลและชื่อผู้ส่ง
	$mail->Subject    = $customerSubject;		//กำหนดชื่อ Subject
	$mail->AltBody    = "การดูอีเมล์นี้ กรุณาใช้โปรแกรมที่สามารถดูอีเมล์แบบ HTML"; // optional, comment out and test
	$mail->MsgHTML($body);						//ส่งข้อความในแบบ HTML
	$address = $customerEmail;					//อีเมลของผู้รับ
	$mail->AddAddress($address, "[customer]");	//กำหนดอีเมลและชื่อของเมลผู้รับ
	$mail->Send();								//สั่งให้ส่งอีเมล
		
	//------------------------ส่งอีเมลไปยังร้านค้า-------------------------//
	$subject = "[New Order] " . $_SESSION['orderId'];
	$shopBody = "ลูกค้าสั่งสินค้า สามารถตรวจสอบรายละเอียดได้ที่ \n http://" . $_SERVER['HTTP_HOST'] . WEB_ROOT . 'admin/order/index.php?view=detail&oid=' . $_SESSION['orderId'] ;						//สร้างลิงก์เพื่อให้สามารถคลิกรหัสสินค้าได้
	$mail->Subject    = $subject;				//ชื่อ Subject
	$mail->AltBody    = "การดูอีเมล์นี้ กรุณาใช้โปรแกรมที่สามารถดูอีเมล์แบบ HTML";
	$mail->MsgHTML($shopBody);					//เนื้อหาที่จะส่งไปกับอีเมล
	$address = $shopEmail;						//อีเมลผู้รับ
	$mail->AddAddress($address, "$shopName");	//กำกับอีเมลผู้รับและชื่อของผู้รับ
	$mail->Send();								//ส่งอีเมล
	}
unset($_SESSION['orderId']);					//ยก*///เลิก session ใบสั่งสินค้า
require_once 'include/header.php';
?>

<div class="row">
  	<div class="col-md-12"> <?php require_once 'include/nevMenu.php'; ?></div>
</div>

<div class="row">
  	<div class="col-md-12"> <?php require_once 'include/top.php'; ?></div>
</div>

<div class="row">
  	<div class="col-md-2"><?php require_once 'include/leftNav.php'; ?></div>
  
  	<div class="col-md-7">
      	<div id="category-container"> 
  			<?php //require_once 'include/categoryList.php'; ?>
  		</div>
  		<div id="product-container">
  			<!--************************************************************-->
			<!--******************** content ใส่ที่นี่ **************************-->
  			<!--************************************************************-->
<p>&nbsp;</p>
<table width="80%" border="0" align="center" cellpadding="1" cellspacing="0">
   <tr> 
      <td align="left" valign="top"> 
      	<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr> 
               <td align=""> <p>&nbsp;</p>
<!--                  <div class="alert alert-success">
                  ขอขอบพระคุณที่ให้ความกรุณาเลือกซื้อสินค้าจากทางร้าน เราจะจัดส่งสินค้าให้ถึงมือท่านโดยเร็วที่สุด หากต้องการซื้อสินค้าเพิ่มเติมกรุณา <a href="index.php" btn btn-primary>คลิกที่นี่ 
                            </a>
                	</div>-->
<div id="receipt" class="panel panel-info">
    <div><center><label>ร้านชัยสิทธิ์เกษตร</label></center></div>
        <div><center><label>36/1 ม.3 ต.หนองบัว อ.บ้านแพ้ว จ.สมุทรสาคร 74120</label></center></div>
    <div><center><label>โทร.081-9177716 &nbsp;&nbsp; kulthidakukps@gmail.com</label></center></div>
    <br>
    <div><lable><center>เลขที่ใบเสร็จ : <?php echo $receipt_no ?>&nbsp;&nbsp;&nbsp;&nbsp;สั่งซื้อเมื่อ : <?php echo $date_od ?></center></lable></div>
    <br>
    <div class="panel-heading">รายการสินค้าที่ท่านได้สั่งไว้กับทางร้าน</div>
  <div class="panel-body"> 
    <table width="550" border="0" align="center" cellpadding="5" cellspacing="1" class="table">
        <tr class="active"> 
            <td>รายการ</td>
            <td align="right">ราคาสินค้า</td>
            <td align="right">รวมย่อย</td>
        </tr>
        <?php
$numItem  = count($pd_id);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	//extract($cartContent[$i]);
	$subTotal += $pd_price[$i] * $pd_qty[$i];
   // $subTotal +=10;
?>
        <tr class=""> 
            <td class=""><?php echo "<span  style=\"font-size:0.9em;\">$pd_qty[$i]</span> x $pd_name[$i]"; ?></td>
            <td align="right"><?php echo displayAmount($pd_price[$i]); ?></td>
            <td align="right"><?php echo displayAmount($pd_qty[$i] * $pd_price[$i]); ?></td>
        </tr>
        <?php
}
?>
        <tr class=""> 
            <td colspan="2" align="right">รวม</td>
            <td align="right"><?php echo displayAmount($subTotal); ?></td>
        </tr>
        <tr class=""> 
            <td colspan="2" align="right">ค่าขนส่ง</td>
            <td align="right"><?php echo displayAmount($tran); ?></td>
        </tr>
        <tr class="active"> 
            <td colspan="2" align="right">รวมสุทธิ</td>
            <td align="right"><strong style="font-size:1.1em;"><?php echo displayAmount($tran + $subTotal); ?></strong></td>
        </tr>
    </table>
    </div>
    <br><br>
    <div><center><label>*** หากไม่ชำระเงินเกิน 3 วัน ทางร้านจะยุติรายการสั่งซื้อ ***</label></center></div>
    <div><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กรุณาโอนเงินมาที่ </label></div>
    <div>&nbsp;&nbsp;&nbsp;769-2-49734-8 ธ.ไทยพาณิชย์ น.ส.กุลธิดา วนาประเสริฐ สาขา กำแพงแสน</div>
    <div>&nbsp;&nbsp;&nbsp;115-3-40984-4 ธ.กรุงไทย    น.ส.อัญมณี วนาประเสริฐ สาขา บ้านแพ้ว</div>
    <div>&nbsp;&nbsp;&nbsp;371-3-00653-8 ธ.กรุงเทพ    นายชัยสิทธิ์ วนาประเสริฐ  สาขา บ้านแพ้ว</div>
</div>
                   <center><input name="btnConfirm1" type="button" onClick="printDiv('receipt');" value="พิมพ์ใบเสร็จ" class="btn btn-primary"></center>
                  <p>&nbsp;</p></td>
            </tr>
         </table>
    </td>
   </tr>
</table>
<br>
<br>
  			<!--************************************************************-->
			<!--******************** สิ้นสุดเนื้อหาตรงนี้ *************************-->
  			<!--************************************************************-->

		</div>	
		<div id="lastest-link-content">
		</div>
	</div>

  	<div class="col-md-3">
  		<div id="cart-content-mini"></div>
  		<div><?php require_once 'include/widgets/otherWidget.php';?></div>
  		<div><?php require_once 'include/widgets/widget2.php';?></div>
  	</div>
</div>

<script>

$(function(){
	var n = true;
	$.ajax({
  		url:'include/miniCartAjax.php',
  		data:{link:n},
  		type:'get',
  		success:function(data){
  			$("#cart-content-mini").empty().append(data).fadeIn(1000);
  		}
  	});
});
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     console.log(printContents);
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();    
     document.body.innerHTML = originalContents;
    }
</script>

<?php require_once 'include/footer.php'; ?>
