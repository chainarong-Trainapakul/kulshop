<?php
if (!defined('WEB_ROOT')) {
	exit;
}

$catId = (isset($_GET['catId']) && $_GET['catId'] > 0) ? $_GET['catId'] : 0;

$categoryList = buildCategoryOptions($catId);
?> 
<p>&nbsp;</p>
<form action="processProduct.php?action=addProduct" method="post" enctype="multipart/form-data" name="frmAddProduct" id="frmAddProduct">
  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" class="entryTable">
  <tr><td colspan="2" id="entryTableHeader">เพิ่มจำนวนสินค้าเข้าสต๊อก</td></tr>
  <tr> 
   <td width="150" class="label">ประเภทสินค้า</td>
   <td class="content"> <select name="cboCategory" id="cboCategory" class="box">
     <option value="" selected>-- เลือกประเภทสินค้า --</option>
<?php
	echo $categoryList;		//แสดงรายชื่อประเภทสินค้าในแบบ Dropdown list
?>	 
    </select></td>
  </tr>
  <tr> 
   <td width="150" class="label">ชื่อสินค้า</td>
   <td class="content"> <input name="txtName" type="text" class="box" id="txtName" size="50" maxlength="100"></td>
  </tr>
     <tr>
    <td width="150" class="label">รหัสสินค้า</td>  
      <td class="content"> <input name="txtid" type="text" class="box" id="txtid"  size="50" maxlength="100"></td>
  </tr>  
   <tr> 
   <td width="150" class="label">เลขที่ใบเสร็จ</td>
   <td class="content"> <textarea name="txtre" class="box" id="txtre" value="<?php echo $in_renum; ?>" size="50"maxlength="100"></textarea></td>
   </tr>
   
  <tr> 
   <td width="150" class="label">เพิ่มสินค้าเข้า</td>
   <td class="content"> <textarea name="txtadd" class="box" id="txtadd" value="<?php echo $warehouse; ?>" size="50"maxlength="100"></textarea></td>
   </tr>
  <div class="form-group">
          <div class="col-sm-3">
              <?php  date_default_timezone_set('Asia/Bangkok');
              $datenow = time();?>
     <td width="15%" align="center">วันเดือนปี </td> 
    	<td class="content"> <input name="re_date" type="date" class="box" id="txtUserTransfer" value="<?php echo $datenow; ?>"size="32" maxlength="32"></td>
         </div></div> 
 </table>
 <p align="center"> 
  <input name="btnAddProduct" type="button" id="btnAddProduct" value="บันทึกข้อมูล" onClick="checkAddProductForm();" class="box">
  &nbsp;&nbsp;<input name="btnCancel" type="button" id="btnCancel" value="ยกเลิก" onClick="window.location.href='index.php';" class="box">  
 </p>
</form>
