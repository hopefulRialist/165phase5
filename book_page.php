<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<div class="topnav">
   <a href="index.php">Home</a>
   <a href="profile.php" onclick="location.href = profile.php">Profile</a>
   <?php if ((!isset($_SESSION['loginStatus'])) || $_SESSION['loginStatus']== 0): ?>
     <a href="login.php" onclick="">Log In</a>
   <?php else: ?>
     <a href="logout.php" onclick="">Log Out</a>
  <?php endif; ?>
   <a href="signup.php" onclick="">Sign Up</a>
</div>


<center>
<table border="0" width="70%">
<tr>
		<td colspan="4"><hr></td>

	</tr>

	<tr>
		<td><b>Reviewed by</b></td>
		<td><b>Review</b></td>
		<td><b>Rating</b></td>
		<td><b>Time submitted</b></td>
		
	</tr>

	<tr>
		<td colspan="4"><hr></td>

	</tr>





<?php
session_start();
include("connections.php");
if (isset($_SESSION["user_id"])) {

	$user_id=$_SESSION["user_id"];
	

}

$chosen_title=$_GET["book_title"];
$book_query=mysqli_query($connections,"SELECT * FROM reviews,book WHERE book.book_id=reviews.book_id AND book.title='$chosen_title'");
$row=mysqli_fetch_assoc($book_query);
$db_book_title=$row["title"];
$db_book_genre=$row["genre"];
$db_book_summary=$row["summary"];

$b2=mysqli_query($connections,"SELECT * FROM book WHERE book.title='$chosen_title'");
#$b3=mysqli_query($connections,"SELECT * FROM reviews,book WHERE book.book_id=reviews.book_id AND book.title='$chosen_title'");
$row2=mysqli_fetch_assoc($b2);
#$row3=mysqli_fetch_assoc($b3);
$genre=$row2["genre"];
$summary=$row2["summary"];

echo "<h1><font color='#024cb5'>Book Review for $chosen_title</font></h1>";

echo "<h3><font color='#1f86fc'>Genre: $genre</font></h3>";
echo "<h3><font color='#1f86fc'>Summary: $summary</font></h3>";
	$ratings_query=mysqli_query($connections,"SELECT AVG(rating) AS avgRating FROM book,reviews WHERE book.book_id=reviews.book_id and book.title='$chosen_title'");
	$row_ratings=mysqli_fetch_assoc($ratings_query);
	$avg_rating=$row_ratings["avgRating"];
	if($avg_rating>=" "){
		echo "<b>Average Rating: ". round($avg_rating,2). "</b>";
	}

#$count_query=mysqli_query($connections, "SELECT COUNT(*) AS total FROM reviews ");
#$row_count=mysqli_fetch_assoc($count_query);
#$count=$row_count["total"];
#echo "Total reviews: $count"; echo "<br>";



$full_review="";
$review_query=mysqli_query($connections,"SELECT * FROM user,book,reviews WHERE book.book_id=reviews.book_id AND user.user_id=reviews.user_id AND book.title='$chosen_title'");



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
					</tr>
					<tr><td colspan='4'> <hr> </td></tr>";

		}
		
	//	$j=$j-1;
?>
</table>


<form method="POST">
	<input type="submit" name="btnInsert" value="Add Review">
	<input type="submit" name="btnEdit" value="Edit Review">
</form>

<?php


	$name=$review_title=$review_body=$rating="";
	$nameErr=$review_titleErr=$review_bodyErr=$ratingErr="";
	if (isset($_POST["btnSubmit"])) {
		

		if (empty($_POST["review_title"])) {
			$review_titleErr="Review Title is required";
		}else{
			$review_title=$_POST["review_title"];

		}

		if (empty($_POST["review_body"])) {
			$review_bodyErr="Review Body is required";
		}else{
			$review_body=$_POST["review_body"];
		}

		if (empty($_POST["rating"])) {
			$ratingErr="Rating is required";
		}elseif((is_numeric($_POST["rating"]))){
			if($_POST["rating"]>=0.0 && $_POST["rating"]<10.1){
				$rating=$_POST["rating"];
			}else{
				$rating="";
				echo "<h3><font color='red'>Please enter a rating from 0-10</font></h3>";;
			}
		}else{
			$rating="";
			echo "<h3><font color='red'>Please enter a rating from 0-10</font></h3>";
		}
		if($review_title && $review_body && $rating){
			#$check_name = strlen($name);

				$check_review_title = strlen($review_title);
				
				if ($check_review_title < 2) {
					$review_titleErr="Review Title is too short";
					
				}else{
					$check_review_body = strlen($review_body);
					if ($check_review_body < 2) {
						$review_bodyErr="Review Body is too short";
					}else{
						$user_name=mysqli_query($connections,"SELECT name FROM user WHERE user_id='$user_id'");
						$book_id=mysqli_query($connections,"SELECT book_id FROM book WHERE title='$chosen_title'");
						$book_row=mysqli_fetch_assoc($book_id);
						$db_book_id=$book_row["book_id"];
						#mysqli_query($connections,"INSERT INTO review(user_id,book_id,title,body,rating,time_submitted) VALUES('$user_id','$book_id','$review_title','$review_body','$rating',now() )";
						mysqli_query($connections,"INSERT INTO reviews(user_id,book_id,title,body,rating,time_submitted) VALUES('$user_id','$db_book_id','$review_title','$review_body','$rating',now())");
						
						echo "<script>window.location.href='book_page.php?book_title=$chosen_title'</script>";
						
					}
				}
			
		}
	

}

?>

<?php
	
	if (isset($_POST["btnInsert"])){
		$book_id=mysqli_query($connections,"SELECT book_id FROM book WHERE title='$chosen_title'");
		$book_row=mysqli_fetch_assoc($book_id);
		$db_book_id=$book_row["book_id"];
		$the_id=mysqli_query($connections,"SELECT * FROM reviews,user WHERE user.user_id='$user_id' AND reviews.book_id='$db_book_id' AND user.user_id=reviews.user_id ");
		$num_row=mysqli_num_rows($the_id);
		if($num_row<1){
			
echo"

<form method = 'POST'>
	<input type='text' name='review_title' required placeholder='Review Title'>	<br>
	<input type='text' name='review_body' required placeholder='Review Body'><br>
	<input type='text' name='rating' required placeholder='Rating' ><br>

	<input type='submit' name='btnSubmit' value='Submit'><br>

</form>
"; 

}
else{
	echo "<h3><font color='red'>You have an existing review for this book!</font></h3>" ;
	
	echo "<h3><font color='red'>You can change your review for this book anytime, just click the edit review button</font> </h3>";
}

}
?>
<?php if(isset($_POST["btnEdit"])){
	$book_query=mysqli_query($connections,"SELECT * FROM reviews,book WHERE book.book_id=reviews.book_id AND book.title='$chosen_title'");
	$book_row=mysqli_fetch_assoc($book_query);
	$book_id=$book_row["book_id"];
	$get_record = mysqli_query($connections, "SELECT * FROM reviews WHERE user_id='$user_id' AND book_id='$book_id'");
	$get_record_num= mysqli_num_rows($get_record);  #check if may record ba

	if($get_record_num>0){
	echo "<script>window.location.href='book_page_edit.php?book_title=$chosen_title&user_id=$user_id'</script>";
	}
	else{
		echo "<h3><font color='red'>You have nothing to edit</font></h3>";
		echo "<h3><font color='red'>Please add a review first</font></h3>";
	}
}
?>



