<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
    <br><br><br><br>
        <h1>Add Category</h1>
        <br><br><br><br>


        <!-- Add category form starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-admin">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit"value="Add Category"class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form ends -->


        <?php

            if(isset($_POST['submit'])){
                //1.get value
                $title=$_POST['title'];

                //check radio button clicked or not
                if(isset($_POST['featured'])){
                    $featured=$_POST['featured'];
                }
                else{
                    $featured='No';
                }
                if(isset($_POST['active'])){
                    $active=$_POST['active'];
                }
                else{
                    $active='No';
                }

                //check image selected or not
                //print_r($_FILES['image']);
                if(isset($_FILES['image']['name'])){
                    $image_name=$_FILES['image']['name'];
                    if($image_name!=''){
                        //auto rename
                        $ext=end(explode('.', $image_name));
                        $image_name='Food_Category_'.rand(000,999).'.'.$ext;
                    
                        $source_path=$_FILES['image']['tmp_name'];
                        $destination_path='../images/category/'.$image_name;

                        //upload image
                        $upload=move_uploaded_file($source_path,$destination_path);

                        //check image uploaded or not
                        if($upload==false){
                            echo"failed to upload";
                            header('location:admin/add-category.php');
                            die();
                        }
                     
                    }
                    
                }
                else{
                    $image_name='';
                }

                //2.insert data into database
                $sql=" INSERT INTO category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                ";

                //3.execute and save into database
                $result=mysqli_query($con,$sql);

                //4.check executed or not
                if($result==true){
                    $_SESSION['add']='Category Added Successfully';
                    header('location:manage-category.php');
                }
                else{
                    $_SESSION['add']='Failed to Add Category';
                    header('location:admin/add-category.php');
                }
            }
        ?>

    </div>
</div>


<?php include("partials/footer.php"); ?>
