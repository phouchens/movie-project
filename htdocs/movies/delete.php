<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

    include ('../includes/header.php');
    require_once ('../../mysqli_connect.php');
    
    $id=$_GET['id']; 
    $query = "DELETE FROM movie WHERE movieId=$id"; 
	$result = @mysqli_query ($dbc, $query);
    echo '<section class="section" id="form-container">';
    
	if ($result){
		echo "The selected movie has been deleted."; 
	}else {
		echo "The selected movie could not be deleted."; 
    }
    
	echo "<p><a class='button is-primary' href=index.php>Back to movies</a>"; 
	echo '</section>';
	mysqli_close($dbc);

    include ('../includes/footer.php');
}

?>