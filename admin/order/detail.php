<?php
//require_once '../library/process_ems.php';
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
$sql2 = "select * from tbl_payment where od_id = '$orderId' order by od_date DESC";
$result2 = dbQuery($sql2);
$payto = array();
$time_transection =array();
$pic = array();
while($row = dbFetchAssoc($result2)){
    $payto[] = $row['od_bank'];
    $time_transection[] = $row['od_date'];
    $pic[] = $row['upload_pic'];
}
$result = dbQuery($sql);
extract(dbFetchAssoc($result));
//กรณีต้องการเปลี่ยนสถานะของใบสั่งซื้อ ให้กำหนด Drop down list แสดงสถานะที่สามารถเปลี่ยนได้
$orderStatus = array('สั่งซื้อ', 'ชำระเงินเรียบร้อย', 'เตรียมการจัดส่ง', 'จัดส่งเรียบร้อย', 'ยกเลิก');
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
<form action="" method="post" name="frmOrder" id="frmOrder">
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
                    <?php echo $orderOption; ?> </select> <input name="btnModify" type="submit" id="btnModify" value="ยืนยัน" class="box" onClick="modifyOrderStatus(<?php echo $orderId; ?>);"></td>
        </tr>
        <tr>
            <td width="150" class="label">เลขพัสดุ</td>
            <td class="content"><input name="txtid" type="text" class="box" id="txtid" size="15" maxlength="15">
            <input name="btnSubmit" type="submit" id="btnSubmit" value="ยืนยัน"  class="box"></td>
<script>
/*        function submitParcelNo(){
            var string = document.getElementById("txtid").value.toString();
          <?php 
            /*$parcelNo = $_POST['txtid'];
            //$orderId = 1000;
            $sql = "UPDATE tbl_order SET od_parcelno = '$parcelNo', od_last_update = NOW() WHERE od_id = '$orderId'";*/
	//อัพเดทสถานะในฐานข้อมูล
        $result = dbQuery($sql);   ?>
            window.location.href = 'index.php';
        }*/
</script>     
        </tr>
    </table>
</form>


</form>
<p>&nbsp;</p>
<table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
    <tr id="infoTableHeader"> 
        <td colspan="3">รายการ</td>
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
<form action="" method="post" name="frmOrder" id="frmOrder">
    <table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
<tr id="infoTableHeader"> 
        <td colspan="3">การทำรายการ</td>
    </tr>
   <tr class="content"> 
        <td colspan="2" align="right">โอนมาที่</td>
        <td align="right"><?php if($payto[0] == "เลือกธนาคาร"){echo "-";}else{echo $payto[0];} ?></td>
    </tr>
           <tr class="content"> 
        <td colspan="2" align="right">วันที่ทำรายการ</td>
        <td align="right"><?php echo $time_transection[0]; ?></td>
    </tr>
        <tr class="content"> 
        <td colspan="2" align="right">หลักฐานการโอนเงิน</td>
        <td align="right"><?php if($pic[0] == ""){echo "-";}else{ echo '<a href="../../'.$pic[0].'">ดูหลักฐานการโอนเงิน</a>';} ?></td>
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


<!--INPUT EMS-->
<?php 
if(isset($_POST['txtid'])){
    $parcelNo = $_POST['txtid'];
    if($parcelNo  != '' || $parcelNo != null){
            //$orderId = 1000;
            $sql = "UPDATE tbl_order SET od_parcelno = '$parcelNo', od_last_update = NOW() WHERE od_id = '$orderId'";
	//อัพเดทสถานะในฐานข้อมูล
        $result = dbQuery($sql);   
    echo "<script>alert('ใส่รหัส EMS เรียบร้อยแล้ว')</script>";
    echo "<script>window.location.href = 'index.php'</script>";
    }
}
if(isset($_POST['btnModify'])){
    $cancle = $_POST['cboOrderStatus'];
    echo $cancle ;
    //echo "<script>modifyOrderStatus('$orderId');</script>";
    //echo "<script>alert('$cancle');</script>";
    if ($cancle == "ยกเลิก" ){
        //echo '<script>alert("gg")</script>';
        $sql = "Select * from tbl_order_item where od_id = '$orderId'";
        $result = dbQuery($sql);
        //echo $result;
        while ($row = mysql_fetch_assoc($result)) {
            $pd_id = $row["pd_id"];
            $od_qty= $row["od_qty"];
            $sql_update = "update tbl_product SET pd_qty = pd_qty+'$od_qty' where pd_id = '$pd_id'";
            dbQuery($sql_update);
}
        
    }
        echo "<script>window.location.href = 'processOrder.php?action=modify&oid=' + '$orderId' + '&status=' + '$cancle';</script>";
}
?>