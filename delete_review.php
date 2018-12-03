<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>

<?php $user_id = $_GET['currentID']; 
    $chosen_title = $_GET['book_title'];?>

<div class="topnav">
 
    <a href="book_page_edit.php?currentID=<?php echo $user_id ?>&book_title=<?php echo $chosen_title; ?>">Back</a>
    <a href="profile.php?currentID=<?php echo $user_id ?>" onclick="location.href = profile.php">Profile</a>
    <a href="logout.php" onclick="">Log Out</a>

</div>
<center>
<?php
session_start();
include("connections.php");
?>

<?php
$book_query=mysqli_query($connections,"SELECT * FROM reviews,book WHERE book.book_id=reviews.book_id AND book.title='$chosen_title'");
$book_row=mysqli_fetch_assoc($book_query);
$book_id=$book_row["book_id"];

$get_record = mysqli_query($connections, "SELECT * FROM reviews WHERE user_id='$user_id' AND book_id='$book_id'");
$check_get_record= mysqli_num_rows($get_record);  #check if may record ba

if($check_get_record>0){
  #$row=mysqli_fetch_assoc($get_record);

  if(isset($_POST["btnDelete"])){
    mysqli_query($connections,"DELETE FROM reviews WHERE user_id='$user_id' AND book_id='$book_id'");
     echo "<script>window.location.href='book_page.php?book_title=$chosen_title&currentID=$user_id'</script>";
  }


  #$db_gender=$row["gender"];
  #$db_email=$row["email"];
?>
<form method="POST">
  <h1><b> <font color="red">You are about to delete your review for this book</font></b></h1>
  <br>
  <h3><b>Are you sure?</b></h3>
  <br>
  <input type="submit" name="btnDelete" value="Delete">
  &nbsp;
  <a href='book_page_edit.php?book_title=<?php echo $chosen_title?>&currentID=<?php echo $user_id ?>'><b>Cancel</b></a>


<?php

}else{
  echo "<h1>404 PAGE NOT FOUND</h1>";
}



?>