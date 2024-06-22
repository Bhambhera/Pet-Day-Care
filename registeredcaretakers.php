

<?php

 
include 'connection.php';
 if(isset($_POST['approve']))
 {

    $id = $_GET['id'];
    $query = "UPDATE caretaker SET approved = 'yes' WHERE  id = '$id'";
    $query_run = mysqli_query($con, $query);
 }

if(isset($_POST['unapprove']))
 {
    
    $id = $_GET['id'];
    $query = "UPDATE caretaker SET approved = 'no' WHERE  id = '$id'";
    $query_run = mysqli_query($con, $query);
 } 
?>

<?php include 'admin_sidebar.php'; ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Registered Caretakers</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                            <li class="breadcrumb-item ">Registered Caretakers</li>
                            

                        </ol>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Registered Caretakers</h4>
                                    <a href="adminaddcaretaker.php" class="btn btn-primary">Add Caretaker</a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Firstname</th>
                                                <th>Lastname</th>
                                                
                                                <th>Gender</th>
                                                
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>approved</th>
                                                <th>document</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
              
              $query = "SELECT * FROM caretaker";
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
                        <td><?= $row['address'];?> - <?= $row['pincode'] ?></td>
                        <td><?= $row['approved'];?>
                        <br>                              
                        <form action="registeredcaretakers.php?id= <?php echo $row['id'];?>" method="post">
                            <?php
                            if ( $row['approved'] == "no")
                            {
                                ?>
                                <input type="submit" class="btn btn-success" value="Approve" name="approve">
                                 <?php
                            }
                            else 
                            {
                                ?>
                                <input type="submit" class="btn btn-danger" value="Unapprove" name="unapprove">
                                <?php
                            }
                            ?>
                        </form>
                        </td>
                        <td>
                            <embed src="<?= $row['document'];?>" width="100" height="100"></embed>
                        </td>
                        <form action="admineditcaretaker.php?id= <?php echo $row['id'];?>" method="post">
                        <td>
                            <button type="submit" class ="btn btn-primary"  name="edit" value="<?= $row['id'];?>">
                            Edit    
                            </button> 
                        </td>
                        <td>
                            <button type="submit" class ="btn btn-danger"  name="delete_user" value="<?= $row['id'];?>" onclick="return confirm('Are you sure you want to Delete?');">
                            Delete    
                            </button>  
                        </td>  
                        </form>
                    </tr>
                    <?php
                }
            }
            else
            {
                ?>
                <tr>
                    <td colspan="10">
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