<?php 
session_start();
include('./database/connection.php');
$jobseeker_email = $_SESSION['email'];
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
                    <a href="sessiondestroy.php"><button>Log out</button></a>
                </div>
                </div>
            </div>
            
            
            
            
            <div class="notification">
                <p>Update your profile before applying for jobs !!</p>
                <?php echo $jobseeker_email; ?>
            </div>
            <div class="content">
                
                <div class="sidebar">
                    
                    <div class="imagearea">
                        <div class="imagetop">
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <img src="./images/esewa.png" alt="">
                    <p><?php echo $row['Full_name']; ?></p>
                </div>
                <hr color="black">
                <div class="imagebutton">
                    <p><i class="fa fa-phone  fa-1x"></i>&nbsp;&nbsp; <?php echo $row['Phone']; ?></p>
                    <p><i class="fa-regular fa-globe fa-1x"></i>&nbsp;&nbsp; <a href="<?php echo $row['website']; ?>"><?php echo $row['website']; ?></a></p>
                    <p><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp; <?php echo $row['contact_email']; ?></p>
                </div>
            </div>
            <div class="Details">
                <div class="header">
                    <h2>Job-Seeker Details</h2>
                    <a href="./joseekerprofileedit/details.php" class="openOverlay"><i class="fa-solid fa-edit " style="color: black;"></i> Edit</a>
                    
                    <div id="overlay">
                        <div id="modal">
                            <button id="closeOverlayBtn"><i class="fa fa-multiply"></i>Close</button>
                          <iframe id="iframe" src="" frameborder="0"></iframe>
                        </div>
                      </div>

                </div>
                <div class="lookingfor">
                    <li style="font-weight: bold;">Looking for:</li>
                    <li><?php echo $row['Position'] ?></li>
                </div>

                <div class="years">
                    <li style="font-weight: bold;">Experience</li>
                    <li>4 Years</li>
                </div>
                <div class="age">
                    <li style="font-weight: bold;">Age</li>
                    <li><?php echo $row['Age']; ?></li>
                </div>
                <div class="sex">
                    <li style="font-weight: bold;">Gender:</li>
                    <li><?php echo $row['gender']; ?></li>
                </div>
                <div class = "address">
                    <li style ="font-weight: bold">Address:</li>
                    <li><?php echo $row['Address']; ?></li>
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
                <p><?php echo $row['Description']; ?></p>
            </div>
            <?php }?>

            <div class="mainsub">
                <div class="edu">
                    <h2>Education</h2>
                    <a href="./joseekerprofileedit/educaiton.php" class="openOverlay"><button><i class="fa-solid fa-plus " style="color: black;"></i> Add new</button></a>
                </div>
                <hr color="black" size="0.5px">
                <div class="educontent">

                    <div class="eduschool">
                        <div class="col1">
                            <p style="font-weight: bold;"><i class="fa fa-circle-check"></i> School <span>2010 -
                                    2020</span></p>
                            <p>&nbsp;&nbsp;&nbsp; <i class="fa fa-dot-circle"></i> Aankura English secondar boarding
                                school </p>
                        </div>
                        <div class="col2">
                            <a href=""><button><i class="fa fa-trash"></i> Delete</button></a>
                        </div>
                    </div>


                    <div class="educollege">
                        <div class="col1">
                            <p style="font-weight: bold;"><i class="fa fa-circle-check"></i> Plus two <span>2020 -
                                    2022</span></p>
                            <p>&nbsp;&nbsp;&nbsp; <i class="fa fa-dot-circle"></i> Triton international college</p>
                        </div>
                        <div class="col2">
                            <a href=""><button><i class="fa fa-trash"></i> Delete</button></a>

                        </div>
                    </div>

                    <div class="edugraduation">
                        <div class="col1">
                            <p style="font-weight: bold;"><i class="fa fa-circle-check"></i> Gradutaion <span>2022 -
                                    present</span></p>
                            <p>&nbsp;&nbsp;&nbsp; <i class="fa fa-dot-circle"></i>Orchid International college</p>
                        </div>
                        <div class="col2">
                            <a href=""><button><i class="fa fa-trash"></i> Delete</button></a>

                        </div>
                    </div>
                </div>
            </div>

            <div class="mainsubtwo">
                <div class="skill">
                    <h2>Skills</h2>
                    <a href="./joseekerprofileedit/skills.php" class="openOverlay"><button><i class="fa-solid fa-plus " style="color: black;"></i> Add new</button></a>
                </div>
                <hr color="black" size="0.5px">

                <div class="skillcontent">
                    <div class="skilltittle">
                        <li><i class="fa fa-dot-circle"></i> &nbsp; python</li>
                    </div>
                    <div class="skillprogressbar">
                        <progress value="90" max="100"></progress>
                    </div>

                    <div class="skilldelbtn">
                        <a href=""><button><i class="fa fa-trash"></i> Delete</button></a>

                    </div>
                </div>
                <div class="skillcontent">
                    <div class="skilltittle">
                        <li><i class="fa fa-dot-circle"></i> &nbsp; python</li>
                    </div>
                    <div class="skillprogressbar">
                        <progress value="50" max="100"></progress>
                    </div>

                    <div class="skilldelbtn">
                        <a href=""><button><i class="fa fa-trash"></i> Delete</button></a>

                    </div>
                </div>
            </div>

            <div class="mainthree">
                <div class="Certificates">
                    <h2>Certificates</h2>
                    <a href="./joseekerprofileedit/certificates.php" class="openOverlay"><button><i class="fa-solid fa-plus " style="color: black;"></i> Add new</button></a>
                </div>
                <hr color="black" size="0.5px">

                <div class="certcontent">
                    <div class="cert1">
                        <li><i class="fa fa-dot-circle"></i>&nbsp; Title</li>
                    </div>
                    <div class="cert2">
                        <li>Year</li>
                    </div>
                    <div class="cert3">
                        <a href=""><button><i class="fa fa-trash"></i> Delete</button></a>

                    </div>
                </div>
            </div>

            <div class="mainfour">
                <div class="Experience">
                    <h2>Experience</h2>
                    <a href="./joseekerprofileedit/experience.php" class="openOverlay"><button><i class="fa-solid fa-plus " style="color: black;"></i> Add new</button></a>
                </div>
                <hr color="black" size="0.5px">
                <div class="expcontents">
                    <div class="expetitle">
                        <li><i class="fa fa-dot-circle"></i>&nbsp; Esewa pvt ltd.</li>
                    </div>
                    <div class="expdate">
                        <li>2000 - 2022</li><span>(22Years)</span>
                    </div>

                    <div class="expdelbtn">
                        <a href=""><button><i class="fa fa-trash"></i> Delete</button></a>
                    </div>
                </div>
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
                <a href="">koteshwore Kthamndu Nepal</a>
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