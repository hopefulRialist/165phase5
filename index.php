<?php
$searchTerm = $searchType = "";
$searchTermErr= $searchTypeErr = "";
$loginStatus = "Log In"; #change it to log out once may naka log in na

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
  <link rel="stylesheet" href="main.css">
</head>


<div class="topnav">
   <a class="active" href="#home">Home</a>
   <a href="profile.php">Profile</a>
   <a href="login.php" onclick="document.getElementById('id01').style.display='block'"><?php echo $loginStatus?></a>
   <a href="signup.php" onclick="document.getElementById('id01').style.display='block'">Sign Up</a>
</div>

<br><br><br><br><br><br><br><br>

<center>
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
