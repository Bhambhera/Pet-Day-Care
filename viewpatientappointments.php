<?php include 'connection.php'; 
session_start();
if(!isset($_SESSION['logged_in']))
{
  header("location:login.php");
}
$id=$_SESSION['uid'];
$query ="SELECT * FROM user_master WHERE id = ".$id;
$users_run = mysqli_query($con,$query); 
//print_r($users_run); exit;
if(mysqli_num_rows($users_run) > 0)
{
    //var_dump($users_run);
    while($user = mysqli_fetch_array($users_run))
        {?>
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
<!-- <html>
<head>
<title></title>
<link href="css/adminstyles.css" rel="stylesheet" />
<link rel="stylesheet" href="css/main.css">
<style>
table{
    width: 85%;
    border-collapse: collapse;
	border: 4px solid black;
    padding: 5px;
	font-size: 25px;
}

th{
border: 4px solid black;
	background-color: #4CAF50;
    color: white;
	text-align: left;
}
tr,td{
	border: 4px solid black;
	background-color: white;
    color: black;
}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head> -->
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  		<div class="container-fluid">
   			<a class="navbar-brand" href="home.php">Pets World</a>
    			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    			</button>
    				<div class="collapse navbar-collapse" id="navbarSupportedContent">
      					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
       						<li class="nav-item">
          						<a class="nav-link" aria-current="page" href="home.php">Home</a>
        					</li>
        					<li class="nav-item">
          						<a class="nav-link active" aria-current="page" href="ulogin.php">Caretaker</a>
        					</li>
      					</ul>
      					<ul class="navbar-nav ml-auto mb-2 mb-lg-0">
      						
      						<li class="nav-item">
      							<a class="nav-link" class="btn btn-primary"><?php echo $user['firstname']; ?></a>
      						</li>
      						<li class="nav-item">
          						<a class="nav-link" aria-current="page" href="logout.php">Logout</a>
        					</li>
      					</ul> 
    		</div>
  		</div>
  		<style>
table{
    width: 85%;
    border-collapse: collapse;
	border: 4px solid black;
    padding: 5px;
	font-size: 25px;
}

th{
border: 4px solid black;
	background-color: #4CAF75;
    color: white;
	text-align: left;
}
tr,td{
	border: 4px solid black;
	background-color: white;
    color: black;
}
</style>
	</nav>
	<div >
		<h2 align="center">Appointment details</h2>
	</div>
	<table align="center">
		<tr>
				<th>Caretaker Name</th>
					<th>Mobile</th>
						<th>Start time</th>
							<th>End time</th>
								<th>Date</th>
									<th>Address</th>
										<th>Cancel</th>
		</tr>

	<?php

$query1 ="SELECT * FROM bookingct WHERE uid = ".$user['id'];
        $users_run1 = mysqli_query($con,$query1); 
        if(mysqli_num_rows($users_run1) > 0)
        {
            while($user1 = mysqli_fetch_array($users_run1))
            {
            	$cid = $user1['cid'];
            
        $query2 ="SELECT * FROM caretaker WHERE id = ".$cid;
        $users_run2 = mysqli_query($con,$query2); 
        if(mysqli_num_rows($users_run2) > 0)
        {
            while($user2 = mysqli_fetch_array($users_run2))
            {
                  ?>
            <tr>
            	<td><?php echo $user2['firstname'];?></td>
            	<td><?php echo $user2['mobile'];?></td>
            	<td><?php echo $user1['time2'];?></td>
            	<td><?php echo $user1['time1'];?></td>
            	<td><?php echo $user1['dov'];?></td>
            	<td><?php echo $user1['address'];?></td>

            	<td>
            	<form action="deleteappointment.php?id= <?php echo $user1['id'];?>" method="post" >
            	<button type="submit" class ="btn btn-danger"  name="delete_app" value="<?php $user1['id'];?>" onclick="return confirm('Are you sure you want to Delete?');">
                Cancel    
                </button>
                </td>
            </tr>
<?php 
           	
            	}
            }
  else{
	echo "0 result";
	  }          

}
}
else
        {
        	?>
        	<tr>
        		<td colspan="7" align="center">
        		Sorry Caretakers are not available at the moment.
        		</td>
        	</tr>
        <?php
        }
}
}
?>
</form>
</body>
</html>