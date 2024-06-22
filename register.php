<!DOCTYPE html>
<html lang="en" class="js">
<head>
<link rel="stylesheet" type="text/css" href="css/style4.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Registration Form</title>
<link href="https://fonts.googleapis.com/css?family=Frijole" rel="stylesheet" type="text/css">
<style> body{padding:-20px;}</style>
<link rel="stylesheet" type="text/css" href="loginfiles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="loginfiles/font-awesome.min.css">
<link href="assets/css/style6.css" rel="stylesheet">
<script src="assets/js/modernizr.custom.js"></script>
</head>
<body>
<div class="container">

<?php
if(!empty($_POST))
{
  include 'connection.php';

  $firstname = $_POST["firstname"];
  $lastname = $_POST["lastname"];
  $username = $_POST["firstname"];
  $password= md5($_POST["password"]);
  $conpassword = md5($_POST["confirmpassword"]);
  $gender = $_POST["gender"];
  $email = $_POST["email"];
  $mobile = $_POST["mobile"];
  $address = $_POST["address"];
  $pincode = $_POST["pincode"];

  $users =" SELECT * FROM user_master WHERE email = '$email'";
  $users_run = mysqli_query($con,$users);
  $mobile_check =" SELECT * FROM user_master WHERE mobile = '$mobile'";
  $mobile_run = mysqli_query($con,$mobile_check);
  $msg = ""; 
  $msgm = "";
        
  if ($password===$conpassword) 
  {
    if(mysqli_num_rows($users_run) > 0)
    {
      $msg = "Email already Registered";
    }
    elseif (mysqli_num_rows($mobile_run) > 0)
    {
      $msgm = "Mobile number already Registered";
    }
    else
    {
      $query = " insert into user_master (firstname, lastname, username, password, gender, email, mobile, address, pincode) 
      values ('$firstname', '$lastname', '$username', '$conpassword','$gender','$email','$mobile','$address','$pincode')";
      $result = mysqli_query($con,$query);
      header("location:login.php");
    }
  }
}  
?>
    <form class="well form-horizontal" action="register.php" method="post"  id="contact_form">
<fieldset>

<!-- Form Name -->
<legend>
  <center>
    <h2>
      <b>Registration Form
      </b>
    </h2>
  </center>
</legend>
<br>


<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label">First Name</label>  
  <div class="col-md-4 inputGroupContainer">
  <div class="input-group">
  <input  name="firstname" placeholder="First Name" class="form-control"  type="text" pattern="[a-z A-Z]{1,15}" required>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Last Name</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="lastname" placeholder="Last Name" class="form-control"  type="text" pattern="[a-z A-Z]{1,15}" required>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Password</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="password" placeholder="min 6 char ex:-(abc123)" class="form-control"  type="password" pattern="^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*|(?=\S*[\W])$" required/>
    </div>
  </div>
</div>

<!-- Text input-->

<div class="form-group">
  <label class="col-md-4 control-label" >Confirm Password</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="confirmpassword" placeholder="Confirm Password" class="form-control"  type="password" required>
  <p class="text-danger"><?php if(isset($password) && isset($conpassword)){ if($password!==$conpassword){ echo "password does not match";} }  ?></p>
    </div>
  </div>
</div>

<div class="form-group"> 
  <label class="col-md-4 control-label" >Gender</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="gender" type="radio" value="male">Male
   <input name="gender" type="radio" value="female" >Female
   <input name="gender" type="radio" value="others">Others
    </div>
  </div>
</div>


<!-- Text input-->
       <div class="form-group">
  <label class="col-md-4 control-label">E-Mail</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" autocomplete="off"  required>
  <p class="text-danger"><?php if(isset($msg)){ echo $msg;} ?></p>
    </div>
  </div>
</div>


<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Contact No</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
      <input name="mobile" placeholder="(+91)" class="form-control" type="text" pattern="^[7-9]{1}[0-9]{9}$" required>
  <p class="text-danger"><?php if(isset($msgm)){ echo $msgm;} ?></p>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" >Address</label> 
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <textarea name="address" placeholder="address" class="form-control"></textarea>
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Pincode</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
      <input name="pincode" placeholder="Pincode" class="form-control" type="text" pattern="^[1-9]{1}[0-9]{2}[0-9]{3}$" required>
      
    </div>
  </div>
</div>

<!-- Select Basic -->

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label"></label>
  <div class="col-md-4"><br>
    <button type="submit" class="btn btn-success" >Register</button>
     <a href="login.php" class="btn btn-success">LOGIN</a>
     <br>
     <a href="employee_register.php">Register As Caretaker</a>
  </div>
</div>

</fieldset>
</form>

</div>
    </div><!-- /.container -->
  </body>
</html>