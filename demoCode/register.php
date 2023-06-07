<?php include("config/constant.php"); 
include("admin/partials/front_menu.php");
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
    <link rel="stylesheet" href="css/style.css">

</head>


<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $cpass=$_POST['cpassword'];
    $user_type=$_POST['user_type'];

    $sql=" SELECT * FROM user_form WHERE email='$email' && password='$pass'";
    $result=mysqli_query($con,$sql);
    if(mysqli_num_rows($result)>0){
        $error[]='user already exist!';
    }
    else{
        if($pass!=$cpass){
            $error[]='password not matched!';
        }
        else{
            $insert="INSERT INTO user_form(name,email,password,user_type) VALUES ('$name','$email','$pass','$user_type')";
            mysqli_query($con,$insert);
            header('location:login.php');
        }
    }
}
?>

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
    <!--form container-->
    <div class="form-container">
        <form action="" method="POST">
            <h3>Register Here</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo $error;
                }
            }  
            ?>

            <input type="text" class="box" name="name" placeholder="enter your name">
            <input type="email" class="box" name="email" placeholder="enter your email">
            <input type="password" class="box" name="password" placeholder="enter your password">
            <input type="password" class="box" name="cpassword" placeholder="confirm your password">
            <select name="user_type" class="box">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
            <input type="submit" name="submit" value="register"class="btn">
            <p>Already have any account? <a href="login.php">login now</a></p>
        </form>
    </div>
</body>
</html>