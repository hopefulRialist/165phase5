<?php
	include("connections.php");
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
	<a class="active">Deactivate</a>
</div>

<?php
	if(isset($_POST['delete'])){
		$query = "DELETE FROM User WHERE user_id = '$id'";
		if ($connections->query($query) === TRUE) {
    		echo "Record deleted successfully";
    		$_SESSION['loginStatus'] = 0;
    	    echo "<script>window.location.href='index.php'</script>";
		} else {
   			echo "Error deleting record: ";
		}
	}

?>

<link rel="stylesheet" href="w3.css">
 <div class="w3-padding w3-display-middle">
<h2> Are you sure you want to deactivate? We'll miss you<h2>
<form method="POST">
<center>
<button class="w3-button w3-round-large w3-red" name="delete">Yes</button>
</center>
</form>
</div>