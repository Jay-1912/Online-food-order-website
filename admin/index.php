<?php include('./partials/menu.php') ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>
                <br><br>
                <?php
                if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>   
                <br><br>
                <div class="col-4 text-center">

                    <?php
                        $sql =" SELECT * FROM tbl_category";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>
                    
                    <h1><?php echo $count; ?></h1>
                    <br />
                    Categories
                </div>
                <div class="col-4 text-center">
                    <?php
                        $sql =" SELECT * FROM tbl_food";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br />
                    Foods
                </div>
                <div class="col-4 text-center">
                    <?php
                        $sql =" SELECT * FROM tbl_order";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if($count>0){
                            $sum=0;
                            while($row=mysqli_fetch_assoc($res)){
                                $total=$row['total'];
                                $sum=$sum+$total;
                            }
                        }
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br />
                    Total orders
                </div>
                <div class="col-4 text-center">
                    <h1>$<?php echo $sum; ?></h1>
                    <br />
                    Revenue Generated
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main content ends -->

<?php include('./partials/footer.php') ?>