<?php
session_start();
include('./database/connection.php');
$seekerSession = isset($_SESSION['seeker_Email']);
$companySession = isset($_SESSION['email']);
$adminSession = isset($_SESSION['admin_Email']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./styles/indexx.css">
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
            <a href="#footer">Contact</a>
            <a href="#footer">About us</a>
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

                    <?php if ($seekerSession) { ?>
                        <img src="./images/Account icon.svg" alt="">
                        <div class="dropdown">
                            <a href="jobseekerprofile.php"><button>Profile</button></a>
                            <a href="sessiondestroy.php"><button>Log out</button></a>
                        </div>

                    <?php } elseif ($adminSession) { ?>
                        <img src="./images/Account icon.svg" alt="">
                        <div class="dropdown">
                            <a href="admindashboard.php"><button>Profile</button></a>
                            <a href="sessiondestroy.php"><button>Log out</button></a>
                        </div>
                    <?php } else { ?>
                        <img src="./images/Account icon.svg" alt="">

                        <div class="dropdown">
                            <a href="companyprofile.php"><button>Profile</button></a>
                            <a href="sessiondestroy.php"><button>Log out</button></a>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="mainimage">
        <div class="image"><img src="./images/man2.jpg" alt=""></div>
        <div class="text">
            <p class="text1">Discover your <span style="color: #B4710D;"> Dream Job</span> <br>
                Explore opportunities Across <br>
                industries and location</p><br> <br>

            <p class="text2">Find Your Perfect Fit with Our User-Friendly <br>
                Platform and Personalized Job Recommendations</p>


            <form action="" class="searching" method="POST">

                <label for="job title"></label>
                <input type="text" name="job" class="jobs" id="jobs" placeholder="Job tilte">

                <label for="job category"></label>
                <select name="category" id="category">
                    <option value="Category">Select category</option>
                    <option value="IT&Telecommunication">IT&Telecommunication</option>
                    <option value="Graphic Designing">Design/Graphics</option>
                    <option value="finance">Account/Finance</option>
                    <option value="Medical">Medical</option>
                    <option value="NGO/ING">NGO/ING</option>
                    <option value="Engineering/Architectures">Engineering/Architectures</option>
                    <option value="Tou/Travel">Tour/Travel</option>
                    <option value="E-comerce">E-comerce</option>
                </select>
                <select name="jobtype" id="jobtype">
                    <option value="">Select Job-type</option>
                    <option value="Full time">Full time</option>
                    <option value="Part time">Part time</option>
                    <option value="Remote">Remote</option>
                    <option value="Internship">Internship</option>
                </select>

                <button type="submit" name="submit"> <i class="fa-solid fa-magnifying-glass"></i> Search</button>
            </form>
        </div>
    </div>
    <?php
    $searchid = '';
    include('./database/connection.php');
    if ((isset($_POST['submit']))) {
        $jobtitle = $_POST['job'];
        $option = $_POST['category'];
        $list = $_POST['jobtype'];
        $sql = "SELECT * FROM job
             LEFT JOIN company ON job.companyID = company.company_id 
             WHERE  
            (job_title LIKE '%$jobtitle%' 
            OR category LIKE '%$option%' 
            OR job_type LIKE '%$list%')
            AND deadline_date >= CURDATE()";
        $result = mysqli_query($conn, $sql);
        ?>
        <section id="trendingjob">
            <p class="trendingtext">Searched Result</p>
            <?php
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="trendingjob">
                            <div class="cards">
                                <?php echo '<a href="jobdescription.php?job_id=' . $row['job_id'] . '">' ?>
                                <!--contents -->
                                <div class="cardscontent">
                                    <div class="imagearea">
                                        <div class="companyimg">
                                            <?php echo '<img src="./images/uploaded_image/' . $row['Image_name'] . '"alt="">' ?>
                                        </div>
                                        <div class="companyname">
                                            <li>
                                                <?php echo $row['job_title']; ?>
                                            </li>
                                            <li>
                                                <?php echo $row['company_name']; ?>
                                            </li>
                                        </div>
                                    </div>
                                    <div class="info">
                                        <li>
                                            <?php echo "location:" . $row['job_address']; ?>
                                        </li>
                                        <li>
                                            <?php echo "Job-type:" . $row['job_type']; ?>
                                        </li>
                                        <li>
                                            <?php
                                            $deaddate = $row['deadline_date'];
                                            $deadstamp = strtotime($deaddate);
                                            $dead = date('Y-m-d', $deadstamp);
                                            echo "Deadlinedate:" . $dead;
                                            ?>
                                        </li>
                                    </div>
                                    <?php echo '<a href="jobdescription.php?job_id=' . $row['job_id'] . '">
                                <button>Apply</button> </a>' ?>
                                    <?php echo '</a>' ?>
                                </div>
                            </div>

                        </div>

                        <?php
                    }
                } else { ?>
                    <h3 style='font-style:Italic; word-spacing:1px;'>searched job not found:</h3>
                    <?php
                }
            } else {
                die("Query error: " . mysqli_error($conn));
            }
    }
    ?>
    </section>
    <section id="trendingjob">
        <p class="trendingtext">Trending <span>Jobs</span></p>
        <!-- main div-->
        <?php
        $sql = "SELECT j.job_title,j.job_address,j.job_type,j.deadline_date,j.job_id,c.company_name,c.Image_name from company c 
        Inner JOIN job j ON c.company_id = j.companyID 
         where deadline_date >= CURDATE() ORDER BY RAND() LIMIT 7";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="trendingjob">
                <div class="cards">
                    <?php echo '<a href="jobdescription.php?job_id=' . $row['job_id'] . '">' ?>
                    <!--contents -->
                    <div class="cardscontent">
                        <div class="imagearea">
                            <div class="companyimg">
                                <?php echo '<img src="./images/uploaded_image/' . $row['Image_name'] . '"alt="">' ?>
                            </div>
                            <div class="companyname">
                                <li>
                                    <?php echo $row['job_title']; ?>
                                </li>
                                <li>
                                    <?php echo $row['company_name']; ?>
                                </li>
                            </div>
                        </div>
                        <div class="info">
                            <li>
                                <?php echo "location:" . $row['job_address']; ?>
                            </li>
                            <li>
                                <?php echo "Job-type:" . $row['job_type']; ?>
                            </li>
                            <li>
                                <?php
                                $deaddate = $row['deadline_date'];
                                $deadstamp = strtotime($deaddate);
                                $dead = date('Y-m-d', $deadstamp);
                                echo "Deadlinedate:" . $dead;
                                ?>
                            </li>
                        </div>
                        <?php echo '<a href="jobdescription.php?job_id=' . $row['job_id'] . '">
                                <button>Apply</button> </a>' ?>
                        <?php echo '</a>' ?>
                    </div>
                </div>

            </div>
        <?php } ?>
    </section>

    <section id="featurejobs">
        <p class="featuretext">Recently Added <span>Jobs</span></p>
        <?php
        $sql = "SELECT j.job_title,j.job_address,j.job_type,j.deadline_date,j.job_id,c.company_name,c.Image_name from company c 
        Inner JOIN job j ON c.company_id = j.companyID 
         where deadline_date >= CURDATE()";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <!-- main div-->
            <div class="featurejob">
                <div class="cards">
                    <?php echo '<a href="jobdescription.php?job_id=' . $row['job_id'] . '">' ?>
                    <!--contents -->
                    <div class="cardscontent">
                        <div class="imagearea">
                            <div class="companyimg">
                                <?php echo '<img src="./images/uploaded_image/' . $row['Image_name'] . '"alt="">' ?>
                            </div>
                            <div class="companyname">
                                <li>
                                    <?Php echo $row['job_title'] ?>
                                </li>
                                <li>
                                    <?php echo $row['company_name'] ?>
                                </li>
                            </div>
                        </div>
                        <div class="info">
                            <li>
                                <?php echo "location:" . $row['job_address'] ?>
                            </li>
                            <li>
                                <?php echo "Job-type:" . $row['job_type'] ?>
                            </li>
                            <li>
                                <?php
                                $deaddate = $row['deadline_date'];
                                $deadstamp = strtotime($deaddate);
                                $dead = date('Y-m-d', $deadstamp);
                                echo "Deadlinedate:" . $dead;
                                ?>
                            </li>
                        </div>

                        <?php echo '<a href="jobdescription.php?job_id=' . $row['job_id'] . '">
                                <button>Apply</button> </a>' ?>
                        <?php echo '</a>' ?>
                    </div>

                </div>

            </div>
        <?php } ?>
    </section>

    <section id="trustedcompany">
        <div class="trustedcompany">
            <div class="carousel">
                <div class="items"><a href=""><img src="./images/carousel/3m.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/uploaded_image/techpana.png" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/barstool-store.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/budweiser.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/buzzfeed.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/forbes.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/3m.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/macys.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/menshealth.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/mrbeast.svg" alt=""></a></div>
                <div class="items"><a href=""><img src="./images/carousel/budweiser.svg" alt=""></a></div>

            </div>
        </div>
    </section>


    <section id="dreamjob">
        <p>Are you Looking for Dream job?</p>
        <a href="index.php"><button>Find Now</button></a>
    </section>





    <footer>
        <div class="footer" id="footer">
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
                    <h2>Social Links</h2>
                    <div class="upper">
                        <a href="https://facebook.com"><img src="./images/facebook.svg" width="30px" height="30px"
                                alt=""></a>
                        <a href="https://linkedin.com"><img src="./images/linkedin.svg" width="30px" height="30px"
                                alt=""></a>
                    </div>
                    <div class="lower">
                        <a href="https://instagram.com"><img src="./images/instagram.svg" width="30px" height="30px"
                                alt=""></a>
                        <a href="https://twitter.com"><img src="./images/twitter.svg" width="30px" height="30px"
                                alt=""></a>
                    </div>
                </div>
                <div class="contactus">
                    <h2>Contact us</h2>
                    <a
                        href="https://www.google.com/maps/place/Koteshwor,+Kathmandu+44600/@27.6771988,85.3340218,15z/data=!3m1!4b1!4m6!3m5!1s0x39eb19f2804a02bf:0x85468199859b2d8d!8m2!3d27.6755549!4d85.3459238!16s%2Fm%2F04jn6xk?entry=ttu">koteshwore
                        Kthamndu Nepal</a>
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
    </footer>
</body>
<script src="./js/index.js"></script>

</html>