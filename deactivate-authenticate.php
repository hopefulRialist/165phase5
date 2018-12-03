<?php
	include("connections.php");
	$id = $_GET['currentID'];
?>

<?php
	$password = $AGAINpassword = "";
	$passwordErr = $password_repeatErr = "";

	if(isset($_POST['btnSearch'])){
		$password = $_POST['Password'];
		$AGAINpassword = $_POST['RepeatPass'];

		if ($password!= $AGAINpassword) {
    		$password_repeatErr = "Password does not match";
    	}	else {
    		$query = "SELECT * from User where User.user_id = '$id'";
    		$getPass = mysqli_query($connections,$query);
    		$row = mysqli_fetch_assoc($getPass);
    		if(password_verify($password,$row['password'])){
				$passwordErr = $password_repeatErr = "";
				echo "<script>window.location.href='delete-user.php?currentID=$id'</script>";
    		}else{
    			$password_Err = "Password does not match";
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
	<a href="profile.php?currentID=<?php echo $id; ?>">Back</a>
	<a class="active">Deactivate</a>
</div>

<html>

<link rel="stylesheet" href="w3.css">
<h1>Enter your Password for Authentication<h1>

<form class="w3-container" method="POST">

<label class="w3-text-blue"><b>Password</b></label>
<input class="w3-input w3-border" type="password" name="Password" required  autocomplete="new-password">
 
<label class="w3-text-blue"><b>Repeat Password</b></label>
<input class="w3-input w3-border" type="password" name="RepeatPass" required autocomplete="new-password">
<br>
<input type = "submit" name="btnSearch" value="Authenticate">
<span class = "error"> <?php echo $password_repeatErr; ?></span><br>
<span class = "error"> <?php echo $passwordErr; ?></span><br>
</form>
</html>