<?php
$title = $year = $compname = "";
$titleErr = $yearErr = $compnameErr = "";
if (isset($_POST['submit'])) {

    if (empty($_POST["certtitle"])) {
        $titleErr = "Name is required";
    } else {
        $title = test_input($_POST["certtitle"]);
        if (!preg_match("/^[a-zA-Z ]*$/",  $title)) {
            $titleErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["year"])) {
        $yearErr = "Name is required";
    } else {
        $year = test_input($_POST["year"]);
        if (!preg_match("/^[/[0-9]$/]*$/",  $year)) {
            $yearErr = "Only letters and white space allowed";
        }
    }

    if (empty($_POST["companyname"])) {
        $compnameErr = "Name is required";
    } else {
        $compname = test_input($_POST["companyname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",  $compname)) {
            $compnameErr = "Only letters and white space allowed";
        }
    }

    if(empty($titleErr) && empty($yearErr) && empty($compnameErr)){
        include ('./database/connection.php');
        $stmt = $conn->prepare("INSERT INTO table_name(cert_title, cert_year,cert_company) VALUES (?,?,?");
        $stmt->bind_param("sss",$title,$year,$compname);
        $stmt->execute();
        $stmt->close();
        header('location:jobseekerprofile.php');
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
    <title>Document</title>
    <link rel="stylesheet" href="certificates.css">
</head>

<body>
    <form action="" method="post">
        <div class="formdetails">
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

            <a href=""><button type="submit">Update</button></a>
        </div>
    </form>
</body>

</html>