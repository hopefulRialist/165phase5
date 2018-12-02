<?php
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
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
     <a href="login.php" onclick="">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   <a href="signup.php" onclick="">Sign Up</a>
</div>

<?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
    <h1>You are not logged in</h1>
<?php else: ?>

<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="openTab('User Info')">My Info</button>
  <button class="w3-bar-item w3-button" onclick="openTab('Clubs')">My Clubs</button>
  <button class="w3-bar-item w3-button" onclick="openTab('Books')">My Books</button>
</div>

<div id="User Info" class="tabs">
  <h2><h2>
</div>

<div id="Clubs" class="tabs" style="display:none">
  <h2></h2>
  <div class="w3-container">
  <h2>Active Memberships</h2>

  <table class="w3-table-all w3-hoverable">
    <thead>
      <tr class="w3-light-grey">
        <th>Club Name</th>
        <th>Club Description</th>
        <th>Date Joined</th>
      </tr>
    </thead>
  
  </table>
</div>
  <p></p> 
</div>

<div id="Books" class="tabs" style="display:none">
  <h2></h2>
  <div class="w3-container">
  <h2>Books Read</h2>

  <table class="w3-table-all w3-hoverable">
    <thead>
      <tr class="w3-light-grey">
        <th>Book Name</th>
        <th>Book Summary</th>
        <th>Date Finished</th>
      </tr>
    </thead>
  </table>
</div>
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
<?php endif; ?>