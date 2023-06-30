<?php
session_start();
include('./database/connection.php');
$jobseeker_email = $_SESSION['seeker_Email'];
if (!isset($jobseeker_email)) {
    header('location: index.php');
}

$stmt = "SELECT * from job_seeker where email ='$jobseeker_email' ";
$result = mysqli_query($conn, $stmt);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $seekerid = $row['Job_seeker_id'];
    }
}

//display the total years of experience
$sum = 0;
$sql = "SELECT startDate, endDate from jobseeker_experience where jobseeker_id =  '$seekerid'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $exp = date_diff(date_create($row['startDate']), date_create($row['endDate']));
    $expyear = $exp->y;
    $expmonth = $exp->m;

    $sum = $sum + $expyear + $expmonth;
}
$stmt = $conn->prepare("SELECT * from job_seeker where email = ?");
$stmt->bind_param("s", $jobseeker_email);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/jobseekerprofilee.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/brands.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/fontawesome.css">
    <link rel="stylesheet" href="./include/fontawesome-free-6.4.0-web/css/solid.css">
</head>

<body>
    <div class="navbarflow">
        <div class="logo">
            <a href="index.php">
                <img src="./images/logo.svg" alt="company logo">
            </a>
        </div>

        <div class="links">
            <a href="index.php">Home</a>
            <a href="">Blog</a>
            <a href="">Contact</a>
            <a href="">About us</a>
        </div>

        <div class="afterlogin">
            <img src="./images/Account icon.svg" alt="#" class="test">
            <div class="dropdown">
                <a href="jobseekerprofile.php"><button>Profile</button></a>
                <a href="sessiondestroy.php"><button>Log out</button></a>
            </div>
        </div>
    </div>




    <div class="notification">
        <p>Update your profile before applying for jobs !!</p>
    </div>
    <div class="content">

        <div class="sidebar">

            <div class="imagearea">
                <div class="imagetop">
                    <?php while ($row = mysqli_fetch_assoc($result)) {
                        $seekerid = $row['Job_seeker_id'];
                        ?>
                        <img src="./images/esewa.png" alt="">
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
                            <?php echo $row['contact_email']; ?>
                        </p>
                    </div>
                </div>
                <div class="Details">
                    <div class="header">
                        <h2>Job-Seeker Details</h2>
                        <a href="./joseekerprofileedit/details.php" class="openOverlay"><i class="fa-solid fa-edit "
                                style="color: black;"></i> Edit</a>
                        <!-- <a href="./joseekerprofileedit/details.php">Edit</a> -->

                        <div id="overlay">
                            <div id="modal">
                                <button id="closeOverlayBtn"><i class="fa fa-multiply"></i>Close</button>
                                <iframe id="iframe" scrooling = "no" src="" frameborder=""></iframe>
                            </div>
                        </div>

                    </div>
                    <div class="lookingfor">
                        <li style="font-weight: bold;">Looking for:</li>
                        <li>
                            <?php echo $row['Position'] ?>
                        </li>
                    </div>

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

                <div class="jobcount">
                    <h2>Jobs Count</h2>
                    <div class="totaljobs">
                        <div class="total">
                            <li style="font-weight: bold;">Total jobs</li>
                            <li>4</li>
                        </div>
                        <div class="pending">
                            <li style="font-weight: bold;">Pending jobs</li>
                            <li>1</li>
                        </div>
                        <div class="Rejected">
                            <li style="font-weight: bold;">Rejected jobs</li>
                            <li>3</li>
                        </div>
                    </div>
                </div>


            </div>

            <div class="main">


                <div class="whoami">
                    <h2>Who am i?</h2>
                    <hr color="black" size="0.5px" style="margin-top: -8px;">
                    <p>
                        <?php echo $row['jobseeker_description']; ?>
                    </p>
                </div>
            <?php } ?>

            <div class="mainsub">
                <div class="edu">
                    <h2>Education</h2>
                    <a href="./joseekerprofileedit/educaiton.php" class="openOverlay"><button><i
                                class="fa-solid fa-plus " style="color: black;"></i> Add new</button></a>
                </div>
                <hr color="black" size="0.5px">
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
                                <div class="col2">
                                    <?php echo '<a href="javascript:void(0);" onclick="edudelete(' . $row['id'] . ')"><button><i class="fa fa-trash" style="color: #F33636; font-weight: lighter;"></i> Delete</button></a>';
                                    ?>
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
                    <a href="./joseekerprofileedit/skills.php" class="openOverlay"><button><i class="fa-solid fa-plus "
                                style="color: black;"></i> Add new</button></a>
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

                            <div class="skilldelbtn">
                                <?php echo '<a href="javascript:void(0);" onclick="skilldelete(' . $row['id'] . ')"><button><i class="fa fa-trash"style="color: #F33636; font-weight: lighter;"></i> Delete</button></a>' ?>

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
                    <a href="./joseekerprofileedit/certificates.php" class="openOverlay"><button><i
                                class="fa-solid fa-plus " style="color: black;"></i> Add new</button></a>
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
                            <div class="cert3">
                                <?php echo '<a href="javascript:void(0);" onclick="certdelete(' . $row['id'] . ')"><button><i class="fa fa-trash"style="color: #F33636; font-weight: lighter;"></i> Delete</button></a>' ?>

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
                    <a href="./joseekerprofileedit/experience.php" class="openOverlay"><button><i
                                class="fa-solid fa-plus " style="color: black;"></i> Add new</button></a>
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

                            <div class="expdelbtn">
                                <?php echo '<a href="javascript:void(0);" onclick="expdelete(' . $row['id'] . ')"><button><i class="fa fa-trash"style="color: #F33636; font-weight: lighter;"></i> Delete</button></a>' ?>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                <h3 style="font-style:Italic; word-spacing:1px;">No data added</h3>
                <?Php } ?>
            </div>
        </div>
    </div>

    <div class="appliedjobs">
        <table>
            <th>Position</th>
            <th>Company</th>
            <th>Industry</th>
            <th>Applied On</th>
            <th>Status</th>

            <tr>
                <td>software Engineer</td>
                <td>Esewa pvt ltd.</td>
                <td>IT&Telicommunication</td>
                <td>2023-12-03</td>
                <td>Pending</td>
            </tr>
        </table>
    </div>



    <div class="footer">
        <div class="footercontent">
            <div class="aboutus">
                <h2>About Us</h2>
                <a href="">About Insearch</a>
                <a href="">Privacy Policy</a>
                <a href="">About Insearch</a>
                <a href="">Terms & Conditions</a>
                <a href="">Blogs</a>
            </div>
            <div class="jobseeker">
                <h2>Job Seeker</h2>
                <a href="job_seekerregistration.php">Register</a>
                <a href="job_seekerlogin.php">Sign In</a>
                <a href="index.php">Search Job</a>
            </div>
            <div class="company">
                <h2>Company</h2>
                <a href="company-registration.php">Register Company</a>
                <a href="company-login.php">Login as company</a>
                <a href="index.php">Browse jobs</a>
                <a href="company-login.php">Post Jobs</a>
            </div>
            <div class="sociallinks">
                <h2>Socail Links</h2>
                <div class="upper">
                    <a href="https://facebook.com"><img src="./images/facebook.svg" width="30px" height="30px"
                            alt=""></a>
                    <a href="https://linkedin.com"><img src="./images/linkedin.svg" width="30px" height="30px"
                            alt=""></a>
                </div>
                <div class="lower">
                    <a href="https://instagram.com"><img src="./images/instagram.svg" width="30px" height="30px"
                            alt=""></a>
                    <a href="https://twitter.com"><img src="./images/twitter.svg" width="30px" height="30px" alt=""></a>
                </div>
            </div>
            <div class="contactus">
                <h2>Contact us</h2>
                <a href="">koteshwore Kathmndu Nepal</a>
                <a href="">+977-011234567</a>
                <a href="">insearch@gmail.com</a>
            </div>
        </div>
        <div class="copyright">
            <p>&copy;
                <?php echo date('Y'); ?> All rights with insearch
            </p>
        </div>
    </div>
    <script src=".//js/jobseekerprofile.js"></script>

</body>

</html>