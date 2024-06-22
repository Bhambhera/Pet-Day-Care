<?php 
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include 'connection.php';
$id = $_GET['id'];
if(isset($_POST['edit_user'])) 
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];    
    $username = $_POST['firstname'];    
    $gender = $_POST['gender'];   
    $mobile = $_POST['mobile']; 
    $email = $_POST['email'];   
    $address = $_POST['address'];    
    $pincode = $_POST['pincode'];
    $mobile_check ="SELECT id,mobile FROM user_master WHERE mobile = '$mobile' && id!= '$id' ";
    $mobile_run =  array (mysqli_query($con,$mobile_check));
        $msgm = "";
    $email_check ="SELECT id,email FROM user_master WHERE email = '$email' && id!= '$id' ";
    $email_check_run =  array (mysqli_query($con,$email_check));
        $msgme = "";
    if (in_array($mobile, $mobile_run))
    {
      $msgm = "Mobile number already Registered";
    }
    else if (in_array($email, $email_check_run))
    {
      $msgme = "Email  already Registered";
    }
    else
    {
        $update = "UPDATE user_master SET firstname = '$firstname' , lastname = '$lastname' , username = '$username' , gender = '$gender'  , mobile = '$mobile' , email = '$email', address = '$address' , pincode = '$pincode' WHERE id = '$id' ";
        $update_run = mysqli_query($con, $update);
    }   
    if ($update_run) 
    {
        header('location:manageprofile.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

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
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                    <a href="manageprofile.php" class="nav-item nav-link active">Profile</a>
                    <a href="logout.php" class="nav-item nav-link">Log Out</a>
                    
                </div>
                <a href="home.php" class="btn btn-lg btn-primary px-3 d-none d-lg-block">Pet World</a>
            </div>
        </nav>
    </div>
<?php
    
        $id = $_SESSION['uid'];
        $users =" SELECT * FROM user_master WHERE id = '$id'";
        $users_run = mysqli_query($con,$users);
        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
                ?>
                <form action="manageprofile.php?id= <?php  echo $user['id']; ?>" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">First Name</label> 
                            <input type="text" name="firstname"  value="<?= $user['firstname'];?>" placeholder="(ex:- Ramesh)" pattern="[a-z A-Z]{1,15}"  class="form-control" required>
                    </div> 
                    <div class="col-md-6 mb-3">
                    <label for="">Last Name</label> 
                        <input type="text" name="lastname" value="<?= $user['lastname'];?>" placeholder="(ex:- Sharma)" pattern="[a-z A-Z]{1,15}"class="form-control" required>
                    </div>  
                    <div class="col-md-6 mb-3">
                        <label for="">Gender</label> 
                        <br/>
                        <div class="form-control">
                            <input name="gender"  type="radio" value="male"  <?php if($user['gender']=="male"){echo "checked=\"checked\"";} ?>>Male   
                                    <input name="gender" type="radio" value="female" <?php if($user['gender']=="female"){echo "checked=\"checked\"";} ?>>Female
                                    <input name="gender" type="radio" value="others" <?php if($user['gender']=="others"){echo "checked=\"checked\"";} ?>>Others
                            </div>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label> 
                            <input type="text" name="email" value="<?= $user['email'];?>" placeholder="(ex:- abc@gmail.com)" pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$" class="form-control" required>
                            <p class="text-danger"><?php if(isset($msgme)){ echo $msgme;} ?></p>

                    </div>  
                    <div class="col-md-6 mb-3">
                        <label for="">Mobile</label> 
                            <input type="text" name="mobile" value="<?= $user['mobile'];?>" placeholder="(ex:- 9845676432)" pattern="^[7-9]{1}[0-9]{9}$" class="form-control" required>
                            <p class="text-danger"><?php if(isset($msgm)){ echo $msgm;} ?></p>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="">Address</label> 
                            <textarea name="address" placeholder="(ex:- 2, ramshahan colony, bandra)" required><?= $user['address'];?></textarea>
                    </div>   
                    <div class="col-md-6 mb-3">
                        <label for="">Pincode</label> 
                            <input type="text" name="pincode" value="<?= $user['pincode'];?>" placeholder="(ex:- 380015)" pattern="^[1-9]{1}[0-9]{2}[0-9]{3}$"  class="form-control" required>
                    </div> 
                    <div class="col-md-12 mb-3">
                        <button type="submit" onclick="return confirm('Are you sure you want to Edit?');" class="btn btn-primary" name="edit_user">
                        Edit User
                        </button>
                    </div>               
                </div>      
            </form>
            <?php
        }
    }
    else
    {
        ?>
        <h4>No Record Found</h4>
        <?php
    }

?> 
                                   
                                 </div>   
                            </div>
                        </div>
                     </div>
                </div>

            <?php include 'scripts.php'; ?>
                    </body>
