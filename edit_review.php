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
$get_record_num= mysqli_num_rows($get_record);  #check if may record ba

if($get_record_num>0){
   
  while($row=mysqli_fetch_assoc($get_record)){
    $db_title=$row["title"];
    $db_body=$row["body"];
    $db_rating=$row["rating"];
  }

   $name_edit=$review_title_edit=$review_body_edit=$rating_edit="";
  $nameErr_edit=$review_titleErr_edit=$review_bodyErr_edit=$ratingErr_edit="";


  if(isset($_POST["btnSubmitEdit"])){

   if (empty($_POST["review_title_edit"])) {
            $review_titleErr_edit="Review Title is required";
        }else{
      $review_title_edit=$_POST["review_title_edit"];
      $db_title=$review_title_edit;
    }

     if (empty($_POST["review_body_edit"])) {
            $review_bodyErr_edit="Review Body is required";
        }else{
     $review_body_edit=$_POST["review_body_edit"];
      $db_body=$review_body_edit;
    }   

    if (empty($_POST["rating_edit"])) {
            $ratingErr_edit="Rating is required";
        }else{
          if(is_numeric($_POST["rating_edit"])){
            if($_POST["rating_edit"]>=0.0 && $_POST["rating_edit"]<=10.0){
                $rating_edit=$_POST["rating_edit"];
                $db_rating=$rating_edit;
            }
            else{
                $db_rating="Rating: 0-10";
            }
          }
          else{
            $db_rating="Rating: 0-10";
          }
      
    }
    
     if($review_title_edit && $review_body_edit && $rating_edit){
            #$check_name = strlen($name);
      #  echo $chosen_title;
            $user_name=mysqli_query($connections,"SELECT name FROM user WHERE user_id='$user_id'");
            $book_id=mysqli_query($connections,"SELECT book_id FROM book WHERE title='$chosen_title'");
            $book_row=mysqli_fetch_assoc($book_id);
            $db_book_id=$book_row["book_id"];
            #mysqli_query($connections,"INSERT INTO review(user_id,book_id,title,body,rating,time_submitted) VALUES('$user_id','$book_id','$review_title','$review_body','$rating',now() )";
            mysqli_query($connections,"UPDATE reviews set
                title='$review_title_edit',
                body='$review_body_edit',
                rating='$rating_edit',
                time_submitted=now()
                WHERE user_id='$user_id' AND book_id='$db_book_id'
                        ");

                echo "<script>window.location.href='book_page.php?book_title=$chosen_title&currentID=$user_id'</script>";
  
        }

    

  }

?>

<?php
                $title=$_GET["book_title"];
                $id=$user_id;

?>
<form method = "POST">
    <input type="text" name="review_title_edit" required placeholder="Review Title" value="<?php echo $db_title;?>">    <br>
    <input type="text" name="review_body_edit" required placeholder="Review Body" value="<?php echo $db_body;?>"><br>
    <input type="text" name="rating_edit" required placeholder="Rating" value="<?php echo $db_rating;?>"><br>


    <input type="submit" name="btnSubmitEdit" value="Submit"><br>
    &nbsp;


   </form>


<?php
}
else{
  echo "<h1> No record found</h1>";
}



?>