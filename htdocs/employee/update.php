<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You are not logged in!";
	exit();
}else{

	include ("../includes/header.php");
	require_once ('../../mysqli_connect.php');

	$id = mysqli_real_escape_string($dbc, $_POST['employeeId']);
	$role = mysqli_real_escape_string($dbc, $_POST['role']);
	$firstName = mysqli_real_escape_string($dbc, $_POST['firstName']); 
	$lastName = mysqli_real_escape_string($dbc, $_POST['lastName']); 
	$email = mysqli_real_escape_string($dbc, $_POST['email']); 
	$phone = mysqli_real_escape_string($dbc, $_POST['phone']); 

	$query = "UPDATE employee SET role='$role', firstName='$firstName', lastName='$lastName', email='$email', phone='$phone' WHERE employeeId='$id'"; 
	
	$result = @mysqli_query ($dbc, $query); 
	echo '<section class="section" id="form-container">';
	if ($result){
		echo "<center><p><strong>The selected record has been updated.</strong></p>"; 
		echo "<a class='button is-primary' href=index.php>Employee Management</a></center>"; 
	}else {
		echo "<p>The record could not be updated due to a system error" . mysqli_error() . "</p>"; 
	}
	mysqli_close($dbc);

	echo '</section>';
	include ("../includes/footer.php");
}

?>
