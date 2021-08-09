<?php include('./partials/menu.php') ?>
        <!-- Main Content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage orders</h1>
              
                <table class="tbl-full">
                    <tr>
                        <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order date</th>
                        <th>status</th>
                        <th>Customer name</th>
                        <th>Customer contact</th>
                        <th>Customer Email</th>
                        <th>Actions</th>
                    </tr>
                    <?php 
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count>0)
                        {
                            $sn=1;
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row['id'];
                                $food=$row['food'];
                                $price=$row['price'];
                                $qty=$row['quantity'];
                                $total=$row['total'];
                                $order_date=$row['order_date'];
                                $status=$row['status'];
                                $customer_name=$row['customer_name'];
                                $customer_contact=$row['customer_contact'];
                                $customer_email=$row['customer_email'];
                                ?>
                                <tr>
                                    <td><?php echo $sn;?></td>
                                    <td><?php echo $food; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td>
                                        <a href="<?php echo SITE_URL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">Update Order</a>
                                    </td>
                                </tr>
                                <?php
                                $sn++;
                            }
                        }
                        else
                        {
                            echo "Orders not available";
                        }

                    ?>
                    
                    
                </table>
                <?php
                    if(isset($_SESSION['update-order'])){
                        echo $_SESSION['update-order'];
                        unset($_SESSION['update-order']);
                    }
                ?>

            </div>
        </div>
        <!-- Main content ends -->

<?php include('./partials/footer.php') ?>