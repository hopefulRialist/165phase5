<?php
session_start();
include ("connections.php");

$club_name = $_GET['db_club_name'];
$query = "SELECT * FROM Club WHERE club_name LIKE '%$club_name%'";
$row = mysqli_query($connections,$query);
$club=mysqli_fetch_assoc($row);
$creationdate = $club['date_created'];
$clubDesc  = $club['description'];
$added=$bookErr = $joined = $left = $notLoggedIn =  "";
$clubID = $club['club_id'];

if((isset($_SESSION['loginStatus']))) {
  $user_id = $_GET['currentID'];

  if(isset($_POST['join'])) {
    $then = null;
    $string = "";
    $aremem = "SELECT * FROM MEMBER_OF WHERE MEMBER_OF.club_id = '$clubID' and MEMBER_OF.user_id = '$user_id'";
    $then = mysqli_query($connections, $aremem);
    $row = mysqli_fetch_assoc($then);
    $string = $row['user_id'];
    $now = date_create()->format('Y-m-d H:i:s');

    if($string == ""){
      $query = "INSERT INTO MEMBER_OF(user_id, club_id, date_joined) VALUES ('$user_id', '$clubID', '$now')";
      $insert = mysqli_query($connections,$query);
      $joined = "You joined the club!";
    } else{
      $joined = "You have already joined this club!";
    }
  }

  if (isset($_POST['leave'])) {
    $then = null;
    $string = "";
    $aremem = "SELECT * FROM MEMBER_OF WHERE MEMBER_OF.club_id = '$clubID' and MEMBER_OF.user_id = '$user_id'";
    $then = mysqli_query($connections, $aremem);
    $row = mysqli_fetch_assoc($then);
    $string = $row['user_id'];
    if($string != $user_id){
      $left = "You are not a part of this club!";
    } else{
      $query = "DELETE FROM MEMBER_OF WHERE MEMBER_OF.club_id = '$clubID' and MEMBER_OF.user_id = '$user_id'";
      $delete = mysqli_query($connections,$query);
      $left = "You have left this club";
    }
  }
} else {
  if(isset($_POST['join']) || isset($_POST['leave']) ) {
    $notLoggedIn = "You're not logged in!";
    $notLoggedIn = "";
  }
}

?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<link rel="stylesheet" href="w3.css">

<div class="topnav">
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
    <a href="index.php">Home</a>
    <a href="login.php" onclick="">Log In</a>
    <a href="signup.php" onclick="">Sign Up</a>
   <?php else: ?>
    <a href="index_loggedin.php?currentID=<?php echo $user_id ?>">Home</a>
    <a href="profile.php?currentID=<?php echo $user_id ?>" onclick="location.href = profile.php">Profile</a>
    <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   
</div>

<div class="w3-container w3-black">
  <h1><?php echo "Welcome to $club_name";?></h1>
</div>
<div class="w3-container w3-blue">
<h4>Date Created: </h4>
<p><?php echo "$creationdate";?> </p>
<h4>Description: </h4>
<p><?php echo "$clubDesc";?></p>
<br></div>


<form method="POST">
  <br>
  <button class="w3-button w3-hover-grey w3-black" name="join"  value = 'Join Club'>Join</button>
  <button class="w3-button w3-hover-grey w3-black" name="leave"  value = 'Leave Club'>Leave</button>
  <br><br>
  <button class="w3-button w3-hover-grey w3-black" name='meeting' value='Add Meeting'>Add</button>
  <button class="w3-button w3-hover-grey w3-black" name = 'delete' value='Delete Club'>Delete</button>
  <br>
</form>

<br>

<table class="w3-table w3-bordered w3-hoverable">
	<tr class="w3-blue">
        <th>Book</th>
        <th>Meeting</th>
        <th>Date</th>
        <th>Time</th>
        <th>Location</th>
        <th>Edit Meeting</th>
	</tr>

  <?php
    $club_name = $_GET['db_club_name'];
    $query = "SELECT * FROM Club WHERE club_name LIKE '%$club_name%'";
    $row = mysqli_query($connections,$query);
    $club=mysqli_fetch_assoc($row);
    $creationdate = $club['date_created'];
    $clubDesc  = $club['description'];
    $added=$bookErr = "";
    $clubID = $club['club_id'];
    $date = $time = $location = $book = $mDesc = "";

    if((isset($_SESSION['loginStatus']))){
      if (isset($_POST['AddMeeting'])){
      //$bookID //DANGER: won't work if hindi exact title ibibigay

        $date = $_POST['date'];
        $time = $_POST['time'];
        $loc = $_POST['location'];
        $book = $_POST['book'];
        $desc = $_POST['mDesc'];
        if ($date && $time && $loc && $book && $desc) {
          $query = "SELECT * from Book WHERE title LIKE '%$book%'";
          $row = mysqli_query($connections,$query);
          if (mysqli_num_rows($row) > 0) {

              $bookFetched = mysqli_fetch_assoc($row);
              $bookID = $bookFetched['book_id'];
              $query1 = "INSERT INTO MEETING (club_id,book_id,dateTOMEET,timeToMEET,location,mTitle,mDescription) VALUES ('$clubID','$bookID','$date','$time', '$loc','$book', '$desc')";
              $insert = mysqli_query($connections,$query1);
              $added = "Meeting Added";
          } else {
              $bookErr = "No book exists. Please check Title";
          }
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

    if (mysqli_num_rows($rowMeet)>0){
      while ($meeting = mysqli_fetch_assoc($rowMeet)){
        $bt = $meeting['mTitle'];
        $md = $meeting['mDescription'];
        $dtm = $meeting['dateTOMEET'];
        $ttm = $meeting['timeToMEET'];
        $loc = $meeting['location'];
        echo "<tr><td>$bt</td>
        <td>$md</td>
        <td>$dtm</td>
        <td>$ttm</td>
        <td>$loc</td>
        <td><a href='updateMeeting.php?club_id=$clubID&title=$bt&desc=$md&date=$dtm&time=$ttm&place=$loc&currentID=$user_id&clubname=$club_name'>Update</a> 
        <br><br><a href= 'deleteMeeting.php?club_id=$clubID&date=$dtm&title=$bt&currentID=$user_id'>Delete</a> </td></tr>";
      }
    }}else{
      if(isset($_POST['delete']) || isset($_POST['AddMeeting'])){
       $notLoggedIn = "You're not logged in!";
          $notLoggedIn = "";
      }
    }?>

<?php if((isset($_SESSION['loginStatus'])) && isset($_POST['meeting'])): ?>
  <form method = "POST">
    <input type='date' name='date' value='Date' required>
    <input type='time' name='time' value='Time' required>
    <br>
    <input type = "text" name="location" placeholder="Location" required>
    <br>
    <input type = "text" name='book' placeholder="Book to be discussed" required>
    <br>
    <input type = "text" name ='mDesc' placeholder='Meeting Description' required>
    <br>
      <input type="submit" name='AddMeeting' value='Submit'>
  </form>

<?php else:
  $notLoggedIn = "You're not logged in!";    $notLoggedIn = ""; endif;?>

<span class='confirmed'><?php echo $joined; ?> </span>
<span class='error'><?php echo $left; ?> </span>
<br>
<span class='confirmed'><?php echo $added; ?> </span>
<span class='error'><?php echo $bookErr; ?> </span>
<br>
<span class='error'><?php echo $notLoggedIn; ?> </span>
