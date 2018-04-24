<?php 
require_once 'config.php';
if(isset($_POST['data'])){
    $user_id_name = $_POST['data'];
    //query_user($user_id_name);
}
/*function query_user($user_id_name){
    echo $user_id_name;
$sql = "select cat_id from tbl_category where cat_name ='$user_id_name'"   ; 
    
  $result = dbQuery($sql);*/
    //return $result ;
?>