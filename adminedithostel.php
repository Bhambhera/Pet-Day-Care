<?php

    include 'connection.php';

    $id = $_GET['id'];
    if (isset($_POST['delete_user']))
    {
       $delete = "DELETE FROM hostel WHERE id = '$id' "; 
       $delete_run = mysqli_query($con , $delete);
       if($delete_run)
       {
         header('location: hostels.php');
       }
    }

    else if(isset($_POST['edit_user'])) 
    {
        $name = $_POST['name'];           
        $contact = $_POST['contact'];   
        $address = $_POST['address'];
        $price = $_POST['price']; 
        if(strlen($_FILES['image']['name']) != 0)
        {
            $targetpath = "uploads/";    
            $filename =basename($_FILES['image']['name']); 
            $image = $targetpath . $filename;
            $filetype = pathinfo($image, PATHINFO_EXTENSION);
            $allowtypes = array('jpg', 'png', 'jpeg');
            if(in_array($filetype, $allowtypes))
            {
                if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
                { 

                    $update = "UPDATE hostel SET name = '$name', contact = '$contact',address = '$address', price = '$price', image = '$image' WHERE id = '$id' ";
                    $update_run = mysqli_query($con, $update );
                    if ($update_run) 
                    {
                        header('location: hostels.php');
                    }
                }
                else
                {
                    $msg = "Sorry, File not found";
                }   
            }
            else
            {   
                $msg = "Please, Upload a image of type(.jpeg, .jpg, .png)";
            }
        }
        else
        {
            $update = "UPDATE hostel SET name = '$name', contact = '$contact',address = '$address', price = '$price'  WHERE id = '$id' ";
            $update_run = mysqli_query($con, $update );
            if ($update_run) 
            {
                header('location: hostels.php');
            }
        }
    }
?>
<?php include 'admin_sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Hostel</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item">Edit Hostel</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Hostel</h4>
                                </div>
                                <div class="card-body">

                                    
<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $users =" SELECT * FROM hostel WHERE id = '$id'";
        $users_run = mysqli_query($con,$users); 
        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
                ?>
                <form action="adminedithostel.php?id= <?php  echo $user['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label> 
                            <input type="text" name="name"  value="<?= $user['name'];?>" pattern="[a-z A-Z]{1,15}" class="form-control">
                    </div> 
                    
                    <div class="col-md-6 mb-3">
                                    <label for="">Hostel Image</label> 
                                    <img src="<?php echo $user['image'];?>" width="100" height ="100">
                                    <br>
                                    <input type="file" name="image" class="form-control">
                                    <p class="text-danger"><?php if(isset($msg)){ echo $msg;} ?></p>
                    </div> 
                    
                    <div class="col-md-6 mb-3">
                        <label for="">Contact</label> 
                            <input type="number" name="contact"  value="<?= $user['contact'];?>" class="form-control">
                    </div> 
                    
                    <div class="col-md-6 mb-3">
                                    <label for="">Price</label> 
                                    <input type="number" name="price" value="<?= $user['price'];?>" class="form-control" required>
                                </div> 
                   
                    <div class="col-md-6 mb-3">
                        <label for="">Address</label> 
                            <textarea name="address" ><?= $user['address'];?></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="edit_user">
                        Edit Hostel
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