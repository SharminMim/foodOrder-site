<?php include("partials/menu.php"); ?>

    <!--  Main content starts-->
    <div class="main-content">
        <div class="wrapper">
        <br><br><br><br>
            <h1>Manage Admin</h1>
            <!--Button to add admin-->
            <br><br><br><br>
            <a href="add-admin.php" class="btn-primary">Add Admin</a><br><br>
                 <?php
                 if(isset($_SESSION['add'])){
                    echo $_SESSION['add'];//display session txt
                    unset($_SESSION['add']);//delete session txt
                 }
                 
                 elseif(isset($_SESSION['update'])){
                    echo $_SESSION['update'];//display session txt
                    unset($_SESSION['update']);//delete session txt
                 }
                 ?>
            <table  class="tbl">
                <tr>
                    <th>S.N.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>

                <?php
                //query to get all admin
                $sql="SELECT * FROM user_form";
                //execute query
                $res=mysqli_query($con,$sql);

                //check query executed or not??
                if($res==true){
                    //count roe to check if we have data on database
                    $count=mysqli_num_rows($res);//get data from database
                    $sn=1;
                    
                    //check row number
                    if($count>0){
                        //we have data
                        while($rows=mysqli_fetch_assoc($res)){
                            //get all data
                            $id=$rows['id'];
                            $name=$rows['name'];
                            $email=$rows['email'];

                            //display on table
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $email; ?></td>
                                <td>
                                    <a href="update-admin.php?id=<?php echo $rows['id'];?>" class="btn-secondary">Update Admin</a>
                                    <a href="delete-admin.php?id=<?php echo $rows['id'];?>" class="btn-danger">Delete Admin</a>
                        
                                </td>
                             </tr>
                            <?php

                        }
                    }
                    else{
                        //dont have data
                    }
                }

                ?>

            </table>

        </div>
    </div>
    <!--  Main content ends-->

<?php include("partials/footer.php"); ?>


