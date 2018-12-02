<?php
session_start();
include("connections.php");
$searchTerm = $_GET['searchTerm'];
$searchType = $_GET['searchType'];
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
 
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
    <a href="index.php">Home</a>
    <a href="login.php" onclick="">Log In</a>
    <a href="signup.php" onclick="">Sign Up</a>
   <?php else:  $currID = $_GET['currentID']; ?>
    <a href="index_loggedin.php?currentID=<?php echo $currID; ?>">Home</a>
    <a href="profile.php?currentID=<?php echo $currID; ?>">Profile</a>
    <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
  
</div>

<table border="0" width="100%">
<tr>
		<td colspan="7"><hr></td>

	</tr>

	<tr>
    <?php if ($searchType == "Person"): ?>
        <td><b><p>Name</p></b></td>
    <?php elseif ($searchType == "Book"): ?>
        <td><b><p>Title</p></b></td>
    <?php elseif ($searchType == "Club"): ?>
        <td><b><p>Club</p></b></td>
    <?php endif;?>

	</tr>

	<tr>
		<td colspan="7"><hr></td>

	</tr>

  <?php

  if($searchTerm && $searchType) {

      if ($searchType == "Person") { //DONE
        $query = "SELECT * FROM User WHERE name LIKE '%$searchTerm%'";
        $name_query = mysqli_query($connections,$query);
        while ($row=mysqli_fetch_assoc($name_query)) {
          $db_id = $row["user_id"];
          $db_name=$row["name"];
     
          if((!isset($_GET['currentID']))):
            echo "<tr> <td> <h2>$db_name</h2>
            <td> <a href='userview.php?id=$db_id&user_name=$db_name&searchType=$searchType&searchTerm=$searchTerm'><h2>View</h2></a> </td>";
          else:
             $currID = $_GET['currentID'];
             echo "<tr> <td> <h2>$db_name</h2>
             <td> <a href='userview.php?currentID=$currID&id=$db_id&user_name=$db_name&searchType=$searchType&searchTerm=$searchTerm'><h2>View</h2></a> </td>";
          endif;
          
          echo "</tr>";
        }
      }

      elseif ($searchType == "Book") { //DONE
        $query = "SELECT title FROM Book WHERE title LIKE '%$searchTerm%'";
        $book_query = mysqli_query($connections,$query);
        while ($row=mysqli_fetch_assoc($book_query)) {
          $db_book_title=$row["title"];
          echo"
          <tr>
            <td> <a href='book_page.php?book_title=$db_book_title'><h2>$db_book_title</h2></a> </td>
          </tr>
          ";
        }
      }

      elseif ($searchType == "Club") {
        $query = "SELECT * FROM Club WHERE club_name LIKE '%$searchTerm%'";
        $club_query = mysqli_query($connections,$query);
        while ($row=mysqli_fetch_assoc($club_query)) {
          $db_club_name=$row["club_name"];
          echo"
          <tr>
            <td> <a href='club_page.php?db_club_name=$db_club_name'><h2>$db_club_name</h2></a> </td>
          </tr>
          ";
        }
        if (isset($_POST['btnViewClub'])) {

        }
      }else{
        echo"<tr>
         No Results Found
        </tr>";
      }

  }




  ?>
