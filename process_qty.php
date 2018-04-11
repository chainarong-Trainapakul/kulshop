<?php
//require_once '/library/database.php';
require_once 'library/config.php';
$tran = 100 ;
$qty = 0 ; 
    $dbConn = mysql_connect ($dbHost, $dbUser, $dbPass) or die ('MySQL connect failed. ' . mysql_error());
    mysql_select_db($dbName) or die('Cannot select database. ' . mysql_error());
    $sql = "select * from tbl_cart" ;
    $result = mysql_query($sql) or die(mysql_error());

    //echo $result;    
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $qty = $qty + (int)$row["ct_qty"];
        //echo $row["ct_qty"];
}
    //echo "\n qty : ",$qty;
 if($qty == 1){
     $tran = 100;
 }
else{
    $tran =$tran+($qty-1)*40 ;
}
    //echo "\n tran : ",$tran;
?>