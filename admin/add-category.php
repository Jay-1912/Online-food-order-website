<?php include('./partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['add-category'])){
                echo $_SESSION['add-category'];
                unset($_SESSION['add-category']);
            }
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Enter title"></td>
                </tr>
                <tr>
                    <td>Upload Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td><input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No</td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td><input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $title=$_POST['title'];
                if(isset($_POST['featured']))
                    $featured=$_POST['featured'];
                else
                    $featured="No";

                if(isset($_POST['active']))
                    $active=$_POST['active'];
                else
                    $active="No";

                if(isset($_FILES['image']['name'])){
                        $image_name=$_FILES['image']['name'];

                        if($image_name!="")
                        {
                            //Auto Renaming the image name
                        //Get the extension of our image(jpg,png..)
                        $ext=end(explode('.', $image_name));

                        //Rename the image
                        $image_name="food_category_".rand(000, 999).'.'.$ext;

                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name;

                        $upload = move_uploaded_file($source_path, $destination_path);

                        if(!$upload){
                            $_SESSION['upload']="<div class='error'>Failed to upload Image!</div>";
                            header("location:".SITE_URL.'admin/add-category.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name="";
                }

                $sql="INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";
                $res=mysqli_query($conn, $sql);
                if($res)
                {
                    $_SESSION['add-category']="<div class='success'>Category is added!</div>";
                    header("location:".SITE_URL.'admin/manage-category.php');
                }
                else
                {
                    $_SESSION['add-category']="<div class='error'>Failed to add category!</div>";
                    header("location:".SITE_URL.'admin/manage-category.php');
                }
                 
            }
        ?>

    </div>
</div>
<?php include('./partials/footer.php'); ?>