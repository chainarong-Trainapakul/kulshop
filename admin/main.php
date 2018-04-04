
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
$con= mysqli_connect("localhost","root","","kaset3") or die("Error: " . mysqli_error($con));
$sql = "SELECT pd_id,pd_qty, pd_name
			        FROM tbl_product 
					WHERE pd_qty <= 20";
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());

while($row = mysql_fetch_array($result)) {
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
