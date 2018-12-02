<?php
  session_destroy();
  session_start();
  $_SESSION['loginStatus'] = 0;
  $_SESSION['message'] = "You are now logged out";
  header('location: login.php');
?>
