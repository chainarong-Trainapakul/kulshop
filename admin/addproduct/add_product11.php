<?php require_once('Connections/connection.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_connection, $connection);
$query_Recordset1 = "SELECT * FROM tbl_product";
$Recordset1 = mysql_query($query_Recordset1, $connection) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$con= mysqli_connect("localhost","kulkul","12345678","kaset3") or die("Error: " . mysqli_error($con));
 
mysqli_query($con, "SET NAMES 'utf8' ");
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ร้านชัยสิทธิ์เกษตร</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
 
<body>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> ฟอร์มเพิ่มสินค้า </h4>
      <hr />
      <form action="add_product_db.php" method="POST" enctype="multipart/form-data"  name="addprd" class="form-horizontal" id="addprd">
            <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสสินค้า</p>
            <input  name="pd_id" type="text" required class="form-control" placeholder="รหัสสินค้า" value="<?php echo $row_Recordset1['pd_id']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> ชื่อสินค้า</p>
            <input  name="pd_name" type="text" required class="form-control" placeholder="ชื่อสินค้า" value="<?php echo $row_Recordset1['pd_name']; ?>" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> เลขที่ใบเสร็จ </p>
            <textarea name="in_renum" class="form-control"  rows="3"  required placeholder="เลขที่ใบเสร็จ"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-3">
            <p><td width="15%" align="center">จำนวน</td></p>
            <input type="number"  name="warehouse" class="form-control" required placeholder="จำนวน" />
          </div>
          </div>
         
              
            
              
            
          

            
        <div class="form-group">
          <div class="col-sm-6">
            <button type="submit" class="btn btn-primary" name="btnadd"> + เพิ่มสินค้า </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
