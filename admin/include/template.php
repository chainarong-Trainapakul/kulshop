<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$self = WEB_ROOT . 'admin/index.php';
//require_once '././library/functions.php';
?>
<!doctype html>
<html>
<head>
<title><?php echo $pageTitle; ?></title>
<meta charset="utf-8">
<link href="<?php echo WEB_ROOT;?>admin/include/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="<?php echo WEB_ROOT;?>library/common.js"></script>
<?php
$n = count($script);
for ($i = 0; $i < $n; $i++) {
	if ($script[$i] != '') {
		echo '<script language="JavaScript" type="text/javascript" src="' . WEB_ROOT. 'admin/library/' . $script[$i]. '"></script>';
	}
}
?>
</head>
<body>
<table width="750" border="0" align="center" cellpadding="0" cellspacing="1" class="graybox">
  <tr>
    <td colspan="2"><img src="<?php echo WEB_ROOT; ?>admin/include/backto.jpg" width="750" height="300"></td>
  </tr>
  <tr>
    <td width="150" valign="top" class="navArea"><p>&nbsp;</p>
      <a href="<?php echo WEB_ROOT; ?>admin/" class="leftnav">หน้าหลัก</a> 
	  <a href="<?php echo WEB_ROOT; ?>admin/category/" class="leftnav">ประเภทสินค้า</a>
	  <a href="<?php echo WEB_ROOT; ?>admin/product/" class="leftnav">รายการสินค้า</a> 
	  <a href="<?php echo WEB_ROOT; ?>admin/addproduct/" class="leftnav">เพิ่มสินค้า</a>
      <a href="<?php echo WEB_ROOT; ?>admin/order/" class="leftnav">รายการสั่งซื้อ</a> 
      <a href="<?php echo WEB_ROOT; ?>admin/config/" class="leftnav">ข้อมูลร้านค้า</a> 
        <a href="<?php echo WEB_ROOT; ?>admin/payment/" class="leftnav">รายการชำระเงิน</a> 
	  <a href="<?php echo WEB_ROOT; ?>admin/user/" class="leftnav">ข้อมูลผู้ใช้</a> 
    <a href="<?php echo $self; ?>?logout" class="leftnav">ออกจากระบบ</a>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>&nbsp;</p></td>
    <td width="600" valign="top" class="contentArea"><table width="100%" border="0" cellspacing="0" cellpadding="20">
        <tr>
          <td>
<?php
require_once $content;	 
?>
          </td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<p align="center">Copyright &copy; 2018  <a href="#">Chaiyasitkaset</a>&nbsp;Edit By&nbsp;</p>
</body>
</html>
