<?php
  session_start();
  session_destroy();
  unset($_SESSION['']);
  $_SESSION['loginStatus'] = 0;
  $_SESSION['message'] = "You are now logged out";
  header('location: login.php');
?>
