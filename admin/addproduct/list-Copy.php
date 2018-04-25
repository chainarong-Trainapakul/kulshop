<?php 
    date_default_timezone_set("Asia/Bangkok");
    $current_date = date('Y-m-d');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<html>
<body>
  <div class="container">
   <h3 align="center">เพิ่มจำนวนสินค้า</h3>
   <br />
   <h4 align="center">กรุณากรอก</h4>
   <br />
     <form method="post" id="insert_form"> 
      <p>เลขที่บิล  <input type='text' name = 'bill_no' class="bill_no" size = "10">  วันที่  <?php echo $current_date?> </p>
   <!--<form method="post" id="insert_form">-->
    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th>เลขที่สินค้า (ต้องการ)</th>
       <th>ชื่อสินค้า</th>
       <th>จำนวน (ต้องการ)</th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button></th>
      </tr>
     </table>
     <div align="center">
      <input type="submit" name="submit" class="btn btn-info" value="ตกลง" />
     </div>
    </div>
   </form>
  </div>
</body>
</html>

<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><input type="number" name="item_no[]" class="form-control item_no" /></td>';
  html += '<td><input type="text" name="item_name[]" class="form-control item_quantity" /></td>';
  html += '<td><input type="text" name="item_quantity[]" class="form-control item_quantity" /></td>';
  //html += '<td><select name="item_unit[]" class="form-control item_unit"><option value="">Select Unit</option><?php /*echo fill_unit_select_box($connect); */?></select></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 
 $('#insert_form').on('submit', function(event){
  event.preventDefault();
  var error = '';
  /*$('.item_name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>Enter Item Name at "+count+" Row</p>";
    return false;
   }
   count = count + 1;
  });*/
  $('.bill_no').each(function(){
      //alert("bill_no");
      var count = 1;
   if($(this).val() == '')
   {
      error += "<p>กรุณากรอกเลขที่บิลให้ถูกต้อง</p>";
    return false;
    }
  });
  $('.item_no').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>กรุณากรอกข้อมูลในช่องเลขทีสินค้า แถวที่"+count+"</p>";
    return false;
   }
   count = count + 1;
  });
  $('.item_quantity').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p>กรุณากรอกข้อมูลในช่องจำนวน แถวที่"+count+"</p>";
    return false;
   }
   count = count + 1;
  });
 
     
  var form_data = $(this).serialize();
  console.log(form_data);
  if(error == '')
  {
   $.ajax({
    url:"update_qty.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     if(data == 'ok')
     {
      //alert ("เพิ่มสินค้าเรียบร้อย");
      $('#item_table').find("tr:gt(0)").remove();
      $('#error').html('<div class="alert alert-success">เพิ่มสิ้นค้าเรียบร้อย</div>');
      
     }
        console.log(data);
    }
   });
  }
  else
  {
   $('#error').html('<div class="alert alert-danger">'+error+'</div>');
  }
 });
 
});
</script>
