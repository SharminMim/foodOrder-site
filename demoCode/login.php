<?php include("config/constant.php"); 
include("admin/partials/front_menu.php");
session_start();
?>


<?php
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $pass=$_POST['password'];

    $sql=" SELECT * FROM user_form WHERE email='$email' AND password='$pass'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){

       $rows=mysqli_fetch_assoc($result);

       if($rows['user_type'] == 'admin'){
            $_SESSION['admin_name']=$rows['name'];
            header('location:admin/index.php');
       }
       elseif($rows['user_type'] == 'user'){
            $_SESSION['admin_name']=$rows['name'];
            header('location:index.html');
       }
    }
    else{
        $error[]='Incorrect email or password!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering Site</title>

    <!--font awsom cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!--css file link-->
    <!-- <link rel="stylesheet" href="css/style.css"> -->

</head>

<body>
    <!--header section starts-->
    <header>
        <a href="#" class="logo">Food<span>U</span></a>
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="#about">about</a>
            <a href="#menu">menu</a>
            <a href="#contact">contact</a>
            <a href="#login.php">Login</a>

        </nav>

    </header>
    <!--header section ends-->

    <!--login form container-->
    <div class="form-container">
        <form action="" method="POST">
            <h3>Login</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo $error;
                }
            }  
            ?>
            <input type="email" class="box" name="email" placeholder="enter your email">
            <input type="password" class="box" name="password" placeholder="enter your password">
            <input type="submit" name="submit"value="login"class="btn">
            <input type="checkbox" id="remember">
            <label for="remember">Remember me</label>
            <p>Don't have any account? <a href="register.php">register now</a></p>
        </form>
    </div>
</body>
</html>