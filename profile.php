<?php
  include ("connections.php"); 
  session_start();
  $userID = $_GET['currentID'];
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>


<div class="topnav">
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
     <a href="login.php" onclick="">Log In</a>
     <a href="signup.php" onclick="">Sign Up</a>
   <?php else: ?>
    <a href="index_loggedin.php?currentID=<?php echo $userID; ?>">Home</a>
    <a class = "active" href="profile.php?currentID=<?php echo $userID; ?>">Profile</a>
    <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   
</div>

<?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
    <h1>You are not logged in</h1>
<?php else: ?>

<html>
<link rel="stylesheet" href="w3.css">

<div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="openTab('User Info')">My Info</button>
  <button class="w3-bar-item w3-button" onclick="openTab('Clubs')">My Clubs</button>
  <button class="w3-bar-item w3-button" onclick="openTab('Books')">My Books</button>
</div>

<div id="User Info" class="tabs">
  <div class="w3-container w3-blue">
  <h2>Username:
  <?php
    $query = "SELECT * from User where user_id = '$userID'";
    $name = mysqli_query($connections, $query);
    $row = mysqli_fetch_assoc($name);
    echo $row['name'];
    echo "<h2>"; ?>
  
  </div>
  
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