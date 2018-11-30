
<?php
include("db_connection.php");

$searchTerm = $searchType = "";
$searchTermErr= $searchTypeErr = "";
$loginStatus = "Log In"; #change it to log out once may naka log in na

if (isset($_POST["btnSearch"])) { #if search button was pushed
  if (empty($_POST["searchTerm"])){ #if there was no search term
    $searchTermErr = "Search Term required";
  } else {  #if there was a term put it into searchTerm variable
    $searchTerm = $_POST["searchTerm"];
  }

  if (empty($_POST["searchType"])){
    $searchTypeErr = "Filter required";
  } else {
    $searchType = $_POST["searchType"];
  }

  if($searchTerm && $searchType) {
    $c_searchTerm = strlen($searchTerm);
    if ($c_searchTerm < 2) {
      $searchTermErr = "Search Term has too few characters";
    }
    $conn = OpenCon();
    // changes characters used in html to their equivalents, for example: < to &gt;
    $searchTerm = htmlspecialchars($searchTerm);

    // makes sure nobody uses SQL injection
    $searchTerm = mysqli_real_escape_string($conn, $searchTerm); 
    
    if($searchType == "Person"){
      $rawResults = mysqli_query($conn, "SELECT * FROM user  WHERE  (user.USERNAME LIKE '%".$searchTerm."%')"); 
    } elseif($searchType == "Book"){
      $rawResults = mysqli_query($conn, "SELECT * FROM book  WHERE  (book.TITLE LIKE '%".$searchTerm."%')"); 
    } elseif($searchType == "Club"){
      $rawResults = mysqli_query($conn, "SELECT * FROM club WHERE  (club.CLUBNAME LIKE '%".$searchTerm."%')"); 
    }
   
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

<p class="scroll">

<?php //iterates through the search results
      if(mysqli_num_rows($rawResults) > 0){ //checks num of results
         while($results = mysqli_fetch_array($rawResults)){
              //  $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
                echo "<p><h3>".$results[1]."</p>";
               // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
      }else{ //if no matching results are found
      echo "No Results Found";
    }
?>
 
