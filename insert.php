<?php
	$id = $_GET['currentID'];
	$bookID = $_GET['book_id'];
	include("connections.php");
	$now = date_create()->format('Y-m-d H:i:s');
	
	$query = "INSERT INTO HAS_READ(userID, bookID, dateFINISHED) VALUES('$id', '$bookID', '$now')";

	if(mysqli_query($connections, $query)){
		echo "<script>window.location.href='profile.php?currentID=$id'</script>";
	}else{
		echo "ERROR IN ADDING";
	}
?>