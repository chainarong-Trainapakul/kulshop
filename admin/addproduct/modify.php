<script>   
    function show_add (){
        alert("เพิ่มสินค้าเรียบร้อย");
        window.location.href='index.php';
    }
</script>
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

$pd_name = $row['pd_name'];
$categoryList = buildCategoryOptions($cat_id); 
?> 
<form action="processProduct.php" method="POST" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <p align="center" class="formTitle">แก้ไขสินค้า</p>
 
   <select input type="text" name="cat_id"><option value="" selected>-- เลือกประเภทสินค้า --</option>
<?php
	echo $categoryList;		//แสดงประเภทสินค้าในแบบ Drop down list
?>	 
    </select>
  <form action="add_product_db.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
    
            <p> รหัสสินค้า</p>
            <input type="text"  name="pd_id" class="form-control" value ="<?php echo $productId; ?>" />
          
            <p> ชื่อสินค้า</p>
            <input type="text"  name="pd_name" class="form-control" value ="<?php echo $pd_name; ?>" />
    
            <p> เลขที่ใบเสร็จ </p>
            <input type="text"  name="re_no" class="form-control"  rows="3"  required placeholder="เลขที่ใบเสร็จ">
            <p>จำนวน</p>
            <input type="text"  name="qty" class="form-control" required placeholder="จำนวน" />
    
             <!-- <?php  date_default_timezone_set('Asia/Bangkok');
              $datenow = time();?>
      <p>วันเดือนปี</p> 
     <input name="re_date" type="date" class="box" id="txtUserTransfer" value="<?php echo $datenow; ?>"size="32" maxlength="32">-->
            <p>
            <button > เพิ่มสินค้า </button>
            </p>
         
      </form>
 
 
    
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="Modify Product" onClick="checkAddProductForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="Cancel" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>