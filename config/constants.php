<?php
//start session

session_start();


// create constant to store Non repeating Values
define('SITEURL','http://localhost/onlinefood/');
define('LOCALHOST','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','onlinefood');


//execute query and save data in database
$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(myqli_error()); //Database connection
$db_select = mysqli_select_db($conn, DB_NAME)or die(mysqli_error()); //selecting database

?>
