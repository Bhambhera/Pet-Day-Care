<?php 
session_start();
if(!isset($_SESSION['logged_in']))
{
  header("location:login.php");
}
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
        					<li class="nav-item">
          						<a class="nav-link" aria-current="page" href="product_userside.php">Store</a>
        					</li>
      					</ul>
      					<ul class="navbar-nav ml-auto mb-2 mb-lg-0">
      						<li class="nav-item">
      							<a class="nav-link" href="mycart.php" class="btn btn-success">My Cart</a>
      						</li>
      						<li class="nav-item">
      							<a class="nav-link active" href="myorders.php" class="btn btn-primary">My Orders</a>
      						</li>
      						<li class="nav-item">
          						<a class="nav-link" class="nav-link active" aria-current="page" href="logout.php">Logout</a>
        					</li>
      					</ul>  
      				</div>
      			</div>
      		</nav>
      		
	      		
		      			<?php
		      			$total = 0;
				      		$uid = $_SESSION['uid'];
				      		include 'connection.php';
				      		$query = "SELECT * FROM store_order WHERE uid = '$uid' ";
				      		$query_run = mysqli_query($con, $query);
				      		$select_group = "SELECT DISTINCT(`currenttime`) FROM `store_order` WHERE uid='$uid' ";
				      		$select_group_run = mysqli_query($con, $select_group);
				      		if(mysqli_num_rows($select_group_run) > 0)
				      		{
				      		foreach($select_group_run as $run)
				      		{
				      			?>
				      		<div class="card-body">
				      			<table class="table table-bordered" >
				      			<thead>
					      			<tr>
					      				<th>Product Name</th>
					      				<th>Price</th>
					      				<th>Subprice</th>
					      				<th>Quantity</th>
					      			</tr>
					      		</thead>
					      		<tbody>
				      			<?php
				      					$currenttime = $run['currenttime'];
				      					$select_product = "SELECT * FROM store_order WHERE uid = '$uid' && currenttime = '$currenttime' ";
				      					$select_product_run = mysqli_query($con, $select_product);
				      					$total = 0;
				      					foreach($select_product_run as $check)
				      					{
				      						$productname = $check['productname'];
				      						$price = $check['price'];
				      						$subprice = $check['subprice'];
				      						$quantity = $check['quantity'];
				      						$status = $check['status'];
				      						$total = $total + $subprice;

				      						?>
				      						<tr>
				      							<td><?php echo $productname ?></td>
				      							<td><?php echo $price ?></td>
				      							<td><?php echo $subprice ?></td>
				      							<td><?php echo $quantity ?></td>
				      						</tr>

				      						<?php 				      						 
				      					}
				      					?>
				      					<tr>
				      							<td>
				      								Status:- 
				      								<?php  
				      									if($status == 'ordered')
				      									{
				      										?>
				      										<h5 class="text-primary" ><?php echo $status; ?></h5>
				      										<?php
				      									}
				      									elseif($status == 'canceled')
				      									{
				      										?>
				      										<h5 class="text-danger" ><?php echo $status; ?></h5>
				      										<?php 
				      									}
				      									elseif($status == 'delivered')
				      									{
				      										?>
				      										<h5 class="text-success" ><?php echo $status; ?></h5>
				      										<?php 
				      									}
				      								?>
				      							</td>
				      							<td>Total</td>
				      							<td><?php echo $total ?></td>
				      							<td>
				      								<?php
				      								if($status == 'ordered')
				      								{
				      									?>
				      									<form action="cancelorder.php?currenttime= <?php echo $run['currenttime'];?>" method ="post">
				      									<button class ="btn btn-danger" onclick="return confirm('Are you sure you want to Cancel order?');" >Cancel Order</button>
				      								</form>
				      									<?php
				      								}
				      								if($status == 'canceled')
				      								{
				      									?>
				      									<a href="#" class= "btn btn-danger disabled">Cancel Order</a>
				      									<?php
				      								}
															if($status == 'delivered')
				      								{
				      									?>
				      									<a href="#" class= "btn btn-danger disabled">Cancel Order</a>
				      									<?php
				      								}				      								
				      								?>
				      								
				      							</td>
				      						</tr>
				      					<?php

				      		}
				      	}
				      	else
				      	{
				      		?>
				      		<h5 class="text-danger" align="center">No Orders</h5>
			       				<h4 align="center"><a href="product_userside.php" class="btn btn-primary">Go To Shop</a><h4>
				      		<?php 
				      	}
				      	?>
		      		</tbody>
		      	</table>
		      </div>
      		
      		
</body>
</html>