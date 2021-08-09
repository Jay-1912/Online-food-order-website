<?php include('./partials/menu.php') ?>
        <!-- Main Content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br /><br />
                <?php 
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add']; //Displaying Session message
                        unset($_SESSION['add']); //Removing session
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete']; //Displaying Session message
                        unset($_SESSION['delete']); //Removing session
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update']; //Displaying Session message
                        unset($_SESSION['update']); //Removing session
                    }

                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found']; //Displaying Session message
                        unset($_SESSION['user-not-found']); //Removing session
                    }

                    if(isset($_SESSION['password-changed'])){
                        echo $_SESSION['password-changed']; //Displaying Session message
                        unset($_SESSION['password-changed']); //Removing session
                    }

                ?><br /><br />
                <!-- Button to add admin -->
                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Query to get all admin
                        $sql="SELECT * FROM tbl_admin";

                        //execute the query
                        $res=mysqli_query($conn, $sql);

                        if($res)
                        {
                            //Count rows to check whether we have data in database or not
                            $count = mysqli_num_rows($res); //Function to get the number of rows in database;

                            //Check the number of rows is greater than 0 that maeans we have data else we dont have data
                            if($count>0)
                            {
                                $sn=1;
                                while($rows=mysqli_fetch_assoc($res)){
                                    //using while loop to get all the data from database
                                    //And while lopp will run as long as we have data

                                    //Get individual data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //Display the values in table
                                    ?>
                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $full_name ?></td>
                                        <td><?php echo $username ?></td>
                                        <td>
                                            <a href="<?php echo SITE_URL; ?>admin/update-password.php?id=<?php echo $id ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITE_URL; ?>admin/update-admin.php?id=<?php echo $id ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITE_URL; ?>admin/delete-admin.php?id=<?php echo $id ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>
                                    <?php
                                }

                            }
                        }
                    ?>
                    
                </table>

            </div>
        </div>
        <!-- Main content ends -->

<?php include('./partials/footer.php') ?>