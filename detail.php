<?php
require_once 'library/config.php';
require_once 'library/category-functions.php';
require_once 'library/product-functions.php';
require_once 'library/cart-functions.php';


$catId  = (isset($_GET['c']) && $_GET['c'] != '1') ? $_GET['c'] : 0;

require_once 'include/header.php';

$view = (isset($_GET['view']) && $_GET['view'] != '') ? $_GET['view'] : '';

switch ($view) {

	case 'detailPar' :		//กรณีแก้ไข User
		$content 	= 'detailPar.php';		
		$pageTitle 	= 'Shop Order detail';
		break;

	default :				//ค่าเริ่มต้น คือดูรายชื่อ User
		$content 	= 'index.php';		
		$pageTitle 	= 'Shop Users';
}

?>



<div class="row">
  <div class="col-md-12"> <?php require_once 'include/nevMenu.php'; ?></div>
</div>

<div class="row">
  <div class="col-md-12"> <?php require_once 'include/top.php'; ?></div>
</div>

<div class="row">
  <div class="col-md-2"><?php require_once 'include/leftNav.php'; ?></div>
  <div class="col-md-7">
  
        <div id="category-container"> 
  			<?php //require_once 'include/categoryList.php'; ?>
  		</div>
  		<div id="product-container">
  
  			<!--************************************************************-->
			<!--******************** content ใส่ที่นี่ **************************-->
  			<!--************************************************************-->  

<div class="panel panel-info">
  <div class="panel-heading">รายการสั่งซื้อ</div>
  <div class="panel-body">
  <div class ="container">
<div class="table-responsive">
<table class="table table-bordered table-hover" border="1" style="width:60%" >
  <tr class="info">
    <td>รหัสใบสั่งซื้อ</td>
    <td>ชื่อลูกค้า</td> 
    <td>รวมสุทธิ</td>
    <td>วันที่สั่งซื้อ</td>
    <td>วันที่สิ้นสุดคำสั่งซื้อ</td>
      
    <td>สถานะ</td>
    <td>วันที่อัพเดทสถานะ</td>
    <td>เลขพัสดุ</td>  
    
  </tr>
<?php
if(isset($_SESSION['plaincart_customer_id'])){
$userId = $_SESSION['plaincart_customer_id'];
$sql = "SELECT user_first_name
		        FROM tbl_user 
				WHERE user_id = $userId";
		$result = dbQuery($sql);
	    
		if (dbNumRows($result) == 1) {
			$row = dbFetchAssoc($result);
			$userFirstName = $row['user_first_name']; 
        
		} 
    
$con= mysqli_connect($dbHost,$dbUser,$dbPass,$dbName) or die("Error: " . mysqli_error($con));
$sql = "SELECT o.od_id, o.od_shipping_first_name, od_shipping_last_name, od_date, od_status,od_parcelno,
               SUM(pd_price * od_qty) + od_shipping_cost AS od_amount
	    FROM tbl_order o, tbl_order_item oi, tbl_product p 
		WHERE o.od_shipping_first_name ='$userFirstName'
		GROUP BY od_id
		ORDER BY od_id DESC;";
    
$user_id = $_SESSION['plaincart_customer_id'];   
$sql = "SELECT o.od_exp_date,o.od_id,o.od_total,o.od_last_update, o.od_shipping_first_name,od_parcelno, od_shipping_last_name, od_date, od_status, SUM(pd_price * od_qty) + od_shipping_cost AS od_amount 
FROM tbl_order o,
tbl_order_item oi,
tbl_product p 
WHERE oi.pd_id = p.pd_id and o.od_id = oi.od_id AND o.user_id = '$user_id' GROUP BY od_id ORDER BY od_id DESC";
    //o.od_shipping_first_name = '$userFirstName'
    //$test = $_SESSION['plaincart_customer_id'];
    //echo $test ;
    //$name = "SELECT * FROM tbl_user WHERE user_id = $test";
   // echo $name ;
 //echo $sql ;   
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());
//$threeday = check_date_3day();
while($row = mysql_fetch_array($result)) {
/*    $temp_od_id = $row['od_id'];
    $sql_date = "select od_date from tbl_order where od_date and od_id = '$temp_od_id'";
    $result_date =mysql_query($sql_date) or die('Cannot get query. ' . mysql_error());
    $query = check_date_3day($result_date);*/
    $od_id = $row['od_id'];
            ?>
                <tr>
                    <td><a href="order_item2.php?od_id=<?php echo $od_id?>"><?php echo  $row['od_id']; ?></a></td>
                   <!-- <td><a href="detail.php?view=detailPar&oid=<?php /*echo $row['od_id'];*/ ?>"><?php/* echo  $row['od_id'];*/ ?></a></td>-->
                    <td><?php echo $row['od_shipping_first_name'];  echo " " . $row['od_shipping_last_name']; ?></td>
                    <td><?php echo $row['od_total']; ?></td>
                    <td><?php echo $row['od_date']; ?></td>
                     <td><?php echo $row['od_exp_date']; ?></td>
                    <td><?php echo $row['od_status']; ?></td>
                    <td><?php echo $row['od_last_update']; ?>
                    <td><?php echo $row['od_parcelno']; ?></td>
                   
                </tr>

            <?php
            }}
else{
    echo "<script type='text/javascript'>var con = confirm('กรุณาเข้าสู่ระบบ');
    if(con == true){
       window.location.replace('login.php');
       
    }
    else{
        window.location.replace('index.php');
   }
    </script>"; 
}
/*$sql = "SELECT user_first_name
		        FROM tbl_user 
				WHERE user_id = $userId";
		$result = dbQuery($sql);
	    
		if (dbNumRows($result) == 1) {
			$row = dbFetchAssoc($result);
			$userFirstName = $row['user_first_name']; 
        
		} 
    
$con= mysqli_connect($dbHost,$dbUser,$dbPass,$dbName) or die("Error: " . mysqli_error($con));
$sql = "SELECT o.od_id, o.od_shipping_first_name, od_shipping_last_name, od_date, od_status,od_parcelno,
               SUM(pd_price * od_qty) + od_shipping_cost AS od_amount
	    FROM tbl_order o, tbl_order_item oi, tbl_product p 
		WHERE o.od_shipping_first_name ='$userFirstName'
		GROUP BY od_id
		ORDER BY od_id DESC;";
    //$test = $_SESSION['plaincart_customer_id'];
    //echo $test ;
    //$name = "SELECT * FROM tbl_user WHERE user_id = $test";
   // echo $name ;
 //echo $sql ;   
$result = mysql_query($sql) or die('Cannot get product. ' . mysql_error());

while($row = mysql_fetch_array($result)) {
            ?>
                <tr>
                    <td><a href="detail.php?view=detailPar&oid=<?php echo $row['od_id']; ?>"><?php echo  $row['od_id']; ?></a></td>
                    <td><?php echo $row['od_shipping_first_name'];  echo " " . $row['od_shipping_last_name']; ?></td>
                    <td><?php echo $row['od_amount']; ?></td>
                    <td><?php echo $row['od_date']; ?></td>
                    <td><?php echo $row['od_status']; ?></td>
                    <td><?php if($row['od_parcelno']==0)echo "-"; else echo $row['od_parcelno']; ?></td>
                </tr>

            <?php
            }*/
            ?>
</table>
</div></div>
	</div>
</div>

  			<!--************************************************************-->
			<!--****************** สิ้นสุด content ตรงนี้ ***********************-->
  			<!--************************************************************-->
		
		</div>	
		<div id="lastest-link-content">
		</div>
	</div><!--div class="col-md-7"-->
		
    <div class="col-md-3">
  		<div id="cart-content-mini"></div>
  		<div><?php require_once 'include/widgets/otherWidget.php';?></div>
  		<div><?php require_once 'include/widgets/widget2.php';?></div>
  	</div>
</div>

<script>

$(function(){
	var n = true;
	$.ajax({
  		url:'include/miniCartAjax.php',
  		data:{link:n},
  		type:'get',
  		success:function(data){
  			$("#cart-content-mini").empty().append(data).fadeIn(1000);
  		}
  	});
});

</script>

<?php require_once 'include/footer.php'; ?>
