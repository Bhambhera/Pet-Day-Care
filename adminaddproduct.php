<?php
 include 'connection.php';
if(!empty($_POST))
{
      $msg = "";
      $name_msg = "";
      $productname = $_POST["productname"];
      $price = $_POST["price"];
      $quantity = $_POST["quantity"];
      $description= $_POST["description"];
      $category_id = $_POST['category']; 
      $targetpath = "uploads/"; 
      $filename =basename($_FILES['productimage']['name']); 
      $productimage = $targetpath . $filename;
      $filetype = pathinfo($productimage, PATHINFO_EXTENSION);
      $allowtypes = array('jpg', 'png', 'jpeg');
      $name_check = "SELECT * FROM products WHERE productname = '$productname'" ;
      $name_check_run = mysqli_query($con, $name_check);

    
      if(in_array($filetype, $allowtypes))
      {
        if(move_uploaded_file($_FILES['productimage']['tmp_name'], $productimage))
        {
            if(mysqli_num_rows($name_check_run) > 0)
            {
                $name_msg = "Product name already exits";
            }
            else
            {
            $query = " INSERT into products ( category_id, productname, productimage, price, quantity, description) 
            values ('$category_id', '$productname', '$productimage', '$price', '$quantity', '$description')";
            $result = mysqli_query($con,$query);
            header("location:products.php");
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
?>

<?php include 'admin_sidebar.php'; ?>
                  
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Add Products</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item active">Registered Products</li>
                            <li class="breadcrumb-item">Add Products</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Add Products</h4>
                                </div>
                                <div class="card-body">
                                    <form action="adminaddproduct.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <label for="">Select Category</label>
                                    <select name="category"> 
                                    <?php
                                    $query = "SELECT * FROM product_category";
                                    $query_run = mysqli_query($con,$query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                    
                                            ?>
                                    
                                        <option value="<?= $row['category_id'];?>"><?= $row['category'];?></option>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                         ?>
                                            <p>No Record Found</p>
                                        <?php
                                    }
                                        ?>
                                    </select>   
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Product Name</label> 
                                    <input type="text" name="productname" class="form-control" pattern="[a-z A-Z]{1,15}" required>
                                     <p class="text-danger"><?php if(isset($name_msg)){ echo $name_msg;} ?></p>

                                </div> 
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">Product Image</label> 
                                    <input type="file" name="productimage"  class="form-control">
                                    <p class="text-danger"><?php if(isset($msg)){ echo $msg;} ?></p>
                                </div>  
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">Price</label> 
                                    <input type="number" name="price"  class="form-control" required>   
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="">Quantity</label> 
                                    <input type="number" name="quantity"  class="form-control" required>
                                </div>
                                </div>
                                 
                                <div class="col-md-6 mb-3">
                                    <label for="">Description</label> 
                                    <textarea name="description" required></textarea>
                                </div>   
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary"  name="add_user">
                                    Add Product
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



