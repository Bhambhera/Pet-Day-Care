<?php 
	session_start();
	include 'connection.php';
	$uid = $_SESSION['uid'];
	$currenttime = $_GET['currenttime'];
	$select_product = "SELECT * FROM store_order WHERE uid = '$uid' && currenttime = '$currenttime' ";
	$select_product_run = mysqli_query($con, $select_product);
	foreach ($select_product_run as $row) 
	{
		$productname = $row['productname'];
		$quantity_cart = $row['quantity'];
		$update_quantity = "SELECT * FROM products WHERE productname = '$productname' ";
		$update_quantity_run = mysqli_query($con, $update_quantity);
		foreach($update_quantity_run as $user)
		{
			$quantity_product = $user['quantity'];
			$quantity_product = $quantity_product + $quantity_cart;
			if($quantity_product == 0)	
			{
				$status = "Out of Stock";
			}
			else
			{
				$status = "available";
			}
			$product_quantity_update = "UPDATE products SET quantity = '$quantity_product', status = '$status' WHERE productname = '$productname' ";
			$product_quantity_update_run = mysqli_query($con, $product_quantity_update);
		}
		$update_status = "UPDATE store_order SET status = 'canceled' WHERE productname = '$productname' && uid = '$uid' && currenttime = '$currenttime' ";
		$update_status_run = mysqli_query($con, $update_status);
		/*$delete_order = "DELETE FROM store_order WHERE productname = '$productname' && uid = '$uid' && currenttime = '$currenttime' ";
		$delete_order_run = mysqli_query($con, $delete_order);*/
		header('location:myorders.php');
	}
?>