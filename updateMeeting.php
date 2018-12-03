<?php
session_start();
include ("connections.php");

$clubID = $_GET['club_id'];
$clubname = $_GET['clubname'];
$title = $_GET['title'];
$desc = $_GET['desc'];
$dateOLD = $_GET['date'];
$time = $_GET['time'];
$place = $_GET['place'];
$confirm="";
$currID = $_GET['currentID'];

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
<link rel="stylesheet" href="w3.css">

<div class="topnav">
     <a href="club_page.php?currentID=<?php echo $currID; ?>&db_club_name=<?php echo $clubname; ?>">Back</a>
     <a href="profile.php?currentID=<?php echo $currID; ?>" onclick="location.href = profile.php">Profile</a>
     <a href="logout.php" onclick="">Log Out</a>
</div>

<div class="w3-container w3-blue">
  <h2>Update Your Meeting</h2>
</div>

<form method = "POST">
  <br> <!--some bug here nahindi showing yung whole thing-->
  <input class="w3-input" type='date' name='date' value=<?php echo $dateOLD?> required>
  <input class="w3-input" type='time' name='time' value=<?php echo $time ?> required>
  <br>
  <input class="w3-input" type = "text" name="location" value=<?php echo $place?> required>
  <br>
  <input class="w3-input" type = "text" name='book'  value = <?php echo $title ?> required>
  <br>
  <input class="w3-input" type = "text" name ='mDesc' value = <?php echo $desc?> required>
  <br><br>
  <button class="w3-button w3-hover-grey w3-blue" name='AddMeeting'>Submit</button>
  <span class = "confirmed"> <?php echo $confirm?></span>
</form>




