<?php
session_start();
include('../database/connection.php');
$sessionmail = $_SESSION['seeker_Email'];
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
        $startedErr = "Date not selected";
    } else {
        $started = test_input($_POST['started']);
    }

    $end = test_input($_POST['passed']);


    // checkbox validation here
    $present = test_input($_POST['present']);


    if (empty($courseErr) && empty($boardErr) && empty($nameErr) && empty($startedErr) && empty($endErr)) {
        include('../database/connection.php');
        $sql = "SELECT Job_seeker_id FROM job_seeker WHERE Email = '$sessionmail'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $seekerID = $row['Job_seeker_id'];
        }

        $stmt = $conn->prepare("INSERT INTO jobseeker_education (course,board,institute,started_year,end_year ,jobseeker_id) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("sssiii", $course, $board, $name, $started, $end, $seekerID);
        $stmt->execute();
        $stmt->close();

        header('location: ../jobseekerprofile.php');

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
    <link rel="stylesheet" href="educationn.css">
</head>

<body>
    <form action="" method="post">
        <div class="formdetails">
            <h2>Update Education details</h2>
            <?php echo $jobseekerid; ?>
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
                <input type="text" name="institute" placeholder="Institution Name" value="" required>
            </div>

            <div class="form">
                <label for="started">Star ted year</label>
                <input type="varchar" name="started" id="started" required>
            </div>

            <div class="form">
                <label for="present">present</label>
                <input type="checkbox" name="present" id="present">
            </div>

            <div class="form">
                <label for="passed">Passed year</label>
                <input type="varchar" name="passed" id="passed">
            </div>

            <a href=""><button type="submit" name="update">Update</button></a>
        </div>
    </form>
</body>

</html>