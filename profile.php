<?php
  include ("global.php");
  session_start();

?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>


<div class="topnav">
   <a href="index.php" onclick="location.href=index.php">Home</a>
   <a class = "active" href="profile.php">Profile</a>
   <?php if ($loginStatus == 0): ?>
     <a href="login.php" onclick="document.getElementById('id01').style.display='block'">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   <a href="signup.php" onclick="document.getElementById('id01').style.display='block'">Sign Up</a>
</div>
