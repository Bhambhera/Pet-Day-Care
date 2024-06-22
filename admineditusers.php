<?php
   include 'connection.php';
    $id = $_GET['id'];

    if (isset($_POST['delete_user']))
    {
       $delete = "DELETE FROM user_master WHERE id = '$id' "; 
       $delete_run = mysqli_query($con , $delete);
       if($delete_run)
       {
         header('location: registeredusers.php');
       }
    }
    else if(isset($_POST['edit_user'])) 
    {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];    
        $username = $_POST['firstname'];    
        $gender = $_POST['gender'];   
        $mobile = $_POST['mobile'];    
        $address = $_POST['address'];    
        $pincode = $_POST['pincode'];
        $mobile_check ="SELECT id,mobile FROM user_master WHERE mobile = '$mobile' && id!= '$id' ";
        $mobile_run =  array (mysqli_query($con,$mobile_check));
        $msgm = "";
        if (in_array($mobile, $mobile_run))
        {
          $msgm = "Mobile number already Registered";
        }
        else
        {
            $update = "UPDATE user_master SET firstname = '$firstname' , lastname = '$lastname' , username = '$username' , gender = '$gender'  , mobile = '$mobile' , address = '$address' , pincode = '$pincode' WHERE id = '$id' ";
            $update_run = mysqli_query($con, $update);
        }   

        if ($update_run) 
        {
            header('location: registeredusers.php');
        }
    }
?>

<?php include 'admin_sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item">Edit Users</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit users</h4>
                                </div>
                                <div class="card-body">

                                    
<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $users =" SELECT * FROM user_master WHERE id = '$id'";
        $users_run = mysqli_query($con,$users);
        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
                ?>
                <form action="admineditusers.php?id= <?php  echo $user['id']; ?>" method="post">
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
                                    <br>
                                    <input name="gender" type="radio" value="female" <?php if($user['gender']=="female"){echo "checked=\"checked\"";} ?>>Female
                                    <br/>
                                    <input name="gender" type="radio" value="others" <?php if($user['gender']=="others"){echo "checked=\"checked\"";} ?>>Others
                            </div>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label> 
                            <input type="text" name="email" value="<?= $user['email'];?>" class="form-control">
                                    <p class="text-danger">Email cannot be changed</p>
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
                        <button type="submit" class="btn btn-primary" name="edit_user">
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
}
?> 
                                   
                                 </div>   
                            </div>
                        </div>
                     </div>
                </div>

            <?php include 'scripts.php'; ?>
                    </body>
                </html>