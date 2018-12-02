<?php
//https://stackoverflow.com/questions/11861317/hashing-in-phpmyadmin
//HASHED NA SA LOCALHOST
//Note during demo for login and sign up. write something on the email first before cancelling. that way the pop up doest get in
//the way when going back to home page
session_start();
include ("connections.php");
$email=$password="";
$emailErr=$passwordErr="";
$confirmation="";
if(isset($_POST["btnLogin"])){

    $email=$_POST["email"];
    $password=$_POST["password"];


  if ($email && $password) {
    $check_email=mysqli_query($connections,"SELECT * FROM User WHERE email_address='$email'") or die ("could not connect to mysql");
    $check_email_row=mysqli_num_rows($check_email);
    if ($check_email_row > 0){//if may nakuha na row
      $row=mysqli_fetch_assoc($check_email);
      if (password_verify($password,$row['password'])) {
        //redirect to home
        $confirmation="You have succesfully logged in!";
        $_SESSION['loginStatus'] = 1;
        $current_LoggedIn_UserID = $row['user_id']; //for accessing current user id pero it isnt changing the value of nung nasa global.php. same case with current loginStatus
      } else {
        $passwordErr="Wrong Password";
      }
    } else {
      $emailErr = "Email is not registered";
    }
  }
}

if(isset($_POST["btnLogin"])) {
  if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    $emailErr = "Invalid Email Format";
  } else {
  }
}

if (isset($_POST["btnCancel"])) {
  echo "<script>window.location.href='index.php'</script>";
}

?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
   <a href="index.php" onclick="location.href='index.php'">Home</a>
   <a href="profile.php">Profile</a>
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
     <a href="login.php" onclick="">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="'">Log Out</a>
  <?php endif; ?>
  <a href="signup.php" onclick="">Sign Up</a>
</div>


<center>
 <form method="POST">
   <br><br><br>
   <h1>Login</h1>
   <br>
   <input type="text"  name="email" placeholder="Email" required value="<?php echo $email;?>">
   <br>
   <input type="password" name="password" value="" required placeholder="Password">
   <br><br><br>
   <input type="submit" name="btnLogin" value="Login">
   <input type="submit" name="btnCancel" onclick="location.href = 'index.php'" value="Cancel">
   <br>
   <span class = "confirmed"> <?php echo $confirmation; ?></span><br>
   <span class = "error"> <?php echo $emailErr; ?></span>
   <span class = "error"> <?php echo $passwordErr; ?></span>


 </form>
<?php
  if(isset($_SESSION['message'])) {
      echo "<div class='error'>".$_SESSION['message']."</div>";
      unset($_SESSION['message']);
  }
?>

</center>
