// JavaScript Document

function viewOrder()
{
	statusList = window.document.frmOrderList.cboOrderStatus;
	status     = statusList.options[statusList.selectedIndex].value;	
	
	if (status != '') {
		window.location.href = 'index.php?status=' + status;
	} else {
		window.location.href = 'index.php';
	}
}

function modifyOrderStatus(orderId)
{
	statusList = window.document.frmOrder.cboOrderStatus;
	status     = statusList.options[statusList.selectedIndex].value;
	window.location.href = 'processOrder.php?action=modify&oid=' + orderId + '&status=' + status;
}

function parcelOrder()
{
   
}
/*function submitParcelNo(){
    //alert('kuy');
    console.log('kuy');
    
    
         /*     <?php 
            $parcalNo = $_GET['txtid'];
            $sql = "UPDATE tbl_order
            SET od_parcelno = '$parcelNo', od_last_update = NOW()
            WHERE od_id = $orderId";
	//อัพเดทสถานะในฐานข้อมูล
        $result = dbQuery($sql);   ?>*/
