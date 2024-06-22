
<?php include 'admin_sidebar.php'; ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                             <h1 class="mt-4">Registered Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item ">Registered Users</li>
                            

                        </ol>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Registered users</h4>
                                    <a href="adminadduser.php" class="btn btn-primary">Add User</a>
                                </div>
                                <div class="card-body">

                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                               
                                                <th>Gender</th>
                                               
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
    include 'connection.php';
    $query = "SELECT * FROM user_master";
    $query_run = mysqli_query($con,$query);

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $row)
        {
            ?>
            <tr>
                <td><?= $row['id'];?></td>
                <td><?= $row['firstname'];?></td>
                <td><?= $row['lastname'];?></td>
                <td><?= $row['gender'];?></td>
                <td><?= $row['mobile'];?></td>
                <td><?= $row['address'];?> - <?= $row['pincode'];?></td>
            <form action="admineditusers.php?id= <?php echo $row['id'];?>" method="post">
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
                <td colspan="10">
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
<script type="text/javascript">
    function deleteme()
</script>
    <?php include 'scripts.php'; ?>
    </body>
</html>