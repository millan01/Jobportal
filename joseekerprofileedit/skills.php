<?php 

$title = $progress = "";
$titleErr = $progressErr = "";

if(isset($_POST['update'])){

    if(empty($_POST['title'])){
        $titleErr = "Empty skill title";
    }else{
        $title = test_input($_POST['title']);
    }

    if(empty($_POST['progress'])){
        $progressErr = "Empty progress bar";
    }else{
        $progress = test_input($_POST['progress']);
        if(!preg_match("/^[0-9]*$/",$progress)){
            $progressErr = "progress status in number only";
        }
    }

    if(empty($titleErr) && empty($progressErr)){
        include('./database/connection.php');
        $stmt = $conn->prepare("INSERT INTO table_name(skill_title, skill_progress) VALUES (?,?");
        $stmt->bind_param("ss", $title , $progress);
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
    <link rel="stylesheet" href="skills.css">
</head>
<body>
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

            <a href=""> <button type="submit" name="update">Update</button></a>
        </div>
    </form>
</body>
</html>