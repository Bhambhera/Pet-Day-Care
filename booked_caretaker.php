<?php
include 'connection.php';
session_start();
if(!isset($_SESSION['logged_in']))
{
  header("location:login.php");
}

$cid = $_SESSION['cid'];
?>
<html>
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
</head>
<body style="background-image:url(images/dog3.jpg)">
	<table align="center">
		<tr>
				<th>Name</th>
					<th>Mobile</th>
						<th>Start time</th>
							<th>End time</th>
								<th>Date</th>
									<th>Address</th>
									    <th>Cancel</th>
</tr>
<div class="header">
		<ul>
			<li style="float:left;border-right:none"><a class="logo"><strong>Your Appointments here</strong></a></li>
			
		</ul>
		<br>
	</div>
<?php

$query = "SELECT bc.id, um.firstname, um.mobile, um.address, bc.time2, bc.time1, bc.dov FROM bookingct bc LEFT JOIN user_master um ON bc.uid = um.id WHERE cid = '$cid'";
	$users_run2 = mysqli_query($con,$query);
        if(mysqli_num_rows($users_run2) > 0)
        {
            foreach($users_run2 as $user2)
            {?>
            	<tr>
            	<td><?echo $user2['firstname'];?></td>
            	<td><?echo $user2['mobile'];?></td>
            	<td><?echo $user2['time2'];?></td>
            	<td><?echo $user2['time1'];?></td>
            	<td><?echo $user2['dov'];?></td>
            	<td><?echo $user2['address'];?></td>
            	<td>
            	<form action="deleteappointment.php?id= <?php echo $user2['id'];?>" method="post" >
            	<button type="submit" class ="btn btn-danger"  name="delete_app" value="<?php $user2['id'];?>" onclick="return confirm('Are you sure you want to Delete?');">
                Cancel    
                </button>
                </td>
            </tr>
<?php
            }
        }
        else
        {
        	?>
        	<tr>
        		<td colspan="7" align="center">
        		You do not have any appointments.
        		</td>
        	</tr>
        <?php
        }
?>
</table>
</body>
</html>