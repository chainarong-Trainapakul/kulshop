<?php
require_once 'library/config.php';
require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/cart-functions.php';
require_once 'library/customer-functions.php';


$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;

$stringMail = '';
$name = '';
$last = '';
$phone = '';
$email = '';
if(isset($_SESSION['plaincart_customer_id'])) {
	$userProfile = getCustomerProfile(); 
	extract($userProfile);
	$name = $user_first_name;
	$last = $user_last_name;
	$phone = $user_phone;
	$email = $user_email;
} 
if(isset($_POST['txtUserFirstName'])){
	if(md5($_POST['captcha']) == $_SESSION['captchaKey']){
		$title = (isset($_POST['txtTitle']))?$_POST['txtTitle']:'';
		$name = (isset($_POST['txtUserFirstName']))?$_POST['txtUserFirstName']:'';
		$last = (isset($_POST['txtUserLastName']))?$_POST['txtUserLastName']:'';
		$phone = (isset($_POST['txtUserPhone']))?$_POST['txtUserPhone']:'';
		$email = (isset($_POST['txtUserEmail']))?$_POST['txtUserEmail']:'';
		$data = (isset($_POST['txtData']))?$_POST['txtData']:'';

		$shopEmail  = $shopConfig['email'];

		$subject = '<h3>ข้อคิดเห็น เรื่อง - '.$title.'</h3>';
		$stringMail .= '<p>ชื่อลูกค้า : '.$name.' '.$last.'</p>';
		$stringMail .= '<p>เบอร์โทรศัพท์ : '.$phone.'</p>';
		$stringMail .= '<p>อีเมล : '.$email.'</p>';
		$stringMail .= '<h4>ข้อคิดเห็น-เสนอแนะ</h4>';
		$stringMail .= '<p>เนื้อหา : '.$data.'</p>';
		$stringMail .= '<p>อีเมลร้านค้า : '.$shopEmail.'</p>';
	
		$headers = 'From: '.$email."\r\n".
				'Reply-To: '.$email."\r\n" .
				'X-Mailer: PHP/' . phpversion();
		@mail($shopEmail, $subject, $stringMail, $headers); 
		setSuccess('ขอขอบคุณสำหรับคำแนะนำติชม');
 	}else {
 		setError('คุณกรอกรหัส Captcha ไม่ถูกต้อง');
 	}
}
require_once 'include/header.php';


?>

<script language="JavaScript" type="text/javascript" src="library/contact-form.js"></script>

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
  <div class="panel-heading">ติดต่อเรา</div>
  <div class="panel-body">
  
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
//จบส่วนแสดง error และ success 
?>  
       <td bgcolor="#F9F9F9"><div align="center">
		<div class="alert alert-warning">หากท่านมีข้อสงสัย หรือมีข้อเสนอแนะเกี่ยวกับทางเว็บไซต์ สามารถสอบถามเพิ่มเติมได้ที่นี้
			</div>
		<table width="407" border="0">
              <tr>
                <td height="30" colspan="2"align="center" class="style33"><p class="style18"><strong>ร้านชัยสิทธิ์เกษตร</strong></p>
                  <p class="style18"><strong>36/1 ม.3 ต.หนองบัว อ.บ้านแพ้ว จ.สมุทรสาคร 74120 </strong></p></td>
                </tr>
              <tr>
                <td width="138" height="30"><span class="style_b18">โทร.081-9177716 </span></td>
                <td width="259" height="30"><span class="style_b18">kulthidakukps@gmail.com</span></td>
              </tr>
              <tr>
                <td height="30" class="style_b18"><span class="style28"><img src="images/line.png" width="164" height="149" /></span></td>
                <td height="30" class="style28"><span class="style_b18"> id line : kulkul26</span></td>
              </tr>
              <tr>
                <td height="30" colspan="2" class="style_b18">เพจเฟสบุ๊ค <a href="https://www.facebook.com/KangchemTH/">https://www.facebook.com/KangchemTH/</a></td>
                </tr>
            </table>
            <td align="center"><input type="button" name="b2" id="b2" value="กลับหน้าหลัก" onclick="parent.location='index.php'"/>&nbsp;</td>
           
         
	</div>
</div>

  			<!--************************************************************-->
			<!--****************** สิ้นสุด content ตรงนี้ ***********************-->
  			<!--************************************************************-->
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

</script>

<?php
//echo $stringMail; ใช้ทดสอบว่า Output ส่งค่าออกไปถูกต้องหรือไม่
?>
<?php require_once 'include/footer.php'; ?>
