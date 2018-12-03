<?php
session_start();
include ("connections.php");
if (isset($_SESSION["user_id"])) {
  
  $user_id=$_SESSION["user_id"];

}
$club_name = $_GET['db_club_name'];
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
   <a href="index.php">Home</a>
   <a href="profile.php" onclick="location.href = profile.php">Profile</a>
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
     <a href="login.php" onclick="">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   <a href="signup.php" onclick="">Sign Up</a>
</div>


<h1><?php echo "Welcome to $club_name"?></h1>
