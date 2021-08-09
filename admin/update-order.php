<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update order</h1>
        <br /><br />
        <?php
            if(isset($_GET['id'])){
                $id=$_GET['id'];

                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($res);

                $food = $row['food'];
                $qty = $row['quantity'];
                $status = $row['status'];
                $price = $row['price'];

            }
            else
            {
                header('location:'.SITE_URL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><input type="text" name="food" value="<?php echo $food; ?>"></td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" >
                            <option value="Ordered"     <?php if($status=="Ordered"){echo "selected"; }?>>Ordered</option>
                            <option value="On Delivery" <?php if($status=="On Delivery"){echo "selected"; }?>>On Delivery</option>
                            <option value="Delivered"   <?php if($status=="Delivered"){echo "selected"; }?>>Delivered</option>
                            <option value="Cancelled"   <?php if($status=="Cancelled"){echo "selected"; }?>>Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        <?php
            if(isset($_POST['submit'])){
                echo $id=$_POST['id'];
                echo $qty=$_POST['qty'];
                echo $status=$_POST['status'];
                echo $price=$_POST['price'];
                echo $total=$price*$qty;

                $sql = "UPDATE tbl_order SET
                quantity=$qty,
                status='$status',
                total=$total
                WHERE id=$id
                ";
                $res = mysqli_query($conn, $sql);

                if($res)
                {
                    $_SESSION['update-order']="<div class='success>Order updated successfully!</div>";
                    header("location:".SITE_URL.'admin/manage-order.php');
                }
                else
                {
                    $_SESSION['update-order']="<div class='error'>Failed to update order</div>";
                    header("location:".SITE_URL.'admin/manage-order.php');
                }

            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>