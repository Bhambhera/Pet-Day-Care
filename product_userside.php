<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
if(!isset($_SESSION['logged_in']))
{
  header("location:login.php");
}
$uid = $_SESSION['uid'];
if(!isset($_SESSION['logged_in']))
{
  header("location:login.php");
}
include 'connection.php';
$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = '$id' ";
$result = mysqli_query($con, $sql);
foreach ($result as $run) 
{
	$productname = $run['productname'];
	$price = $run['price'];
	$quantity_product = $run['quantity'];
	$productincart_check = "SELECT * FROM cart WHERE productname = '$productname' && uid = '$uid' ";
	$productincart_check_run = mysqli_query($con, $productincart_check);
	if(mysqli_num_rows($productincart_check_run) > 0)
	{
		foreach($productincart_check_run as $user)
		{
			$id = $user['id'];
			$quantity = $user['quantity'];
			if($quantity >= $quantity_product)
			{
				header('location:mycart.php');
			}
			else
			{
				$quantity++;
				$add_quantity = "UPDATE cart SET quantity = '$quantity' WHERE id = '$id'";
				$add_quantity_run = mysqli_query($con, $add_quantity);
				header('location:mycart.php');
			}
		}
	}
	else
	{
		$cart_insert = " INSERT into cart (uid, productname, price) 
	            VALUES ('$uid', '$productname', '$price')";
		$cart_insert_run = mysqli_query($con,$cart_insert);
		$added_to_cart  = 1;
		if($cart_insert_run)
		{
			header('location:mycart.php');
		}
	}
}
?>
<?php

$query = "SELECT * FROM products";
$query_run = mysqli_query($con , $query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

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
   			<a class="navbar-brand" href="home.php">Pets Day Care</a>
    			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      				<span class="navbar-toggler-icon"></span>
    			</button>
    				<div class="collapse navbar-collapse" id="navbarSupportedContent">
      					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
       						<li class="nav-item">
          						<a class="nav-link" aria-current="page" href="home.php">Home</a>
        					</li>
        					<li class="nav-item">
          						<a class="nav-link active" aria-current="page" href="product_userside.php">Store</a>
        					</li>
      					</ul>
      					<ul class="navbar-nav ml-auto mb-2 mb-lg-0">
      						<li class="nav-item">
      							<a class="nav-link" href="mycart.php" class="btn btn-success">My Cart</a>
      						</li>
      						<li class="nav-item">
      							<a class="nav-link" href="myorders.php" class="btn btn-primary">My Orders</a>
      						</li>
      						<li class="nav-item">
          						<a class="nav-link" aria-current="page" href="logout.php">Logout</a>
        					</li>
      					</ul> 
    		</div>
  		</div>
	</nav>
	<br>
	<div class="col-md-12">
	<div class="row">
	<?php
	        While($row = mysqli_fetch_array($query_run))
	        {
	            ?>
	            <form action="product_userside.php?id=<?php echo $row['id'];?>" method="post">
			       <div class="card" style="width:300px">
			          <img class="card-img-top" src="<?php echo $row['productimage'];?>" alt="Card image">
			            <div class="card-body">
			              <h4 class="card-title"><?php echo $row['productname']; ?></h4>
			                <h4 class="card-title">Rs <?php echo $row['price']; ?></h4>
			            </div>
			             <div class="card-body">
			            	
			                <?php 
								if($row['quantity'] > 0)
				                {
				                 	?>
				                  	<input type="submit" value="Add To Cart" class="btn btn-primary btn-sm">
				                  	<?php
				                }
				                elseif($row['quantity'] <= 0)
				                {
				                	?>
				                  	<p class="text-danger"><?php echo $row['status']; ?></p>
				                  	<a href="#" class= "btn btn-primary disabled">Add To Cart</a>
				                  	<?php
				                }
			                ?>
			            </div>
			        </div>
			    </form>
			    <?php
			}
	?>
</div>
</div>
</body>
</html>