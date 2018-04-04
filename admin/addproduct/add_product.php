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
            <div class="form-group">
          <div class="col-sm-12">
            <p> รหัสสินค้า</p>
            <input type="text"  name="pd_id" class="form-control" required placeholder="รหัสสินค้า" />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> ชื่อสินค้า</p>
            <input type="text"  name="pd_name" class="form-control" required placeholder="ชื่อสินค้า" />
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
            <input type="text"  name="warehouse" class="form-control" required placeholder="จำนวน" />
          </div>
          </div>
      <div class="form-group">
          <div class="col-sm-3">
              <?php  date_default_timezone_set('Asia/Bangkok');
              $datenow = time();?>
     <td width="15%" align="center">วันเดือนปี </td> 
    	<td class="content"> <input name="re_date" type="date" class="box" id="txtUserTransfer" value="<?php echo $datenow; ?>"size="32" maxlength="32"></td>
         </div></div> 
              
            
          

            
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