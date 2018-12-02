<?php
/*
search result page*/
/*
signup keeps just showing  error 1
LOGOUT
PHP IF STATEMENT: https://stackoverflow.com/questions/722379/can-html-be-embedded-inside-php-if-statement
VARIABLE ACCESS: https://stackoverflow.com/questions/18588972/how-to-access-a-variable-across-two-files
STILL NEED VAR ACCESS AND HOW TO MODIFY IT FROM ANOTHER FILE
*/
session_start();
include ("global.php");
include ("connections.php");
$searchTerm = $searchType = "";
$searchTermErr= $searchTypeErr = "";

if (isset($_POST["btnSearch"])) { #if search button was pushed
  if (empty($_POST["searchTerm"])){ #if there was no search term
    $searchTermErr = "Search Term required";
  } else {  #if there was a term put it into searchTerm variable
    $searchTerm = $_POST["searchTerm"];
  }
}
  if (isset($_POST["btnSearch"])) { #if search button was pushed
    if (empty($_POST["searchType"])){
      $searchTypeErr = "Filter required";
    } else {
      $searchType = $_POST["searchType"];
    }
  }

  if($searchTerm && $searchType) {
    $c_searchTerm = strlen($searchTerm);
    if ($c_searchTerm < 2) {
      $searchTermErr = "Search Term has too few characters";
    }
  }

?>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
   <a class="active" href="#home">Home</a>
   <a href="profile.php" onclick="location.href = profile.php">Profile</a>
   <?php if ($_SESSION['loginStatus'] == 0): ?>
     <a href="login.php" onclick="">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   <a href="signup.php" onclick="">Sign Up</a>
</div>

<br><br>


<center>
  <img src="open-book.png">
  <br><br><br>
  <form method = "POST">
      <input type="text" name="searchTerm" placeholder="Search" value="<?php echo $searchTerm; ?>">
      <select name = "searchType">
        <option name = "searchType" value="">Filter</option>
        <option name = "searchType" <?php if ($searchType =="Person") { echo "selected";}?> value="Person">Person</option>
        <option name = "searchType" <?php if ($searchType =="Book") { echo "selected";}?> value="Book">Book</option>
        <option name = "searchType" <?php if ($searchType =="Club") { echo "selected";}?> value="Club">Club</option>
      </select>
      <br>
      <span class = "error"><?php echo $searchTypeErr; ?> </span>
      <br>
      <span class = "error"><?php echo $searchTermErr; ?> </span>
      <br>
      <input type = "submit" name="btnSearch" value="Search">
  </form>
</center>
