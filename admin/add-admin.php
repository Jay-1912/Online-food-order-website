<?php include('./partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br />
        <br />

        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter full name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Enter username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Enter password"></td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('./partials/footer.php');?>

<?php
    //Process the value from form and save it in database
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Button clicked
        //echo "Button clicked";
        
        //. Get the data from Form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']); //Password Encryption with MD5

        //2. SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        //3. Execute query and save data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        //4. Check wheter the data is inserted or not and display appreciate message
        if($res)
        {
            //Data Inserted
            //echo "data inserted";
            //Create a session variable to display message
            $_SESSION['add']="Admin added successfully!";
            //Redirect page to manage admin
            header("location:".SITE_URL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to insert data
            //echo "failed to insert data";
            //Create a session variable to display message
            $_SESSION['add']="Failed to add admin!";
            //Redirect page to add admin
            header("location:".SITE_URL.'admin/add-admin.php');
        }
    }
?>