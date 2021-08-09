<?php include ('../config/constants.php'); ?>
<html>
    <head>
        <title>
            Log in - Food order system
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>

            <?php 
                if(isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>

            <form action="" method="POST">
                Username:<br />
                <input type="text" name="username" placeholder="Enter username"><br /><br />
                Password:<br />
                <input type="password" name="password" placeholder="Enter password"><br /><br />

                <input type="submit" name="submit" value="login" class="btn-primary">
            </form>

            <p class="text-center">Created By - <a href="">Jay Vadhavana</a></p>
        </div>
    </body>
</html>

<?php 
    
    if(isset($_POST['submit'])){
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        $res = mysqli_query($conn, $sql);

        if($res)
        {
            $count=mysqli_num_rows($res);
            if($count==1){
                $_SESSION['login']="<div class='success'>Logged In Successfully</div>";
                $_SESSION['user']=$username;
                header("location:".SITE_URL.'/admin');
            }
            else
            {
                $_SESSION['login']="<div class='error'>Failed to Login</div>";
                header("location:".SITE_URL.'/admin/login.php');
            }
        }
    }
?>