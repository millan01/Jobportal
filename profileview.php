<?php
session_start();
include('./database/connection.php');
if ($_GET['applicationid']) {
    $applicationId = $_GET['applicationid'];
}

$stmt = $conn->prepare("SELECT * from application where application_id = ?");
$stmt->bind_param("i", $applicationId);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $jobseekerid = $row['jobSeekerID'];
    }
}
//display the total years of experience
$sum = 0;
$sql = "SELECT startDate, endDate from jobseeker_experience where jobseeker_id =  '  $jobseekerid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $exp = date_diff(date_create($row['startDate']), date_create($row['endDate']));
    $expyear = $exp->y;
    $expmonth = $exp->m;

    $sum = $sum + $expyear + $expmonth;
}
$stmt = $conn->prepare("SELECT * from job_seeker where Job_seeker_id = ?");
$stmt->bind_param("i", $jobseekerid);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/jobseekerprofile.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/brands.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/fontawesome.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/solid.css">
</head>

<body>
    <div class="content">

        <div class="sidebar">

            <div class="imagearea">
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    $seekerid = $row['Job_seeker_id']; ?>
                    <div class="imagetop">
                        <div class="detailsimage">
                            <?php
                            if ($row['Image_name'] == '') {
                                echo '<img src =./images/avatar.png>';
                            } else {
                                echo '<img src="./images/uploaded_image/jobseeker/' . $row['Image_name'] . '">';
                            }
                            ?>
                        </div>
                        <p>
                            <?php echo $row['Full_name']; ?>
                        </p>
                    </div>
                    <hr color="black">
                    <div class="imagebutton">
                        <p><i class="fa fa-phone  fa-1x"></i>&nbsp;&nbsp;
                            <?php echo $row['Phone']; ?>
                        </p>
                        <p><i class="fa-regular fa-globe fa-1x"></i>&nbsp;&nbsp; <a
                                href="<?php echo $row['website']; ?>"><?php echo $row['website']; ?></a></p>
                        <p><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;
                            <?php echo $row['contact_email'];
                }
                $stmt->close(); ?>
                    </p>
                </div>
            </div>
            <div class="Details">
                <div class="header">
                    <h2>Job-Seeker Details</h2>
                </div>
                <?php
                $stmt = $conn->prepare("SELECT * from job_seeker where Job_seeker_id = ?");
                $stmt->bind_param("i", $jobseekerid);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = mysqli_fetch_assoc($result)) { ?>


                    <div class="years">
                        <li style="font-weight: bold;">Experience</li>

                        <li></li>
                    </div>
                    <div class="age">
                        <li style="font-weight: bold;">Age</li>
                        <?php $date = $row['Age'];
                        $age = date_diff(date_create($date), date_create('today'))->y;
                        ?>
                        <li>
                            <?php echo $age; ?>
                        </li>
                    </div>
                    <div class="sex">
                        <li style="font-weight: bold;">Gender:</li>
                        <li>
                            <?php echo $row['gender']; ?>
                        </li>
                    </div>
                    <div class="address">
                        <li style="font-weight: bold">Address:</li>
                        <li>
                            <?php echo $row['jobseeker_address']; ?>
                        </li>
                    </div>
                </div>
            <?php }
                $stmt->close(); ?>
        </div>

        <div class="main">


            <div class="whoami">
                <h2>Who am I</h2>
                <hr color="black" size="0.5px" style="margin-top: -8px;">
                <?php
                $stmt = $conn->prepare("SELECT jobseeker_description from job_seeker where Job_seeker_id = ?");
                $stmt->bind_param("i", $jobseekerid);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = mysqli_fetch_assoc($result);
                    $des = $row['jobseeker_description'];
                }
                ?>
                <p>
                    <?php echo $des; ?>
                </p>
            </div>
            <?php ?>

            <div class="mainsub">
                <div class="edu">
                    <h2>Education</h2>
                </div>
                <div class="educontent">
                    <?php
                    $stmt = "SELECT * from  jobseeker_education where jobseeker_id = $seekerid";
                    $result = mysqli_query($conn, $stmt);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="eduschool">
                                <div class="col1">
                                    <p style="font-weight: bold;"><i class="fa fa-circle-check"></i>
                                        <?php echo $row['Course'] ?> <span>
                                            <?php echo $row['started_year'] ?> -
                                            <?php echo $row['end_year'] ?>
                                        </span>
                                    </p>
                                    <p>&nbsp;&nbsp;&nbsp; <i class="fa fa-dot-circle"></i>
                                        <?php echo $row['institute'] ?>
                                    </p>


                                </div>
                            </div>
                        <?php }
                    } else { ?>
                    <h3 style="font-style:Italic; word-spacing:1px;">No data added</h3>
                    <?php }
                    ?>
                </div>
            </div>

            <div class="mainsubtwo">
                <div class="skill">
                    <h2>Skills</h2>
                </div>

                <hr color="black" size="0.5px">


                <?php
                $sql = "SELECT * from jobseeker_skill where jobseeker_id = $seekerid";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="skillcontent">
                            <div class="skilltittle">
                                <li><i class="fa fa-dot-circle"></i> &nbsp;
                                    <?php echo $row['Title']; ?>
                                </li>
                            </div>
                            <div class="skillprogressbar">
                                <progress value="<?php echo $row['progress']; ?>" max="100"></progress>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                <h3 style="font-style:Italic; word-spacing:1px;">No data added</h3>
                <?php } ?>
            </div>

            <div class="mainthree">
                <div class="Certificates">
                    <h2>Certificates</h2>
                </div>
                <hr color="black" size="0.5px">
                <?php
                $query = "SELECT * from  jobseeker_certs where jobseeker_id = $seekerid";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="certcontent">
                            <div class="cert1">
                                <li><i class="fa fa-dot-circle"></i>&nbsp;
                                    <?php echo $row['Title']; ?>
                                </li>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp; (
                                    <?php echo $row['awarded_by']; ?>)
                                </span>
                            </div>
                            <div class="cert2">
                                <li>
                                    <?Php echo $row['year']; ?>
                                </li>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                <h3 style="font-style:Italic; word-spacing:1px;">No data added</h3>
                <?php } ?>
            </div>

            <div class="mainfour">
                <div class="Experience">
                    <h2>Experience</h2>
                </div>
                <hr color="black" size="0.5px">
                <?php
                $sql = "SELECT * from jobseeker_experience where jobseeker_id =  $seekerid";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                        <div class="expcontents">
                            <div class="expetitle">
                                <li><i class="fa fa-dot-circle"></i>&nbsp;
                                    <?php echo $row['companyName']; ?>
                                </li>
                            </div>
                            <div class="expdate">
                                <li>
                                    <?php echo date('Y', strtotime($row['startDate'])); ?> -
                                    <?php echo date('Y', strtotime($row['endDate'])); ?>
                                </li><span>
                                    <?php
                                    $totalyear = date_diff(date_create($row['startDate']), date_create($row['endDate']));
                                    $year = $totalyear->y;
                                    $months = $totalyear->m;
                                    echo $year . 'Year' . '&nbsp;' . $months . 'months';
                                    ?>
                                </span>
                            </div>
                        </div>
                    <?php }
                }else{ ?>
                    <h3 style="font-style:Italic; word-spacing:1px;">No data added</h3>
  
               <?php } ?>
            </div>
        </div>
    </div>
    <script src="./js/jobseekerprofile.js"></script>

</body>

</html>