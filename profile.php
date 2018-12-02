<?php
  session_start();
  include ("global.php");

?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>


<div class="topnav">
   <a href="index.php" onclick="location.href=index.php">Home</a>
   <a class = "active" href="profile.php">Profile</a>
   <?php if ($_SESSION['loginStatus'] == 0): ?>
     <a href="login.php" onclick="document.getElementById('id01').style.display='block'">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   <a href="signup.php" onclick="document.getElementById('id01').style.display='block'">Sign Up</a>
</div>

<center>
  <?php if ($_SESSION['loginStatus'] == 0): ?>
    <h1>You are not logged in</h1>
  <?php else: ?>
    <h1>Welcome *insert user name here*</h1>
  <?php endif; ?>
</center>
