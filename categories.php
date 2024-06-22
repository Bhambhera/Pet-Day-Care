
<?php include 'admin_sidebar.php';
include 'connection.php';
session_start();
//$msg = $_SESSION['message'];
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Registered Categories</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item ">Registered Categories</li>
                            

                        </ol>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Registered Categories</h4>
                                    <form action="categories.php" method="post">
                                        <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
                                    </form>
                                </div>
                                <?php 
                               
                                    if(isset($_POST['add_category']))
                                    {
                                        ?>
                                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Add Category</h4>
                            </div>
                            <div class="card-body">
                            <form action="adminaddcategory.php" method="post">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                <label for="">Category Name</label> 
                                <input type="text" name="categoryname" class="form-control" pattern="[a-z A-Z]{1,15}" required>
                                </div>
                                <p class="text-danger"><?php if(isset($msg)){ echo $msg;} ?><p>
                            </div> 
                            <div class="col-md-3 mb-3">
                                <label for="">Description</label> 
                                <textarea name="description"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary" name="add_user">Add Category          
                                </button>
                                <a href="categories.php" class="btn btn-danger">Back</a>
                            </div>
                        </form>
                    </div>
                                        <?php
                                    }
                                ?>
                                <div class="card-body">

                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category Name</th>
                                                <th>Description</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    include 'connection.php';
    $query = "SELECT * FROM product_category";
    $query_run = mysqli_query($con,$query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $row)
        {
            ?>
            <tr>
                <td><?= $row['category_id'];?></td>
                <td><?= $row['category'];?></td>
                <td><?= $row['description'];?></td>
            <form action="admineditcategory.php?category_id= <?php echo $row['category_id'];?>" method="post">
                <td>
                    <button type="submit" class ="btn btn-primary"  name="edit" value="<?= $row['category_id'];?>">
                    Edit    
                    </button> 
                </td>
                <td>
                <button type="submit" class ="btn btn-danger"  name="delete_user" value="<?= $row['category_id'];?>" onclick="return confirm('Are you sure you want to Delete?');">
                Delete    
                </button>  
            </form> 
                </td>
            </tr>
            <?php

        }
    }
    else
    {
        ?>
            <tr>
                <td colspan="6">
                    No Record Founded  
                </td>
            </tr>
            <?php
    }

            ?>
        </tbody>
        </table>
    </div>
    </div>
</div>
                        <?php include 'scripts.php'; ?>
                    </body>
                </html>