<?php include("partials/menu.php"); ?>

<div class="main-content">
    <div class="wrapper">
    <br><br><br><br>
        <h1>Update Category</h1>
        <br><br><br><br>

        <?php
        if(isset($_GET['id'])){
            //get all info
            $id=$_GET['id'];
            $sql=" SELECT * FROM category WHERE id='$id'";
            $result=mysqli_query($con,$sql);
            $count=mysqli_num_rows($result);
            if($count==1){
                //get all data
                $row=mysqli_fetch_assoc($result);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
            }
            else{
                echo 'no-category found';
                header('location:manage-category.php');
            }
        }
        else{
            header('location:manage-category.php');
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                            if($current_image!=''){
                                //display image
                                ?>
                                <img src="../images/category/<?php echo $current_image; ?>"width='100px'>
                                <?php
                            }
                            else{
                                echo'Image not Added';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php  if($featured=="Yes"){echo "checked";} ?>type="radio" name="featured" value="Yes">Yes
                        <input <?php  if($featured=="No"){echo "checked";} ?>type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?>type="radio" name="active" value="Yes">Yes
                        <input <?php if($active=="No"){echo "checked";} ?>type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name='current_image'value='<?php echo $current_image; ?>'>
                        <input type="hidden" name='id'value='<?php echo $id; ?>'>
                        
                        <input type="submit" name="submit"value="Update Category"class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php
            if(isset($_POST['submit'])){
                $id=$_POST['id'];
                $title=$_POST['title'];
                $current_image=$_POST['current_image'];
                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //update new image
                if(isset($_FILES['image']['name'])){
                    $image_name=$_FILES['image']['name'];
                    if($image_name!=''){
                        //upload new image
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
                            header('location:admin/manage-category.php');
                            die();
                        }

                        //remove current image
                        if($current_image!=''){
                            $path='../images/category/'.$current_image;
                            $remove=unlink($path);
                            if($remove==false){
                                echo'failed to remove currentt image';
                                header('location:admin/manage-category.php');
                                die();
                            }
                        }
                    }
                    else{
                        $image_name=$current_image;
                    }
                }
                else{
                    $image_name=$current_image;
                }

                //update database
                $sql2=" UPDATE category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id='$id'
                ";

                $result2=mysqli_query($con,$sql2);
                if($result2==true){
                    echo'Category Updated';
                    header('location:manage-category.php');
                }
                else{
                    echo'Failed to Category Updated';
                    header('location:manage-category.php');
                }


            }

        ?>

    </div>
</div>


<?php include("partials/footer.php"); ?>
