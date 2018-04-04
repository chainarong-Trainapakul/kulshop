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
    <table width="550" border="0"  align="center" cellpadding="5" cellspacing="1" class="detailTable">
        <tr> 
            <td colspan="2" align="center" id="infoTableHeader">Order Detail</td>
        </tr>
        <tr> 
            <td width="150" class="label">Order Number</td>
            <td class="content"><?php echo $orderId; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">Order Date</td>
            <td class="content"><?php echo $od_date; ?></td>
        </tr>
        <tr> 
            <td width="150" class="label">Last Update</td>
            <td class="content"><?php echo $od_last_update; ?></td>
        </tr>
        <tr> 
            <td class="label">Status</td>
            <td class="content"><?php echo $od_status; ?></td>
        </tr>
        <tr>
            <td width="150" class="label">Parcel No</td>
            <td class="content"><?php echo $od_parcelno; ?></td>
<?php
        function submitParcelNo(){
            $orderId = (int)$_GET['oid'];
            $parcalNo = $_GET['txtid'];
            $sql = "UPDATE tbl_order
            SET od_parcelno = '$parcelNo', od_last_update = NOW()
            WHERE od_id = $orderId";
	//อัพเดทสถานะในฐานข้อมูล
    $result = dbQuery($sql);
        }
            ?>
        </tr>
    </table>

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
