<?php
if(isset($_GET['cate'])){
    $product = array();
    require_once 'config.php';
    $cate = $_GET['cate'];
    $sql = "select cat_id from tbl_category where cat_name = '$cate'";
    $result = dbQuery($sql);
    while ($row = mysql_fetch_assoc($result)) {
        //array_push($gg,$row['cat_id']);
        $cat_id = $row['cat_id'];
    }
    $sql = "select pd_name from tbl_product where cat_id = '$cat_id'";
    $result = dbQuery($sql);
    while ($row = mysql_fetch_assoc($result)) {
        $product[] = $row['pd_name'];
        
    }
     $jsonData = json_encode($product); 
 echo $jsonData;
}

?>