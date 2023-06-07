<?php include("partials/menu.php"); ?>

<!--  Main content starts-->

<div class="main-content">
    <div class="wrapper">
    <br><br><br><br>
        <h1>Add Admin</h1>
        <br><br><br><br>
        
        <form action="" method="POST">
            <table class="tbl-admin">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="name" placeholder="enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email"  name="email" placeholder="enter your email">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="enter your password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
                </tr>
            </table>
        </form>
    </div>
</div>
<!--  Main content ends-->

<?php include("partials/footer.php"); ?>


<?php

//take input & save database
//check submit button clicked or not

if(isset($_POST['submit'])){
    //button clicked
  
    //1.data from form
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);

    //2.SQL query to save data
    $_sql = "INSERT INTO user_form SET
    name='$name',
    email='$email',
    password='$password'
    ";

    //3.Execute Query & save database
    if(!mysqli_query($con,$_sql)){
    $_SESSION['add']="Failed to insert data!";
    //Redirect page
    header('location:add-admin.php');
    }

    else{
    $_SESSION['add']="Admin Added Successfully";
    //Redirect page
    header('location:manage-admin.php');

    }
    

}



?>