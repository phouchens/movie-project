<?php
session_start(); 
include ('../includes/header.php'); // Include the header file.
// Print a customized message:
if (!isset($_SESSION['email'])){
	echo "<h1>You have not logged in yet!</h1>";
} else {
	echo "<section class='section'><h1>Logged In!</h1><p>session" . $_SESSION['firstName'] . " "  .$_SESSION['role'] ."!</p>
	<p>You can now enjoy our services for logged in users. Click 'My Bookmarks' to get started!</p></section>";

} 
?>
<?
include ('../includes/footer.php'); //Include the footer file.
?>
