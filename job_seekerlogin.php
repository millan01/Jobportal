<?php
session_start();
include('./database/connection.php');
$error = '';
if (isset($_POST['signin'])) {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT Password from job_seeker where Email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $isPasswordCorrect = FALSE;
  $stmt->bind_result($jobseekerpassword);
  if ($stmt->fetch() == TRUE) {
    $isPasswordCorrect = password_verify($password, $jobseekerpassword);
    $_SESSION['seeker_Email'] = $email;

    header("Location:jobseekerprofile.php");
    exit();
  } else {
    $error = "Incorrect email or Password";
  }


  //admin check
  $sql = "SELECT Password from admin_login where Email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $isPasswordCorrect = FALSE;
  $stmt->bind_result($jobseekerpassword);
  if ($stmt->fetch() == TRUE) {
    $isPasswordCorrect = password_verify($password, $jobseekerpassword);
    $_SESSION['admin_Email'] = $email;

    header("Location:admindashboard.php");
    exit();
  } else {
    $error = "Incorrect email or Password";
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./styles/jobseekerloginn.css" />
</head>

<body>
  <div class="navbar_flow">
    <div class="logo">
      <a href="index.php">
        <img src="./images/logo.svg " alt="company logo"> </a>
    </div>
    <div class="header">
      <a href="index.php" id="home">Home</a>
      <a href="#" id="Blog">Blog</a>
      <a href="#" id="contact">Contact</a>
      <a href="#" id="company">About us</a>
    </div>
    <div class="buttons">
      <div class="signin">
        <a href="job_seekerregistration.php">
          <button type="submit">
            <img src="./images/sign in.png" alt="#" width="10px" height="10px" /> Sign up</button>
        </a>
      </div>
    </div>
  </div>
  <div class="outersection">
    <div class="formlogin">
      <div class="imagesection">
        <img src="./images/illustrate.png" alt="#" />
      </div>
      <div class="login">
        <!-- <div class="headerbutton">
            <button type="submit" class="signin">Sign in</button>
            <button type="submit" class="register">Register</button>
          </div> -->
        <div class="innersection">
          <?php
          if (isset($_SESSION['registered'])) {
            echo $_SESSION['registered'];
          }
          ?>
          <h2>Welcome Back</h2>
          <h4>Login with email and password</h4>
          <div class="inputfields">
            <form action="" method="POST">
              <div class="input-field">
                <label for="email"></label>
                <input type="email" name="email" id="email" placeholder="Email" value="<?php if (isset($_POST['email'])) {
                  echo $_POST['email'];
                } ?>" required />
              </div>

              <div class="input-field">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password" required /> <br>
                <span style="color:red;">
                  <?php echo $error ?>
                </span>
              </div>

              <div class="rememberme">
                <input type="checkbox" name="checkbox" id="checkbox" />
                <label for="rememberme">Remember me</label>
              </div>
              <input type="submit" class="buttn" name="signin" value="Sign in">
              <!-- <button class="buttn" type="submit">Sign in</button> -->
            </form>
            <div class="resetsection">
              <div class="forget">
                <a href="#">Forget password?</a>
              </div>
              <div class="register">
                <!-- <span>Don't have account?</span> -->
                <a href="job_seekerregistration.php">Create Free Account!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>