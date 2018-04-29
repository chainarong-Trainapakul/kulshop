<?php 
require_once 'library/config.php';
    $sid = session_id();
	$sql = "SELECT ct_id, ct.pd_id, ct_qty, pd_name, pd_price, pd_thumbnail, pd.cat_id, pd.pd_qty
			FROM tbl_cart ct, tbl_product pd, tbl_category cat
			WHERE ct_session_id = '$sid' AND ct.pd_id = pd.pd_id AND cat.cat_id = pd.cat_id ";
   $result = dbQuery($sql);     
    while ($row = dbFetchAssoc($result)) {
		if ($row['pd_thumbnail']) {	//นำเอาภาพ thumbnail ออกมา
			$row['pd_thumbnail'] = WEB_ROOT . 'images/product/' . $row['pd_thumbnail'];
		} else {		//ถ้าไม่มี thumbnail ใช้รูปที่เตรียมไว้แทน
			$row['pd_thumbnail'] = WEB_ROOT . 'images/no-image-small.png';
		}
		$cartContent[] = $row;	//นำข้อมูลจากฐานข้อมูลเก็บเข้า array
	}
$numItem  = count($cartContent);
$subTotal = 0;
for ($i = 0; $i < $numItem; $i++) {
	extract($cartContent[$i]);
	$subTotal += $pd_price * $ct_qty;

}


?>