<?php 
require_once 'config.php';
$product = array();
if(isset($_POST['data'])){
    $user_id_name = $_POST['data'];
    query_user($user_id_name);
    //echo $user_id_name ;
}
function query_user($user_id_name){
$sql = "select cat_id from tbl_category where cat_name ='$user_id_name'"  ; 
$result = dbQuery($sql);
$cat =""  ;   

    while ($row = mysql_fetch_assoc($result)) {
        //array_push($gg,$row['cat_id']);
        $cat = $row['cat_id'];
    }
$sql = "select pd_name from tbl_product where cat_id = '$cat'"   ; 
    $result = dbQuery($sql);
    while ($row = mysql_fetch_assoc($result)) {
        $product[] = $row['pd_name'];
        
    }
    $jsonData = json_encode($product); 
 return $jsonData;
}
?>