<?php
if (!defined('WEB_ROOT')) {
	exit;
}

// make sure a product id exists
if (isset($_GET['productId']) && $_GET['productId'] > 0) {
	$productId = $_GET['productId'];
} else {
	// redirect to index.php if product id is not present
	header('Location: index.php');
}

$sql = "SELECT tbl_category.cat_name, tbl_product.pd_name, tbl_product.pd_description, tbl_product.pd_price, tbl_product.pd_qty, tbl_product.pd_image, tbl_receipt_product.receipt_no, tbl_receipt_product.quantity, tbl_receipt_date.date 
FROM tbl_product INNER JOIN tbl_category ON tbl_product.pd_id = $productId AND tbl_product.cat_id = tbl_category.cat_id INNER JOIN tbl_receipt_product ON tbl_product.pd_id = tbl_receipt_product.product_id INNER JOIN tbl_receipt_date ON tbl_receipt_product.receipt_no = tbl_receipt_date.receipt_no ORDER BY tbl_receipt_date.date DESC
"
        ;
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());

$row = mysql_fetch_assoc($result);
//extract($row);
    $cat_name = $row['cat_name'];
    $pd_name = $row['pd_name'];
    $re_no = $row['receipt_no'];
    $qty = $row['quantity'];
    $re_date = $row['date'];
//if ($pd_image) {
//	$pd_image = WEB_ROOT . 'images/product/' . $pd_image;
//} else {
//	$pd_image = WEB_ROOT . 'images/no-image-large.png';
//}

//$sql2 = "SELECT tbl_receipt_product.receipt_no, tbl_receipt_product.quantity, tbl_receipt_date.date
//FROM tbl_receipt_product
//INNER JOIN tbl_receipt_date ON tbl_receipt_product.receipt_no = tbl_receipt_date.receipt_no;"
//$result2 = mysql_query($sql2) or die('Cannot get product. ' . mysql_error());
//$row2 = mysql_fetch_assoc($result2);
//extract($row2);
//    $re_no = $row2['tbl_receipt_product.receipt_no'];
//    $qty = $row2['tbl_receipt_product.quantity'];
//    $re_date = $row2['tbl_receipt_date.date'];

?>
<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
 <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr> 
   <td width="150" class="label">ประเภทสินค้า</td>
   <td class="content"><?php if($cat_name==null){echo "ไม่มีข้อมูล";}else echo $cat_name; ?></td>
  </tr>
  <tr> 
   <td width="150" class="label">ชื่อสินค้า</td>
   <td class="content"> <?php if($pd_name==null){echo "ไม่มีข้อมูล";}else echo $pd_name; ?></td>
  </tr>
     <tr> 
   <td width="150" class="label">รหัสสินค้า</td>
   <td class="content"> <?php echo $productId; ?></td>
  </tr>
      <tr> 
   <td width="150" class="label">เลขที่ใบเสร็จ</td>
   <td class="content"> <?php if($re_no==null){echo "ไม่มีข้อมูล";}else echo $re_no; ?></td>
   </tr>
    <tr> 
   <td width="150" class="label">จำนวน</td>
   <td class="content"> <?php if($qty==null){echo "ไม่มีข้อมูล";}else echo $qty; ?></td> 
     </tr>
<tr>
     <td width="15%" align="center">วันเดือนปี </td> 
    	<td class="content"> <?php if($re_date==null){echo "ไม่มีข้อมูล";}else echo $re_date; ?></td>
       </tr> 

 </table>
 <p align="center"> 
  <input name="btnModifyProduct" type="button" id="btnModifyProduct" value="แก้ไข" onClick="window.location.href='index.php?view=modify&productId=<?php echo $productId; ?>';" class="box">
  &nbsp;&nbsp;
  <input name="btnBack" type="button" id="btnBack" value=" ย้อนกลับ " onClick="window.history.back();" class="box">
 </p>
</form>
