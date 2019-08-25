<?php 

session_start(); 

if (!isset($_SESSION['email'])) {
	header("Location: index.php");
	exit(); 
} else { 
	$_SESSION = array(); 
	session_destroy(); 
}

include ('../includes/header.php');

echo "<section class='section' id='form-container'><h1>Logged Out!</h1>
<p>You are now logged out!</p>
<p><br /><br /></p></section>";

include ('../includes/footer.php');
?>
