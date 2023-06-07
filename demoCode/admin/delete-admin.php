<?php
include("../config/constant.php");
if(isset($_GET['id'])){
    
$id=$_GET['id'];
$_sql = " DELETE FROM user_form WHERE id = $id";

    if(!mysqli_query($con,$_sql)){
    $_SESSION['add']="Failed to delete data!";
    }

    else{
    $_SESSION['add']="Admin Deleted Successfully";
    //Redirect page
    header('location:manage-admin.php');
    } 

}
?>
        