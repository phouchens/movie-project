<?php
session_start(); 
include ('../includes/header.php'); 

if (!isset($_SESSION['email']) && $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	echo "<br><a href=../Home/index.php>Home</a>"; 
	exit();
}else{
	echo "<h2 class='is-size-2 has-text-centered'>Reports</h2>";
	echo "<section class='section' id='form-container'>";
?>
	<a class='button is-primary' href=printCsv.php>Print All Movies Report</a></td>
	<br/>
	<br/>
	<a class='button is-primary' href=printUsersCsv.php>Print All Customers Report</a></td>
	<br/>
	<br/>
	<a class='button is-primary' href=rentedMovies.php>Show Rented Movies Report</a></td>

<?
	echo "</section>";
	include ("../includes/footer.php");
}
?>