<?php
//include '../library/config.php'
/*$con= mysqli_connect('localhost','root','','kaset3') or die("Error: " . mysqli_error($con));
$NUM = 1000 ;
$sql = "SELECT * FROM tbl_order";
$result = mysql_query("SELECT * FROM tbl_order");
$row = mysql_fetch_row($result);
echo $row[0];*/
mysqli_connect("localhost", "root", "","kaset3");  
mysql_select_db("kaset3");  
$result = mysql_query("select * from tbl_order");  
$row = mysql_fetch_row($result);  
echo $row[1];  
?>
WHERE oi.pd_id = p.pd_id and o.od_id = oi.od_id