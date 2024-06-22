<!DOCTYPE html>
<html lang="en" class="js">
<head>
<link rel="stylesheet" type="text/css" href="css/style4.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Forget Password</title>
<link href="https://fonts.googleapis.com/css?family=Frijole" rel="stylesheet" type="text/css">
<style> body{padding:20px;}</style>
<link rel="stylesheet" type="text/css" href="loginfiles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="loginfiles/font-awesome.min.css">
<link href="assets/css/style6.css" rel="stylesheet">
<script src="assets/js/modernizr.custom.js"></script>
</head>
<body>
<?php
if(!empty($_POST))
{
$email = $_POST["email"];
$password= md5($_POST["password"]);
$conpassword = md5($_POST["confirmpassword"]);
$type = $_POST['type'];


    include 'connection.php';
  if ($password===$conpassword) 
  {
    if($type == "user") 
    {
      $data="UPDATE user_master SET password='$conpassword' WHERE email='$email'";
    }
    elseif($type == "caretaker")
    {
      $data="UPDATE caretaker SET password='$conpassword' WHERE email='$email'";

    }
    elseif($type == "trainer")
    {
      $data="UPDATE trainer SET password='$conpassword' WHERE email='$email'";

    }
    $result = mysqli_query($con,$data);
     header("location:login.php");
   }
}

?>

<form class="well form-horizontal" action="forgetpassword.php" method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend>
  <center>
    <h2>
      <b>Forget Password
      </b>
    </h2>
  </center>
</legend>
<br>

<div class="form-group">
  <label class="col-md-4 control-label">E-Mail</label>  
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" autocomplete="off" pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$" required>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" >Password</label> 
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
  <input name="password" placeholder="Password" class="form-control"  type="password"  required/>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Confirm Password</label> 
    <div class="col-md-8 inputGroupContainer">
    <div class="input-group">
  <input name="confirmpassword" placeholder="Confirm Password" class="form-control"  type="password" required>
  <p class="text-danger"><?php if(isset($password) && isset($conpassword)){ if($password!==$conpassword){ echo "password does not match";} }  ?></p>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Select User Type</label>
  <div class="col-md-4"><br>
    <select name="type">
      <option value="caretaker">Caretaker</option>
      <option value="user">User</option>
    </select>
  </div>
</div>


<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    <button type="submit" class="btn btn-success" >Update Password</button>
  </div>
</div>

</fieldset>
</body>
</html>