<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
$id = $_GET['id'];
$sum = 0;
$subprice = 0; 
include 'connection.php';
$uid = $_SESSION['uid'];
?>
<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <title>Pet World</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Flaticon Font -->
    <link href="lib/flaticon/font/flaticon.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style1.css" rel="stylesheet">
	<title></title>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  		<div class="container-fluid">
   			<a class="navbar-brand" href="home.php">Pets World</a>
    			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      				<span class="navbar-toggler-icon"></span>
    			</button>
    				<div class="collapse navbar-collapse" id="navbarSupportedContent">
      					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
       						<li class="nav-item">
          						<a class="nav-link" aria-current="page" href="home.php">Home</a>
        					</li>
        					</li>
        					<li class="nav-item">
          						<a class="nav-link" aria-current="page" href="product_userside.php">Store</a>
        					</li>
      					</ul>
      					<ul class="navbar-nav ml-auto mb-2 mb-lg-0">
      						<li class="nav-item">
      							<a class="nav-link active" href="mycart.php" class="btn btn-success">My Cart</a>
      						</li>
      						<li class="nav-item">
      							<a class="nav-link" href="myorders.php" class="btn btn-primary">My Orders</a>

      						</li>
      						<li class="nav-item">
          						<a class="nav-link" class="nav-link active" aria-current="page" href="logout.php">Logout</a>
        					</li>
      					</ul> 
    		</div>
  		</div>
	</nav>
    <div class="card-body">
		<table class="table table-bordered" >
	    	<thead>
	        	<tr>
	                <th>Product Name</th>
	                <th>MRP</th>
	                <th>Price</th>
	                <th>Quantity</th>
	                <th>Remove</th>
	            </tr>
	        </thead>
	        <tbody>
		        	<?php
		        	$sql = "SELECT * FROM cart WHERE uid = '$uid' "; 
		        	$sql_run = mysqli_query($con,$sql);
		        	if(mysqli_num_rows($sql_run) > 0)
		        	{
			        	while ($row = mysqli_fetch_array($sql_run)) 
			        	{
			        		$id = $row['id'];
			        		$quantity = $row['quantity'];
			        		$productname = $row['productname'];
			        		$price = $row['price'];
			        		$quantity_value = "SELECT * FROM products WHERE productname = '$productname'";
							$quantity_value_run  = mysqli_query($con, $quantity_value);
							foreach($quantity_value_run as $user)
							{
								$quantity_product = $user['quantity'];
							}
							if($quantity > $quantity_product)
							{
								$add_quantity = "UPDATE cart SET quantity = '$quantity_product' WHERE id = '$id'";
								$add_quantity_run = mysqli_query($con, $add_quantity);
								header('location:mycart.php');
							}
							if($quantity_product == 0)
							{
								$add_quantity = "DELETE FROM cart WHERE id = '$id'";
								$add_quantity_run = mysqli_query($con, $add_quantity);
								header('location:mycart.php');
							}
			        		?>
			        		<tr>
				        		<td><?php echo $productname; ?></td>
					        	<td>
					        		<?php 
					        			echo $price;
					        			$subprice = $price * $quantity;
					        	 	?>
					        	</td> 	
					        	<td><?php echo $subprice; ?></td>
					        	<form action="editcart.php?id= <?php echo $row['id'];?>" method="post">
					        		<td>
					        				<button type="submit" name="quantity_minus" class="btn btn-danger">-</button>
					        				<?php 
					        					echo $quantity;
					        					$sum = $sum + $price * $quantity;
					        				 ?>
					        				<button type="submit" name="quantity_plus" class="btn btn-success">+</button>
					        		</td>
					        		<td>
					        			<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to Remove Product?');" name="remove_item">Remove</button>
					        		</td>
					        	</form>
					        </tr>	
			        		<?php	        	
			       		}
			       	}
			       	else
			       	{
			       		?>
			       		<td colspan="5">
			       				<h5 class="text-danger" align="center">No products in cart</h5>
			       				<h4 align="center"><a href="product_userside.php" class="btn btn-primary">Go To Shop</a><h4>
			       		</td>
			       		<?php
			       	}
		        	?>
	        </tbody>
	        <tbody>
	        	<tr>
		        	<td>
		        		<h5 class="text-danger" align="center">Note:-
		        		Payment Method will be Cash On delivery</h5>
		        	</td>
		        	<td></td>
		        	<td>Total = <?php echo $sum; ?> </td>
		        	<td></td>
		        	<td>
		        		<form action="confirmorder.php?id = <?php echo $uid ?>" method= "post"> 
		        			<button type="submit" onclick="return confirm('Are you sure you want to Place order?');" class="btn btn-primary">Confirm Order</button>
		        		</form>
		        	</td>
		        </tr>
	        </tbody>
	    </table>
	</div>
</body>
</html>