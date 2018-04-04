<?php
if (!defined('WEB_ROOT')) {
	exit;
}

//ตรวจสอบเพื่อให้แน่ใจว่ามีการส่งรหัสใบสั่งซื้อมาด้วย
if (!isset($_GET['oid']) || (int)$_GET['oid'] <= 0) {
	header('Location: index.php');
}

$orderId = (int)$_GET['oid'];

//แสดงรายการสินค้าที่ได้สั่งซื้อ
$sql = "SELECT pd_name, pd_price, od_qty
	    FROM tbl_order_item oi, tbl_product p 
		WHERE oi.pd_id = p.pd_id and oi.od_id = $orderId
		ORDER BY od_id ASC";

$result = dbQuery($sql);
$orderedItem = array();
while ($row = dbFetchAssoc($result)) {
	$orderedItem[] = $row;
}

//ดึงข้อมูลการสั่งสินค้า ตามเลขที่ใบสั่งสินค้าที่ได้มา ซึ่งในที่นี้คือ $orderId
$sql = "SELECT od_date, od_last_update, od_status, od_shipping_first_name, od_shipping_last_name, od_shipping_address1, 
               od_shipping_address2, od_shipping_phone, od_shipping_state, od_shipping_city, od_shipping_postal_code, od_shipping_cost, 
			   od_payment_first_name, od_payment_last_name, od_payment_address1, od_payment_address2, od_payment_phone,
			   od_payment_state, od_payment_city , od_payment_postal_code,od_parcelno,
			   od_memo
	    FROM tbl_order 
		WHERE od_id = $orderId";

$result = dbQuery($sql);
extract(dbFetchAssoc($result));
//กรณีต้องการเปลี่ยนสถานะของใบสั่งซื้อ ให้กำหนด Drop down list แสดงสถานะที่สามารถเปลี่ยนได้
$orderStatus = array('New', 'Paid', 'Shipped', 'Completed', 'Cancelled');
$orderOption = '';
foreach ($orderStatus as $status) {
	$orderOption .= "<option value=\"$status\"";
	if ($status == $od_status) {
		$orderOption .= " selected";
	}
	
	$orderOption .= ">$status</option>\r\n";
}
?>
<p>&nbsp;</p>
<form action="" method="get" name="frmOrder" id="frmOrder">
    <table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
        <tr> 
            <td colspan="2" align="center" id="infoTableHeader">รายการสั่งซื้อ</td>
        </tr>
        <tr> 
            <td width="150" class="label">รหัสใบสั่งซื้อ</td>
            <td class="content"><?php echo $orderId; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">วันที่สั่งซื้อ</td>
            <td class="content"><?php echo $od_date; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">วันที่เสร็จสิ้น</td>
            <td class="content"><?php echo $od_last_update; ?></td>
        </tr>
        <tr> 
            <td class="label">สถานะ</td>
            <td class="content"> <select name="cboOrderStatus" id="cboOrderStatus" class="box">
                    <?php echo $orderOption; ?> </select> <input name="btnModify" type="button" id="btnModify" value="ยืนยัน" class="box" onClick="modifyOrderStatus(<?php echo $orderId; ?>);"></td>
        </tr>
        <tr>
            <td width="150" class="label">เลขพัสดุ</td>
            <td class="content"><input name="txtid" type="text" class="box" id="txtid" size="15" maxlength="15">
            <input name="btnSubmit" type="button" id="btnSubmit" value="ยืนยัน"  class="box" onClick="submitParcelNo();"></td>
<script>
        function submitParcelNo(){
          <?php 
            $parcalNo = $_GET['txtid'];
            $sql = "UPDATE tbl_order
            SET od_parcelno = '$parcelNo', od_last_update = NOW()
            WHERE od_id = $orderId";
	//อัพเดทสถานะในฐานข้อมูล
        $result = dbQuery($sql);   ?>
            window.location.href = 'index.php';
        }
</script>     
        </tr>
    </table>
</form>

<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="3">Ordered Item</td>
    </tr>
    <tr align="center" class="label"> 
        <td>จำนวน/ชื่อสินค้า</td>
        <td>ราคา</td>
        <td>รวม</td>
    </tr>
    <?php
$numItem  = count($orderedItem);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($orderedItem[$i]);
	$subTotal += $pd_price * $od_qty;
?>
    <tr class="content"> 
        <td><?php echo "$od_qty X $pd_name"; ?></td>
        <td align="right"><?php echo displayAmount($pd_price); ?></td>
        <td align="right"><?php echo displayAmount($od_qty * $pd_price); ?></td>
    </tr>
    <?php
}
?>
    <tr class="content"> 
        <td colspan="2" align="right">รวมย่อย</td>
        <td align="right"><?php echo displayAmount($subTotal); ?></td>
    </tr>
    <tr class="content"> 
        <td colspan="2" align="right">ค่าขนส่ง</td>
        <td align="right"><?php echo displayAmount($od_shipping_cost); ?></td>
    </tr>
    <tr class="content"> 
        <td colspan="2" align="right">รวมสุทธิ</td>
        <td align="right"><?php echo displayAmount($od_shipping_cost + $subTotal); ?></td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">ข้อมูลของผู้รับสินค้า</td>
    </tr>
    <tr> 
        <td width="150" class="label">ชื่อ</td>
        <td class="content"><?php echo $od_shipping_first_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">นามสกุล</td>
        <td class="content"><?php echo $od_shipping_last_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">ที่อยู่</td>
        <td class="content"><?php echo $od_shipping_address1; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">ตำบล</td>
        <td class="content"><?php echo $od_shipping_address2; ?> </td>
    </tr>
   <tr> 
        <td width="150" class="label">เขต/อำเภอ</td>
        <td class="content"><?php echo $od_shipping_city; ?> </td>
    </tr>
     <tr> 
        <td width="150" class="label">จังหวัด</td>
        <td class="content"><?php echo $od_shipping_state; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">รหัสไปรษณีย์</td>
        <td class="content"><?php echo $od_shipping_postal_code; ?> </td>
    </tr>
     <tr> 
        <td width="150" class="label">เบอร์โทรศัพท์</td>
        <td class="content"><?php echo $od_shipping_phone; ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">ข้อมูลของผู้ชำระค่าสินค้า</td>
    </tr>
    <tr> 
        <td width="150" class="label">ชื่อ</td>
        <td class="content"><?php echo $od_payment_first_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">นามสกุล</td>
        <td class="content"><?php echo $od_payment_last_name; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">ที่อยู่</td>
        <td class="content"><?php echo $od_payment_address1; ?> </td>
    </tr>
    <tr> 
        <td width="150" class="label">ตำบล</td>
        <td class="content"><?php echo $od_payment_address2; ?> </td>
    </tr>
   <tr> 
        <td width="150" class="label">เขต/อำเภอ</td>
        <td class="content"><?php echo $od_payment_city; ?> </td>
    </tr>
   <tr> 
        <td width="150" class="label">จังหวัด</td>
        <td class="content"><?php echo $od_payment_state; ?> </td>
    </tr> 
    <tr> 
        <td width="150" class="label">รหัสไปรษณีย์</td>
        <td class="content"><?php echo $od_payment_postal_code; ?> </td>
    </tr>
     <tr> 
        <td width="150" class="label">เบอร์โทรศัพท์</td>
        <td class="content"><?php echo $od_payment_phone; ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="2">บันทึกช่วยจำ</td>
    </tr>
    <tr> 
        <td colspan="2" class="label"><?php echo nl2br($od_memo); ?> </td>
    </tr>
</table>
<p>&nbsp;</p>
<p align="center"> 
    <input name="btnBack" type="button" id="btnBack" value="ย้อนกลับ" class="box" onClick="window.history.back();">
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>