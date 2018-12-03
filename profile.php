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
  <div class="w3-container w3-blue-grey">
  <h2>Username:
  <?php
    $query = "SELECT * from User where user_id = '$userID'";
    $name = mysqli_query($connections, $query);
    $row = mysqli_fetch_assoc($name);
    echo $row['name']; ?>
  <h2>
  <h6>Email:
   <?php
    $query = "SELECT * from User where user_id = '$userID'";
    $name = mysqli_query($connections, $query);
    $row = mysqli_fetch_assoc($name);
    echo $row['email_address'];
    echo "<h6>"; ?>
  <h6>Nationality:
   <?php
    $query = "SELECT * from User where user_id = '$userID'";
    $name = mysqli_query($connections, $query);
    $row = mysqli_fetch_assoc($name);
    echo $row['nationality'];
    echo "<h6>"; ?>
  </div>
  <a href='editusername.php?currentID=<?php echo $userID; ?>' class="w3-button w3-black w3-block">Edit Profile</a> 
  <a href='deactivate-authenticate.php?currentID=<?php echo $userID; ?>' class="w3-button w3-black w3-block">Deactivate Account</a> 
</div>

 <?php
      if(isset($_POST['create'])){
        echo "<script>window.location.href='create-club.php?currentID=$userID'</script>";
      }
  ?>

<div id="Clubs" class="tabs" style="display:none">
  <h2></h2>
  <div class="w3-container">
  <h2>Active Memberships</h2>
  <form method="POST">
    <button class="w3-button w3-round w3-blue w3-small" name='create'>Create A New Club</button></form>
  <table class="w3-table-all w3-hoverable">
    <thead>
      <tr class="w3-light-grey">
        <th>Club Name</th>
        <th>Club Description</th>
        <th>Date Joined</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php $clubs = null;
      $query = "SELECT * from Club, User, MEMBER_OF where (User.user_id = '$userID' and 
      MEMBER_OF.user_id = User.user_id) and (Club.club_id = MEMBER_OF.club_id)";
      $clubs = mysqli_query($connections,$query);
      if($clubs != null){
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
          <td>
          <a href='club_page.php?db_club_name=$cN&currentID=$userID'>View</a>
          </td>

          </tr>";
        } 
      }}else{
        echo "No Club Memberships";
      }
    ?>
    </tbody>
  </table>
</div>
  <p></p> 
</div>

<div id="Books" class="tabs" style="display:none">
  <h2></h2>

  <?php
      if(isset($_POST['addList'])){
        echo "<script>window.location.href='add-to-hasread.php?currentID=$userID'</script>";
      }
  ?>
  <div class="w3-container">
  <h2>Books Read<form method="POST">
    <button class="w3-button w3-round w3-blue w3-small" name='addList'>Add to Your List</button></form></h2>
  
  <table class="w3-table-all w3-hoverable">
    <thead>
      <tr class="w3-light-grey">
        <th>Book Name</th>
        <th>Book Summary</th>
        <th>Date Finished</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

    <?php
    $books = null;
    $query = "SELECT * from Book, User, HAS_READ where (User.user_id = '$userID' and 
    HAS_READ.userID = User.user_id) and (Book.book_id = HAS_READ.bookID)";
    $books = mysqli_query($connections,$query);
    if($books != null){
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
        <td>
        <a href='book_page.php?currentID=$userID&book_title=$cN'>View</a>
        </td>

        </tr>";
      } 
    }}else{

      echo "<br>No Books Read";
    }
  ?>
    </tbody>
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