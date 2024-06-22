<?php 
include 'connection.php';
include 'admin_sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Registered Products</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item ">Registered Products</li>
                            

                        </ol>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Registered Products</h4>
                                    <a href="adminaddproduct.php" class="btn btn-primary">Add Product</a>
                                </div>
                                <div class="card-body">

                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>Product Image</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Description</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
    <?php
    
    $query = "SELECT id, p.category_id, productname, productimage, price, quantity, p.description, status, pc.category FROM products p LEFT JOIN product_category pc ON p.category_id = pc.category_id";
    $query_run = mysqli_query($con,$query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $row)
        {
            $id = $row['id'];
            ?>
            <tr>
                <td><?= $row['id'];?></td>
                <td><?= $row['category'];?></td>
                <td><?= $row['productname'];?></td>
                <td><img src="<?php echo $row['productimage'];?>" width="100" height ="100"></td>
                <td><?= $row['price'];?></td>
                <td><?= $row['quantity'];?></td>
                <td>
                 <?php                          
                            if ( $row['quantity'] <= 0)
                            {
                                

                                ?>
                                 <p class="text-danger"><?php echo $row['status']; ?></p>
                                
                                <a href="admineditproducts.php?id= <?php echo $row['id'];?>" class="btn btn-success"> Add Stock</a>
                                 <?php
                            }
                            elseif ($row['quantity'] > 0)
                            {
                                ?>
                                <p><?php echo $row['status']; ?>
                                </p>
                                <?php
                            }
                            ?>

                </td>
                <td><?= $row['description'];?></td>
            <form action="admineditproducts.php?id= <?php echo $row['id'];?>" method="post">
                <td>
                    <button type="submit" class ="btn btn-primary"  name="edit" value="<?= $row['id'];?>">
                    Edit    
                    </button> 
                </td>
                <td>
                <button type="submit" class ="btn btn-danger"  name="delete_user" value="<?= $row['id'];?>" onclick="return confirm('Are you sure you want to Delete?');">
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
                <td colspan="7">
                    No Record Found  
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