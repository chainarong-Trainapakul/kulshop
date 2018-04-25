<?php

require_once 'library/config.php';
require_once 'library/customer-functions.php';
//ถ้าล็อคอินอยู่ ไม่อนุญาตให้ลงทะเบียนได้ กรณีเข้าเว็บเพจโดยตรงไม่ผ่านเมนู Register
if (isset($_SESSION['plaincart_customer_id'])) {
	header("Location: ".WEB_ROOT);
}

require_once 'library/category-functions.php';
require_once 'library/common.php';
require_once 'include/header.php';
$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;

?>

<script language="JavaScript" type="text/javascript" src="library/register.js"></script>
<script language="JavaScript" type="text/javascript" src="library/common.js"></script>

<?php
$hightlight = false ; 
//ตรวจสอบว่ามี error หรือไม่ ถ้ามีให้เก็บเข้าตัวแปร errorMessage
$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '';
//การลงทะเบียน จะมีการเก็บข้อมูลบางอย่างไว้ชั่วคราว เพราะถ้าผู้ใช้กรอกบางอย่างผิด 
//จะไม่ต้องกรอกข้อมูลเดิมซ้ำอีก
$tempName = (isset($_SESSION['txtUserName']))?$_SESSION['txtUserName']:'';   
$tempPassword = (isset($_SESSION['txtUserPassword']))?$_SESSION['txtUserPassword']:''; 
$tempEmail = (isset($_SESSION['txtUserEmail']))?$_SESSION['txtUserEmail']:'';  
$tempFirstName = (isset($_SESSION['txtUserFirstName']))?$_SESSION['txtUserFirstName']:'';    
$tempLastName = (isset($_SESSION['txtUserLastName']))?$_SESSION['txtUserLastName']:''; 
$tempAddress = (isset($_SESSION['txtUserAddress']))?$_SESSION['txtUserAddress']:'';   
$tempAddress2 = (isset($_SESSION['txtUserAddress2']))?$_SESSION['txtUserAddress2']:'';   
$tempPhone = (isset($_SESSION['txtUserPhone']))?$_SESSION['txtUserPhone']:''; 

$tempCity = (isset($_SESSION['txtUserCity']))?$_SESSION['txtUserCity']:'';    
$tempState = (isset($_SESSION['txtUserState']))?$_SESSION['txtUserState']:''; 
$tempPostalCode = (isset($_SESSION['txtUserPostalCode']))?$_SESSION['txtUserPostalCode']:''; 
if(isset($_GET['username'])){
    $tempName = $_GET['username'] ;
    $tempEmail = $_GET['email'];
    $tempFirstName = $_GET['firstname'];
    $tempLasName = $_GET['lastname'];
    $tempAddress = $_GET['address'];
    $tempAddress2 = $_GET['address2'];
    $tempPhone = $_GET['phone'];
    $tempCity = $_GET['city'];
    $tempState = $_GET['state'];
    $tempPostalCode = $_GET['portalcode'];
    $hightlight = true ;
}

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
  			<!--************************************************************-->
			<!--******************** แสดงประเภทสินค้า ************************-->
  			<!--************************************************************-->
  		</div>
  		<div id="product-container">
  			<!--************************************************************-->
			<!--********************* content ใส่ที่นี่ *************************-->
  			<!--************************************************************-->
  			
<?php
//ตรวจสอบว่ามี error ส่งมาหรือไม่ ถ้ามีแสดง error ดังกล่าวออกมา
if(isset($_GET['error']) && $_GET['error'] != ''){
?>
<div class="alert alert-danger" align="center"><?php echo $errorMessage; ?></div>
<?php
}
?>

<div class="panel panel-info" style="width:100%;margin-left:auto;margin-right:auto;">
	<div class="panel-heading">ลงทะเบียนสมาชิก</div>
  	<div class="panel-body">

<table align="center" cellpadding="0" cellspacing="1" class="table table-hover">

<form method="post" action="login.php" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser" onSubmit="return checkRegisterInfo();">
 <style>

</style>
  <tr>  
   <td width="200" class="">ชื่อผู้ใช้ <span class="label label-warning">ต้องการ</span></td>
   <td class=""> <input name="txtUserName" type="text" class="box" id="txtUserName" size="32" maxlength="32" placeholder = 'กรุณาใส่ชื่อผู้ใช้ <a-z,0-9>' value="<?php echo $tempName; ?>">
       <?php 
            if($hightlight==true){?>
                <label class="label label-default" style="font-size:0.9em;" id = 'label_user_name2' >* มีผู้ใช้ชื่อนี้แล้วกรุณาเปลี่ยนเป็นชื่ออื่น</label>
                <script type="application/javascript"> 
                    //clear_lable();
                    //alert("gg");
                    //console.log("gg");
                   /* document.getElementById('txtUserName').style.backgroundColor = 'yellow';
                    document.getElementById('txtUserPassword').style.backgroundColor = 'yellow';
                    document.getElementById('txtConfirmPassword').style.backgroundColor = 'yellow';*/
                    hightlight();
                </script> 
       <?php        
            }
       ?>
       <label class="label label-default" style="font-size:0.9em;" id = 'label_user_name' >* กรุณาใส่ชื่อผู้ใช้ให้ถูกต้อง</label>
      </td>
  	<input type="hidden" name="secretCode" value="<?php echo SECRET_KEY;?>"
  </tr>
  <tr> 
   <td width="150" class="" >รหัสผ่าน <span class="label label-warning">ต้องการ</span></td>
   <td class=""> 
   	<input name="txtUserPassword" type="password" class="box" id="txtUserPassword" value="" size="32" maxlength="32" placeholder=" รหัสผ่าน(อักษรผสมตัวเลข 6 ตัวอักษรขึ้นไป)">
    <label class="label label-default" style="font-size:0.9em;" style="display: none;" id = 'label_user_password'>* อักษรผสมกับตัวเลข 6 ตัวอักษรขึ้นไป</label>
   </td>
  </tr>
    <tr> 
   <td width="150" class="">ยืนยันรหัสผ่าน <span class="label label-warning">ต้องการ</span></td>
   <td class=""> <input name="txtUserConfirmPassword" type="password" class="box" id="txtConfirmPassword" value="" size="32" maxlength="32" placeholder="ยืนยันรหัสผ่าน">
        <label class="label label-default" style="font-size:0.9em;" id = 'label_user_con_password'>* กรุณายืนยันรหัสผ่านให้ตรงกับรหัสผ่าน</label></td>
  </tr>
  
  <tr> 
   <td width="150" class="">อีเมล <span class="label label-warning">ต้องการ</span></td>
   <td class=""> <input name="txtUserEmail" type="text" class="box" id="txtUserEmail" size="32" maxlength="32" placeholder="กรุณาใส่อีเมล(example@gmail.com)" value="<?php echo $tempEmail; ?>">
      <label class="label label-default" style="font-size:0.9em;" id = 'label_user_email'>* กรุณาใส่อีเมลให้ถูกต้อง เช่น  example@gmail.com</label></td>
  </tr>
    <tr> 
   <td width="150" class="">ชื่อ</td>
   <td class=""> <input name="txtUserFirstName" type="text" class="box" id="txtUserFirstName" size="32" maxlength="32" placeholder="กรุณาใส่ ขื่อ" value="<?php echo $tempFirstName; ?>"></td>
  </tr>
  <tr> 
   <td width="150" class="">นามสกุล</td>
   <td class=""> <input name="txtUserLastName" type="text" class="box" id="txtUserLastName" size="32" maxlength="32" placeholder="กรุณาใส่ นามสกุล" value="<?php echo $tempLastName; ?>"></td>
  </tr>
  <tr> 
   <td width="150" class="">โทรศัพท์</td>
   <td class=""> <input name="txtUserPhone" type="text" class="box" id="txtUserPhone" size="32" maxlength="10" placeholder = 'กรุณาใส่ เบอร์โทรศัพท์' value="<?php echo $tempPhone; ?>">
      <label class="label label-default" style="font-size:0.9em;" id = 'label_user_phone'>* กรุณาใส่หมายเลขโทรศัพท์ให้ถูกต้อง 0xxxxxxxxx</label></td>
  </tr>
  <tr> 
   <td width="150" class="">ที่อยู่</td>
   <td class=""> <input name="txtUserAddress" type="text" class="box" id="txtUserAddress" size="32" maxlength="50" placeholder='กรุณาใส่ ที่อยู่' value="<?php echo $tempAddress; ?>"></td>
  </tr>
  
    <tr> 
   <td width="150" class="">ตำบล</td>
   <td class=""> <input name="txtUserAddress2" type="text" class="box" id="txtUserAddress2" size="32" placeholder = "ตำบล" maxlength="50" value="<?php echo $tempAddress2; ?>"></td>
  </tr>
      <tr> 
   <td width="150" class="">เขต/อำเภอ</td>
   <td class=""> <input name="txtUserCity" type="text" class="box" id="txtUserCity" size="32" maxlength="32" placeholder='เขต/อำเภอ' value="<?php echo $tempCity; ?>"></td>
  </tr>
    <tr> 
   <td width="150" class="">จังหวัด</td>
   <td class=""> <input name="txtUserState" type="text" class="box" id="txtUserState" size="32" maxlength="32" placeholder="จังหวัด" value="<?php echo $tempState; ?>"></td>
  </tr>
  <tr> 
   <td width="150" class="">รหัสไปรษณีย์</td>
   <td class=""> <input name="txtUserPostalCode" type="text" class="box" id="txtUserPostalCode" size="32" maxlength="5" placeholder='รหัสไปรษณีย์' value="<?php echo $tempPostalCode; ?>">
      <label class="label label-default" style="font-size:0.9em;" id = 'label_user_postal'>* กรุณารหัสไปรษณีย์ให้ถูกต้อง</label></td>
  </tr>
 
  </table>

        <script>
            var count = false ;
            if(!count){             
                clear_lable();
                count = true ;
            }
        </script>
        <?php 
            if($hightlight == true){?>
                <script>
                    hightlight();
                </script>
          <?php  }
        ?>
 <p align="center"> 
  <input name="btnAddUser" type="submit" id="btnAddUser" value="ลงทะเบียน"  class="btn btn-primary" >
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="ยกเลิก" onClick="window.location.href='index.php?clearTemp=true';" class="btn btn-primary">  
       
        </p></div></div></div></div></div>

  			
		  	<!--************************************************************-->
			<!--******************* สิ้นสุดส่วน Content ************************-->
  			<!--************************************************************--> 			
  			
			
		<div id="lastest-link-content">
		  	<!--************************************************************-->
			<!--******************* แสดง Paging Link ***********************-->
  			<!--************************************************************-->
		</div>
	
  	<div class="col-md-3">
  		<div id="cart-content-mini">
  		  	<!--************************************************************-->
			<!--******************** แสดงตะกร้าสินค้า *************************-->
  			<!--************************************************************-->
  		</div>
  		<div><?php require_once 'include/widgets/otherWidget.php';?></div>
  		<div><?php require_once 'include/widgets/widget2.php';?></div>
  	</div>


<script>

//เมื่อโหลดหน้าเว็บเพจนี้ขึ้นมา ให้แสดงตะกร้าสินค้าทางขวามือทันที
$(function(){
	$.ajax({
  		url:'include/miniCartAjax.php',
  		type:'get',
  		success:function(data){
  			$("#cart-content-mini").empty().append(data).fadeIn(1000);
  		}
  	});
});

</script>
<?php require_once 'include/footer.php'; ?>
