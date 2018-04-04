

 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<style type="text/css">

<!--

body,td,th {

font-family: Geneva, Arial, Helvetica, sans-serif;

font-size: 11px;

color: #FFFFFF;

}

body {

background-image: url();

margin-left: 0px;

margin-top: 0px;

margin-right: 0px;

margin-bottom: 0px;

}

.style1 {

font-family: Geneva, Arial, Helvetica, sans-serif;

font-size: 11px;

color: #999999;

}

.style2 {color: #000000}

-->

</style>

</head>

 

<body>

<form id="form1" name="form1" method="post" action="s_admin_stok_insert2.php">

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" background="image/BG_Starwell2.png" bgcolor="#666666">

<tr>

<td><br />

<table width="720" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">

<tr>

<td colspan="4" bgcolor="#333333"><div align="center"><strong><br />

ข้อมูลสินค้า<br />

<br />

</strong></div></td>

</tr>

<tr>

<td bgcolor="#333333"><div align="center"><strong>รหัสสินค้า</strong></div></td>

<td bgcolor="#333333"><div align="center"><strong>ขื่อสินค้า</strong></div></td>

<td bgcolor="#333333"><div align="center"><strong>ประเภทสินค้า</strong></div></td>

<td bgcolor="#333333"><div align="center"><strong>จำนวนสินค้าคงเหลือ</strong></div></td>

</tr>

<tr bgcolor='#E2E2E2' onmouseover="this.bgColor='#FFFFFF'" onmouseout="this.bgColor='E2E2E2'">

<td><center class="style2"><?=$pro_id?></center></td>

<td><center class="style2"><?=$pro_name?></center></td>

<td><center class="style2"><?=$type_name?></center></td>

<td><center class="style2"><?=$pro_instok?></center></td>

</tr>

<tr>

<td colspan="4" bgcolor="#333333">

<div align="center"><br />

<br />

<strong>เพิ่มจำนวนสินค้า</strong>

<input name="num_add" type="text" class="style1" id="num_add" size="5" maxlength="3" />

<input name="Submit" type="submit" class="style1" id="button" value="Add" />

<input name="button2" type="submit" class="style1" id="button2" value="Close" />

<br />

<br />

<br />

</div></td>

</tr>

</table>

<br /></td>

</tr>

</table>

</form>

</body>

</html>

?>