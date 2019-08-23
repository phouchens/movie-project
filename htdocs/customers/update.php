<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

	include ("../includes/header.php");
	require_once ('../../mysqli_connect.php');

	$id = mysqli_real_escape_string($dbc, $_POST['id']);
	$firstName = mysqli_real_escape_string($dbc, $_POST['firstName']); 
	$lastName = mysqli_real_escape_string($dbc, $_POST['lastName']); 
	$email = mysqli_real_escape_string($dbc, $_POST['email']); 
	$phone = mysqli_real_escape_string($dbc, $_POST['phone']); 
	$address = mysqli_real_escape_string($dbc, $_POST['address']); 

	$query = "UPDATE customer SET firstName='$firstName', lastName='$lastName', email='$email', phone='$phone', address='$address' WHERE customerId='$id'"; 
	
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
