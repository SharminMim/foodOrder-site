<?php 

//Session start
// session_start();
// define('SITEURL',"http://localhost/WebCode/demoCode/");


/*
define('LOCALHOST','localhost');
define('DB_NAME','root');
define('DB_PASSWORD','');
define('DB_NAME','food-order');
*/
 $con = mysqli_connect('localhost','root','');
 if(!$con){
     echo "not connected";
 }
 if(!mysqli_select_db($con,'food-order')){
     echo 'not selected any database';
 }

?>