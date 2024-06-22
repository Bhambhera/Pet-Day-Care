<?php

    include 'connection.php';
    $id = $_GET['id'];
    if (isset($_POST['delete_user']))
    {
       $delete = "DELETE FROM products WHERE id = '$id' "; 
       $delete_run = mysqli_query($con , $delete);
       if($delete_run)
       {
         header('location: products.php');
       }
    }

    else if(isset($_POST['edit_user'])) 
    {
        $msg = "";
        $productname = $_POST['productname'];    
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];   
        $description = $_POST['description'];
        $category = $_POST['category'];
         if ( $quantity <= 0)
                            {
                                $status_update = "UPDATE products SET status = 'Out Of Stock' WHERE  id = '$id'";
                                $status_update_run = mysqli_query($con, $status_update);

                                
                            }
                            elseif ($quantity > 0)
                            {
                                $status_update = "UPDATE products SET status = 'available' WHERE  id = '$id'";
                                $status_update_run = mysqli_query($con, $status_update);
                                
                            }
        if(strlen($_FILES['productimage']['name']) != 0)
        {
            $targetpath = "uploads/";    
            $filename =basename($_FILES['productimage']['name']); 
            $productimage = $targetpath . $filename;
            $filetype = pathinfo($productimage, PATHINFO_EXTENSION);
            $allowtypes = array('jpg', 'png', 'jpeg');
            if(in_array($filetype, $allowtypes))
            { 
                if(move_uploaded_file($_FILES['productimage']['tmp_name'], $productimage))
                {    

                    $update = "UPDATE products SET productname = '$productname', category_id = '$category',  productimage = '$productimage', price = '$price' , quantity = '$quantity',description = '$description' WHERE id = '$id' ";
                    $update_run = mysqli_query($con, $update );
                    if ($update_run) 
                    {
                        header('location: products.php');
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
            $update = "UPDATE products SET productname = '$productname', category_id = '$category', price = '$price', quantity = '$quantity', description = '$description' WHERE id = '$id' ";
            $update_run = mysqli_query($con, $update );
            if ($update_run) 
            {
                header('location: products.php');
            }
        }
    }
?>

<?php include 'admin_sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Product</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item">Edit Product</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Product</h4>
                                </div>
                                <div class="card-body">

                                    
<?php
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $users =" SELECT * FROM products WHERE id = '$id'";
        $users_run = mysqli_query($con,$users); 
        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
                ?>
                <form action="admineditproducts.php?id= <?php  echo $user['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="col-md-6 mb-3">
                        <label for="">Product Category</label> 
                            <select name="category">
                                <?php
                                    $query = "SELECT * FROM product_category";
                                    $query_run = mysqli_query($con,$query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        foreach($query_run as $row)
                                        {
                                    
                                            ?>
                                    
                                        <option value="<?= $row['category_id'];?>" <?php if($row['category_id']==$user['category_id']){echo "selected=\"selected\"";} ?>><?= $row['category'];?></option>
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
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Product Name</label> 
                            <input type="text" name="productname"  value="<?= $user['productname'];?>" pattern="[a-z A-Z]{1,15}" class="form-control" required>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="">Product Image</label>
                        <img src="<?php echo $user['productimage'];?>" width="100" height ="100"> 
                        <input type="file" name="productimage" class="form-control">
                        <p class="text-danger"><?php if(isset($msg)){ echo $msg;} ?></p>
                    </div> 
                    <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Quantity</label> 
                            <input type="number" name="quantity"  value="<?= $user['quantity'];?>" class="form-control" required>
                    </div>  
                    <div class="col-md-6 mb-3">
                        <label for="">Price</label> 
                            <input type="text" name="price"  value="<?= $user['price'];?>" class="form-control" required>
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="">Description</label> 
                            <textarea name="description" required><?= $user['description'];?></textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="edit_user">
                        Edit Product
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