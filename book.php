<?php include 'connection.php'; 
session_start();
if(!isset($_SESSION['logged_in']))
{
  header("location:login.php");
}
$id=$_SESSION['uid'];
$query =" SELECT * FROM user_master WHERE id = '$id' ";
        $users_run = mysqli_query($con,$query); 
        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
            	
            
                ?>


<html>
<head>
<link rel="stylesheet" href="css/main.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
</head>			

<body style="background-image:url(images/dog3.jpg)" height="100%">
	<div class="header">
		<ul>
			<li style="float:left;border-right:none"><a href="ulogin.php" class="logo"><strong> CARE-TAKER </strong></a></li>
			
			<li><a href="home.php">Home</a></li>
		</ul>
	</div>
	<form action="connect.php" method="post">
	<div class="sucontainer" style="background-image:url(images/sky1.jpg)">
		<label><b>Name:</b></label><br>


		<!-- //////////////firstname///////// -->
		<input type="text" value="<?= $user['firstname'];?>" placeholder=" Full name " name="fname" required>  
		<br>
		<br>
		<label><b>TIME:<b></label><br>
		<br>
		<label style="font-size:15px"> From </label>
		<input type="time" name="time" required>
		<label style="font-size:15px"> To</label>
		<input type="time" name="time1" required>	
        <br>
		<br>
		<label>*Note: Hourly price for hiring caretaker is 175Rs INR</label><br>
		<br>
	
		<label><b>On which Date</b></label><br>
		<input type="date" name="dov" onchange="getDay(this.value);" min="2022-05-12" max="2022-05-18" required=""><br><br>
		<div id="datestatus"> </div>

		<div class="form-group">
  <label class="col-md-4 control-label">Contact No</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
      <input name="mobile" value="<?= $user['mobile'];?>" placeholder="(+91)" class="form-control" type="number" pattern="^[7-9]{1}[0-9]{9}$" required>
       
    </div>
    <br>
		<label>Address:</label><br>
		<br>
		<textarea name="address" rows="6" cols="58"><?= $user['address'];?></textarea>


		<div class="container">
			<input type="submit" style="position:center" name="submit" value="Book">
		</div>
		<?php
		}
				}
				?>
	

</div></form></body></html>