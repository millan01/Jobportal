<?php

$companyname = $startdate = $enddate = $start_date = $end_date = "";
$companynameErr = $startdateErr = $enddateErr = "";

if (isset($_POST[''])) {

    if (empty($_POST['cname'])) {
        $companynameErr = "company name not selected";
    } else {
        $companyname = test_input($_POST['canme']);
        if (!preg_match("/^[a-zA-Z ]*$/", $companyname)) {
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
        include('./database/connection.php');
        $stmt = $conn->prepare("INSERT INTO table_name(companyname, starteddate,end_date) VALUES (?,?,?");
        $stmt->bind_param("sss", $companyname, $start_date, $end_date);
        $stmt->execute();
        $stmt->close();
        header('location:jobseekerprofile.php');

    }
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