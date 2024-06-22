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
            $query = " INSERT into user_master (firstname, lastname, username, password, gender, email, mobile, address, pincode) 
            values ('$firstname', '$lastname', '$username', '$conpassword','$gender','$email','$mobile','$address', '$pincode')";
            $result = mysqli_query($con,$query);
            header("location:registeredusers.php");
        }
        
       }
    }
?>

<?php include 'admin_sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Add Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item active">Registered Users</li>
                            <li class="breadcrumb-item">Add Users</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Add users</h4>
                                </div>
                                <div class="card-body">
                                    <form action="adminadduser.php" method="post">
                                <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">First Name</label> 
                                    <input type="text" name="firstname" placeholder="(ex:- Ramesh)" class="form-control" pattern="[a-z A-Z]{1,15}" required>
                                </div> 
                                <div class="col-md-6 mb-3">
                                    <label for="">Last Name</label> 
                                    <input type="text" name="lastname" placeholder="(ex:- Sharma)" pattern="[a-z A-Z]{1,15}" class="form-control" required>
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
                                    <input type="text" name="email"  placeholder="(ex:- abc@gmail.com)"pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$" class="form-control" required>
                                    <p class="text-danger"><?php if(isset($msg)){ echo $msg;} ?></p>   
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Password</label> 
                                    <input type="Password" placeholder="(ex:-abc123)" name="password" pattern="^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*|(?=\S*[\W])$" class="form-control" required>
                                </div> 
                                <div class="col-md-6 mb-3">
                                    <label for="">ConfirmPassword</label> 
                                    <input type="Password" name="confirmpassword"  class="form-control" placeholder="re-enter password"required>
                                    <p class="text-danger"><?php if(isset($password) && isset($conpassword)){ if($password!==$conpassword){ echo "password does not match";} }  ?>
                                    </p>
                                </div>  
                                <div class="col-md-6 mb-3">
                                    <label for="">Mobile</label> 
                                    <input type="text" name="mobile" placeholder="(ex:- 9823456127)" class="form-control"  pattern="^[7-9]{1}[0-9]{9}$" required>
                                    <p class="text-danger"><?php if(isset($msgm)){ echo $msgm;} ?></p>
                                </div> 
                                <div class="col-md-6 mb-3">
                                    <label for="">Address</label> 
                                    <textarea name="address" placeholder="(ex:- 2, ramshahan colony, bandra)" required ></textarea>
                                </div>   
                                <div class="col-md-6 mb-3">
                                    <label for="">Pincode</label> 
                                    <input type="text" name="pincode" placeholder="(ex:- 380055)" pattern="^[1-9]{1}[0-9]{2}[0-9]{3}$" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary" name="add_user">
                                    Add User
                                    </button>
                                </div>               
                            </div>      
                                        </form>
                                    </div>   
                            </div>
                        </div>
                     </div>
                </div>

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
                        <script src="js/scripts.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
                        <script src="assets/demo/chart-area-demo.js"></script>
                        <script src="assets/demo/chart-bar-demo.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
                        <script src="js/datatables-simple-demo.js"></script>
                    </body>
                </html>