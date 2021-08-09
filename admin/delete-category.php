<?php 

    include('../config/constants.php');

   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //Remove the physical image file is available
         if($image_name != " ")
         {
            $path="../images/category/".$image_name;

            $remove = unlink($path);

            if($remove==false)
            {
                $_SESSION['remove']="<div class='error'>Failed to remove image</div>";

                header("location:".SITE_URL.'admin/manage-category.php');

                die();
            }

         }  
         
         $sql="DELETE FROM tbl_category WHERE id=$id";

         $res=mysqli_query($conn, $sql);

         if($res)
         {
            $_SESSION['delete-category']="<div class='success'>Category deleted successfully!</div>";
            header("location:".SITE_URL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['delete-category']="<div class='error'>Failed to delete category</div>";
            header("location:".SITE_URL.'admin/delete-category.php');
        }

        //Delete data from database


   }
   else{
        header("location:".SITE_URL.'admin/manage-category.php');
   }


?>