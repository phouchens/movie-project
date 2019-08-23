<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	exit();
}else{
    include ('../includes/header.php');
    
    require_once ('../../mysqli_connect.php');
    
	echo '<section class="section" id="form-container">';
	$id=$_GET['id'];  
	$query = "SELECT * FROM customer WHERE customerId=$id"; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<strong>".$row['title']."</strong>"; 
		} 
		echo "<div>";
		echo "<br>Are you sure that you want to delete this record?<br>";
		echo "<a class='button is-danger' href=delete.php?id=".$id.">YES</a> 
			<a class='button is-light' href=index.php>NO</a></div>";    
	}else{ 
		echo '<p>There is no such record.</p>';
	}
    echo '</section>';
    
	mysqli_close($dbc); 

	include ('../includes/footer.php');
}

?>
