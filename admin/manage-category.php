<?php include('./partials/menu.php') ?>
        <!-- Main Content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Category</h1>
                <br /><br />
                <!-- Button to add admin -->
                <a href="<?php echo SITE_URL; ?>admin/add-category.php" class="btn-primary">Add category</a>
                <br /><br />
                <?php 
                    if(isset($_SESSION['add-category'])){
                        echo $_SESSION['add-category'];
                        unset($_SESSION['add-category']);
                    }

                    if(isset($_SESSION['remove'])){
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['delete-category'])){
                        echo $_SESSION['delete-category'];
                        unset($_SESSION['delete-category']);
                    }

                    if(isset($_SESSION['no-category-found'])){
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }

                    if(isset($_SESSION['category-update'])){
                        echo $_SESSION['category-update'];
                        unset($_SESSION['category-update']);
                    }

                    if(isset($_SESSION['upload'])){
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['failed-remove-image'])){
                        echo $_SESSION['failed-remove-image'];
                        unset($_SESSION['failed-remove-image']);
                    }

                    

                ?>
                <br /><br />
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        $sql="SELECT * FROM tbl_category";
                        $res=mysqli_query($conn, $sql);

                        if($res)
                        {
                            $count=mysqli_num_rows($res);
                            if($count>0)
                            {
                                $sn=1;
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    $image=$row['image_name'];
                                    $featured=$row['featured'];
                                    $active=$row['active'];

                                    ?>
                                    <tr>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $title; ?></td>
                                        <td><?php 
                                            
                                            if($image!="")
                                            {
                                                ?>
                                                    <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image; ?>" alt="" width="100px" height="100px">
                                                <?php
                                            }  
                                            else
                                            {
                                                echo "<div class='error'>Image not added</div>";
                                            }
                                            
                                        ?></td>
                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITE_URL ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update category</a>
                                            <a href="<?php echo SITE_URL ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image; ?>" class="btn-danger">Delete Category</a>
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
                                        <td colspan="6"><div class="error">No category Added</div></td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                    
                    
                </table>
            </div>
        </div>
        <!-- Main content ends -->

<?php include('./partials/footer.php') ?>