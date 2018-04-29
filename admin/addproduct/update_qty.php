<?php
//insert.php;

if(isset($_POST["item_no"]))
{
 require_once '../../library/config.php';
 //$product_name = $_POST["item_name"];
 $product_id = $_POST["item_no"];
 $product_qty = $_POST["item_quantity"];
 $bill_no = $_POST['bill_no'];
 date_default_timezone_set("Asia/Bangkok");
 $current_date = date('Y-m-d H:i:s');
    //echo $bill_no ;
   // echo $product_name[0];
   // echo $product_id[0];
   // echo $product_qty[0];
 //$connect = new PDO("mysql:host=localhost;dbname=kaset3", "root", "password");
    $dbConn = mysql_connect ($dbHost, $dbUser,$dbPass) or die ('MySQL connect failed. ' . mysql_error());
mysql_select_db($dbName) or die('Cannot select database. ' . mysql_error());
mysql_query("SET NAMES UTF8");
 $order_id = uniqid();
    
 for($count = 0; $count < count($_POST["item_no"]); $count++)
 {  
  $query = "UPDATE tbl_product
  set pd_qty = pd_qty + '$product_qty[$count]'
  where pd_id = '$product_id[$count]'";
  $result = mysql_query($query) or die(mysql_error());
     //echo $result ;
  $query = "Insert into tbl_receipt_product(receipt_no,product_id,quantity) values ('$bill_no','$product_id[$count]','$product_qty[$count]')";
  $resultss = '';
    if(!mysql_query($query)){
          $resultss =  mysql_query($query) or die(header("HTTP/1.0 404 Not Found"));
     }
 
 
 }
    //echo $resultss;
    $query = "Insert into tbl_receipt_date(receipt_no,date) values('$bill_no','$current_date')" ;
    $results = mysql_query($query) or die(mysql_error());
    
 //$result = $statement->fetchAll();
 if(isset($result)&&isset($results)&&isset($resultss))
 {
  echo 'ok';
 }
 else{
     echo "result: ".$result;
 }
}
?>