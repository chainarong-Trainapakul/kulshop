<?php

session_start();

// database connection config
$dbHost = 'localhost';
$dbUser = 'kulkul';
$dbPass = '12345678';
$dbName = 'kaset3';
function deleteAbandonedCart()
{
    date_default_timezone_set("Asia/Bangkok");
	$yesterday= date('Y-m-d H:i:s', mktime(0,0,0, date('m'), date('d') - 3, date('Y')));
	$sql = "DELETE FROM tbl_cart
	        WHERE ct_date < '$yesterday'";
	dbQuery($sql);		
}


            <input type="button" name="button3" id="button3" value="ยกเลิกการส่งสินค้า" ?>'" />
          
            
?>