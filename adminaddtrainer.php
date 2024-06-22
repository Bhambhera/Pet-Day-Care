<?php
include 'connection.php';
    if(!empty($_POST))
    {
      $firstname = $_POST["firstname"];
      $lastname = $_POST["lastname"];
      $username = $_POST["firstname"];
      $password= $_POST["password"];
      $conpassword = $_POST["confirmpassword"];
      $gender = $_POST["gender"];
      $email = $_POST["email"];
      $mobile = $_POST["mobile"];
      $address = $_POST["address"];
      $pincode = $_POST["pincode"];
      $targetpath = "documents/"; 
      $filename =basename($_FILES['document']['name']); 
      $document = $targetpath . $filename;
      $filetype = pathinfo($document, PATHINFO_EXTENSION);
      $allowtypes = array('pdf');
      $trainer =" SELECT email FROM trainer WHERE email = '$email'";
        $trainer_run = mysqli_query($con,$trainer);
        $trainermobile_check =" SELECT mobile FROM trainer WHERE mobile = '$mobile'";
        $trainermobile_run = mysqli_query($con,$trainermobile_check);
        $msgt = ""; 
        $msgmt = "";
      if(in_array($filetype, $allowtypes))
      {
        if(move_uploaded_file($_FILES['document']['tmp_name'], $document))
        {
          if ($password===$conpassword) 
          {
            if(mysqli_num_rows($trainer_run) > 0)
            {
                $msgt = "Trainer Email already Registered";
            }
            elseif (mysqli_num_rows($trainermobile_run) > 0)
            {
                $msgmt = "Trainer Mobile number already Registered";
            }
            else
            {
                $query = " INSERT into trainer (firstname, lastname, username, password, gender, email, mobile, address, pincode, document) 
                values ('$firstname', '$lastname', '$username', '$conpassword','$gender','$email','$mobile','$address', '$pincode', '$document')";
                $result = mysqli_query($con,$query);
                header("location:registeredtrainers.php");
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

<?php include 'admin_sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Add Trainers</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item active">Registered Trainers</li>
                            <li class="breadcrumb-item">Add Trainers</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Add Trainers</h4>
                                </div>
                                <div class="card-body">
                                    <form action="adminaddtrainer.php" method="post"  enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">First Name</label> 
                                    <input type="text" name="firstname" class="form-control" placeholder="(ex:- Ramesh)"
                                    pattern="[a-z A-Z]{1,15}" required>
                                </div> 
                                <div class="col-md-6 mb-3">
                                    <label for="">Last Name</label> 
                                    <input type="text" name="lastname" placeholder="(ex:- Sharma)"
                                    pattern="[a-z A-Z]{1,15}" class="form-control" required>
                                </div>  
                                <div class="col-md-6 mb-3" >
                                    <label for="">Gender</label>
                                <div class="form-control">
                                                               
                                    <input name="gender"  type="radio" value="male"  checked>Male
                                <br>
                                    <input name="gender" type="radio" value="female" >Female
                                <br/>
                                    <input name="gender" type="radio" value="others">Others
                                </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Email</label> 
                                    <input type="text" name="email" placeholder="(ex:- abc@gmail.com)" pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$" class="form-control" required>
                                    <p class="text-danger"><?php if(isset($msgt)){ echo $msgt;} ?></p>    
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Password</label> 
                                    <input type="Password" name="password" placeholder="(ex:-abc123)" pattern="^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*|(?=\S*[\W])$" class="form-control" required>
                                </div> 
                                <div class="col-md-6 mb-3">
                                    <label for="">ConfirmPassword</label> 
                                    <input type="Password" name="confirmpassword" placeholder="re-enter password" class="form-control" required>

                                    <p class="text-danger"><?php if(isset($password) && isset($conpassword)){ if($password!==$conpassword){ echo "password does not match";} }  ?></p>

                                </div>  
                                <div class="col-md-6 mb-3">
                                    <label for="">Mobile</label> 
                                    <input type="text" name="mobile"  class="form-control" placeholder="(ex:- 9823456127)"pattern="^[7-9]{1}[0-9]{9}$" required>
                                    <p class="text-danger"><?php if(isset($msgmt)){ echo $msgmt;} ?></p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Document</label> 
                                    <input type="file" name="document"  class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Address</label> 
                                    <textarea name="address" placeholder="(ex:- 2, ramshahan colony, bandra)" required></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Pincode</label> 
                                    <input name="pincode" placeholder="(ex:- 380015)" class="form-control" type="text" pattern="^[1-9]{1}[0-9]{2}[0-9]{3}$" required>
                        </div>    
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary" name="add_user">Add Trainer
                                    </button>
                                </div>               
                                </div>      
                                        </form>
                                    </div>   
                            </div>
                        </div>
                     </div>
                </div>

            <?php include 'scripts.php'; ?>
                    </body>
                </html>