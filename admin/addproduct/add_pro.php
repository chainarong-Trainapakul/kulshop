<?php
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
            
              <tr> 
   <td width="150" class="label">Product Name</td>
   <td class="content"> <?php echo $pd_name; ?></td>
  </tr>
     <tr> 
   <td width="150" class="label">Product Id</td>
   <td class="content"> <?php echo $productId; ?></td>
  </tr>
      <tr> 
   <td width="150" class="label">เลขที่ใบเสร็จ</td>
   <td class="content"> <?php echo $in_renum; ?></td>
   </tr>
    <tr> 
   <td width="150" class="label">เพิ่มสินค้าเข้า</td>
   <td class="content"> <?php echo $warehouse; ?>" </td> 
     </tr>

    <td width="15%" align="center">วันเดือนปี </td> 
    	<td class="content"> <?php echo $re_date; ?>"</td>
         
          

            
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