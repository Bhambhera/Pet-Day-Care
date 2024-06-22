<?php 
include 'connection.php';
$id = $_GET['id'];
$quantity_upadte = "SELECT * FROM cart WHERE id = '$id'";
$quantity_upadte_run  = mysqli_query($con, $quantity_upadte);
foreach($quantity_upadte_run as $row)
{
	$quantity = $row['quantity'];
	$productname = $row['productname'];
}
$quantity_value = "SELECT * FROM products WHERE productname = '$productname'";
$quantity_value_run  = mysqli_query($con, $quantity_value);
foreach($quantity_value_run as $user)
{
	$quantity_product = $user['quantity'];
}
if(isset($_POST['remove_item']))
{
	$delete_item = "DELETE FROM cart WHERE id = '$id'";
	$delete_item_run = mysqli_query($con, $delete_item);
	header('location:mycart.php');
}
else if(isset($_POST['quantity_plus']))
{
	if($quantity >= $quantity_product)
	{
		header('location:mycart.php');
	}else if(){
		header('location:yourcart.php');
	}
	else
	{
		$quantity++;
		$add_quantity = "UPDATE cart SET quantity = '$quantity' WHERE id = '$id'";
		$add_quantity_run = mysqli_query($con, $add_quantity);
		header('location:mycart.php');
	}
}
else if(isset($_POST['quantity_minus']))
{
	if($quantity <=1)
	{
		header('location:mycart.php');
	}
	else
	{
		$quantity--;
		$add_quantity = "UPDATE cart SET quantity = '$quantity' WHERE id = '$id'";
		$add_quantity_run = mysqli_query($con, $add_quantity);
		header('location:mycart.php');
	}
}
?>