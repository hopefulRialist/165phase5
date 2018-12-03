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
	<a href="profile.php?currentID=<?php echo $userID; ?>">Back</a>
	<a class="active">Create</a>
</div>

<link rel="stylesheet" href="w3.css">

<?php

if(isset($_POST['insert'])){
	$clubname = $_POST['name'];
	$clubdesc = $_POST['desc'];
	$now = date_create()->format('Y-m-d H:i:s');
	$query = "INSERT INTO Club(club_name,description,date_created) VALUES('$clubname', '$clubdesc', '$now')";

	if($connections->query($query) === TRUE){
		echo "<h4>Successful Insert</h4>";
	}					
}

?>


<div class="w3-card-4">
<div class="w3-container w3-blue">
  <h2>Club Details</h2>
</div>
<form method="POST">
<form class="w3-container">
<label>Club Name</label>
<input class="w3-input" type="text" name="name" placeholder='Name'>
<br>
<label>Club Description</label>
<input class="w3-input" type="text" name='desc' placeholder='Description'>
<button class="w3-button w3-round w3-blue w3-medium" name='insert'>Submit</button>
</form>

</div>
