<?php 
if(isset($_POST['data'])){
    $pd_id = $_POST['data'];
    require_once '../../library/config.php';
    $sql = "select pd_name from tbl_product where pd_id = '$pd_id'";
    $result = dbQuery($sql);
    $pd_name = '';
    while($row = mysql_fetch_assoc($result)){
        $pd_name = $row['pd_name'];
    }
    if ($pd_name != ''){
        echo $pd_name ;
    }
    else {
        echo "no_query";
    }
}
?>