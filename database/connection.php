<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$database_name = 'JobPortal';

$conn = new mysqli($servername,$username, $password,$database_name);
if($conn->connect_error){
    die(mysqli_connect_error());
}


// $sql = "CREATE DATABASE JobPortal";

// if($conn->query($sql)==true){
//     echo "Database created";
// }
// else{
//     echo "Failed";
// }
?>