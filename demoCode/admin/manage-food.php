<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <br><br><br><br>
        <h1>Manage Food</h1>
        <br><br><br><br>
        <a href="add-food.php" class="btn-primary">Add Food</a><br><br>
        <table class="tbl">
        <tr>
            <th>S.N.</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
        <?php 
        $sql = "SELECT * FROM food";
        $res = mysqli_query($con, $sql);
        $count = mysqli_num_rows($res);
        $sn=1;
        if($count>0){
            //Get the Foods from Database and Display
            while($row=mysqli_fetch_assoc($res)){
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
        ?>
        <tr>
            <td><?php echo $sn++; ?>. </td>
            <td><?php echo $title; ?></td>
            <td><?php echo $price; ?></td>
            <td>
            <?php  
            if($image_name==""){
                echo "<div class='error'>Image not Added.</div>";
            }
            else{
                //Display Image
            ?>
            <img src="<?php echo '//localhost/WebCode/demoCode/'; ?>images/food/<?php echo $image_name; ?>"width="100px">
            <?php
            }
            ?>
            </td>
            <td><?php echo $featured; ?></td>
            <td><?php echo $active; ?></td>
            <td>
                <a href="update-food.php?id=<?php echo $row['id'];?>" class="btn-secondary">Update Food</a>
                <a href="delete-food.php?id=<?php echo $row['id']; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>

            </td>
        </tr>
        <?php
        }}
        else{
        //Food not Added in Database
        echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
        }
        ?>
        </table>
    </div>   
</div>

<?php include('partials/footer.php'); ?>