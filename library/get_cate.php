<?php
require_once 'config.php';
$category = array();
$sql = "select cat_name from tbl_category";
$result = dbQuery($sql);
while ($row = mysql_fetch_assoc($result)) {
        //array_push($gg,$row['cat_id']);
        $category[] = $row['cat_name'];
    }
$jsonData = json_encode($category); 
 echo $jsonData;
?>