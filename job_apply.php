<?php
include('./database/connection.php');
session_start();
$seekerSession = $_SESSION['seeker_Email'];

$stmt = $conn->prepare("SELECT Job_seeker_id from job_seeker where Email = ?");
$stmt->bind_param("s", $seekerSession);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    $row = mysqli_fetch_assoc($result);
    $jobseekerid = $row['Job_seeker_id'];
}
$stmt->close();

if ($_GET['job_id']) {
    $id = $_GET['job_id'];
}

$stmt = $conn->prepare("SELECT companyID,CompanyName,job_title from job where job_id =?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
while ($row = mysqli_fetch_assoc($result)) {
    $companyid = $row['companyID'];
    $companyName = $row['CompanyName'];
    $jobtitle = $row['job_title'];
}
$stmt->close();

$stmt = $conn->prepare("SELECT Job_seeker_id,Email from job_seeker where Email =?");
$stmt->bind_param("s", $seekerSession);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows == 1) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jobseeker = $row['Job_seeker_id'];
        $email = $row['Email'];
    }
}
$stmt->close();

$defaulttime = time();
$applicationdate = date('Y-m-d H:i:s', $defaulttime);

$stmt = $conn->prepare("INSERT INTO application(jobID,jobTitle,companyID,companyName,jobSeekerID,jobSeekerEmail,applicationDate) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("isisiss", $id, $jobtitle, $companyid,$companyName, $jobseeker, $email,$applicationdate);
$stmt->execute();
$stmt->close();
header('location:jobdescription.php?job_id=' . $id);
?>