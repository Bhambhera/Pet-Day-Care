<?php
include 'connection.php';
session_start();
$uid = $_SESSION['uid'];
$subprice = 0;
$query = "SELECT * FROM cart WHERE uid = '$uid' ";
$query_run = mysqli_query($con, $query);
if(mysqli_num_rows($query_run) > 0)
{
	$order = "INSERT into store_order(uid, productname, price, quantity) SELECT uid, productname, price, quantity FROM cart WHERE uid = '$uid' ";
	$order_run = mysqli_query($con, $order);
	$price_get = "SELECT * FROM cart WHERE uid = '$uid' ";
	$price_get_run = mysqli_query($con, $price_get);
	foreach($price_get_run  as $row)
	{
		$productname = $row['productname'];
		$quantity_cart = $row['quantity'];
		$price = $row['price'];
		$subprice = $price *$quantity_cart;
		$update_subprice = "UPDATE store_order SET subprice ='$subprice' WHERE uid ='$uid' && productname = '$productname' ";
		$update_subprice_run = mysqli_query($con, $update_subprice);
	
		$update_quantity = "SELECT * FROM products WHERE productname = '$productname' ";
		$update_quantity_run = mysqli_query($con, $update_quantity);
		foreach($update_quantity_run as $user)
		{
			$quantity_product = $user['quantity'];
			$quantity_product = $quantity_product - $quantity_cart;
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
	}
	$delete_cart = "DELETE FROM cart WHERE uid = '$uid' ";
	$delete_cart_run = mysqli_query($con, $delete_cart);
	header('location:myorders.php');
}
else
{	
	
	header('location:mycart.php'); 
}
?>