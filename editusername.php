<html>
<link rel="stylesheet" href="w3.css">
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

<?php
	if(isset($_POST['user'])){
		$new = $_POST['userText'];
		$query = "UPDATE User SET name ='$new' WHERE user_id = '$id'";

		if($connections->query($query) === TRUE){
			echo "<script>window.location.href='profile.php?currentID=$id'</script>";
		}else{
			echo "ERROR FOUND";
		}
	}

	if(isset($_POST['nationality'])){
		$new = $_POST['nat'];
		$query = "UPDATE User SET nationality ='$new' WHERE user_id = '$id'";

		if($connections->query($query) === TRUE){
			echo "<script>window.location.href='profile.php?currentID=$id'</script>";
		}else{
			echo "ERROR FOUND";
		}
	}

?>

<div class="topnav">
	<a href="profile.php?currentID=<?php echo $id; ?>">Back</a>
	<a class="active">Edit</a>
</div>

<div class="w3-card-4">
<div class="w3-container w3-blue">
  <h2>Edit Your Information</h2>
</div>
<form method="POST">
<form class="w3-container">
<label>Edit UserName</label>
<input class="w3-input" type="text" name="userText" placeholder='Username'>
<button class="w3-button w3-round w3-blue w3-small" name='user'>Submit</button>
<br><br>
<label>Edit Nationality</label>
<input class="w3-input" type="text" name='nat' placeholder='Nationality'>
<button class="w3-button w3-round w3-blue w3-small" name='nationality'>Submit</button>
</form>

</div>


</html>