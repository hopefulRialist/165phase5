<?php
//Note during demo for login and sign up. write something on the email first before cancelling. that way the pop up doest get in
//the way when going back to home page
session_start();
include ("global.php");
include ("connections.php");

$email = $password = $password_repeat = $first_name = $surname = $nationality = "";
$emailErr = $passwordErr = $password_repeatErr = $first_nameErr = $surnameErr = $nationalityErr = "";
$confirmation="";

if (isset($_POST["btnSignUp"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $password_repeat = $_POST["password_repeat"];
  $first_name = $_POST["first_name"];
  $surname = $_POST ["surname"];
  $nationality = $_POST["nationality"];

  if($email && $password && $password_repeat && $first_name && $surname && $nationality) {
    if ($password!= $password_repeat) {
      $password_repeatErr = "Password does not match";
    } else {

      //HASH the pass
      $hashPass = password_hash($password,PASSWORD_DEFAULT); //uses bcrypt
      $insert = mysqli_query($connections,"INSERT INTO User(first_name, surname, email_address, password, nationality,points,loginStatus) VALUES ('$first_name','$surname','$email','$hashPass','$nationality',0,1)");

      // if ($connections->query($insert)===TRUE) {
      $confirmation = "You have succesfully signed up!";
      $_SESSION['loginStatus'] = 1;
      $emailErr = $passwordErr = $password_repeatErr = $first_nameErr = $surnameErr = $nationalityErr = "";
      // } else {
      //   echo "Error: " . $insert . "<br>" . $connections->error;
      // }
      $connections -> close();

    }
  }
}


if(isset($_POST["btnSignUp"])) {
  if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $emailErr = "Invalid Email Format";
  }
}



 if(isset($_POST["btnCancel"])) {
   echo "<script>window.location.href='index.php'</script>";
 }


?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>
<!-- The Modal (contains the Sign Up form) -->
<div class="topnav">
   <a href="index.php" onclick="location.href=index.php">Home</a>
   <a href="profile.php">Profile</a>
   <?php if ($_SESSION['loginStatus'] == 0): ?>
     <a href="login.php" onclick="">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="'">Log Out</a>
  <?php endif; ?>
  <a class="active" href="signup.php" onclick="">Sign Up</a>
</div>


<center>
  <form method="POST">
    <div class="container">
      <br><br>
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <br>
      <input type="text" placeholder="Enter Email" name="email"  required autocomplete="username">
      <br>
      <input type="password" placeholder="Enter Password" name="password" required  autocomplete="new-password">
      <br>
      <input type="password" placeholder="Repeat Password" name="password_repeat" required autocomplete="new-password">
      <br>
      <input type="text" placeholder="First Name" name="first_name" required>
      <br>
      <input type="text" placeholder="Surname" name="surname" required>
      <br>
      <input type="text" placeholder="Nationality" name="nationality" required>
      <br>
      <br><br>

      <input type="submit" name="btnSignUp" value="Sign Up">
      <input type="submit" name="btnCancel" onclick="location.href='index.php'" value="Cancel">
      <br><br>
      <span class = "confirmed"> <?php echo $confirmation; ?></span><br>
      <span class = "error"> <?php echo $emailErr; ?></span><br>
      <span class = "error"> <?php echo $password_repeatErr; ?></span><br>
      <span class = "error"> <?php echo $first_nameErr; ?></span><br>
      <span class = "error"> <?php echo $surnameErr; ?></span><br>
      <span class = "error"> <?php echo $nationalityErr; ?></span><br>

    </div>
  </form>
  <?php
    if(isset($_SESSION['message'])) {
        echo "<div class='error'>".$_SESSION['message']."</div>";
        unset($_SESSION['message']);
    }
  ?>
</center>
