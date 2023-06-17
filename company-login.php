<?php
session_start();

?>
<?php

include('./database/connection.php');
$error = '';
$email = $pass = $storedpassword = '';
if (isset($_POST['signin'])) {

  $email = $_POST['email'];
  $pass= $_POST['password'];

  $stmt = $conn->prepare("SELECT password from company where email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $storedpassword = $row['password'];
    if(password_verify($pass, $storedpassword)){
      $_SESSION['email'] = $email;
      header("Location:companyprofile.php");
      exit();
    } else {
      $error = "Incorrect Password";
    }
  } else {
    $error = "User doesn't exit";
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
  <link rel="stylesheet" href="./styles/ccompanylogin.css" />
</head>

<body>
  <div class="navbar">
    <?php include('company-loginnav.php') ?>
  </div>

  <div class="outersection">

    <div class="formlogin">
      <div class="login">
        <div class="innersection">

          <?php if (isset($_SESSION['success'])) {
            echo $_SESSION['success'];
          }
          ?>

          <h2>Welcome Back</h2>
          <h4>Login with email and password</h4>
          <div class="inputfields">
            <form action="" method="POST">
              <div class="input-field">
                <label for="email"></label>
                <input type="text" name="email" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" required />
              </div>

              <div class="input-field">
                <label for="password"></label>
                <input type="password" name="password" id="password" placeholder="Password" required /> <br>
                <span><?php echo $error; ?></span>
              </div>
              <div class="rememberme">
                <input type="checkbox" name="checkbox" id="checkbox" />
                <label for="rememberme">Remember me</label>
              </div>
              <input type="submit" name="signin" id="signin" value="Sign in" class="buttn">
              <!-- <button name="signin" class="buttn" type="submit">Sign in</button> -->
            </form>
            <div class="resetsection">
              <div class="forget">
                <a href="#">Forget password?</a>
              </div>
              <div class="register">
                <!-- <span>Don't have account?</span> -->
                <a href="company-registration.php">Create Free Account!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="imagesection">
        <img src="./images/signincompany.png" alt="#" />
      </div>
    </div>
  </div>

</body>

</html>