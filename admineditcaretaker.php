<?php
    include 'connection.php';

    $id = $_GET['id'];

    if (isset($_POST['delete_user']))
    {
       $delete = "DELETE FROM caretaker WHERE id = '$id' "; 
       $delete_run = mysqli_query($con , $delete);
       if($delete_run)
       {
         header('location: registeredcaretakers.php');
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
        $caretaker =" SELECT email FROM caretaker WHERE email = '$email'";
        $caretaker_run = mysqli_query($con,$caretaker);
        $caretakermobile_check =" SELECT mobile FROM caretaker WHERE mobile != '$mobile'";
        $caretakermobile_run =  array (mysqli_query($con,$caretakermobile_check));
        $msgmc = ""; 
        if(in_array($mobile, $caretakermobile_run))
        {
                $msgmt = "Caretaker Mobile number already Registered";
        }
        else
        {
            $update = "UPDATE caretaker SET firstname = '$firstname' , lastname = '$lastname' , username = '$username' , gender = '$gender' , mobile = '$mobile' , address = '$address' , pincode = '$pincode' WHERE id = '$id' ";
            $update_run = mysqli_query($con, $update );
        }

        if ($update_run) 
        {
            header('location: registeredcaretakers.php');
        }
    }
?>

<?php include 'admin_sidebar.php'; ?>             
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Caretakers</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item">Edit Caretakers</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Caretakers</h4>
                                </div>
                                <div class="card-body">

                                    
<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $users =" SELECT * FROM caretaker WHERE id = '$id'";
        $users_run = mysqli_query($con,$users); 
        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
                ?>
                <form action="admineditcaretaker.php?id= <?php  echo $user['id']; ?>" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">First Name</label> 
                            <input type="text" name="firstname" placeholder="(ex:- Ramesh)" value="<?= $user['firstname'];?>" pattern="[a-z A-Z]{1,15}" class="form-control" required>
                    </div> 
                    <div class="col-md-6 mb-3">
                    <label for="">Last Name</label> 
                        <input type="text" name="lastname" placeholder="(ex:- Sharma)"value="<?= $user['lastname'];?>" class="form-control" required>
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
                            <input type="text" name="email" value="<?= $user['email'];?>" placeholder="(ex:- abc@gmail.com)" pattern="^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$"class="form-control" required>
                                    <p class="text-danger">Email cannot be changed</p>
                    </div>  
                    <div class="col-md-6 mb-3">
                        <label for="">Mobile</label> 
                            <input type="text" name="mobile" value="<?= $user['mobile'];?>" placeholder="(ex:- 9823456127)"pattern="^[7-9]{1}[0-9]{9}$" class="form-control" required>
                            <p class="text-danger"><?php if(isset($msgmc)){ echo $msgmc;} ?></p>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="">Address</label> 
                            <textarea name="address" placeholder="(ex:- 2, ramshahan colony, bandra)" required><?= $user['address'];?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Pincode</label> 
                            <input type="text" name="pincode" value="<?= $user['pincode'];?>" placeholder="(ex:- 380015)"pattern="^[1-9]{1}[0-9]{2}[0-9]{3}$"class="form-control">
                    </div>   
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="edit_user">
                        Edit Trainer
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