<html>
<link rel="stylesheet" href="w3.css">
<?php
	session_start();
	$id = $_GET['currentID'];
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
	<a href="profile.php?currentID=<?php echo $id; ?>">Back</a>
	<a class="active">Edit</a>
</div>

<div class="w3-card-4">

<div class="w3-container w3-green">
  <h2>Header</h2>
</div>

<form class="w3-container">

<label>First Name</label>
<input class="w3-input" type="text">

<label>Last Name</label>
<input class="w3-input" type="text">

</form>

</div>


</html>