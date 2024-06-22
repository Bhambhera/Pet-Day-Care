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
</head>
<body>
	<div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-lg-5">
            <a href="" class="navbar-brand d-block d-lg-none">
                <h1 class="m-0 display-5 text-capitalize font-italic text-white"><span class="text-primary">Safety</span>First</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                <div class="navbar-nav mr-auto py-0">
                    <a href="home.php" class="nav-item nav-link ">Home</a>
                    
                    <div class="nav-item dropdown">
                        <a href="services.php" class="nav-link dropdown-toggle" data-toggle="dropdown">Services</a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="product_userside.php" class="dropdown-item">Pet Store</a>
                            <a href="ulogin.php" class="dropdown-item">Pet Caretaker</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link active">Contact Us</a>
                    <a href="manageprofile.php" class="nav-item nav-link ">Profile</a>
                    <a href="logout.php" class="nav-item  nav-link">Log Out</a>
                    
                </div>
                <a href="home.php" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Pet World</a>
            </div>
        </nav>
    </div>
<section>
  <div>
    <h2 class="text-center">Contact Us</h2>
    <br>
 
       <br>
</section>
<br>

<?php
if(!empty($_POST))
{
  session_start();
  $con = mysqli_connect('localhost','root');
  mysqli_select_db($con,'petdaycaredatabase');

  $user = $_POST["user"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  $comment = $_POST["comment"];

  $query = " insert into userinfodata (user, email, mobile, comment) 
  values ('$user', '$email', '$mobile', '$comment')";

  $result = mysqli_query($con,$query);
  header("location:home.php");
}?>
  <div class="w-50 m-auto">
    <form action="contact.php" method="post">
      <div class="form-group">
        <label>UserName</label>
        <input type="text" value="<?= $user['firstname'];?>" name="user" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Email ID</label>
        <input type="text" value="<?= $user['email'];?>" name="email" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Mobile Number</label>
        <input type="text" value="<?= $user['mobile'];?>" name="mobile" class="form-control" required />
      </div>
      <div class="form-group">
        <label>Comments</label>
        <textarea class="form-control" name="comment" required /></textarea>
      </div>
      <input type="submit" class="btn btn-success" align="text-center" />
  </div>
  <?php
    }
        }
        ?>
  
  <br/>
  <br/>
  <footer>
    <h3 class="p-3 bg-dark text-white text-center">@Pets World</h3>
  </footer>
</body>
</html>