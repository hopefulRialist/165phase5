<?php
//Note during demo for login and sign up. write something on the email first before cancelling. that way the pop up doest get in
//the way when going back to home page
session_start();
include ("connections.php");

$email = $password = $password_repeat = $name = $nationality = "";
$emailErr = $passwordErr = $password_repeatErr = $nameErr = $nationalityErr = "";
$confirmation="";

if (isset($_POST["btnSignUp"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $password_repeat = $_POST["password_repeat"];
  $name = $_POST["name"];
  $nationality = $_POST["nationality"];

  if($email && $password && $password_repeat && $name && $nationality) {
    if ($password!= $password_repeat) {
      $password_repeatErr = "Password does not match";
    } else {

      //HASH the pass
      $hashPass = password_hash($password,PASSWORD_DEFAULT); //uses bcrypt
      $query = "INSERT INTO User(name, email_address, password, nationality,points) VALUES ('$name','$email','$hashPass','$nationality',0)";

      if ($connections->query($query)===TRUE) {
        $confirmation = "You have succesfully signed up!";
        $_SESSION['loginStatus'] = 1;
        $emailErr = $passwordErr = $password_repeatErr = $name = $nationalityErr = "";
      } else {
        echo "Error: " . $insert . "<br>" . $connections->error;
      }
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
   
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
    <a href="index.php" onclick="location.href=index.php">Home</a>
    <a href="login.php" onclick="">Log In</a>
    <a class="active" href="signup.php" onclick="">Sign Up</a>
   <?php else: $currentID = $row[$user_id];?>
     <a href="index_loggedin.php?currentID=<?php echo $current_ID;?>">Home</a>
     <a href="logout.php" onclick="'">Log Out</a>
  <?php endif; ?>
 
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
      <input type="text" placeholder="Full Name" name="name" required>
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
      <span class = "error"> <?php echo $nameErr; ?></span><br>
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
