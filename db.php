<?php
$dbhost = 'localhost';
$dbusername = 'root';
$dbpassword = '';
$dbname = 'codesprint';

//creating a DB connection
$conn = mysqli_connect($dbhost, $dbusername, $dbpassword, $dbname);

//displaying a message if the connection fails
if(!$conn){
    die('Could not connect : '.mysqli_error($conn));
}

//select the database
mysqli_select_db($conn, $dbname);

?>