<?php
require_once 'library/config.php';
require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/cart-functions.php';


$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;
$customerStringMail = '';

if(isset($_POST['txtUserPrice'])){

/*	if(md5($_POST['captcha']) == $_SESSION['captchaKey']){*/

		$name = (isset($_POST['txtUserFirstName']))?$_POST['txtUserFirstName']:'';

		$phone = (isset($_POST['txtUserPhone']))?$_POST['txtUserPhone']:'';
		$email = (isset($_POST['txtUserEmail']))?$_POST['txtUserEmail']:'';
		$bank = (isset($_POST['txtShopBank']))?$_POST['txtShopBank']:'';
		$time = (isset($_POST['txtUserTransfer']))?$_POST['txtUserTransfer']:'';
		$amount = (isset($_POST['txtUserPrice']))?$_POST['txtUserPrice']:'';
	    $order_no = (isset($_POST['txtUserOrderNo']))?
        $_POST['txtUserOrderNo']:'';
	
		$shopEmail  = $shopConfig['email'];

		$subject = '<h3>ลูกค้าโอนเงิน</h3>';
		$customerStringMail = '<p>ชื่อลูกค้า : '.$name.'</p>';
		$customerStringMail .= '<p>เบอร์โทรศัพท์ : '.$phone.'</p>';
		$customerStringMail .= '<p>อีเมล : '.$email.'</p>';
		$customerStringMail .= '<p>โอนมาที่ธนาคาร : '.$bank.'</p>';
		$customerStringMail .= '<p>เวลาโอน : '.$time.'</p>';
		$customerStringMail .= '<p>จำนวนเงิน : '.$amount.'</p>';
	
		$headers = 'From: '.$email."\r\n".
				'Reply-To: '.$email."\r\n" .
				'X-Mailer: PHP/' . phpversion();
		@mail($shopEmail, $subject, $stringMail, $headers); 
        date_default_timezone_set("Asia/Bangkok");
        $current_date = date('Y-m-d H:i:s');
        $sql = "Insert into tbl_payment(od_id,
        od_shipping_first_name,
        od_payment_phone,
        od_payment_email,
        od_bank,
        od_date,
        od_amount) 
        values('$order_no',
        '$name',
        '$phone',
        '$email',
        '$bank','
        $current_date',
        '$amount')";
        dbQuery($sql);
        setSuccess("แจ้งชำระเงินเสร็จสิ้น ขอบคุณที่ใช้บริการ");

/* 	}else {
 		setError('คุณกรอกรหัส Captcha ไม่ถูกต้อง');
 	}*/
    
    
}

require_once 'include/header.php';


?>

<script language="JavaScript" type="text/javascript" src="library/paid-form.js"></script>

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

<div class="panel panel-info">
  <div class="panel-heading">แจ้งชำระเงิน</div>
  <div class="panel-body">
  		
  		 <!--ส่วนของการตรวจสอบข้อผิดพลาด-->
  
  <?php
//ตรวจสอบว่ามี error หรือ success หรือไม่โดยดูค่าจาก array ใน $_SESSION ถ้ามีก็ให้เปลี่ยนชื่อ class
if(isset($_SESSION['plaincart_error']) && $_SESSION['plaincart_error']!=null){
?>

		<div>
			<div class="alert alert-danger" style="text-align:center;"><?php displayError(); ?></div>
		</div>

<?php
}
if(isset($_SESSION['plaincart_success']) && $_SESSION['plaincart_success']!=null){
?>

		<div>
			<div class="alert alert-success" style="text-align:center;"><?php displaySuccess(); ?></div>
		</div>

<?php
}
?>  
  			
  		<!--ส่วนของเนื้อหาหลัก-->
		<div class="alert alert-warning">เมื่อลูกค้าได้โอนเงินผ่านทางธนาคารเพื่อชำระค่าสินค้าไปแล้ว รบกวนลูกค้าแจ้งการชำระเงินทางโทรศัพท์หมายเลข 081-917-7716
		หรือกรอกข้อมูลลงในแบบฟอร์มข้างล่างนี้ ทางร้านจะจัดส่งสินค้าไปยังลูกค้าโดยเร็วที่สุด 
		</div>
		<!--<table align="center" cellpadding="0" cellspacing="1" class="table table-bordered table-striped table-hover">-->

<!--			<form method="post" enctype="multipart/form-data" name="frmPaid" id="frmPaid" onSubmit="return checkCustomerSubmitInfo();">-->
            			<form method="post" enctype="multipart/form-data" name="frmPaid" id="frmPaid" >
                            
                            		<table align="center" cellpadding="0" cellspacing="1" class="table table-bordered table-striped table-hover">

  				<!--<tr> 
   					<td width="200" class="">ชื่อ <span class="label label-warning">ต้องการ</span></td>
   					<td class=""> <input name="txtUserFirstName" type="text" class="box" id="txtUserFirstName" size="32" maxlength="32"></td>
  				</tr>
   				<tr> 
   					<td width="150" class="">โทรศัพท์</td>
   					<td class=""> <input name="txtUserPhone" type="text" class="box" id="txtUserPhone"  
                    size="32" maxlength="10" value=""></td>
  				</tr>
  				<tr> 
   					<td width="150" class="">อีเมล <span class="label label-warning">ต้องการ</span></td>
   					<td class=""> <input name="txtUserEmail" type="email" class="box" id="txtUserEmail"	 
                    size="32" maxlength="32" value=""></td>
  				</tr>-->
  				
                  <tr>
           <td width="150" class="">โอนไปยังบัญชีธนาคาร <span class="label label-warning">ต้องการ</span></td>
	        <td class="style23"><select name="txtShopBank" class="box" id="txtShopBank" >
              <option value="เลือกธนาคาร" selected="selected">กรุณาเลือกธนาคาร</option>
	          <option value="ธนาคารไทยพาณิชย์ 769-2-49734-8" >ธนาคารไทยพาณิชย์ 769-2-49734-8</option>
              <option value="ธนาคารกรุงไทย 115-3-40984-4">ธนาคารกรุงไทย 115-3-40984-4</option>
              <option value="ธนาคารกรุงเทพ 371-3-00653-8" >ธนาคารกรุงเทพ 371-3-00653-8</option>
	          </select></td>
	        <td class="style23">&nbsp;</td>
	        </tr>
                
  				<!--<tr> 
   					<td width="150" class="">เวลาที่โอน </td>
   					<td class=""> <input name="txtUserTransfer" type="date" class="box" id="txtUserTransfer" size="32" maxlength="32"></td>
  				</tr>-->
                <tr> 
   					<td width="150" class="">เลขที่บิล <span class="label label-warning">ต้องการ</span></td>
   					<td class=""> <input name="txtUserOrderNo" type="text" class="box" id="txtUserOrderNo" size="32" maxlength="32" onKeyUp="checkNumber(this);"></td>
  				</tr>
    			<tr> 
   					<td width="150" class="">จำนวนเงิน <span class="label label-warning">ต้องการ</span></td>
   					<td class=""> <input name="txtUserPrice" type="text" class="box" id="txtUserPrice" size="32" maxlength="32" onKeyUp="checkNumber(this);"></td>
  				</tr>
                  
                             <!--  <tr>
                    
                                   <td><img src='<?php /*echo "include/captcha/captcha.php"*/;?>' border = '0'/>
                                    <span class="label label-warning">ต้องการ</span>
                                   </td> 
                                   
                                   <td> <input type="text" name="captcha" class="box" id="captcha" size='32' maxlength="32"></td>
                    
                </tr>     -->
                            

                            
                              
                               
            </table>
    <p align="center">
  		<input name="btnAddUser" type="submit" id="btnAddUser" value="ส่ง"  class="btn btn-primary">
  		&nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="ยกเลิก" onClick="window.location.href='<?php echo WEB_ROOT; ?>';" class="btn btn-primary">  
                            </p>
      </form>
 		<!--<p align="center"> 
  		<input name="btnAddUser" type="submit" id="btnAddUser" value="ส่ง"  class="btn btn-primary">
  		&nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="ยกเลิก" onClick="window.location.href='<?php echo WEB_ROOT; ?>';" class="btn btn-primary">  
      </p>--></div></div></div></div></div>
 		

  			<!--************************************************************-->
			<!--****************** สิ้นสุด content ตรงนี้ ***********************-->
  			<!--************************************************************-->

		</div><!--div id="product-container"-->
		<div id="lastest-link-content">
		</div>
	</div><!--div class="col-md-7"-->

  	<div class="col-md-3">
  		<div id="cart-content-mini"></div>
  		<div><?php require_once 'include/widgets/otherWidget.php';?></div>
  		<div><?php require_once 'include/widgets/widget2.php';?></div>
  	</div>
</div>

<?php 
/*if(isset($_SESSION['txtUserFirstName'])){
    echo '<script>alert("OK dude");</script>';
}
else{
    echo '<script>alert("kuy rai sus");</script>';
}*/
?>


<script>
$(document).ready(function() {
    $("#txtUserPhone").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
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

</script>

<?php
//echo $customerStringMail;
?>
<?php require_once 'include/footer.php'; ?>
