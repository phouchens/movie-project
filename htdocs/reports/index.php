<?php
session_start(); 
include ('../includes/header.php'); 

if (!isset($_SESSION['email']) && $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	echo "<br><a href=../Home/index.php>Home</a>"; 
	exit();
}else{
    echo "<section> Reports page</section>";
 }

?>



