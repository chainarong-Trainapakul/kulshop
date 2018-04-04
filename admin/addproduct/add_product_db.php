<?php
$con= mysqli_connect("localhost","kulkul","12345678","kaset3") or die("Error: " . mysqli_error($con));
 
mysqli_query($con, "SET NAMES 'utf8' ");
 
?>

 <?php  date_default_timezone_set('Asia/Bangkok');
              $datenow = time();?>
<?php 
include('condb.php');

	
	//รับชื่อไฟล์จากฟอร์ม 
    $in_renum =  $_REQUEST["in_renum"];
    $pd_id =  $_REQUEST["pd_id"];
	$warehouse =  $_REQUEST["warehouse"];
    $in_renum =  $_REQUEST["in_renum"];
	$re_date =  date("Y-m-d H:i:s");
	
$sql = "INSERT INTO tb_instock (in_renum,pd_id,warehouse) 
        VALUES('$in_renum', '$pd_id', '$warehouse')";
$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

$sql = "INSERT INTO tbl_reference(in_renum,re_date)
			 VALUES('$in_renum','$re_date')";
	$result = mysqli_query($con, $sql) or die ("Error in query: $sql " . mysqli_error());

mysqli_close($con);

	if($result){
	echo "<script type='text/javascript'>";
	echo "alert('Save Succesfuly');";
	echo "window.location = 'add_product.php'; ";
	echo "</script>";
	}
	else{
	echo "<script type='text/javascript'>";
	echo "alert('Error!!');";
	echo "</script>";
}
?>
