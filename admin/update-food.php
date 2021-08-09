<?php include('./partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update food</h1>


        <?php 

            if(isset($_GET['id'])){
                $id=$_GET['id'];

                $sql="SELECT * FROM tbl_food WHERE id=$id";

                $res=mysqli_query($conn, $sql);

                if($res)
                {
                    $count=mysqli_num_rows($res);
                    if($count==1)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $title=$row['title'];
                        $description=$row['description'];
                        $price=$row['price'];
                        $current_image=$row['image_name'];
                        $category_id=$row['category_id'];
                        $featured=$row['featured'];
                        $active=$row['active'];
                    }
                }
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $title; ?>"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" cols="30" rows="5"> <?php echo $description; ?> </textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>"></td>
                </tr>
                <tr>
                    <td>Selected Image</td>
                    <td>
                        <?php 
                            if($current_image!=""){
                                echo "<img src='../images/food/$current_image' alt='' width='150px' height='150px'>";
                            }
                            else{
                                echo "<div class='error'>Image wasn't selected</div>";
                            }
                        ?>
                        
                    </td>
                </tr>
                <tr>
                    <td>New Image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Selected Category</td>
                    <td>
                       <select name="category"> 
                    <?php 
                            //Create PHP code to display categories from database
                            //1. Create SQL query to get all active query from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                            
                            $res = mysqli_query($conn, $sql);

                            $count=mysqli_num_rows($res);

                            if($count>0)
                            {
                                while($row=mysqli_fetch_assoc($res))
                                {
                                    //get the detail of category
                                    $category_id2=$row['id'];
                                    $category_title=$row['title'];
                                    ?>
                                    <option value="<?php echo $category_id2; ?>"<?php if($category_id2==$category_id){echo "selected"; }?>><?php echo $category_title; ?></option>        
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <option value="0">No category found</option>
                                <?php
                            }

                            //2.Display on dropdown
                        ?>
                          </select>  
                        <?php 

                          /*  $sql2 = "SELECT * FROM tbl_category WHERE id=$category_id";

                            $res2 = mysqli_query($conn, $sql2);

                            if($res2)
                            {
                                $count = mysqli_num_rows($res2);
                                if($count==1)
                                {
                                    $row=mysqli_fetch_assoc($res2);
                                    $category_title=$row['title'];
                                }
                            }
                            */
                        ?>
                    
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td><input type="radio" name="featured" value="Yes" <?php if($featured=="Yes"){echo "checked"; }?>>Yes
                        <input type="radio" name="featured" value="No" <?php if($featured=="No"){echo "checked"; }?>>No</td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td><input type="radio" name="active" value="Yes" <?php if($active=="Yes"){echo "checked"; }?>>Yes
                        <input type="radio" name="active" value="No" <?php if($active=="No"){echo "checked"; }?>>No</td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $id=$_POST['id'];
                $title=$_POST['title'];
                $description=$_POST['description'];
                $category_id=$_POST['category'];
                $price=$_POST['price'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                if(isset($_FILES['image']['name'])){

                    $image_name=$_FILES['image']['name'];

                    if($image_name!=""){
                        $ext = end(explode('.',$image_name));

                        $image_name = "food_name".rand(0000,9999).".".$ext;

                        $src_path=$_FILES['image']['tmp_name'];
                        $dnt_path="../images/food/".$image_name;

                        $upload=move_uploaded_file($src_path, $dnt_path);
                    }
                    else
                    {
                        $image_name=$current_image;
                    }

                }
                else{
                    $image_name=$current_image;
                }

                $sql = "UPDATE tbl_food SET
                    title='$title',
                    description='$description',
                    price=$price,
                    image_name='$image_name',
                    category_id=$category_id,
                    featured='$featured',
                    active='$active'
                    WHERE id=$id
                ";

                $res= mysqli_query($conn, $sql);

                if($res){
                    $_SESSION['update-food']="<div class='success'>Food updated successfully!</div>";
                    header("location:".SITE_URL.'admin/manage-food.php');
                }
                else{
                    // $_SESSION['update-food']="<div class='error'>Failed to update food!</div>";
                    // header("location:".SITE_URL.'admin/manage-food.php');
                    echo mysqli_error($conn);
                }

            }
        ?>


    </div>
</div>
<?php include('./partials/footer.php') ?>