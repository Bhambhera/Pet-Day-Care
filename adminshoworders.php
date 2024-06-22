<?php 
error_reporting(E_ALL ^ E_NOTICE);
include 'connection.php';
include 'admin_sidebar.php';
session_start();
$query = "SELECT * FROM store_order";
$query_run = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<div id="layoutSidenav_content">
    	<main>
        	<div class="container-fluid px-4">
            	<h1 class="mt-4">Orders</h1>
                	<ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                        <li class="breadcrumb-item ">Orders</li>
                    </ol>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Orders</h4>
                    </div>
                     <?php
				      		$uid = $_SESSION['uid'];
				      		$query = "SELECT * FROM store_order ";
				      		$query_run = mysqli_query($con, $query);
				      		$select_group = "SELECT DISTINCT(`currenttime`) FROM `store_order`";
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
					      				<th>Username</th>
					      				<th>Address</th>
					      				<th>Mobile Number</th>
					      				<th>Subprice</th>
					      				<th>Quantity</th>
					      			</tr>
					      		</thead>
					      		<tbody>
				      			<?php
				      					$currenttime = $run['currenttime'];
				      					$select_product = "SELECT * FROM  store_order   WHERE currenttime = '$currenttime' ";
				      					$select_product_run = mysqli_query($con, $select_product);
				      					$total = 0;
				      					foreach($select_product_run as $check)
				      					{
				      						$productname = $check['productname'];
				      						$price = $check['price'];
				      						$subprice = $check['subprice'];
				      						$quantity = $check['quantity'];
				      						$status = $check['status'];
				      						$uid_store = $check['uid'];
				      						$total = $total + $subprice ;
				      						$select_user = "SELECT * FROM user_master WHERE id = '$uid_store' ";
				      						$select_user_run = mysqli_query($con, $select_user);
				      					foreach($select_user_run as $user)
				      					{
				      						$username = $user['username'];
				      						$address = $user['address'];
				      						$mobile = $user['mobile'];
				      					}
				      						?>
				      						<tr>
				      							<td><?php echo $productname ?></td>
				      							<td><?php echo $price ?></td>
				      							<td><?php echo $username ?></td>
				      							<td><?php echo $address ?>	</td>
				      							<td><?php echo $mobile ?></td>
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
				      										<form action="admincancelorder.php?currenttime= <?php echo $run['currenttime'];?>" method ="post">
				      									<button class ="btn btn-success" name="order_delivered" onclick="return confirm('Are you sure your order is delivered?');" >Delivered</button>
				      								</form>
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
				      							<td></td>
				      							<td></td>
				      							<td></td>
				      							<td>Total</td>
				      							<td><?php echo $total ?></td>
				      							<td>

				      								<?php
				      								if($status == 'ordered')
				      								{
				      									?>
				      								<form action="admincancelorder.php?currenttime= <?php echo $run['currenttime'];?>" method ="post">
				      									<button class ="btn btn-danger" name="cancel_delivered" onclick="return confirm('Are you sure you want to Cancel order?');" >Cancel Order</button>
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
				      		<?php
				      	}
				      	?>
		      		</tbody>
		      	</table>
		      </div>
            </div>
        </main>
    </div>
   
</body>
</html>