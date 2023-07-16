<?php 
include('./database/connection.php');
session_start();
$seekerSession = $_SESSION['seeker_Email'];

if ($_GET['job_id']) {
    $id = $_GET['job_id'];
}

$stmt = $conn->prepare("SELECT companyID,CompanyName,job_title from job where job_id =?");
$stmt->bind_param("i",$id);
$stmt->execute();
$result = $stmt->get_result();
while($row=mysqli_fetch_assoc($result)){
    $companyid = $row['companyID'];
    $companyName = $row['CompanyName'];
    $jobtitle = $row['job_title'];
}
$stmt->close();

$stmt = $conn->prepare("SELECT Job_seeker_id from job_seeker where Email =?");
$stmt->bind_param("s",$seekerSession);
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows == 1){
    while($row=mysqli_fetch_assoc($result)){
        $jobseeker = $row['Job_seeker_id'];
    }
}
$stmt->close();

$stmt =$conn->prepare("INSERT INTO application(jobID,jobTitle,companyID,jobSeekerID) VALUES (?,?,?,?)");
$stmt->bind_param("isii",$id,$jobtitle,$companyid,$jobseeker);
$stmt->execute();
$stmt->close();
header('location:jobdescription.php?job_id='.$id);
?>
