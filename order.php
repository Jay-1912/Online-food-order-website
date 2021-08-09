<?php include('./partial-front/menu.php'); ?>

<?php
    if(isset($_GET['id'])){
        $food_id=$_GET['id'];

        $sql= "SELECT * FROM tbl_food WHERE id=$food_id";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            while($row=mysqli_fetch_assoc($res)){
                $title=$row['title'];
                $description=$row['description'];
                $price=$row['price'];
                $image_name=$row['image_name'];


            }

        }
        else
        {
            header("location:".SITE_URL);
        }
    }
    else
    {
        header("location:".SITE_URL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                            if($image_name!="")
                            {
                                ?>
                                <img src="<?php echo SITE_URL; ?>images/food/<?php echo $image_name; ?>" alt="<?php $title; ?>" class="img-responsive img-curve">
                                <?php
                            }
                            else
                            {
                                echo "<div class='error'>Image is not available</div>";
                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php  echo $title; ?></h3>
                        <input type="hidden" name="title" value="<?php echo $title; ?>">
                        <p class="food-price">$<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                if(isset($_POST['submit'])){
                    $food = $_POST['title'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price*$qty;
                    $order_date = date("Y-m-d h:i:sa");
                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];

                    $sql = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = $price,
                        quantity = $qty,
                        total = $total,
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    $res = mysqli_query($conn, $sql);

                    if($res){
                        $_SESSION['order']="<div class='success'>Order placed successfully!</div>";
                        header("location:".SITE_URL);
                    }
                    else
                    {
                        $_SESSION['order']="<div class='error'>Failed to order food!</div>";
                        header("location:".SITE_URL);
                    }
                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('./partial-front/footer.php'); ?>
