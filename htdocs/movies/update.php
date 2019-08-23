<?php
session_start();


if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

	include ("../includes/header.php");
	require_once ('../../mysqli_connect.php');
	$movieId = mysqli_real_escape_string($dbc, $_POST['movieId']);
	$title = mysqli_real_escape_string($dbc, $_POST['title']);
	$genre = mysqli_real_escape_string($dbc, $_POST['genre']);
	$year = mysqli_real_escape_string($dbc, $_POST['year']); 
	$language = mysqli_real_escape_string($dbc, $_POST['langauge']); 
	$actors = mysqli_real_escape_string($dbc, $_POST['actors']); 
    $rating = mysqli_real_escape_string($dbc, $_POST['rating']); 
    $price = mysqli_real_escape_string($dbc, $_POST['price']); 

	$query = "UPDATE movie SET title='$title', genre='$genre', year='$year', language='$language', actors='$actors', rating='$rating', price='$price' WHERE movieId='$movieId'"; 

	$result = @mysqli_query ($dbc, $query); 
	echo '<section class="section" id="form-container">';
	if ($result){
		echo "<center><p><strong>The selected record has been updated.</strong></p>"; 
		echo "<a class='button is-primary' href=index.php>Home</a></center>"; 
	}else {
		echo "<p>The record could not be updated due to a system error" . mysqli_error() . "</p>"; 
	}
	mysqli_close($dbc);

	echo '</section>';
	include ("../includes/footer.php");
}

?>
