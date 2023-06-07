<?php
include("../config/constant.php");

if(isset($_GET['id']) AND isset($_GET['image_name'])){
    //get value and delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //remove available image
    if($image_name!=''){
        //remove availabled image
        $path='../images/category/'.$image_name;
        $remove=unlink($path);
        if($remove==false){
            echo "Failed to remove image!";
            header('location:manage-category.php');
            die();
        }
    }
    //delete data from database
    $sql=" DELETE FROM category WHERE id='$id'";
    $result=mysqli_query($con,$sql);
    if($result==true){
        echo "Category Deleted Successfully";
        header('location:manage-category.php');
    }
    else{
        echo "Category Failed to Delete";
        header('location:manage-category.php');
    }
}
else{
    header('location:admin/manage-category.php');
}
?>