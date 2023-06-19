<?php
session_start();
include('../database/connection.php');
$sessionmail = $_SESSION['email'];

$stmt = $conn->prepare("SELECT * from job_seeker where email = ?");
$stmt->bind_param("s", $sessionmail);
$stmt->execute();


$result = $stmt->get_result();

$name = $gender = $dob = $dateofbirth = $address = $phone = $mobile = $website = $contactemail = $whoami = $imagename = "";
$nameErr = $genderErr = $dobErr = $addressErr = $phoneErr = $mobileErr = $websiteErr = $whoamiErr = $contactErr = $imageErr = "";
if (isset($sessionmail)) {


    if (isset($_POST['submit'])) {

        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
            $imageName = $_FILES["image"]["name"];
            $targetDir = "./images/uploaded_image/jobseeker";
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
            $dob = $_POST['gender'];
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
            $dob = $_POST['dob'];
            $dateofbirth = date('Y-m-d', strtotime($dob));
        }

        $website = ($_POST['website']);
        if (!preg_match("~^(?:f|ht)tps?://~", $website)) {
            $website = 'https://' . $website;
            $websiteErr = "invalid website format";
        }

        $contactemail = test_input($_POST["cemail"]);
        // check if email address is well-formed
        if (!filter_var($contactemail, FILTER_VALIDATE_EMAIL)) {
            $contactErr = "Invalid email format";
        }


        $whoami = test_input($_POST['description']);

        if (empty($nameErr) && empty($genderErr) && empty($dobErr) && empty($addressErr) && empty($phoneErr) && empty($mobileErr) && empty($websitErr) && empty($whoamiErr) && empty($imageErr)) {
            // include('/database/connection.php');
            $stmt = $conn->prepare("UPDATE job_seeker SET Full_name =?, gender=?,Age=?,jobseeker_address=?,Phone=?, Mobile=?,contact_email=?,website=?,job_description=?,Image_name=? where Email=?");
            $stmt->bind_param("ssissssssss", $name, $gender, $dateofbirth, $address, $phone, $mobile, $contactemail, $website, $whoami, $imagename, $sessionmail);
            $stmt->execute();
            $stmt->close();
            header("location: certificates.php");
        }

    }
}
function test_input($data)
{
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
    <title>Profileedit</title>
    <link rel="stylesheet" href="details.css">
</head>

<body>


    <form action="" method="POST" enctype="multipart/form-data">
        <div class="details-form">
            <h2>Update Basic information</h2>
            <?php echo $sessionmail;
            ?>
            <hr color="black" size="0.5px">

            <div class="content">
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="imagearea">
                        <?php if ($row['Image_name'] == '') {
                            echo '<img src =../images/avatar.png>';
                        } else {
                            echo '<img src="../images/jobseekerprofile/' . $row['Image_name'] . '">';
                        } ?>
                        <input type="file" name="image">
                    </div>

                    <div class="col1">
                        <label for="Name">Name:</label>
                        <input type="text" name="name" id="name" value="<?php echo $row['Full_name'] ?>">
                        <span style="color:red;">
                            <?php echo $nameErr; ?>
                        </span>
                    </div>

                    <div class="col2">

                        <div class="gender">
                            <label for="gender">Gender:</label>
                            <select name="gender" id="Gender" required>
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
                            <input type="text" name="address" id="address" value="<?php echo $row['jobseeker_address'] ?>"
                                required>
                            <span style="color:red;">
                                <?php echo $addressErr; ?>
                            </span>

                        </div>
                    </div>


                    <div class="col3">
                        <div class="phone">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone" value="<?php echo $row['Phone']; ?>" required>
                            <span style="color:red;">
                                <?php echo $phoneErr; ?>
                            </span>

                        </div>
                        <div class="mobile">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" id="mobile" value="<?php echo $row['Mobile'] ?>">
                            <span style="color:red;">
                                <?php echo $mobileErr; ?>
                            </span>

                        </div>
                        <div class="website">
                            <label for="website">Website<span>(if any):</span></label>
                            <input type="text" name="website" id="website" value="<?php echo $row['website'] ?>" required>
                            <span style="color:red;">
                                <?php echo $websiteErr; ?>
                            </span>


                        </div>
                    </div>
                    <div class="col5">
                        <label for="contactemail">Contact_email</label>
                        <input type="text" name="cemail" id="cemail" value="<?php echo $row['contact_email'] ?>">
                        <span>
                            <?php echo $contactErr; ?>
                        </span>
                    </div>


                    <div class="col4">
                        <label for="description">Who am I?</label>
                        <textarea name="description" id="description" cols="48" rows="15"
                            required><?php echo $row['jobseeker_description'] ?></textarea>
                        <span style="color:red;">
                            <?php echo $whoamiErr; ?>
                        </span>


                    </div>
                <?php } ?>


            </div>
        </div>
        <div class="buttons">
            <button type="submit" name="submit"id="closeOverlayBtn">Update</button>
        </div>
    </form>
</body>

</html>