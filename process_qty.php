<?php
//require_once '/library/database.php';
require_once 'library/config.php';
$tran = 100 ;
$qty = 0 ; 
    $ss_id = session_id();
    $dbConn = mysql_connect ($dbHost, $dbUser, $dbPass) or die ('MySQL connect failed. ' . mysql_error());
    mysql_select_db($dbName) or die('Cannot select database. ' . mysql_error());
    $sql = "select * from tbl_cart where ct_session_id = '$ss_id'" ;
    $result = mysql_query($sql) or die(mysql_error());
    //echo $result;   
$qty =0 ; 
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $qty = $qty + (int)$row["ct_qty"];
        //echo $row["ct_qty"];
}

//echo "<script>alert('$qty');<\script>";
 if($qty > 1 ){
     $tran =$tran+(($qty-1)*40);
 }
 else if($qty == 1){
     $tran = 100;
 }


    //echo "\n tran : ",$tran;
?>