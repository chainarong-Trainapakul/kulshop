<?php 
require_once 'config.php';
function check_expire_order(){
    date_default_timezone_set("Asia/Bangkok");
    $user_id = $_SESSION['plaincart_customer_id'];
    $sql = "select  od_id,user_id,od_exp_date,od_status from tbl_order where user_id = '$user_id' and od_status != 'ยกเลิก'";
    $result = dbQuery($sql);
    $exp_hour = date('H');
    $exp_minute = date('i');
    $current_date = date('Y-m-d H:i:s', mktime($exp_hour,$exp_minute,0, date('m'), date('d'), date('Y')));
    while($row = dbFetchAssoc($result)){
        if ($row['od_exp_date'] < $current_date ){
            $temp = $row['od_id'];
           /* echo "<script> alert('expire date < current_date');</script>";*/
            $sql = "update tbl_order set od_status = 'ยกเลิก' where od_id = '$temp'";
            dbQuery($sql);
            $sql = "select * from tbl_order_item where od_id = $temp";
            $results = dbQuery($sql);
            while($row_od_item = dbFetchAssoc($results) ){
                $pd_id = $row_od_item['pd_id'];
                $od_qty= $row_od_item["od_qty"];
                $sql_update = "update tbl_product SET pd_qty = pd_qty+'$od_qty' where pd_id = '$pd_id'";
                dbQuery($sql_update);
            }
        }
        
    }
}
?>