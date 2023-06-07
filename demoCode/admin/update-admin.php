<?php include("partials/menu.php"); ?>
<?php include("../config/constant.php"); ?>

<?php
    $id=$_GET['id'];

    $sql = "SELECT *FROM user_form WHERE id = '$id'";
    $result=mysqli_query($con,$sql);
    
    if($result==true){
        $count=mysqli_num_rows($result);
        if($count==1){
            $rows=mysqli_fetch_assoc($result);
            $full_name=$rows['name'];
            $email=$rows['email'];
        }
    }
    else{
        //redirect
    } 
?>



<div class="main-content">
    <div class="wrapper">
    <h1>Update Admin</h1>
    <br><br>    
    <form action="" method="POST">
            <table class="tbl-admin">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="enter your name" value="<?php echo $full_name ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email"  name="email" placeholder="enter your email"value="<?php echo $email?>">
                    </td>
                </tr>
                <!-- <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="enter your password">
                    </td>
                </tr> -->
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id"value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
if(isset($_POST['submit'])){
    //
    $id=$_POST['id'];
    $full_name=$_POST['name'];
    $email=$_POST['email'];

    //UPDATE query
    $sql="Update user_form SET
    name='$full_name',
    email='$email'
    WHERE id='$id'
    ";

    //execute query
    $result=mysqli_query($con,$sql);

    if($result==true){
        $_SESSION['update']="Admin Updated Successfully";
        //Redirect page
        header('location:manage-admin.php');
    }
    else{
        $_SESSION['update']="Failed to Updated";
    }
}
?>

<?php include("partials/footer.php"); ?>