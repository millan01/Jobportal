<?php 
include('./database/connection.php');
session_start();
$seekerSession = $_SESSION['seeker_Email'];
if ($_GET['job_id']) {
    $id = $_GET['job_id'];
}

$stmt = $conn->prepare("SELECT jobSeekerID from application where jobID = ?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows==1){
 }
header('location:jobdescription.php?job_id=' . $id);
