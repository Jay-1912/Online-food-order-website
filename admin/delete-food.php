<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        if($image_name!=" ")
        {
            $path="../images/food/".$image_name;

            $remove = unlink($path);

            if(!$remove)
            {
                $_SESSION['remove']="<div class='error'>Failed to remove image</div>";

                header("location:".SITE_URL.'admin/manage-food.php');

                die();
            }
        }
    }

    $sql= "DELETE FROM tbl_food WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res){



        $_SESSION['delete-food']="<div class='success'>Food deleted successfully!</div>";
        header("location:".SITE_URL.'admin/manage-food.php');
    }
    else
    {
        $_SESSION['delete-food']="<div class='error'>Failed to delete food!</div>";
        header("location:".SITE_URL.'admin/manage-food.php');
    }
?>