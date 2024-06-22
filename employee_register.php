<!DOCTYPE html>
<html lang="en" class="js">
<head>
<link rel="stylesheet" type="text/css" href="css/style4.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Employee Registration </title>
<link href="https://fonts.googleapis.com/css?family=Frijole" rel="stylesheet" type="text/css">
<style> body{padding:20px;}</style>
<link rel="stylesheet" type="text/css" href="loginfiles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="loginfiles/font-awesome.min.css">
<link href="assets/css/style.css" rel="stylesheet">
<script src="assets/js/modernizr.custom.js"></script>
</head>
<body>
<div class="container">
<?php
  if(!empty($_POST))
  {
      $msg = "";
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
    $type = $_POST["employee_type"];
    $targetpath = "documents/"; 
    $filename =basename($_FILES['document']['name']); 
    $document = $targetpath . $filename;
    $filetype = pathinfo($document, PATHINFO_EXTENSION);
    $allowtypes = array('pdf');

   // $trainer =" SELECT email FROM trainer WHERE email = '$email'";
   // $trainer_run = mysqli_query($con,$trainer);
   // $trainermobile_check =" SELECT mobile FROM trainer WHERE mobile = '$mobile'";
   // $trainermobile_run = mysqli_query($con,$trainermobile_check);
   // $msgt = ""; 
    //$msgmt = "";

    $caretaker =" SELECT email FROM caretaker WHERE email = '$email'";
    $caretaker_run = mysqli_query($con,$caretaker);
    $caretakermobile_check =" SELECT mobile FROM caretaker WHERE mobile = '$mobile'";
    $caretakermobile_run = mysqli_query($con,$caretakermobile_check);
    $msgc = ""; 
    $msgmc = "";
      if(in_array($filetype, $allowtypes))
      {
        if(move_uploaded_file($_FILES['document']['tmp_name'], $document))
        {
          if ($password===$conpassword) 
          {
             if($type == "caretaker") 
            {
              

              if(mysqli_num_rows($caretaker_run) > 0)
              {
                $msgc = "Caretaker  Email already Registered";
              }
              elseif (mysqli_num_rows($caretakermobile_run) > 0)
              {
                $msgmc = "Caretaker Mobile number already Registered";
              }
              else
              {
                $query = " insert into caretaker (firstname, lastname, username, password, gender, email, mobile, address, pincode, document) 
                values ('$firstname', '$lastname', '$username', '$conpassword','$gender','$email','$mobile','$address', '$pincode', '$document')";
                $result = mysqli_query($con,$query);
                header("location:login.php");
              }
            }
          }   
        }
        else
        {
            $msg = "Sorry, File not found";
        }
      }
      else
      {
        $msg = "Please, Upload a image of type(.pdf)";
      }
  }  
?>
    <form class="well form-horizontal" action="employee_register.php" method="post" id="contact_form" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend>
  <center>
    <h2>
      <b>Employee Registration 
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
  <input name="password" placeholder="Password" class="form-control"  type="password"  required/>
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
  <label class="col-md-4 control-label" >Register As</label> 
  <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
      <select name="employee_type">
      
        <option value="caretaker">Caretaker</option>
      </select>
    </div>
  </div>
</div>

<div class="form-group"> 
  <label class="col-md-4 control-label" >Gender</label> 
    <div class="col-md-4 inputGroupContainer"> 
    <div class="input-group">
  <input name="gender"  type="radio" value="male" checked>Male
   <br><input name="gender" type="radio" value="female" >Female
   <br/><input name="gender" type="radio" value="others">Others
    </div>
  </div>
</div>


<!-- Text input-->
       <div class="form-group">
  <label class="col-md-4 control-label">E-Mail</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
  <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" autocomplete="off" pattern="/^[a-zA-Z0-9.! #$%&'*+/=? ^_`{|}~-]+@[a-zA-Z0-9-]+(?:\. [a-zA-Z0-9-]+)*$/" required>
  <p class="text-danger"><?php if(isset($msgt)){echo $msgt;} if(isset($msgc)){echo $msgc;} ?></p>
    </div>
  </div>
</div>


<!-- Text input-->
       
<div class="form-group">
  <label class="col-md-4 control-label">Contact No</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
      <input name="mobile" placeholder="(+91)" class="form-control" type="number" min="7000000000" max="9999999999" required>
    <p class="text-danger"><?php if(isset($msgmt)){echo $msgmt;} if(isset($msgmc)){ echo $msgmc; } ?></p>
      
    </div>
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label">Document</label>  
    <div class="col-md-4 inputGroupContainer">
    <div class="input-group">
      <input name="document" class="form-control" type="file">
      <p class="text-danger"><?php if(isset($msg)){ echo $msg;} ?></p>
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
  <label class="col-md-4 control-label" >Address</label> 
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
    <button type="submit" class="btn btn-success" >SUBMIT</button>
     <a href="login.php" class="btn btn-success">LOGIN</a>
     <a href="forgetpassword.php">forgot password?</a>
  </div>
</div>

</fieldset>
</form>

</div>
    </div><!-- /.container -->
  </body>
</html>