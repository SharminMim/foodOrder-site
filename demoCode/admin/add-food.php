<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    <br><br><br><br>
        <h1>Add Food</h1>

        <br><br><br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php 
                                //display categories from Database
                                //get all active categories from database
                                $sql = "SELECT * FROM category WHERE active='Yes'";
                                $res = mysqli_query($con, $sql);
                                $count = mysqli_num_rows($res);
                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //don't have category
                                    ?>
                                    <option value="0">No Category Found</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes 
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes 
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        
        <?php 

            if(isset($_POST['submit']))
            {                
                //1. Get the DAta from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                //radion button active or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //Setting the Default Value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No";
                }

                //2. Upload the Image if selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];
                    if($image_name!="")
                    {
                        //renamge the Image
                        $ext = end(explode('.', $image_name));
                        $image_name = "Food_Name-".rand(000,999).".".$ext; 

                        //B. Upload the Image
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../images/food/".$image_name;
                        $upload = move_uploaded_file($src, $dst);

                        //check image uploaded of not
                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:add-food.php');
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = "";
                }

                //3. Insert Into Database

                $sql2 = "INSERT INTO food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = $category,
                    featured = '$featured',
                    active = '$active'
                ";
                $res2 = mysqli_query($con, $sql2);
                if($res2 == true)
                {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:manage-food.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>