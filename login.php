<!DOCTYPE html>
<html lang="en" class="js">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Login Form</title>
  <!--<link href="https://fonts.googleapis.com/css?family=Frijole" rel="stylesheet" type="text/css">-->
  <style> body{padding:200px;}</style>
  <link rel="stylesheet" type="text/css" href="loginfiles/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="loginfiles/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/style4.css">
  <link href="assets/css/style4.css" rel="stylesheet">
  <script src="assets/js/modernizr.custom.js"></script>
</head>
<body>
  
<?php 
  include 'connection.php';
  session_start();
  if(isset($_POST['email']))
  {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $sql="select * from user_master where email='".$email."' AND password='".$password."'";
    $result=mysqli_query($con,$sql);
    $no_of_rec = mysqli_num_rows($result);

    $sqladmin="select * from admin_master where email='".$email."' AND password='".$password."'";
    $resultadmin= mysqli_query($con,$sqladmin);
    $no_of_rec1 = mysqli_num_rows($resultadmin);

    $sqlcaretaker="select * from caretaker where email='".$email."' AND password='".$password."'";
    $resultcaretaker= mysqli_query($con,$sqlcaretaker);
    $no_of_rec2 = mysqli_num_rows($resultcaretaker);

    foreach($result as $value)
    {
      $id = $value['id'];
    }

    foreach($resultcaretaker as $valuecaretaker)
    {
      $cid = $valuecaretaker['id'];
    }   

    if($no_of_rec == 1)
    {
      $_SESSION['uid'] = $id;
      mysqli_close($con);
	    $_SESSION['logged_in'] = TRUE;
      header("location:home.php");
    }
    else if ($no_of_rec1 == 1)
    {
      mysqli_close($con);
      $_SESSION['logged_in'] = TRUE;
      header("location:admin.php");
    }
    else if ($no_of_rec2 == 1)
    {
      $_SESSION['cid'] = $cid;
      mysqli_close($con);
      $_SESSION['logged_in'] = TRUE;
      header("location:booked_caretaker.php");
    }
  }
  
?>
  <div class="container">
<form class="well form-horizontal" action="login.php" method="post">
<fieldset>


<legend><center><h2><b>Login Form</b></h2></center></legend><br>


<div class="form-group">
  <label class="col-md-4 control-label">Email Id</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="email" placeholder="Enter your Email Id" class="form-control"  type="email" required>
    </div>
  </div>
</div>



<div class="form-group">
  <label class="col-md-4 control-label" >Password</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="password" placeholder="Password" class="form-control"  type="password" required>
    </div>
    <p class="text-danger"><?php if(isset($no_of_rec) && isset($no_of_rec1)){if($no_of_rec != 1 && $no_of_rec1 != 1) {echo "invalid email or password"; }}?></p>
  </div>
</div>
<div>

 <div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    <button type="submit" class="btn btn-success" >Submit</button>
    <a href="register.php" class="btn btn-success">Register</a></br>
    <a href="forgetpassword.php" >forgot password?</a>

  </div>
</div>

</fieldset>
</form>
</body>
</html>
