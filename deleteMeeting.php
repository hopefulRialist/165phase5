<?php
session_start();
include ("connections.php");
$del = "";
$clubID = $_GET['club_id'];
$date = $_GET['date'];
$title = $_GET['title'];
$currID = $_GET['currentID'];

$q = "SELECT book_id from Book WHERE title LIKE '%$title%'";
$bid = mysqli_query($connections,$q);
$book_id = mysqli_fetch_assoc($bid);
$book_id  = $book_id['book_id'];

if (isset($_POST['delete'])) {
  $query = "DELETE FROM MEETING WHERE club_id ='$clubID' AND book_id='$book_id' AND dateTOMEET ='$date' ";
  $delQuery = mysqli_query($connections,$query);
  $del = "Meeting deleted";
}

$clubname = "SELECT club_name FROM Club WHERE club_id = $clubID ";
$clubname_query = mysqli_query($connections,$clubname);
$cn = mysqli_fetch_assoc($clubname_query);
$club_name = $cn['club_name'];

if (isset($_POST['NOdelete']) || isset($_POST['back'])) {
  echo "<script>window.location.href ='club_page.php?currentID=$currID&db_club_name=$club_name'</script>";
}

?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
     <a href="profile.php?currentID=<?php echo $currID; ?>" onclick="location.href = profile.php">Profile</a>
     <a href="logout.php" onclick="">Log Out</a>
</div>

<h1>Are you sure you want to delete?</h1>
<form method = "POST">
  <input type = "submit" name = "delete" value = 'Yes'>
  <input type = "submit" name = "NOdelete" value = 'No'><br>
  <?php if (isset($_POST['delete'])): ?>
      <input type = "submit" name="back" value= "Back">
  <?php endif; ?>
</form>
<span class = "confirmed"><?php echo $del ?></span>
