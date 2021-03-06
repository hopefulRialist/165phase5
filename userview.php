<?php
  session_start();
  include("connections.php");
  $searchTerm = $_GET['searchTerm'];
  $searchType = $_GET['searchType'];
  $userName = $_GET['user_name'];
  $userID = $_GET['id'];
  if (isset($_SESSION["user_id"])) {
 
  $user_id=$_SESSION["user_id"];

}

?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
     <a href="search_results.php?searchType=<?php echo $searchType; ?>&searchTerm=<?php echo $searchTerm; ?>">Back</a>
     <a href="signup.php" onclick="">Sign Up</a>
     <a href="login.php" onclick="">Log In</a>
   <?php else:  $currID = $_GET['currentID']; ?>
    <a href="search_results.php?currentID=<?php echo $currID; ?>&searchType=<?php echo $searchType; ?>&searchTerm=<?php echo $searchTerm; ?>">Back</a>
    <a href="profile.php?currentID=<?php echo $currID; ?>">Profile</a>
    <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>

</div>

<html>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-bar w3-black">
  <button class="w3-bar-item w3-button" onclick="openTab('User Info')">User Info</button>
  <button class="w3-bar-item w3-button" onclick="openTab('Clubs')">Clubs</button>
  <button class="w3-bar-item w3-button" onclick="openTab('Books')">Books</button>
</div>

<div id="User Info" class="tabs">

  <div class="w3-container w3-blue-grey">
  <h2><?php echo "$userName"?></h2>
  <?php $query = "SELECT * from User where name = '$userName' and  user_id = '$userID'";
  		$email = mysqli_query($connections,$query);
  		$row=mysqli_fetch_assoc($email);
  		$eA = $row['email_address'];
      echo "$eA";
  ?><br>
  <?php $query = "SELECT * from User where name = '$userName' and  user_id = '$userID'";
  		$nationality = mysqli_query($connections,$query);
  		$row=mysqli_fetch_assoc($nationality);
  		$nat = $row['nationality'];
      echo "$nat";
  ?><br> </div>
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
  <?php
  	$clubs = null;
  	$query = "SELECT * from Club, User, MEMBER_OF where (User.user_id = '$userID' and 
  	MEMBER_OF.user_id = User.user_id) and (Club.club_id = MEMBER_OF.club_id)";
  	$clubs = mysqli_query($connections,$query);

  	if(mysqli_num_rows($clubs) > 0){
  		while ($r=mysqli_fetch_assoc($clubs)) {
  			$cN = $r['club_name'];
  			$stat = $r['description'];
  			$date_joined = $r['date_joined'];
  			echo "<tr>

  			<td> 
  			$cN
  			</td>
  			<td> 
  			$stat
  			</td>
  			<td> 
  			$date_joined
  			</td>

  			</tr>";
  		}	
  	}else{
  		echo "No Club Memberships";
  	}

  ?>
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
  <?php
  	$books = null;
  	$query = "SELECT * from Book, User, HAS_READ where (User.user_id = '$userID' and 
  	HAS_READ.userID = User.user_id) and (Book.book_id = HAS_READ.bookID)";
  	$books = mysqli_query($connections,$query);

    if($books!=null){
  	if(mysqli_num_rows($books) > 0){
  		while ($r=mysqli_fetch_assoc($books)) {
  			$cN = $r['title'];
  			$stat = $r['summary'];
  			$date_joined = $r['dateFINISHED'];
  			echo "<tr>

  			<td> 
  			$cN
  			</td>
  			<td> 
  			$stat
  			</td>
  			<td> 
  			$date_joined
  			</td>

  			</tr>";
  		}	
  	}}else{
  		echo "No Books Read";
  	}

  ?>
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
