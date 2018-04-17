<?php
//require_once '../include/header.php';
require_once 'config.php';
require_once '../library/config.php';
require_once '../library/cart-functions.php';
require_once '../library/category-functions.php';
$sql = "select * from tbl_order_item where od_id = 1040";
//SELECT * FROM `tbl_order_item` WHERE od_id = 1040
$result = dbQuery($sql);
?>
$cartContent = getCartContent();
$numItem = count($cartContent);
$pageTitle = 'Shopping Cart';


require_once 'include/header.php';
?>

<div class="row">
  <div class="col-md-12"> <?php require_once '../include/nevMenu.php'; ?></div>
</div>

<div class="row">
  <div class="col-md-12"> <?php require_once '../include/top.php'; ?></div>
</div>

<div class="row">
  <div class="col-md-2"><?php require_once './/include/leftNav.php'; ?></div>
<?php
while ($row = mysql_fetch_assoc ($result)){
    
    



?>
<!--<tr class="content"> -->
 <tr class="content"> 
    <td><?php echo $row['pd_id']?></td>
    <td><?php echo $row['od_id']?></td>
</tr>
<?php
}
?>