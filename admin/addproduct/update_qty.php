<?php
//insert.php;

if(isset($_POST["item_name"]))
{
 $product_name = $_POST["item_name"];
 $product_id = $_POST["item_no"];
 $product_qty = $_POST["item_quantity"];
 $bill_no = $_POST['bill_no'];
 date_default_timezone_set("Asia/Bangkok");
 $current_date = date('Y-m-d H:i:s');
    echo $bill_no ;
   // echo $product_name[0];
    echo $product_id[0];
    echo $product_qty[0];
 //$connect = new PDO("mysql:host=localhost;dbname=kaset3", "root", "password");
    $dbConn = mysql_connect ('localhost', "root", "password") or die ('MySQL connect failed. ' . mysql_error());
mysql_select_db("kaset3") or die('Cannot select database. ' . mysql_error());
mysql_query("SET NAMES UTF8");
 $order_id = uniqid();
    
 for($count = 0; $count < count($_POST["item_name"]); $count++)
 {  
  $query = "UPDATE tbl_product
  set pd_qty = pd_qty + '$product_qty[$count]'
  where pd_id = '$product_id[$count]'";
  $result = mysql_query($query) or die(mysql_error());
  $query = "Insert into tbl_receipt_product(receipt_no,product_id,quantity) values ('$bill_no','$product_id[$count]','$product_qty[$count]')";
  $resultss =  mysql_query($query) or die(mysql_error());  
  //$statement = $connect->prepare($query);
  /*$statement->execute(
   array(
    ':order_id'   => 999999,
    ':item_name'  => $_POST["item_name"][$count], 
    ':item_quantity' => $_POST["item_quantity"][$count],
    ':item_no'=> $_POST["item_no"][$count]
   )
  );*/
 }
    
    $query = "Insert into tbl_receipt_date(receipt_no,date) values('$bill_no','$current_date')" ;
    $results = mysql_query($query) or die(mysql_error());

 //$result = $statement->fetchAll();
 if(isset($result)&&isset($results)&&isset($resultss))
 {
  echo 'ok';
 }
}
?>