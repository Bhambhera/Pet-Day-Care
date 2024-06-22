<?php
    include 'connection.php';
    $category_id = $_GET['category_id'];

    if (isset($_POST['delete_user']))
    {
       $delete = "DELETE FROM product_category WHERE category_id = '$category_id' "; 
       $delete_run = mysqli_query($con , $delete);
       if($delete_run)
       {
         header('location: categories.php');
       }
    }

    else if(isset($_POST['edit_user'])) 
    {
        
        $category = $_POST['category'];   
        $description = $_POST['description'];    

        $update = "UPDATE product_category SET category = '$category',description = '$description' WHERE category_id = '$category_id' ";
        $update_run = mysqli_query($con, $update );

        if ($update_run) 
        {
            header('location: categories.php');
        }
    }
?>

<?php include 'admin_sidebar.php'; ?>                  
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Edit Category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item">Edit Category</li>
                        </ol>
                    

                    <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Edit Category</h4>
                                </div>
                                <div class="card-body">

                                    
<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];
        $users =" SELECT * FROM product_category WHERE category_id = '$category_id'";
        $users_run = mysqli_query($con,$users); 
        if(mysqli_num_rows($users_run) > 0)
        {
            foreach($users_run as $user)
            {
                ?>
                <form action="admineditcategory.php?category_id= <?php  echo $user['category_id']; ?>" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Category Name</label> 
                            <input type="text" name="category"  value="<?= $user['category'];?>" class="form-control">
                    </div> 
                    <div class="col-md-6 mb-3">
                        <label for="">Description</label> 
                            <textarea name="description" ><?= $user['description'];?></textarea>
                    </div>   
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="edit_user">
                        Edit Category
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