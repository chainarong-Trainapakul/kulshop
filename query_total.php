<?php
if(isset($_POST['data'])){
    require_once "library/config.php";
    $od_id = $_POST['data'];
    $total = '';
    $sql = "Select od_total from tbl_order where od_id = '$od_id'";
    $result = dbQuery($sql);
    while($row = mysql_fetch_assoc($result)){
        $total = $row['od_total'];
    }
    if($total != ""){
        echo $total ;
    }
    else{
        echo "ไม่มีรายการ" ;
    }
}





?>