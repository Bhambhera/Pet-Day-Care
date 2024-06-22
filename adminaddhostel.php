<?php
    include 'connection.php';
    if(!empty($_POST))
    {
        $msg = "";
      
      $name = $_POST["name"];
      $contact = $_POST["contact"];
      $address= $_POST["address"];
      $price= $_POST["price"];
      $targetpath = "uploads/"; 
      $filename =basename($_FILES['image']['name']); 
      $image = $targetpath . $filename;
      $filetype = pathinfo($image, PATHINFO_EXTENSION);
      $allowtypes = array('jpg', 'png', 'jpeg');
      if(in_array($filetype, $allowtypes))
      {
        if(move_uploaded_file($_FILES['image']['tmp_name'], $image))
        {
        $query = " insert into hostel ( name, image, price, contact, address) 
        values ('$name', '$image', '$price', '$contact', '$address')";
        $result = mysqli_query($con,$query);
        header("location:hostels.php");
        }
        else
        {
            $msg = "Sorry, Image not found";
        }
      }
      else
      {
        $msg = "Please, Upload a image of type(.jpeg, .jpg, .png)";
      }
    }
?>
<?php include 'admin_sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Add Hostel</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item active">Registered Hostel</li>
                            <li class="breadcrumb-item">Add Hostel</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Add Hostel</h4>
                                </div>
                                <div class="card-body">
                                    <form action="adminaddhostel.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="">Hostel Name</label> 
                                    <input type="text" name="name" class="form-control" pattern="[a-z A-Z]{1,15}" required>
                                </div> 
                                <br>
                                <div class="col-md-6 mb-3">
                                    <label for="">Hostel Image</label> 
                                    <input type="file" name="image" class="form-control" >
                                    <p class="text-danger"><?php if(isset($msg)){ echo $msg;} ?></p>

                                </div> 
                                <br>
                                <div class="col-md-6 mb-3">
                                    <label for="">Contact</label> 
                                    <input type="number" name="contact" class="form-control" min="7000000000" max="9999999999" required>
                                </div> 
                                <br>
                                <div class="col-md-6 mb-3">
                                    <label for="">Price</label> 
                                    <input type="number" name="price" class="form-control" required>
                                </div> 
                                <br>
                                <div class="col-md-6 mb-3">
                                    <label for="">Address</label> 
                                    <textarea name="address" required></textarea>
                                </div>   
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary"  name="add_user">
                                    Add Hostel
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