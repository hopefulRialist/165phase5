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
include ("connections.php");
$searchTerm = $searchType = "";
$searchTermErr= $searchTypeErr = "";

if (isset($_POST["btnSearch"])) { #if search button was pushed
  if (empty($_POST["searchTerm"])){ #if there was no search term
    $searchTermErr = "Search Term required";
  } else {  #if there was a term put it into searchTerm variable
    $searchTerm = $_POST["searchTerm"];
    $_SESSION['searchTerm'] = $searchTerm;
  }

  if (empty($_POST["searchType"])){
    $searchTypeErr = "Filter required";
  } else {
    $searchType = $_POST["searchType"];
    $_SESSION['$searchType'] = $searchType;
  }

  if($searchTerm && $searchType) {
    $c_searchTerm = strlen($searchTerm);
    if ($c_searchTerm < 2) {
      $searchTermErr = "Search Term has too few characters";
    } else {
      if(isset($_GET['currentID'])){ $currentID = $_GET['currentID'];
        echo "<script>window.location.href='search_results.php?searchTerm=$searchTerm&searchType=$searchType&currentID=$currentID'</script>";
      }else{ 
        echo "<script>window.location.href='search_results.php?searchTerm=$searchTerm&searchType=$searchType'</script>";
      }
      //header("Location: search_results.php");
    }

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
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
    <a href="login.php" onclick="">Log In</a>
    <a href="signup.php" onclick="">Sign Up</a>
   <?php else: $currentID = $_GET['currentID']; ?>
    <a href="profile.php?currentID=$currentID">Profile</a>
    <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
 
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
      <span class = "error"><?php echo $searchTermErr; ?> </span>
      <br>
      <span class = "error"><?php echo $searchTypeErr; ?> </span>
      <br>
      <input type = "submit" name="btnSearch" value="Search">
  </form>
</center>
