
<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
        <div class="main-content">
            <div class="wrapper">
            <br><br><br><br>
                <h1>Dashboard</h1>
                <br><br><br><br>

                <div class="col-4">

                    <?php 
                        $sql = "SELECT * FROM category";
                        $res = mysqli_query($con, $sql);
                        $count = mysqli_num_rows($res);
                    ?>

                    <h1><?php echo $count; ?></h1>
                    <br>
                    Categories
                </div>

                <div class="col-4 ">
                    <?php 
                        $sql2 = "SELECT * FROM food";
                        $res2 = mysqli_query($con, $sql2);
                        $count2 = mysqli_num_rows($res2);
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br>
                    Foods
                </div>

                <div class="col-4">
                    <?php 
                        $sql3 = "SELECT * FROM order_food";
                        $res3 = mysqli_query($con, $sql3);
                        $count3 = mysqli_num_rows($res3);
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br>
                    Total Orders
                </div>

                <div class="col-4">
                    <?php 
                        //Creat SQL Query to Get Total Revenue Generated
                        //Aggregate Function in SQL
                        $sql4 = "SELECT SUM(total) AS Total FROM order_food WHERE status='Delivered'";

                        $res4 = mysqli_query($con, $sql4);
                        $row4 = mysqli_fetch_assoc($res4);
                        //GEt the Total REvenue
                        $total_revenue = $row4['Total'];
                    ?>
                    <h1>$<?php echo $total_revenue; ?></h1>
                    <br>
                    Revenue Generated
                </div>

                <div class="clearfix"></div>

            </div>
        </div>
        <!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>