<?php
include('./database/connection.php');
if (isset($_GET['Job_seeker_id'])) {
    $del = $_GET['Job_seeker_id'];


    $stmt = $conn->prepare("DELETE FROM  job_seeker WHERE Job_seeker_id  = ?");
    $stmt->bind_param("i", $del);
    $stmt->execute();
    $stmt->close();

    header("location: admindashboard.php");
}

if (isset($_GET['company_id'])) {
    $delete = $_GET['company_id'];


    $stmtt = $conn->prepare("DELETE FROM  company WHERE company_id   = ?");
    $stmtt->bind_param("i", $delete);
    $stmtt->execute();
    $stmtt->close();

    header("location: admindashboard.php");
}
?>