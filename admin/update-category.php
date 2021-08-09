<?php include('./partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br /><br />
        <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
                $sql="SELECT * FROM tbl_category WHERE id=$id";

                $res=mysqli_query($conn, $sql);

                    $count=mysqli_num_rows($res);
                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $id=$row['id'];
                        $title=$row['title'];
                        $current_image=$row['image_name'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                    }
                    else
                    {
                        $_SESSION['no-category-found']="<div class='error'>No category founded!</div>";
                        header("location:".SITE_URL.'admin/manage-category.php');
                    }
                
            }
            else{
                header("location:".SITE_URL.'admin/manage-category.php');
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Current Image</td>
                    <td>
                        <?php 
                            if($current_image!="")
                            {
                                ?>
                                    <img src="<?php echo SITE_URL;?>images/category/<?php echo $current_image; ?>" alt="" width="150px" height="150px"> 
                                <?php

                            }
                            else{
                                echo "<div class='error'>Image was not added!</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td><input type="file" name="image"></td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td><input type="radio" name="featured" value="Yes" <?php if($featured=="Yes"){ echo "checked"; }?>>Yes
                        <input type="radio" name="featured" value="No" <?php if($featured=="No"){ echo "checked"; }?>>No</td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td><input type="radio" name="active" value="Yes" <?php if($active=="Yes"){ echo "checked"; }?>>Yes
                        <input type="radio" name="active" value="No" <?php if($active=="No"){ echo "checked"; }?>>No</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    
        <?php 
            if(isset($_POST['submit']))
            {
                $id=$_POST['id'];
                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                if(isset($_FILES['image']['name']))
                {
                    $image_name=$_FILES['image']['name'];

                    if($image_name!="")
                    {
                        //Get the extension of our image(jpg,png..)
                        $ext=end(explode('.', $image_name));

                        //Rename the image
                        $image_name="food_category_".rand(000, 999).'.'.$ext;

                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if(!$upload){
                            $_SESSION['upload']="<div class='error'>Failed to upload Image!</div>";
                            header("location:".SITE_URL.'admin/manage-category.php');
                            die();
                        }

                        if($current_image!="")
                        {
                            $remove_path="../images/category/".$current_image;
                            $remove = unlink($remove_path);
                            if(!$remove)
                            {
                                $_SESSION['failed-remove-image']="<div class='error'>Failed to remove current image</div>";
                                header("location:".SITE_URL.'admin/manage-category.php');
                                die();
                            }
                        }

                    }
                    else
                    {
                        $image_name=$current_image;
                    }
                }
                else
                {
                    $image_name=$current_image;
                }

                $sql2="UPDATE tbl_category SET 
                title='$title', 
                image_name='$image_name', 
                featured='$featured', 
                active='$active'
                WHERE id=$id
                ";
                
                $res2=mysqli_query($conn, $sql2);
                if($res2)
                {
                    $_SESSION['category-update']="<div class='success'>Category updated successfully!</div>";
                    header("location:".SITE_URL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['category-update']="<div class='error'>Failed to update category!</div>";
                    header("location:".SITE_URL.'admin/manage-category.php');
                }

            }
        ?>

    </div>
</div>
<?php include('./partials/footer.php'); ?>
