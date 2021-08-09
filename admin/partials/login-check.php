<?php 

    if(!isset($_SESSION['user']))
    {
        $_SESSION['no-login-message']="<div class='error'>Please login to access admin panel</div>";
        header("location:".SITE_URL.'admin/login.php');
    }

?>