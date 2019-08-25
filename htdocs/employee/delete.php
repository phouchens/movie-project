<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

    include ('../includes/header.php');
    require_once ('../../mysqli_connect.php');
    
	$id=$_GET['id']; 
	$query = "DELETE FROM employee WHERE employeeId=$id"; 
	$result = @mysqli_query ($dbc, $query);
    echo '<section class="section" id="form-container">';
    
	if ($result){
		echo "The selected employee has been deleted."; 
	}else {
		echo "The selected employee could not be deleted."; 
    }
    
	echo "<p><a class='button is-primary' href=index.php>Back to Employees</a>"; 
	echo '</section>';
	mysqli_close($dbc);

    include ('../includes/footer.php');
}

?>