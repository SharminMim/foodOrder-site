<?php include("partials/menu.php"); ?>

    <!--  Main content starts-->
    <div class="main-content">
        <div class="wrapper">
        <br><br><br><br>
            <h1>Manage Category</h1>
            <br><br><br><br>
            <a href="add-category.php" class="btn-primary">Add Category</a><br><br>

            <table  class="tbl">
                <tr>
                    <th>S.N.</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                    $sql='SELECT * FROM category';
                    $result=mysqli_query($con,$sql);
                    $count=mysqli_num_rows($result);
                    $sn=1;

                    if($count>0){
                        //get data and display
                        while($row=mysqli_fetch_assoc($result)){
                            $id=$row['id'];
                            $title=$row['title'];
                            $image_name=$row['image_name'];
                            $featured=$row['featured'];
                            $active=$row['active'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>

                                <td>
                                    <?php 
                                    //echo $image_name;
                                    //check image name available or not
                                    if($image_name!=""){
                                        //display image
                                        ?>
                                        <img src="<?php echo '//localhost/WebCode/demoCode/'; ?>images/category/<?php echo $image_name; ?>"width="100px">
                                        <?php
                                    }
                                    else{
                                        echo "Image not Added";
                                    }
                                    ?>
                                </td>

                                <td><?php echo $featured; ?></td>
                                <td><?php echo $active; ?></td>
                                <td>
                                    <a href="update-category.php?id=<?php echo $row['id'];?>" class="btn-secondary">Update Category</a>
                                    <a href="delete-category.php?id=<?php echo $row['id'];?>& image_name=<?php echo $image_name; ?>" class="btn-danger"> Delete Category</a>
                                </td>
                            </tr>
                            <?php
                        }

                    }
                    else{
                        //dont have data
                        //display txt inside table
                        ?>
                        <tr>
                            <td colspan="6">
                                <div class="error">No Category Added</div>
                            </td>
                        </tr>
                        <?php

                    }
                ?>

                
                
            </table>     
        </div>
            
    </div>
    <!--  Main content ends-->

<?php include("partials/footer.php"); ?>
        