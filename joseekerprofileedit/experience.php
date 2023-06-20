<?php
session_start();
include('../database/connection.php');
$sessionmail = $_SESSION['seeker_Email'];
$companyname = $startdate = $enddate = $start_date = $end_date = "";
$companynameErr = $startdateErr = $enddateErr = "";

if (isset($_POST['update'])) {

    if (empty($_POST['cname'])) {
        $companynameErr = "company name not selected";
    } else {
        $companyname = test_input($_POST['cname']);
        if (!preg_match("/^[a-zA-Z0-9 ]+$/", $companyname)) {
            $companynameErr = "only letters";
        }
    }

    if (empty($_POST['start'])) {
        $startdate = "start date required";
    } else {
        $startdate = test_input($_POST['start']);
        $start_date = date('Y-m-d', strtotime($startdate));
    }

    if (empty($_POST['end'])) {
        $enddate = "end date required";
    } else {
        $enddate = test_input($_POST['end']);
        $end_date = date('Y-m-d', strtotime($enddate));
    }


    if (empty($companynameErr) && empty($startdateErr) && empty($enddateErr)) {
        $sql = "SELECT Job_seeker_id FROM job_seeker WHERE Email = '$sessionmail'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $seekerID = $row['Job_seeker_id'];
        }
        $stmt = $conn->prepare("INSERT INTO jobseeker_experience(companyName, startDate,endDate,jobseeker_id) VALUES (?,?,?,?)");
        $stmt->bind_param("sssi", $companyname, $start_date, $end_date,$seekerID);
        $stmt->execute();
        $stmt->close();
        header('location:../jobseekerprofile.php');

    }
}
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="experience.css">
</head>

<body>
    <form action="" method="post">
        <div class="formdetails">
            <h2>Update experience details</h2>
            <hr color="black" size="0.5px">

            <div class="form">
                <label for="companyname">Company Name</label>
                <input type="text" name="cname" id="cname" required>
                <span style ="color:red;"><?php echo $companynameErr ?></span>
            </div>

            <div class="form">
                <label for="fromyear">Start date</label>
                <input type="date" name="start" id="start" required>
                <span style ="color:red;"><?php echo $startdateErr ?></span>

            </div>

            <div class="form">
                <label for="toyear">End date</label>
                <input type="date" name="end" id="end" required>
                <span style ="color:red;"><?php echo $enddateErr ?></span>

            </div>

            <a href=""><button type="submit" name="update">Update</button></a>
        </div>
    </form>
</body>

</html>