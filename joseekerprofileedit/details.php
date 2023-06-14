<?php

$name = $gender = $dob = $address = $phone = $mobile = $website = $whoami = $imagename="";
$nameErr = $genderErr = $dobErr = $addressErr = $phoneErr = $mobileErr = $websiteErr = $whoamiErr =$imageErr= "";

if (isset($_POST['update'])) {

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



    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
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

    $website = ($_POST['website']);
    if (!preg_match("~^(?:f|ht)tps?://~", $website)) {
        $website = 'https://' . $website;
        $websiteErr = "invalid website format";
    }

    $whoami = test_input($_POST['description']);

    if(empty($nameErr) && empty($genderErr) && empty($dobErr) && empty($addressErr) &&empty($phoneErr) && empty($mobileErr) && empty($websitErr) && empty($whoamiErr) && empty($imageErr)){
        include ('./database/connection.php');

        $stmt = $conn->prepare("INSERT INTO table_name(name, gender,dateofbirth,address,phone,mobile,website,whoami,imagename) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss", $name, $gender, $dob,$address,$phone,$mobile,$website,$whoami,$imagename);
        $stmt->execute();
        $stmt->close();
        header('location:jobseekerprofile.php');
    }

}
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data  = htmlspecialchars($data);
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

    <form action="" method="post">
        <div class="details-form">
            <h2>Update Basic information</h2>
            <hr color="black" size="0.5px">

            <div class="content">
                <div class="imagearea">
                    <img src="esewa.svg" alt="">
                    <input type="file" name="image">
                </div>

                <div class="col1">
                    <label for="Name">Name:</label>
                    <input type="text" name="name" id="name" value="">
                    <span style ="color:red;"><?php echo $nameErr; ?></span>
                </div>


                <div class="col2">

                    <div class="gender">
                        <label for="gender">Gender:</label>
                        <select name="gender" id="Gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <span style ="color:red;"><?php echo $genderErr; ?></span>

                    </div>
                    <div class="dob">
                        <label for="dob">Date of birth:</label>
                        <input type="date" name="dob" required>
                        <span style ="color:red;"><?php echo $dobErr; ?></span>

                    </div>

                    <div class="address">
                        <label for="address">Address:</label>
                        <input type="text" name="address" id="address" value="" required>
                        <span style ="color:red;"><?php echo $addressErr; ?></span>

                    </div>
                </div>


                <div class="col3">
                    <div class="phone">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" value="" required>
                        <span style ="color:red;"><?php echo $phoneErr; ?></span>

                    </div>
                    <div class="mobile">
                        <label for="mobile">Mobile</label>
                        <input type="text" name="mobile" id="mobile" value="" required>
                        <span style ="color:red;"><?php echo $mobileErr; ?></span>

                    </div>
                    <div class="website">
                        <label for="website">Website<span>(if any):</span></label>
                        <input type="text" name="website" id="website" value="" required>
                        <span style ="color:red;"><?php echo $websiteErr; ?></span>


                    </div>
                </div>


                <div class="col4">
                    <label for="description">Who am I?</label>
                    <textarea name="description" id="description" cols="48" rows="15" required></textarea>
                    <span style ="color:red;"><?php echo $whoamiErr; ?></span>


                </div>

                <div class="buttons">
                    <a href=""><button type="submit" name="update">Update</button></a>
                </div>

            </div>
        </div>
    </form>
</body>

</html>