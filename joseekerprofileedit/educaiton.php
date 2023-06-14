<?php
$course = $board = $name = $started = $end = $present = "";
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
        $board = test_input($_POST["name"]);
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

    if (empty($_POST['passed'])) {
        $endErr = "Date not selected";
    } else {
        $end = test_input($_POST['passed']);
    }


    // checkbox validation here

    if(empty($courseErr) && empty($boardErr)&& empty($nameErr) && empty($startedErr) && empty($endErr)){

        include ('./database/connection.php');
        $stmt = $conn->prepare("INSERT INTO table_name(course,board,insititute,startedyear,endyear,running) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $course, $board, $name, $started, $end);
        $stmt->execute();
        $stmt->close();

        header('location:jobseekerprofile.php');

    }

}
function test_input($data){
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
    <link rel="stylesheet" href="education.css">
</head>

<body>
    <form action="" method="post">
        <div class="formdetails">
            <h2>Update Education details</h2>

            <hr color="black" size="1px">

            <div class="form">
                <label for="course">Course</label>
                <select name="course" id="course" required>
                    <option value="">Select course</option>
                    <option value="school">SLC/SEE</option>
                    <option value="plustwo">Plus two</option>
                    <option value="diploma">Diploma</option>
                    <option value="graduation">Gradutaion</option>
                    <option value="postgraduation">Post Gradutaion</option>
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
                <label for="started">Started year</label>
                <input type="date" name="started" id="started" required>
            </div>

            <div class="form">
                <label for="present">present</label>
                <input type="checkbox" name="present" id="present" required>
            </div>

            <div class="form">
                <label for="passed">Passed year</label>
                <input type="date" name="passed" id="passed" required>
            </div>

            <a href=""><button type="submit" name="update">Update</button></a>
        </div>
    </form>
</body>

</html>