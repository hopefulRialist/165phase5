<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<?php $user_id = $_GET['currentID']; 
	  $book = $_GET['book_title'];?>

<div class="topnav">

    <a href="book_page.php?currentID=<?php echo $user_id ?>&book_title=<?php echo $book; ?>">Back</a>
    <a href="profile.php?currentID=<?php echo $user_id ?>" onclick="location.href = profile.php">Profile</a>
    <a href="logout.php" onclick="">Log Out</a>

</div>
<center>
<table border="0" width="70%">
<tr>
		<td colspan="5"><hr></td>

	</tr>

	<tr>
		<td><b>Reviewed by</b></td>
		<td><b>Review</b></td>
		<td><b>Rating</b></td>
		<td><b>Time submitted</b></td>
		<td><b><center>Option</center></b></td>
		
	</tr>

	<tr>
		<td colspan="5"><hr></td>

	</tr>




<?php
session_start();
include("connections.php");

$chosen_title=$_GET["book_title"];



$book_query=mysqli_query($connections,"SELECT * FROM user,reviews,book WHERE book.book_id=reviews.book_id AND user.user_id='$user_id' AND reviews.user_id=user.user_id AND book.title='$chosen_title'");
$row=mysqli_fetch_assoc($book_query);
$db_book_title=$row["title"];
$db_book_genre=$row["genre"];
$db_book_summary=$row["summary"];
?>


<?php
echo "<h1><font color='#024cb5'>Book Review for $db_book_title</font></h1>";

echo "<h3><font color='#1f86fc'>Genre: $db_book_genre</font></h3>";
echo "<h3><font color='#1f86fc'>Summary: $db_book_summary</font></h3>";



$full_review="";
$review_query=mysqli_query($connections,"SELECT * FROM user,book,reviews WHERE book.book_id=reviews.book_id AND user.user_id='$user_id' AND reviews.user_id=user.user_id AND book.title='$chosen_title'");



		while($row2=mysqli_fetch_assoc($review_query)){

		
			$db_title=$row2["title"];
			$db_rating=$row2["rating"];
			$db_review=$row2["body"];
			$db_reviewer=$row2["name"];
			$db_time_submitted=$row2["time_submitted"];
			$full_review=$db_title . ": " . $db_review;
			//if($i==0){
			echo"
			<tr>
					<td>$db_reviewer</td>
					<td>$full_review</td>
					<td>$db_rating</td>
					<td>$db_time_submitted</td>
					<td>
						<center><a href='edit_review.php?book_title=$chosen_title&currentID=$user_id'>Edit</a>
						|
						<a href='delete_review.php?book_title=$chosen_title&currentID=$user_id'>Delete</a>
					</td>
					</tr>
					<tr><td colspan='5'> <hr> </td></tr>";

		}
		
	//	$j=$j-1;
?>
</table>
