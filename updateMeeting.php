<?php
session_start();
include ("connections.php");

$clubID = $_GET['club_id'];
$title = $_GET['title'];
$desc = $_GET['desc'];
$dateOLD = $_GET['date'];
$time = $_GET['time'];
$place = $_GET['place'];
$confirm="";

$query1 = "SELECT * from Book WHERE title LIKE '%$title%'";
$row = mysqli_query($connections,$query1);
if (mysqli_num_rows($row) > 0) {
    $bookFetched = mysqli_fetch_assoc($row);
    $bookID_OLD = $bookFetched['book_id'];
}

if (isset($_POST['AddMeeting'])) {
  $dtm = $_POST['date'];
  $ttm = $_POST['time'];
  $loc = $_POST['location'];
  $mt =  $_POST['book'];
  $md = $_POST['mDesc'];
  $query = "UPDATE MEETING SET dateTOMEET = '$dtm', timeTOMEET = '$ttm', location='$loc', mTitle = '$mt',mDescription='$md' WHERE book_id = '$bookID_OLD' AND club_id='$clubID' AND dateTOMEET = '$dateOLD'";
  $update = mysqli_query($connections, $query);
  $confirm = "Changes Saved";

}
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

<center>
<form method = "POST">
  <br> <!--some bug here nahindi showing yung whole thing-->
  <input type='date' name='date' value=<?php echo $dateOLD?> required>
  <input type='time' name='time' value=<?php echo $time ?> required>
  <br>
  <input type = "text" name="location" value=<?php echo $place?> required>
  <br>
  <input type = "text" name='book'  value = <?php echo $title ?> required>
  <br>
  <input type = "text" name ='mDesc' value = <?php echo $desc?> required>
  <br><br>
  <input type="submit" name='AddMeeting' value='Submit'>
</form>
<span class = "confirmed"> <?php echo $confirm?></span>
</center>
