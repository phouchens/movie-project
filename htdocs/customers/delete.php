<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

    include ('../includes/header.php');
    require_once ('../../mysqli_connect.php');
    
	$id=$_GET['id']; 
	$query = "DELETE FROM customer WHERE customerId=$id"; 
	$result = @mysqli_query ($dbc, $query);
    echo '<section class="section" id="form-container">';
    
	if ($result){
		echo "The selected customer has been deleted."; 
	}else {
		echo "The selected customer could not be deleted."; 
    }
    
	echo "<p><a class='button is-primary' href=index.php>Back to Customers</a>"; 
	echo '</section>';
	mysqli_close($dbc);

    include ('../includes/footer.php');
}

?>