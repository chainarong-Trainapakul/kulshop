<?php
if (!defined('WEB_ROOT')) {	//ตรวจสอบว่าได้กำหนด WEB_ROOT หรือไม่
	exit;
}
$userRole = array('customer', 'guest', 'admin');	//เก็บระดับของ User ลงใน array
$userOption = '';	//กำหนดลงใน drop-down เพื่อให้สามารถเลือกระดับของผู้ใช้ได้
foreach ($userRole as $role) {
	$userOption .= '<option value="'.$role.'"';
	if ($role == 'guest') {
		$userOption .= ' selected';
	}
	$userOption .= '>'.$role.'</option>\r\n';
}
$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';
?> 
<p class="errorMessage"><?php echo $errorMessage; ?></p>
<form action="processUser.php?action=add" method="post" enctype="multipart/form-data" name="frmAddUser" id="frmAddUser">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">ชื่อผู้ใช้</td>
   <td class="content"> <input name="txtUserName" type="text" class="box" id="txtUserName" size="20" maxlength="20"></td>
  </tr>
  <tr> 
   <td width="150" class="label">รหัสผ่าน</td>
   <td class="content"> <input name="txtPassword" type="password" class="box" id="txtPassword" value="" size="20" maxlength="20"></td>
  </tr>
    <tr> 
   <td width="150" class="label">ยืนยันรหัสผ่าน</td>
   <td class="content"> <input name="txtConfirmPassword" type="password" class="box" id="txtConfirmPassword" value="" size="20" maxlength="20"></td>
  </tr>
  
  <tr align="center"> 
  	<td width="150" class="label">สถานะ</td>
  	<td class="content">
  		<select name="cboUserRole" class="box" id="cboUserRole">
    		<?php echo $userOption; ?>
  		</select>
  </td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnAddUser" type="button" id="btnAddUser" value="บันทึกข้อมูล" onClick="checkAddUserForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="ยกเลิก" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>