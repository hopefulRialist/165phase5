<?php
session_start();
include ("connections.php");

$club_name = $_GET['db_club_name'];
$query = "SELECT * FROM Club WHERE club_name LIKE '%$club_name%'";
$row = mysqli_query($connections,$query);
$club=mysqli_fetch_assoc($row);
$creationdate = $club['date_created'];
$clubDesc  = $club['description'];
$added="";
$clubID = $club['club_id'];
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
  <h1><?php echo "Welcome to $club_name";?></h1>
</center>
<h2>Date Created: </h2>
<br>
<p><?php echo "$creationdate";?> </p>
<h2>Description: </h2>
<br>
<p><?php echo "$clubDesc";?></p>
<br>
<form method="POST">
  <input type = "submit" name='meeting' value='Add Meeting'>
  <input type="submit" name = 'delete' value='Delete Club'>
</form>

<?php if(isset($_POST['meeting'])): ?>
  <form method = "POST">
    <input type='date' name='date' value='Date'>
    <input type='time' name='time' value='Time'>
    <br>
    <input type = "text" name="location" placeholder="Location">
    <br>
    <input type = "text" name='book' placeholder="Book to be discussed" >
    <br>
    <input type = "text" name ='mDesc' placeholder='Meeting Description'>
    <br>
      <input type="submit" name='AddMeeting' value='Submit'>
  </form>

<?php endif;?>


<span class='confirmed'><?php echo $added; ?> </span>

<table border="0" width="100%">
<tr>
		<td colspan="7"><hr></td>

	</tr>

	<tr>
        <td><b><p>Book</p></b></td>

        <td><b><p>Meeting</p></b></td>

        <td><b><p>Date</p></b></td>

        <td><b><p>Time</p></b></td>

        <td><b><p>Location</p></b></td>
	</tr>

	<tr>
		<td colspan="7"><hr></td>

	</tr>

  <?php
  $club_name = $_GET['db_club_name'];
  $query = "SELECT * FROM Club WHERE club_name LIKE '%$club_name%'";
  $row = mysqli_query($connections,$query);
  $club=mysqli_fetch_assoc($row);
  $creationdate = $club['date_created'];
  $clubDesc  = $club['description'];
  $added="";
  $clubID = $club['club_id'];
  $date = $time = $location = $book = $mDesc = "";

      if (isset($_POST['AddMeeting'])) {
      //$bookID //DANGER: won't work if hindi exact title ibibigay

        $date = $_POST['date'];
        $time = $_POST['time'];
        $loc = $_POST['location'];
        $book = $_POST['book'];
        $desc = $_POST['mDesc'];
        if ($date && $time && $loc && $book && $desc) {
          $query = "SELECT * from Book WHERE title LIKE '%$book%'";
          $row = mysqli_query($connections,$query);
          $bookFetched = mysqli_fetch_assoc($row);
          $bookID = $bookFetched['book_id'];
          $query1 = "INSERT INTO MEETING (club_id,book_id,dateTOMEET,timeTOMEET,location,mTitle,mDescription) VALUES ('$clubID','$bookID','$date', '$time', '$loc','$book', '$desc')";
          $insert = mysqli_query($connections,$query1);
          $added = "Meeting Added";
          //need to reprint for it to display to current meeting list
      }
    }

   if (isset($_POST['delete'])) {
    $query_delete = "DELETE FROM Club WHERE club_id = $clubID";
    $DELETE = mysqli_query($connections,$query_delete);
    echo "<h1>$club_name Deleted </h1>";
    //echo "<script>window.location.href='index.php'</script>"; //href back to hom
  }

  $meet_query = "SELECT * FROM MEETING WHERE club_id= $clubID";
  $rowMeet = mysqli_query($connections,$meet_query);

  if (mysqli_num_rows($rowMeet)>0) {
    while ($meeting = mysqli_fetch_assoc($rowMeet)){
      $bt = $meeting['book_title'];
      $md = $meeting['meeting_description'];
      $dtm = $meeting['date_to_meet'];
      $ttm = $meeting['time_to_meet'];
      $loc = $meeting['location'];
      echo "<tr><td>$bt</td>
      <td>$md</td>
      <td>$dtm</td>
      <td>$ttm</td>
      <td>$loc</td></tr>";
    }
  }


  ?>
