<?php
if (!defined('WEB_ROOT')) {
	exit;
}

//ใช้ SQL ดึงข้อมูลของผู้ใช้ทั้งหมดมาจากตาราง
$sql = "SELECT user_id, user_name, user_regdate, user_last_login
        FROM tbl_user
		ORDER BY user_name";
$result = dbQuery($sql);
$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

?> 
<p class="errorMessage"><?php echo $errorMessage; ?></p>
<form action="processUser.php?action=addUser" method="post"  name="frmListUser" id="frmListUser">
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td>ชื่อผู้ใช้</td>
   <td width="120">วันที่สมัครสมาชิก</td>
   <td width="120">วันที่ใช้งานล่าสุด</td>
   <td width="120">แก้ไข</td>
   <td width="70">ลบ</td>
  </tr>
<?php
while($row = dbFetchAssoc($result)) {
	extract($row);		//แตกข้อมูล จะได้ชื่อตัวแปร ชื่อเดียวกับชื่อ field ของตาราง tbl_user
	
	if ($i%2) {
		$class = 'row1';
	} else {
		$class = 'row2';
	}
	
	$i += 1;
//-----------------------แสดงข้อมูลออกมาเป็นตาราง------------------------//
?>
  <tr class="<?php echo $class; ?>"> 
   <td><?php echo $user_name; ?></td>
   <td width="120" align="center"><?php echo $user_regdate; ?></td>
   <td width="120" align="center"><?php echo $user_last_login; ?></td>
   <td width="120" align="center"><a href="javascript:changePassword(<?php echo $user_id; ?>);">แก้ไข</a></td>
   <td width="70" align="center"><a href="javascript:deleteUser(<?php echo $user_id; ?>);">ลบ</a></td>
  </tr>
<?php
} // end while

?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <tr> 
   <td colspan="5" align="right"><input name="btnAddUser" type="button" id="btnAddUser" value="เพิ่มผู้ใช้" class="box" onClick="addUser()"></td>
  </tr>
 </table>
 <p>&nbsp;</p>
</form>