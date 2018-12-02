<?php
  session_start();
  include("connections.php");
  $searchTerm = $_GET['searchTerm'];
  $searchType = $_GET['searchType'];
  $userName = $_GET['user_name'];
  $userID = $_GET['id'];
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
   <a href='search_results.php?searchType=$searchType&searchTerm=$searchTerm'>Back</a>
   <a href="index.php" onclick="location.href=index.php">Home</a>
   <a href="profile.php" onclick="location.href=profile.php">Profile</a>
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
     <a href="login.php" onclick="">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   <a href="signup.php" onclick="">Sign Up</a>
</div>

<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="openTab('User Info')">User Info</button>
  <button class="w3-bar-item w3-button" onclick="openTab('Clubs')">Clubs</button>
  <button class="w3-bar-item w3-button" onclick="openTab('Books')">Books</button>
</div>

<div id="User Info" class="tabs">
  <h2><?php echo "$userName"?></h2>
  <?php $query = "SELECT * from User where name = '$userName' and  user_id = '$userID'";
  		$email = mysqli_query($connections,$query);
  		$row=mysqli_fetch_assoc($email);
  		echo $row['email_address'];
  ?><br>
  <?php $query = "SELECT * from User where name = '$userName' and  user_id = '$userID'";
  		$nationality = mysqli_query($connections,$query);
  		$row=mysqli_fetch_assoc($nationality);
  		echo $row['nationality'];
  ?><br>
</div>

<div id="Clubs" class="tabs" style="display:none">
  <h2></h2>
  <div class="w3-container">
  <h2>Active Memberships</h2>

  <table class="w3-table-all w3-hoverable">
    <thead>
      <tr class="w3-light-grey">
        <th>Club Name</th>
        <th>Club Status</th>
        <th>Date Joined</th>
      </tr>
    </thead>
  <?php

  	$query = "SELECT ";


  ?>
  </table>
</div>
  <p></p> 
</div>

<div id="Books" class="tabs" style="display:none">
  <h2></h2>
  <p></p>
</div>

<script>
function openTab(tab) {
    var i;
    var x = document.getElementsByClassName("tabs");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    document.getElementById(tab).style.display = "block";  
}
</script>
</html>
