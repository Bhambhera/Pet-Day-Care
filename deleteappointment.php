<?php
   include 'connection.php';
   $id = $_GET['id'];
    if(isset($_POST['delete_app']))
    {
      $query1 =" SELECT * FROM bookingct WHERE id = '$id' ";
      $caretaker_run = mysqli_query($con,$query1); 
        if(mysqli_num_rows($caretaker_run) > 0)
      {
            foreach($caretaker_run as $caretaker)
            {
                  $cid = $caretaker['cid'];
            }
      }  

      $query2 = "UPDATE caretaker SET status = 'available' WHERE  id = '$cid'";
      $query_run = mysqli_query($con, $query2);

      $delete = "DELETE FROM bookingct WHERE id = '$id' "; 
      $delete_run = mysqli_query($con , $delete);
      
      header('location:viewpatientappointments.php');   
    }
    