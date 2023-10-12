<?php
session_start();

include('./database/connection.php');
$seekerSession = isset($_SESSION['seeker_Email']);
$companySession = isset($_SESSION['email']);
$adminSession = isset($_SESSION['admin_Email']);

if($seekerSession){
    $sql = "SELECT jobSeekerID from application where jobSeekerEmail = '$seekerSession'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $jobseeker_id = $row['jobSeekerID'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/jobdescriptionn.css">
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

        <div class="navbutton">
            <?php if (!($seekerSession || $companySession || $adminSession)) { ?>
                <div class="signin">
                    <a href="job_seekerlogin.php">
                        <button type="submit"><img src="./images/sign in.png" height="13px" width="13px"
                                style="align-items: center;"> Sign in</button>
                    </a>
                </div>
                <div class="signup">
                    <a href="company-registration.php">
                        <button type="submit"><img src="./images/post.png" width="13px" height="13px" alt=""> Post
                            Job</button>
                    </a>
                </div>
            <?php } else { ?>
                <div class="afterlogin">
                    <img src="./images/Account icon.svg" alt="#" class="test">
                    <div class="dropdown">
                        <?php
                        if ($seekerSession) { ?>
                            <a href="jobseekerprofile.php"><button>Profile</button></a>
                        <?php } elseif ($adminSession) { ?>
                            <a href="admindashboard.php"><button>Profile</button></a>

                        <?php } else { ?>
                            <a href="companyprofile.php"><button>profile</button></a>
                        <?php } ?>
                        <a href="sessiondestroy.php"><button>Log out</button></a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    if ($_GET['job_id']) {
        $id = $_GET['job_id'];
    }
   
    //function to check whether the user have already applied job or not
    function hasUserApplied($conn, $seekerSession,  $id)
    {
        $sql = "SELECT * FROM application WHERE jobSeekerEmail = $seekerSession AND jobID =   $id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            return mysqli_num_rows($result) > 0;
        } else {
            die("Query error: " . mysqli_error($conn));
        }
    }


    $stmt = $conn->prepare("SELECT c.company_name,c.location,c.description,c.phone,c.website,c.contact_email, c.Image_name,
    j.job_title,j.job_id,j.job_address,j.no_of_vacancy,j.estimated_salary,j.category,j.job_type,j.posted_date,j.deadline_date,
    j.job_description,j.experience
     from company c INNER JOIN job j 
      ON c.company_id = j.companyID where job_id = ? AND deadline_date >= CURDATE()");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    ?>
    <section id="main">
        <div class="jobdescription">
            <div class="jobsection-vert-one">
                <div class="upper-one">
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="companyname">
                            <div class="companyname1">
                                <?php echo '<img src="./images/uploaded_image/' . $row['Image_name'] . '" alt="company logo" style="object-fit:cover;">' ?>
                            </div>
                            <div class="companyname2">
                                <p style="margin-top: 10px;">
                                    <?php echo $row['company_name'] ?>
                                </p>
                                <p><i class="fa fa-location-dot" style="background-color: transparent"></i>
                                    <?php echo $row['location'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="expdate">
                            <?php
                            $deadline_seconds = $deadline_days = $deadline_hours = "";
                            $deadlinedate = $row['deadline_date'];
                            $deadline_timestamp = strtotime($deadlinedate);
                            $current_timestamp = time();
                            $deadline_seconds = $current_timestamp - $deadline_timestamp;
                            $deadline_days = floor($deadline_seconds / (60 * 60 * 24));
                            $deadline_hours = floor(($deadline_seconds % (60 * 60 * 24)) / (60 * 60));
                            echo "Expires in: " . abs($deadline_days) . " days and " . abs($deadline_hours) . " hours";
                            ?>
                        </div>
                    </div>
                    <div class="content"></div>
                    <div class="upper-two">
                        <div class="comp-desc">
                            <h3>About Us</h3>
                            <p>
                                <?php echo $row['description'] ?>
                            </p>
                        </div>
                    </div>
                    <div class="title">
                        <h2>
                            <?php echo $row['job_title'] ?>
                        </h2>
                        <p>
                            <?php echo "Location:&nbsp;" . $row['job_address']; ?>
                        </p>
                        <p>
                            <?php echo "Vacancy:&nbsp; " . $row['no_of_vacancy']; ?>
                        </p>
                    </div>
                    <div class="upper-three">
                        <div class="job-spec">
                            <div class="job-specgrid">
                                <div class="job-specgrid-grid">
                                    <div> <i class="fa-solid fa-coins fa-2x" style="color:green;"></i></div>
                                    <div>
                                        <p>Offered Salary</p>
                                        <p>
                                            <?php echo $row['estimated_salary']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="job-specgrid-grid">
                                    <div> <i class="fa-solid fa-times fa-2x" style="color:green;"></i></div>
                                    <div>
                                        <p>Experience</p>
                                        <p>
                                            <?php echo $row['experience']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="job-specgrid-grid">
                                    <div> <i class="fa-solid fa-coins fa-2x" style="color:green;"></i></div>
                                    <div>
                                        <p>Industry</p>
                                        <p>
                                            <?php echo $row['category']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="job-specgrid-grid">
                                    <div> <i class="fa-solid fa-table-tennis fa-2x" style="color:green;"></i></div>
                                    <div>
                                        <p>Job type</p>
                                        <p>
                                            <?php echo $row['job_type']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="job-specgrid-grid">
                                    <div> <i class="far fa-calendar-check fa-2x" style="color:green;"></i></div>
                                    <div>
                                        <p>Post Date</p>
                                        <p>
                                            <?php
                                            $posteddate = $row['posted_date'];
                                            $timestamp = strtotime($posteddate);
                                            $post = date('Y-m-d', $timestamp);
                                            echo $post;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="job-specgrid-grid">
                                    <div> <i class="fas fa-hourglass-half fa-2x" style="color:green;"></i></div>
                                    <div>
                                        <p>Deadline</p>
                                        <p>
                                            <?php
                                            $deaddate = $row['deadline_date'];
                                            $deadstamp = strtotime($deaddate);
                                            $dead = date('Y-m-d', $deadstamp);
                                            echo $dead;
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="upper-four">
                        <div class="description">
                            <h3>Description</h3>
                            <p>
                                <?php echo $row['job_description']; ?>
                            </p>

                        </div>
                    </div>

                    <div class="upper-five">
                        <?php
                    
                        if($companySession){
                            echo '<a href="" onclick="checkuser()"><button>Apply</button></a>';
                        }elseif($seekerSession){
                            if(hasUserApplied($conn, $seekerSession,  $id)){
                                 echo '<a href="" onclick="doubleapplycheck()"><button>Apply</button></a>';

                            }else{
                                echo '<a href="javascript:void(0);"onclick="applyjob(' . $row['job_id'] . ')"><button>Apply</button></a>';
                            }
                        }else{
                            echo '<a href="" onclick="checksession()"><button>Apply</button></a>';

                        }
                        ?>

                    </div>
                </div>





                <div class="jobsection-vert-two">
                    <div class="info">
                        <p><i class="fa fa-phone fa-1x"></i>&nbsp;&nbsp;
                            <?php echo $row['phone']; ?>
                        </p>
                        <p><i class="fa-solid fa-globe"></i>&nbsp;&nbsp;<a href="<?php echo $row['website'] ?>">
                                <?php echo $row['website'] ?>
                            </a></p>
                        <p><i class="fa-regular fa-envelope"></i>&nbsp;&nbsp;
                            <?php echo $row['contact_email'] ?>
                        </p>
                    </div>
                <?php }
                    $stmt->close();
                    ?>

                <div class="relatedjob">
                    <div class="relatedjobtitle">
                        <h3>Related Jobs </h3>
                    </div>
                    <?php
                    $sql = "SELECT c.company_name, c.Image_name ,j.job_id, j.job_title from company c INNER JOIN job j 
                        ON c.company_id = j.companyID where  j.deadline_date >= CURDATE() ORDER BY RAND() LIMIT 4";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <?php echo '<a style="text-decoration: none; color:black;" href="jobdescription.php?job_id=' . $row['job_id'] . '">' ?>
                        <div class="relatedjob-upper">
                            <div class="asideimg">
                                <?php echo '<img src="./images/uploaded_image/' . $row['Image_name'] . '" height="40px" width="40px"  alt="" style="object-fit:cover;">' ?>
                            </div>
                            <div class="iconside">
                                <h4>
                                    <?php echo $row['job_title'] ?>
                                </h4>
                                <p>
                                    <?php echo $row['company_name'] ?>
                                </p>
                            </div>
                        </div>
                        <?php
                        echo '</a>'; ?>
                    <?php } ?>
                </div>


                <div class="otherjob">
                    <div class="otherjobtitle">
                        <h3>Other jobs</h3>
                    </div>
                    <?php
                    $sql = "SELECT c.company_name,c.Image_name, j.job_id,j.job_title from company c INNER JOIN job j ON 
                            c.company_id = j.companyID where j.deadline_date >= CURDATE() ORDER BY RAND() LIMIT 4";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <?php echo '<a style="text-decoration:none; color: black;" href="jobdescription.php?job_id=' . $row['job_id'] . '">' ?>

                        <div class="otherjob-upper">
                            <div class="asideimg">
                                <?php echo '<img src="./images/uploaded_image/' . $row['Image_name'] . '" height="40px" width="40px" alt="" style ="object-fit:cover;">' ?>
                            </div>
                            <div class="iconside">
                                <h4>
                                    <?php echo $row['job_title']; ?>
                                </h4>
                                <p>
                                    <?php echo $row['company_name']; ?>
                                </p>
                            </div>
                        </div>
                        <?php echo '</a>' ?>
                    <?php } ?>
                </div>
                <?php
                //  } 
                ?>

            </div>
        </div>
    </section>

    <div class="footer">
        <?php
        include('footer.php');
        ?>
    </div>
    <script>
        function checksession() {
            alert("Please login before applying for job :)");
        }
    </script>
    <script>
        function checkuser() {
            alert("Company cannot apply for any job post :)");
        }
        function applyjob(job_id) {
            var success = window.location.href = "job_apply.php?job_id=" + job_id;
            if (success)
                alert("Job applied successfully")
        }

        function doubleapplycheck() {
            alert("You have already applied for this job");
        }
    </script>
</body>

</html>