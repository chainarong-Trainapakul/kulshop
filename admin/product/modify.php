<?php
if (!defined('WEB_ROOT')) {
	exit;
}

//ตรวจสอบเพื่อให้แน่ใจว่า มีการส่งรหัสสินค้ามาแล้ว
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
	$productId = $_GET['productId'];
} else {
	//ถ้าไม่มีรหัสสินค้าส่งมาด้วย ก็ให้ redirect เปลี่ยนไปยังหน้า  index.php
	header('Location: index.php');
}

//ดึงรายละเอียดของสินค้าจากฐานข้อมูล โดยอ้างอิงจากรหัสสินค้า
$sql = "SELECT pd.cat_id, pd_name, pd_description, pd_price, pd_qty, pd_image, pd_thumbnail
        FROM tbl_product pd, tbl_category cat
		WHERE pd.pd_id = $productId AND pd.cat_id = cat.cat_id";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());
$row    = mysql_fetch_assoc($result);
extract($row);

$categoryList = buildCategoryOptions($cat_id);
?> 
<form action="processProduct.php?action=modifyProduct&productId=<?php echo $productId; ?>" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <p align="center" class="formTitle">แก้ไขสินค้า</p>
 
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">ประเภทสินค้า</td>
   <td class="content"> <select name="cboCategory" id="cboCategory" class="box">
     <option value="" selected>-- เลือกประเภทสินค้า --</option>
<?php
	echo $categoryList;		//แสดงประเภทสินค้าในแบบ Drop down list
?>	 
    </select></td>
  </tr>
  <tr> 
   <td width="150" class="label">ชื่อสินค้า</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" value="<?php echo $pd_name; ?>" size="50" maxlength="100"></td>
  </tr>
      <tr>
    <td width="150" class="label">รหัสสินค้า</td>  
      <td class="content"> <input name="txtid" type="text" class="box" id="txtid" value="<?php echo $productId; ?>" size="50" maxlength="100"></td>
  </tr>
  <tr> 
   <td width="150" class="label">คุณสมบัติ</td>
   <td class="content"> <textarea name="mtxDescription" cols="70" rows="10" class="box" id="mtxDescription"><?php echo $pd_description; ?></textarea></td>
  </tr>
  <tr> 
   <td width="150" class="label">ราคา</td>
   <td class="content"><input name="txtPrice" type="text" class="box" id="txtPrice" value="<?php echo $pd_price; ?>" size="10" maxlength="7"> </td>
  </tr>
  <tr> 
   <td width="150" class="label">สินค้าในคลัง</td>
   <td class="content"><input name="txtQty" type="text" class="box" id="txtQty" value="<?php echo $pd_qty;  ?>" size="10" maxlength="10"> </td>
  </tr>  
    
     
  <tr> 
   <td width="150" class="label">รูปสินค้า</td>
   <td class="content"> <input name="fleImage" type="file" id="fleImage" class="box">
<?php
	//ถ้ามีการกำหนดรูปภาพ ก็ให้แสดงลิงก์ Delete สำหรับลบรูป
	if ($pd_thumbnail != '') {
?>
    <br>
    <img src="'width="100"'<?php echo WEB_ROOT . PRODUCT_IMAGE_DIR . $pd_thumbnail; ?>"> &nbsp;&nbsp;<a href="javascript:deleteImage(<?php echo $productId; ?>);">ลบรูปภาพ</a> 
    <?php
	}
?>    
    </td>
  </tr>
 </table>
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="บันทึกข้อมูล" onClick="checkAddProductForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="ยกเลิก" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>