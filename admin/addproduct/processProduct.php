<?php

$con= mysqli_connect("localhost","root","","kaset3") or die("Error: " . mysqli_error($con));
//require_once '../../library/config.php';
//require_once '../library/functions.php';
//
//checkAdminUser();
//
//$action = isset($_GET['action']) ? $_GET['action'] : '';
//
//switch ($action) {
//	
//	case 'addProduct' :
//		addProduct();
//		break;
//		
//	case 'modifyProduct' :
//		modifyProduct();
//		break;
//		
//	case 'deleteProduct' :
//		deleteProduct();
//		break;
//	
//	case 'deleteImage' :
//		deleteImage();
//		break;
//    
//
//	default :
//	    // if action is not defined or unknown
//		// move to main product page
//		header('Location: index.php');
//}
//
//
//function addProduct()
//{
    $pro_id      = $_POST['pd_id'];
    $receipt_no  = $_POST['re_no'];
	$qty         = (int)$_POST['qty'];
    date_default_timezone_set('Asia/Bangkok');
    $re_date     = date('Y-m-d H:i:s');
    
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
} 
	$sql = "INSERT INTO tbl_receipt_product (product_id, receipt_no, quantity) VALUES ('$pro_id','$receipt_no','$qty');";
    $sql .= "INSERT INTO tbl_receipt_date(receipt_no, date) VALUES('$receipt_no','$re_date');";
    $sql .= "UPDATE tbl_product SET pd_qty = pd_qty+$qty WHERE pd_id = $pro_id;";
    if ($con->multi_query($sql) === TRUE) {
    echo "New records created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$con->close();

//    $sql2  = "UPDATE tbl_product SET pd_qty = pd_qty+$qty, pd_last_update = $re_date WHERE pd_id = $pro_id;"
//	$result2 = mysqli_query($conn, $sql2) or die ("Error in query: $sql2 " . mysqli_error());

	header("Location: index.php?catId=$catId");	
//}
//
///*
//	Upload an image and return the uploaded image name 
//*/
//function uploadProductImage($inputName, $uploadDir)
//{
//	$image     = $_FILES[$inputName];	//เก็บรายละเอียดของไฟล์ที่อัพโหลดลงใน array()
//	$imagePath = '';
//	$thumbnailPath = '';
//	
//	// ถ้ามีการอัพโหลดไฟล์ โดยชื่อไฟล์ที่อัพโหลดต้องไม่ใช่ค่าว่างๆ
//	if (trim($image['tmp_name']) != '') {
//		$ext = substr(strrchr($image['name'], "."), 1); //หานามสกุลไฟล์
//		
//		//ตั้งชื่อไฟล์ใหม่ โดยใช้การสุ่ม เวลา และฟังก์ชัน md5() เพื่อให้ชื่อไฟล์ไม่ซ้ำ 
//		$imagePath = md5(rand() * time()) . ".$ext";
//		
//		list($width, $height, $type, $attr) = getimagesize($image['tmp_name']); 
//
//		//ตรวจสอบว่าความกว้างไฟล์ต้องไม่เกินกว่าที่กำหนด แล้วทำการสร้างไฟล์ Thumbnail
//		if (LIMIT_PRODUCT_WIDTH && $width > MAX_PRODUCT_IMAGE_WIDTH) {
//			$result    = createThumbnail($image['tmp_name'], $uploadDir . $imagePath, MAX_PRODUCT_IMAGE_WIDTH);
//			//เรียกฟังก์ชัน createThumbnail() เพื่อปรับความกว้างใหม่
//			$imagePath = $result;
//		} else {
//			$result = move_uploaded_file($image['tmp_name'], $uploadDir . $imagePath);
//		}	
//		
//		if ($result) {
//			//สร้าง Thumbnail ซึ่งเป็นไฟล์ภาพขนาดเล็ก
//			$thumbnailPath =  md5(rand() * time()) . ".$ext";
//			$result = createThumbnail($uploadDir . $imagePath, $uploadDir . $thumbnailPath, THUMBNAIL_WIDTH);
//			
//			//ถ้าสร้าง Thumnail ไม่ได้ ก็ให้ลบไฟล์ภาพทิ้งไป
//			if (!$result) {
//				unlink($uploadDir . $imagePath);
//				$imagePath = $thumbnailPath = '';
//			} else {
//				$thumbnailPath = $result;
//			}	
//		} else {
//			//กรณีที่ไฟล์ภาพอัพโหลดไม่ได้ หรือสร้าง Thumbnail ไม่ได้
//			$imagePath = $thumbnailPath = '';
//		}
//		
//	}
//
//	
//	return array('image' => $imagePath, 'thumbnail' => $thumbnailPath);
//}
//
///*
//	Modify a product
//*/
//function modifyProduct()
//{
//	$productId   = $_POST['txtId'];	
//    $catId       = $_POST['cboCategory'];
//    $name        = $_POST['txtName'];
//	$addProduct  = $_POST['txtadd'];
//    $receipt     = $_POST['txtre'];
//	
//	
//			
//	$sql   = "UPDATE tbl_product 
//	          SET cat_id = $catId, pd_name = '$name', 
//			      pd_qty = $qty, pd_image = $mainImage, pd_thumbnail = $thumbnail
//			  WHERE pd_id = $productId";  
//
//	$result = dbQuery($sql);
//	
//	header('Location: index.php');			  
//}
//
///*
//	Remove a product
//*/
//function deleteProduct()
//{
//	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
//		$productId = (int)$_GET['productId'];
//	} else {
//		header('Location: index.php');
//	}
//	
//	// ลบสินค้านี้จากตาราง  tbl_order_item
//	$sql = "DELETE FROM tbl_order_item
//	        WHERE pd_id = $productId";
//	dbQuery($sql);
//			
//	//ลบสินค้านี้จากตาราง  tbl_cart	
//	$sql = "DELETE FROM tbl_cart
//	        WHERE pd_id = $productId";	
//	dbQuery($sql);
//			
//	//ดึงรูป และ Thumbnail มาจากฐานข้อมูล
//	$sql = "SELECT pd_image, pd_thumbnail
//	        FROM tbl_product
//			WHERE pd_id = $productId";
//			
//	$result = dbQuery($sql);
//	$row    = dbFetchAssoc($result);
//	
//	//ลบรูปและ Thumbnail ออกจากฐานข้อมูล
//	if ($row['pd_image']) {
//		unlink(SRV_ROOT . 'images/product/' . $row['pd_image']);
//		unlink(SRV_ROOT . 'images/product/' . $row['pd_thumbnail']);
//	}
//	
//	//ลบข้อมูลสินค้าออกจากฐานข้อมูล
//	$sql = "DELETE FROM tbl_product 
//	        WHERE pd_id = $productId";
//	dbQuery($sql);
//	
//	//เปลี่ยนหน้าไปยัง index.php พร้อมทั้งแสดงรายชื่อสินค้าในประเภทสินค้าเดิม
//	header('Location: index.php?catId=' . $_GET['catId']);
//}
//
//
///*
//	Remove a product image
//*/
//function deleteImage()
//{
//	if (isset($_GET['productId']) && (int)$_GET['productId'] > 0) {
//		$productId = (int)$_GET['productId'];
//	} else {
//		header('Location: index.php');
//	}
//	
//	$deleted = _deleteImage($productId);
//
//	// update the image and thumbnail name in the database
//	$sql = "UPDATE tbl_product
//			SET pd_image = '', pd_thumbnail = ''
//			WHERE pd_id = $productId";
//	dbQuery($sql);		
//
//	header("Location: index.php?view=modify&productId=$productId");
//}
//
//function _deleteImage($productId)
//{
//	// we will return the status
//	// whether the image deleted successfully
//	$deleted = false;
//	
//	$sql = "SELECT pd_image, pd_thumbnail 
//	        FROM tbl_product
//			WHERE pd_id = $productId";
//	$result = dbQuery($sql) or die('Cannot delete product image. ' . mysql_error());
//	
//	if (dbNumRows($result)) {
//		$row = dbFetchAssoc($result);
//		extract($row);
//		
//		if ($pd_image && $pd_thumbnail) {
//			// remove the image file
//			$deleted = @unlink(SRV_ROOT . "images/product/$pd_image");
//			$deleted = @unlink(SRV_ROOT . "images/product/$pd_thumbnail");
//		}
//	}
//	
//	return $deleted;
//}
?>