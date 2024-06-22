<?php
  session_start();
  include 'connection.php';
  $categoryname = $_POST["categoryname"];
  $description = $_POST["description"];
  $users =" SELECT * FROM product_category WHERE category = '$categoryname'";
  $users_run = mysqli_query($con,$users);
  $msg = "";
    if(mysqli_num_rows($users_run) > 0)
    {
      $msg = "Category already Registered";
      header("location:categories.php");
    }
    else
    {
      $query = " INSERT into product_category (category, description) 
      VALUES ('$categoryname', '$description')";
      $result = mysqli_query($con,$query);
      $msg = "";
      header("location:categories.php");
    }
    $_SESSION['message'] = $msg;
?>

