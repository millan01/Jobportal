<?php
session_start();
include('./database/connection.php');
$jobseeker_email = $_SESSION['seeker_Email'];
if (!isset($jobseeker_email)) {
    header('location: index.php');
}
$sql = "SELECT Job_seeker_id FROM job_seeker WHERE Email = '$jobseeker_email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $seekerID = $row['Job_seeker_id'];
}

//display the total years of experience
$sum = 0;
$sql = "SELECT startDate, endDate from jobseeker_experience where jobseeker_id =  ' $seekerID'";
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
    <link rel="stylesheet" href="./styles/jobseekerprofile.css">
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
                    <button onclick="openProfile()"><i class="fa-solid fa-edit"></i> Edit</button>
                </div>
                <?php

                $stmt = $conn->prepare("SELECT * from job_seeker where email = ?");
                $stmt->bind_param("s", $jobseeker_email);
                $stmt->execute();
                $result = $stmt->get_result();
                $name = $sex = $birthdate = $datebirth = $lookingfor = $address = $experience = $phone = $mobile = $website = $contactemail = $whoami = $imagename = "";
                $nameErr = $genderErr = $dobErr = $lookingforErr = $addressErr = $experienceErr = $phoneErr = $mobileErr = $websiteErr = $whoamiErr = $contactErr = $imageErr = "";
                if (isset($_POST['submit'])) {

                    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
                        $imageName = $_FILES["image"]["name"];
                        $targetDir = "./images/uploaded_image/jobseeker/";
                        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

                        $validExtensions = ["jpg", "jpeg", "png"];
                        if (in_array($imageFileType, $validExtensions)) {

                            if ($_FILES["image"]["size"] <= 5 * 1024 * 1024) {

                                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                                    // Store the image name in the database
                                    $imageName = $_FILES["image"]["name"];

                                } else {
                                    $imageErr = "Error uploading files";
                                }
                            } else {
                                $imageErr = "Files should be less than 5MB";
                            }
                        } else {
                            $imageErr = "Invalid image format";
                        }
                    } else {
                        $imageErr = "Error uploading files";
                    }


                    $name = test_input($_POST["name"]);
                    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                        $nameErr = "Only letters and white space allowed";
                    }

                    if (empty($_POST['gender'])) {
                        $dobErr = "choose a gender";
                    } else {
                        $sex = $_POST['gender'];
                    }

                    if (empty($_POST['address'])) {
                        $addressErr = "Address field empty";
                    } else {
                        $address = $_POST['address'];
                    }

                    $phone = test_input($_POST['phone']);
                    if (!preg_match("/[0-9]{10}$/", $phone)) {
                        $phoneErr = "invalid phone number";
                    }

                    $mobile = test_input($_POST['mobile']);
                    if (!preg_match("/[0-9]{10}$/", $mobile)) {
                        $mobileErr = "invalid phone number";
                    }

                    if (empty($_POST['dob'])) {
                        $dobErr = "select date of birth";
                    } else {
                        $birthdate = $_POST['dob'];
                        $datebirth = date('Y-m-d', strtotime($birthdate));
                    }

                    $website = ($_POST['website']);
                    if (!preg_match("~^(?:f|ht)tps?://~", $website)) {
                        $website = 'https://' . $website;
                        $websiteErr = "invalid website format";
                    }

                    $contactemail = test_input($_POST["cemail"]);
                    if (!filter_var($contactemail, FILTER_VALIDATE_EMAIL)) {
                        $contactErr = "Invalid email format";
                    }


                    

                    $whoami = test_input($_POST['description']);

                    if (empty($nameErr) && empty($genderErr) && empty($dobErr) && empty($addressErr) && empty($phoneErr) && empty($mobileErr) && empty($websitErr) && empty($whoamiErr) && empty($imageErr)) {
                        $stmt = $conn->prepare("UPDATE job_seeker SET Full_name =?, gender=?,Age=?,jobseeker_address=?,Phone=?, Mobile=?,contact_email=?,website=? ,jobseeker_description=?,Image_name=? where Email=?");
                        $stmt->bind_param("sssssssssss", $name, $sex, $datebirth, $address, $phone, $mobile, $contactemail, $website, $whoami, $imageName, $jobseeker_email);
                        $stmt->execute();
                        $stmt->close();
                        header('location:jobseekerprofile.php');
                    }

                }

                ?>
                <div class="overlayEditProfile" id="overlayEditProfile">
                    <span onclick="closeProfile()" class="closeProfile"><i class="fa-solid fa-multiply"></i></span>
                    <div class="profileformContainer">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="details-form">
                                <h2>Update Basic information</h2>
                                <hr color="black" size="0.5px">

                                <div class="profileContent">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                        <div class="profileimage">
                                            <?php
                                            if ($row['Image_name'] == '') {
                                                echo '<img src =./images/avatar.png>';
                                            } else {
                                                echo '<img src="./images/uploaded_image/jobseeker/' . $row['Image_name'] . '">';
                                            }
                                            ?>
                                            <input type="file" name="image">
                                        </div>

                                        <div class="col1">
                                            <label for="Name">Name:</label>
                                            <input type="text" name="name" id="name"
                                                value="<?php echo $row['Full_name'] ?>">
                                            <span style="color:red;">
                                                <?php echo $nameErr; ?>
                                            </span>
                                        </div>

                                        <div class="col2">

                                            <div class="gender">
                                                <label for="gender">Gender:</label>
                                                <select name="gender" id="gender" required>
                                                    <option value="">Select Gender</option>
                                                    <option value="Male" <?php echo ($row['gender'] === 'Male') ? 'selected' : ''; ?>>Male
                                                    </option>
                                                    <option value="Female" <?php echo ($row['gender'] === 'Female') ? 'selected' : ''; ?>>Female
                                                    </option>
                                                    <option value="Other" <?php echo ($row['gender'] === 'Other') ? 'selected' : ''; ?>>Other
                                                    </option>
                                                </select>
                                                <span style="color:red;">
                                                    <?php echo $genderErr; ?>
                                                </span>

                                            </div>
                                            <div class="dob">
                                                <label for="dob">Date of birth:</label>
                                                <input type="date" name="dob" value="<?php echo $row['Age'] ?>" required>
                                                <span style="color:red;">
                                                    <?php echo $dobErr; ?>
                                                </span>

                                            </div>

                                            <div class="address">
                                                <label for="address">Address:</label>
                                                <input type="text" name="address" id="address"
                                                    value="<?php echo $row['jobseeker_address'] ?>" required>
                                                <span style="color:red;">
                                                    <?php echo $addressErr; ?>
                                                </span>

                                            </div>
                                        </div>


                                        <div class="col3">
                                            <div class="phone">
                                                <label for="phone">Phone:</label>
                                                <input type="text" name="phone" id="phone"
                                                    value="<?php echo $row['Phone']; ?>" required>
                                                <span style="color:red;">
                                                    <?php echo $phoneErr; ?>
                                                </span>

                                            </div>
                                            <div class="mobile">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" name="mobile" id="mobile"
                                                    value="<?php echo $row['Mobile'] ?>">
                                                <span style="color:red;">
                                                    <?php echo $mobileErr; ?>
                                                </span>

                                            </div>
                                            <div class="website">
                                                <label for="website">Website<span>(if any):</span></label>
                                                <input type="text" name="website" id="website"
                                                    value="<?php echo $row['website'] ?>" required>
                                                <span style="color:red;">
                                                    <?php echo $websiteErr; ?>
                                                </span>


                                            </div>
                                        </div>
                                        <div class="col5">
                                            <label for="contactemail">Contact_email</label>
                                            <input type="text" name="cemail" id="cemail"
                                                value="<?php echo $row['contact_email'] ?>">
                                            <span>
                                                <?php echo $contactErr; ?>
                                            </span>
                                        </div>



                                        <div class="col4">
                                            <label for="description">Who am I</label>
                                            <textarea name="description" id="description" cols="48" rows="15"
                                                required><?php echo $row['jobseeker_description'] ?></textarea>
                                            <span style="color:red;">
                                                <?php echo $whoamiErr; ?>
                                            </span>


                                        </div>
                                    <?php }
                                    $stmt->close(); ?>


                                </div>
                            </div>
                            <div class="col6">
                                <button type="submit" name="submit" id="closeOverlayBtn">Update</button>
                            </div>
                        </form>


                    </div>
                </div>
                <?php
                $stmt = $conn->prepare("SELECT * from job_seeker where email = ?");
                $stmt->bind_param("s", $jobseeker_email);
                $stmt->execute();
                $result = $stmt->get_result();
               while ($row = mysqli_fetch_assoc($result)) { ?>
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
            <div class="jobcount">
                <h2>Jobs Count</h2>
                <div class="totaljobs">
                    <div class="total">
                        <li style="font-weight: bold;">Total jobs</li>
                        <?php
                        include('./database/connection.php');
                        $totaljob = '';
                        $sql = "SELECT COUNT(*) as jobSeekerID from application where jobSeekerEmail = '$jobseeker_email'";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $totaljob = $row['jobSeekerID'];
                        ?>
                        <li>
                            <?php echo $totaljob; ?>
                        </li>
                    </div>
                    <div class="pending">
                        <li style="font-weight: bold;">Pending jobs</li>
                        <?php
                        $pendingjob = '';
                        $sql = "SELECT COUNT(*) as jobSeekerID from application where jobSeekerEmail = '$jobseeker_email' AND applicationStatus = 'Pending' ";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $pendingjob = $row['jobSeekerID'];
                        ?>
                        <li>
                            <?php echo $pendingjob; ?>
                        </li>
                    </div>
                    <div class="Rejected">
                        <li style="font-weight: bold;">Rejected jobs</li>
                        <?php
                        $rejectedjob = '';
                        $sql = "SELECT COUNT(*) as jobSeekerID from application where jobSeekerEmail = '$jobseeker_email' AND applicationStatus = 'Rejected' ";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $rejectedjob = $row['jobSeekerID'];
                        ?>
                        <li>
                            <?php echo $rejectedjob; ?>
                        </li>
                    </div>
                    <div class="Rejected">
                        <li style="font-weight: bold;">Accepted jobs</li>
                        <?php
                        $acceptedjob = '';
                        $sql = "SELECT COUNT(*) as jobSeekerID from application where jobSeekerEmail = '$jobseeker_email' AND applicationStatus = 'Accepted' ";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($result);
                        $acceptedjob = $row['jobSeekerID'];
                        ?>
                        <li>
                            <?php echo $acceptedjob; ?>
                        </li>
                    </div>
                </div>
            </div>


        </div>

        <div class="main">


            <div class="whoami">
                <h2>Who am I</h2>
                <hr color="black" size="0.5px" style="margin-top: -8px;">
                <?php
                $stmt = $conn->prepare("SELECT jobseeker_description from job_seeker where email = ?");
                $stmt->bind_param("s", $jobseeker_email);
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
                    <button onclick="openEdu()"><i class="fa-solid fa-plus" style="color:black;"></i> Add new</button>
                </div>
                <?php
                $course = $board = $name = $started = $end = $present = $jobseekerid = "";
                $courseErr = $boardErr = $nameErr = $startedErr = $endErr = $presentErr = "";

                if (isset($_POST['update'])) {
                    if (empty($_POST['course'])) {
                        $courseErr = "choose course";
                    } else {
                        $course = $_POST['course'];
                    }

                    if (empty($_POST["board"])) {
                        $boardErr = "Education board is required";
                    } else {
                        $board = test_input($_POST["board"]);
                        if (!preg_match("/^[a-zA-Z ]*$/", $board)) {
                            $boardErr = "Only letters";
                        }
                    }
                    if (empty($_POST["institute"])) {
                        $nameErr = "Institution name required";
                    } else {
                        $name = test_input($_POST["institute"]);
                        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                            $nameErr = "Only letters";
                        }
                    }
                    if (empty($_POST['started'])) {
                        $startedErr = "Date not entered";
                    } else {
                        $started = test_input($_POST['started']);
                    }

                    if (empty($_POST['present']) && empty($_POST['passed'])) {
                        $presentErr = "Date not entered";
                    }
                    if (isset($_POST['present'])) {
                        $end = "Running";
                    } else {
                        $end = test_input(isset($_POST['passed']));
                    }
                    if (empty($courseErr) && empty($boardErr) && empty($nameErr) && empty($startedErr)) {
                        $stmt = $conn->prepare("INSERT INTO jobseeker_education (course,board,institute,started_year,end_year,jobseeker_id) VALUES (?,?,?,?,?,?)");
                        $stmt->bind_param("sssisi", $course, $board, $name, $started, $end, $seekerID);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
                ?>
                <div class="overlayEduContainer" id="overlayEduContainer">
                    <span class="close-edu" onclick="closeEdu()"><i class="fa-solid fa-multiply"></i></span>
                    <div class="Eduformcontainer">

                        <form action="" method="post">
                            <div class="eduformdetails">
                                <h2>Update Education details</h2>
                                <hr color="black" size="1px">

                                <div class="form">
                                    <label for="course">Course</label>
                                    <select name="course" id="course" required>
                                        <option value="">Select course</option>
                                        <option value="SLC/SEE">SLC/SEE</option>
                                        <option value="Plus two">Plus two</option>
                                        <option value="Diploma">Diploma</option>
                                        <option value="Gradutaion">Gradutaion</option>
                                        <option value="Post Gradutaion">Post Gradutaion</option>
                                        <option value="Master">Master</option>
                                        <option value="Phd">Phd</option>
                                    </select>
                                </div>

                                <div class="form">
                                    <label for="board">Board</label>
                                    <input type="text" name="board" id="board" required>
                                </div>

                                <div class="form">
                                    <label for="Name">Name</label>
                                    <input type="text" name="institute" placeholder="Institution Name" value=""
                                        required>
                                </div>

                                <div class="form">
                                    <label for="started">Start year</label>
                                    <input type="varchar" name="started" id="started" required>
                                </div>

                                <div class="form">
                                    <label for="present">present</label>
                                    <input type="checkbox" name="present" onclick="toggleEndYear()" id="present">
                                </div>

                                <div class="form">
                                    <label for="passed">End year</label>
                                    <input type="varchar" name="passed" id="passed">
                                </div>

                                <button type="submit" class="eduUpdate" name="update">Update</button>
                            </div>
                        </form>
                    </div>
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
                    <button onclick="openOver()"><i class="fa-solid fa-plus" style="color:black;"></i> Add new</button>
                </div>
                <?php
                $title = $progress = "";
                $titleErr = $progressErr = "";

                if (isset($_POST['update'])) {

                    if (empty($_POST['title'])) {
                        $titleErr = "Empty skill title";
                    } else {
                        $title = test_input($_POST['title']);
                    }

                    if (empty($_POST['progress'])) {
                        $progressErr = "Empty progress bar";
                    } else {
                        $progress = test_input($_POST['progress']);
                        if (!preg_match("/^[0-9]*$/", $progress)) {
                            $progressErr = "progress status in number only";
                        }
                    }
                    if (empty($titleErr) && empty($progressErr)) {
                        $stmt = $conn->prepare("INSERT INTO jobseeker_skill (Title, progress, jobseeker_id ) VALUES (?,?,?)");
                        $stmt->bind_param("ssi", $title, $progress, $seekerID);
                        $stmt->execute();
                        $stmt->close();
                    }
                }
                ?>
                <div class="over" id="over">
                    <span class="close-btn" onclick="closeOver()"> <i class="fa-solid fa-multiply"></i></span>
                    <div class="form-container">
                        <form action="" method="post">
                            <div class="formdetails">
                                <h2>Update skill set</h2>
                                <hr color="black" size="1px">

                                <div class="form">
                                    <label for="skill title">Title</label>
                                    <input type="text" name="title" id="title" required>
                                </div>

                                <div class="form">
                                    <label for="Progress">Progress <span>(in number upto 100)</span></label>
                                    <input type="number" name="progress" id="progress" required>
                                </div>

                                <button type="submit" class="skillupdate" name="update">Update</button>
                            </div>
                        </form>
                    </div>
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
                    <button onclick="openCert()"><i class="fa-solid fa-plus" style="color:black"></i> Add new</button>
                </div>
                <?php
                $title = $year = $compname = "";
                $titleErr = $yearErr = $compnameErr = "";
                if (isset($_POST['update'])) {

                    if (empty($_POST["certtitle"])) {
                        $titleErr = "Name is required";
                    } else {
                        $title = test_input($_POST["certtitle"]);
                        if (!preg_match("/^[a-zA-Z ]*$/", $title)) {
                            $titleErr = "Only letters and white space allowed";
                        }
                    }

                    if (empty($_POST["year"])) {
                        $yearErr = "Name is required";
                    } else {
                        $year = test_input($_POST["year"]);
                    }

                    if (empty($_POST["companyname"])) {
                        $compnameErr = "Name is required";
                    } else {
                        $compname = test_input($_POST["companyname"]);
                        if (!preg_match("/^[a-zA-Z ]*$/", $compname)) {
                            $compnameErr = "Only letters and white space allowed";
                        }
                    }

                    if (empty($titleErr) && empty($yearErr) && empty($compnameErr)) {
                        $stmt = $conn->prepare("INSERT INTO jobseeker_certs(Title, year,awarded_by,jobseeker_id) VALUES (?,?,?,?)");
                        $stmt->bind_param("sssi", $title, $year, $compname, $seekerID);
                        $stmt->execute();
                        $stmt->close();
                    }
                }

                ?>
                <div class="overlayCertContainer" id="openOverlayCert">
                    <span class="closeCert"><i class="fa-solid fa-multiply" onclick=" closeCert()"></i></span>
                    <div class="certformContainer">
                        <form action="" method="post">
                            <div class="certformdetails">
                                <h2>Update Certificates/Achivements</h2>
                                <hr color="black" size="0.5px">
                                <div class="form">
                                    <label for="Title">Title</label>
                                    <input type="text" name="certtitle" id="certtitle" required>
                                </div>

                                <div class="form">
                                    <label for="year">Year</label>
                                    <input type="text" name="year" id="year" required>
                                </div>

                                <div class="form">
                                    <label for="company">Company name</label>
                                    <input type="text" name="companyname" name="companyname" required>
                                </div>

                                <a href=""><button type="submit" class="certUpdate" name="update">Update</button></a>
                            </div>
                        </form>
                    </div>
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
                    <button onclick="openExp()"><i class="fa-solid fa-plus"></i> Add New</button>
                </div>
                <?php
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
                        $stmt = $conn->prepare("INSERT INTO jobseeker_experience(companyName, startDate,endDate,jobseeker_id) VALUES (?,?,?,?)");
                        $stmt->bind_param("sssi", $companyname, $start_date, $end_date, $seekerID);
                        $stmt->execute();
                        $stmt->close();

                    }
                }

                ?>
                <div class="overlayExperienceContainer" id="overlayExperienceContainer">
                    <span class="closeExp" onclick="closeExp()"><i class="fa-solid fa-multiply"></i></span>
                    <div class="expformContainer">
                        <form action="" method="post">
                            <div class="expformdetails">
                                <h2>Update experience details</h2>
                                <hr color="black" size="0.5px">

                                <div class="form">
                                    <label for="companyname">Company Name</label>
                                    <input type="text" name="cname" id="cname" required>
                                    <span style="color:red;">
                                        <?php echo $companynameErr ?>
                                    </span>
                                </div>

                                <div class="form">
                                    <label for="fromyear">Start date</label>
                                    <input type="date" name="start" id="start" required>
                                    <span style="color:red;">
                                        <?php echo $startdateErr ?>

                                    </span>

                                </div>

                                <div class="form">
                                    <label for="toyear">End date</label>
                                    <input type="date" name="end" id="end" required>
                                    <span style="color:red;">
                                        <?php echo $enddateErr ?>

                                    </span>

                                </div>

                                <button type="submit" class="expupdate" name="update">Update</button>
                            </div>
                        </form>

                    </div>
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
        <h3 style='font-style:bold; word-spacing:1px;'>Applied Jobs</h3>

        <table>
            <th>S.N</th>
            <th>Company Name</th>
            <th>Job Title</th>
            <th>Applied On</th>
            <th>Status</th>
            <?php
            $sql = "SELECT * from application where jobSeekerID = $seekerID";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $counter = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $counter; ?>
                        </td>
                        <td>
                            <?php echo $row['companyName']; ?>
                        </td>
                        <td>
                            <?php echo $row['jobTitle'] ?>
                        </td>
                        <td>
                            <?php echo $row['applicationDate']; ?>
                        </td>
                        <td>
                            <?php echo $row['applicationStatus']; ?>
                        </td>
                        
                    </tr>
                    <?php
                    $counter++;
                }
            }
            ?>
        </table>
    </div>

    <?php
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    ?>

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
    <script src="./js/jobseekerprofile.js"></script>

</body>

</html>