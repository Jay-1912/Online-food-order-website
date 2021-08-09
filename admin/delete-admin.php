<?php 
    
    include('../config/constants.php');

    //1. get the id of admin to be deleted
    $id = $_GET['id'];

    //2. Execute SQL query to delete
    $sql= "DELETE FROM tbl_admin WHERE id=$id";

    //Execute ther query
    $res=mysqli_query($conn, $sql);

    if($res){
        //query exected
        //echo "Admin Deleted";
        //Create session variable to display message
        $_SESSION['delete']="<div class='success'>Admin deleted Successfully!</div>";
        //Redirect to manage-admin
        header("location:".SITE_URL.'admin/manage-admin.php');
    }
    else
    {
        //query not executed
        // echo "Failed to delete admin";
        $_SESSION['delete']="<div class='error'>Failed to deleter admin!</div>";
        header("location:".SITE_URL.'admin/manage-admin.php');
    }
    //3. Redirect to manage admin page with the message 

?>
