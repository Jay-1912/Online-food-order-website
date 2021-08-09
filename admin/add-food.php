<?php include('./partials/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>
        <br /><br />
        <br /><br />
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" placeholder="Enter title"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" placeholder="Enter description" cols="30" rows="5"></textarea></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><input type="number" name="price"></td>
                </tr>
                <tr>
                    <td>Select image</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category:</td>
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
                                    $id=$row['id'];
                                    $title=$row['title'];
                                    ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>        
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
                    </td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Add Food" class="btn-secondary"></td>
                </tr>
            </table>
        </form>
        
        <?php
            if(isset($_POST['submit'])){
                $title=$_POST['title'];
                $description=$_POST['description'];
                $price=$_POST['price'];
                $category=$_POST['category'];

                if(isset($_POST['featured'])){
                    $featured=$_POST['featured'];
                }
                else
                {
                    $featured="No";
                }

                if(isset($_POST['active'])){
                    $active=$_POST['active'];
                }
                else
                {
                    $active="No";
                }

                if(isset($_FILES['image']['name'])){
                    $image_name=$_FILES['image']['name'];

                    if($image_name!="")
                    {
                        $ext=end(explode('.',$image_name));
                        $image_name="food_name_".rand(0000,9999).".".$ext;

                        $source_path=$_FILES['image']['tmp_name'];

                        $destination_path="../images/food/".$image_name;
                        
                        $upload=move_uploaded_file($source_path, $destination_path);

                        if($upload==false)
                        {
                            $_SESSION['upload']="<div class='error'>Failed to upload image</div>";
                            header("location:".SITE_URL.'admin/manage-food.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name="";
                }

                $sql2="INSERT INTO tbl_food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                ";

                $res2=mysqli_query($conn, $sql2);

                if($res2){
                    $_SESSION['add-food']="<div class='success'>Food added successfully!</div>";
                    header("location:".SITE_URL.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['add-food']="<div class='error'>Failed add food!</div>";
                    header("location:".SITE_URL.'admin/manage-food.php');
                }
            }
        ?>


    </div>
</div>
<?php include('./partials/footer.php') ?>