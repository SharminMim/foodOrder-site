<?php 
include("../config/constant.php");

    if(isset($_GET['id']) AND isset($_GET['image_name'])) 
    {
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //2. Remove the Image if Available
        if($image_name != "")
        {
            $path='../images/food/'.$image_name;
            $remove=unlink($path);
            if($remove==false)
            {
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                header('location:manage-food.php');
                die();
            }
        }
        //3. Delete Food from Database
        $sql = "DELETE FROM food WHERE id='$id'";
        $result = mysqli_query($con, $sql);
        if($result==true)
        {
            $_SESSION['delete'] = "<div class='success'>Food Deleted Successfully.</div>";
            header('location:manage-food.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food.</div>";
            header('location:manage-food.php');
        }
    }
    else
    {
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:admin/manage-food.php');
    }
?>