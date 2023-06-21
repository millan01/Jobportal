<?php 
include('../database/connection.php');
if(isset($_GET['id'])){
    $del = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM jobseeker_skill WHERE id = ?");
    $stmt->bind_param("i", $del); 
    $stmt->execute();
    $stmt->close();

    header('location: ../jobseekerprofile.php');

}

?>