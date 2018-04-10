
<head> 
    <meta charset="utf-8" name="viewport" content="width=device-width,initial-scale=1">
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
<script src="bootstrap/js/jquery-1.11.0.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<p style="font-size:30px;" align="center">รายการสินค้าที่เหลือจำนวนน้อย</p>
<div class ="container">
<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
  <tr class="success">
    <td>รหัสสินค้า</td>
    <td>ชื่อสินค้า</td> 
    <td>จำนวน</td>
  </tr>
<?php
      
require_once '../library/config.php';	
$con= mysqli_connect($dbHost,$dbUser,$dbPass,$dbName) or die("Error: " . mysqli_error($con));
$sql_11 = "SELECT tbl_product.pd_id,tbl_product.pd_qty,tbl_product.cat_id,tbl_product.pd_name,tbl_category.cat_id 
FROM tbl_product INNER JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id
WHERE tbl_product.pd_qty < 50 and tbl_product.cat_id ='11' ";
$result_11 = mysql_query($sql_11) or die('Cannot get product. ' . mysql_error());

$sql_10 = "SELECT tbl_product.pd_id,tbl_product.pd_qty,tbl_product.cat_id,tbl_product.pd_name,tbl_category.cat_id 
FROM tbl_product INNER JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id
WHERE tbl_product.pd_qty < 30 and tbl_product.cat_id ='10' ";
$result_10 = mysql_query($sql_10) or die('Cannot get product. ' . mysql_error());    
      
$sql_8 = "SELECT tbl_product.pd_id,tbl_product.pd_qty,tbl_product.cat_id,tbl_product.pd_name,tbl_category.cat_id 
FROM tbl_product INNER JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id
WHERE tbl_product.pd_qty < 20 and tbl_product.cat_id ='8'";
$result_8 = mysql_query($sql_8) or die('Cannot get product. ' . mysql_error());       

$sql_9 = "SELECT tbl_product.pd_id,tbl_product.pd_qty,tbl_product.cat_id,tbl_product.pd_name,tbl_category.cat_id 
FROM tbl_product INNER JOIN tbl_category ON tbl_product.cat_id = tbl_category.cat_id
WHERE tbl_product.pd_qty < 20 and tbl_product.cat_id ='9'";
$result_9 = mysql_query($sql_9) or die('Cannot get product. ' . mysql_error());       
      
while($row = mysql_fetch_array($result_8)) {
            ?>
                <tr>
                    <td><?php echo $row['pd_id']?></td>
                    <td><?php echo $row['pd_name']?></td>
                    <td><?php echo $row['pd_qty']?></td>
                </tr>

            <?php
            }
while($row = mysql_fetch_array($result_9)) {
            ?>
                <tr>
                    <td><?php echo $row['pd_id']?></td>
                    <td><?php echo $row['pd_name']?></td>
                    <td><?php echo $row['pd_qty']?></td>
                </tr>

            <?php
            }
while($row = mysql_fetch_array($result_10)) {
            ?>
                <tr>
                    <td><?php echo $row['pd_id']?></td>
                    <td><?php echo $row['pd_name']?></td>
                    <td><?php echo $row['pd_qty']?></td>
                </tr>

            <?php
            }
            
while($row = mysql_fetch_array($result_11)) {
            ?>
                <tr>
                    <td><?php echo $row['pd_id']?></td>
                    <td><?php echo $row['pd_name']?></td>
                    <td><?php echo $row['pd_qty']?></td>
                </tr>

            <?php
            }        

            ?>
     
      
</table>
    </div></div>
