<?php
	include("connections.php");
	$id = $_GET['currentID'];
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link type = "text/css" rel="stylesheet" href="main.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans|Proza+Libre" rel="stylesheet">
</head>


<div class="topnav">
	<a href="profile.php?currentID=<?php echo $id; ?>">Back</a>
	<a class="active">Add To List</a>
</div>

<html>
<link rel="stylesheet" href="w3.css">

<table class="w3-table-all w3-hoverable">
<tr class="w3-blue">
  <th>Title</th>
  <th>Summary</th>
  <th></th>
</tr>
<?php
	$books = null;
    $query = "SELECT * from Book";
    $books = mysqli_query($connections,$query);
    if($books != null){
	    if(mysqli_num_rows($books) > 0){
	      while ($r=mysqli_fetch_assoc($books)) {
	      	$bID = $r['book_id'];
	        $cN = $r['title'];
	        $stat = $r['summary'];
	        echo "<tr>
	        <td> 
	        $cN
	        </td>
	        <td> 
	        $stat
	        </td>
	        <td>
	        <a href='insert.php?book_id=$bID&currentID=$id'>Add</a>
			</td>
	        </tr>";
	      } 
	    }
	}else{
      echo "<br>No Books Read";
    }
?>

</table>
</html>
