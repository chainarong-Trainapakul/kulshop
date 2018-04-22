<?php 
require_once 'config.php';
if(isset($_POST['data'])){
    $user_id_name = $_POST['data'];
    query_user($user_id_name);
}
function query_user($user_id_name){
 $sql = "select user_name from tbl_user where user_name = '$user_id_name'" ;
  $result = dbQuery($sql);
  if(dbNumRows($result)>=1){
      echo 'true' ;
  }
    else{
        echo 'false'   ;
    }
}
?>