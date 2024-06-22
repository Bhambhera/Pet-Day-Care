<?php
include 'connection.php';
session_start();

$uid = $_SESSION['uid'];  
$fname = $_POST['fname'];
$mobile = $_POST['mobile'];
$time = $_POST['time'];
$time1 = $_POST['time1'];
$dov = date('y-m-d',strtotime($_POST['dov']));
$address = $_POST['address'];

      $query1 =" SELECT * FROM caretaker WHERE approved = 'yes' && status = 'available' ";
        $caretaker_run = mysqli_query($con,$query1); 
if(mysqli_num_rows($caretaker_run) > 0)
      {
            foreach($caretaker_run as $caretaker)
            {
                  $cid = $caretaker['id'];
            }
      }  
      $query = "INSERT into bookingct (uid, cid, time2, time1, dov, address)
      values ('$uid', '$cid', '$time', '$time1', '$dov', '$address')";
      $result = mysqli_query($con,$query);

      $query2 = "UPDATE caretaker SET status = 'unavailable' WHERE  id = '$cid'";
      $query_run = mysqli_query($con, $query2);

      header('location: viewpatientappointments.php');

?>