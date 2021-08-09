<?php include('./partials/menu.php') ?>
        <!-- Main Content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Food</h1>
                <br /><br />
                <?php
                    if(isset($_SESSION['add-food']))
                    {
                        echo $_SESSION['add-food'];
                        unset($_SESSION['add-food']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['delete-food']))
                    {
                        echo $_SESSION['delete-food'];
                        unset($_SESSION['delete-food']);
                    }

                    if(isset($_SESSION['update-food']))
                    {
                        echo $_SESSION['update-food'];
                        unset($_SESSION['update-food']);
                    }
                ?>
                <br /><br />
                <!-- Button to add admin -->
                <a href="<?php echo SITE_URL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
                <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Selected Image</th>
                        <th>Selected Category</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <tr>
                        <?php 
                            
                            $sql = "SELECT * FROM tbl_food";

                            $res=mysqli_query($conn, $sql);

                            if($res)
                            {
                                $count=mysqli_num_rows($res);
                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $sn=1;
                                        $id=$row['id'];
                                        $title=$row['title'];
                                        $description=$row['description'];
                                        $price=$row['price'];
                                        $image_name=$row['image_name'];
                                        $category_id=$row['category_id'];
                                        $featured=$row['featured'];
                                        $active=$row['active'];

                                        ?>
                                        
                                        <td><?php echo $sn ?></td>
                                        <td><?php echo $title ?></td>
                                        <td><?php echo $description ?></td>
                                        <td><?php echo $price ?></td>
                                        <td>
                                            <?php
                                                if($image_name!="")
                                                    {?><img src="../images/food/<?php echo $image_name ?>" alt="" width="100px" height="100px"><?php }
                                                else
                                                {
                                                    echo "<div class='error'>Image was not selected</div>";
                                                    $image_name="";
                                                }
                                            ?>
                                            
                                        </td>
                                        <td>
                                            <?php 
                                                $sql2="SELECT * FROM tbl_category WHERE id=$category_id";

                                                $res2=mysqli_query($conn, $sql2);

                                                $count=mysqli_num_rows($res2);

                                                if($count==1)
                                                {
                                                    $row=mysqli_fetch_assoc($res2);
                                                    $category=$row['title'];
                                                    echo $category;
                                                }
                                                
                                            ?>

                                        </td>
                                        <td><?php echo $featured ?></td>
                                        <td><?php echo $active ?></td>
                                        <td>
                                            <a href="<?php echo SITE_URL; ?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                                            <a href="<?php echo SITE_URL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                                        </td>
                                        </tr>
                                        
                                        <?php
                                        $sn++;
                                    }
                                }
                                else
                                {
                                    ?>
                                        <tr>
                                        <td colspan="8">No foods are added</td>
                                        </tr>
                                    <?php
                                    
                                }
                            
                                
                            }
                            else
                            {
                                echo mysqli_error($conn);
                            }

                        ?>
                </table>
            </div>
        </div>
        <!-- Main content ends -->

<?php include('./partials/footer.php') ?>