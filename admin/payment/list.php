
<?php
if (!defined('WEB_ROOT')) {
	exit;
}

require_once '../../library/category-functions.php';

if (isset($_GET['catId']) && (int)$_GET['catId'] > 0) {
//SQL กรณีมีการเลือกประเภทสินค้า
	$catId = (int)$_GET['catId'];
	$children = array_merge(array($catId), getChildCategories(NULL, $catId));
	$children = ' (' . implode(', ', $children) . ')';
	$sql2 = "WHERE c.cat_id = $catId AND pd.cat_id IN $children";
	$queryString = "catId=$catId";
} else {	//SQL กรณีไม่มีการเลือกประเภทสินค้า
	$catId = 0;
	$sql2  = 'WHERE c.cat_id = pd.cat_id';
	$queryString = "catId=$catId";
}

//สำหรับแบ่งประเภทสินค้าออกเป็นหลายๆ หน้า
//กำหนดจำนวนแถวต่อหนึ่งหน้า
$rowsPerPage = 5;

		
/*$sql = "SELECT pd_id, pd_name, pd_price, pd_thumbnail, pd_qty, c.cat_id, c.cat_name
		FROM tbl_product pd, tbl_category c
		$sql2 
		ORDER BY pd_name";*/
//$sql = "sELECT * from tbl_payment " ;	
$sql = 'SELECT * FROM tbl_order INNER JOIN tbl_payment ON tbl_payment.od_id = tbl_order.od_id and tbl_order.od_status = "สั่งซื้อ"';
//คิวรี่ข้อมูลจากตาราง โดยจะแสดงสินค้าเฉพาะหน้าซึ่งได้คลิกเลือก แต่ถ้าไม่มีการกำหนดเลขหน้า 
//จะไปยังหน้าแรก
$result     = dbQuery(getPagingQuery($sql, $rowsPerPage));
//สร้างลิงก์สำหรับไปยังหน้าต่างๆ  
$pagingLink = getPagingLink($sql, $rowsPerPage, $queryString);

//เก็บรายชื่อประเภทสินค้าทั้งหมด 
$categoryList = buildCategoryOptions($catId);

?> 
<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post"  name="frmListProduct" id="frmListProduct">
 <table width="100%" border="0" cellspacing="0" cellpadding="2" class="text">
  <tr>
   <!--<td align="right">ประเภทสินค้า : 
    <select name="cboCategory" class="box" id="cboCategory" onChange="viewProduct();">
     <option selected>เลือกประเภทสินค้า</option>
	<?/*php echo $categoryList; */?>
   </select>
 </td>-->
 </tr>
</table>
<br>
 <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" class="text">
  <tr align="center" id="listTableHeader"> 
   <td width="70">เลขที่บิล</td>
   <td width="125">ชื่อ</td>
   <td width="75">เบอร์โทรศัพท์</td>
   <td width="70">Email</td>
   <td width="70">โอนเงินมาที่</td>
   <td width="70">วันที่โอน</td>
   <td width="70">โอนมาที่</td>
  </tr>
  <?php
if (dbNumRows($result) > 0) {
     $i = 0;
while ($row = mysql_fetch_assoc($result)) {
/*    echo $row["userid"];
    echo $row["fullname"];
    echo $row["userstatus"];*/
    if ($i%2) {
			$class = 'row1';
		} else {
			$class = 'row2';
		}
		
		$i += 1;
    
    ?>
    <tr class="<?php echo $class; ?>"> 
        <td><a href="../order/index.php?view=detail&oid=<?php echo $row['od_id']; ?>"><?php echo $row['od_id'];?></a></td>
        <td><?php echo $row['od_shipping_first_name'];?></td>
        <td><?php echo $row['od_payment_phone'];?></td>
        <td><?php echo $row['od_payment_email'];?></td>
        <td><?php echo $row['od_bank'];?></td>
        <td><?php echo $row['od_date'];?></td>
        <td><?php echo $row['od_amount'];?></td>
    </tr>    




  <?php
	} //สิ้นสุดลูป while*/   
?>
  <tr> 
   <td colspan="5" align="center">
   <?php 
echo $pagingLink;	//แสดงลิงก์ เพื่อเปลี่ยนหน้า
   ?></td>
  </tr>
<?php	
} else {
?>
  <tr> 
      <td colspan="8" align="center" ><font color ="red" size = 5><br>ไม่มีรายการ</font></td>
  </tr>
  <?php
}
?>
  <tr> 
   <td colspan="5">&nbsp;</td>
  </tr>
  <!--<tr> 
   <td colspan="5" align="right"><input name="btnAddProduct" type="button" id="btnAddProduct" value="เพิ่มสินค้า" class="box" onClick="addProduct(<?php echo $catId; ?>)"></td>
  </tr>-->
 </table>
 <p>&nbsp;</p>
</form>