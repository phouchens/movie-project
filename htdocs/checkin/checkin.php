<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You are not logged in!";
	exit();
}else{
  
    include ("../includes/header.php");
    include '../includes/helpers.php';
	require_once ('../../mysqli_connect.php');

    console_log($_POST);

    $transactionId = mysqli_real_escape_string($dbc, $_POST['transactionId']);
    $movieId =  mysqli_real_escape_string($dbc, $_POST['movieId']);
    $actualReturnDate =  mysqli_real_escape_string($dbc, $_POST['returnDate']);

    $transactionQuery =  "UPDATE rental_transaction SET completed=1, actualReturnDate=NOW() WHERE transactionId = '$transactionId' ";
    $movieQuery = "UPDATE movie SET rented=0, returnDate=NULL WHERE movieId='$movieId'";
    $transactionResult = @mysqli_query ($dbc, $transactionQuery); 
    $movieResult = @mysqli_query($dbc, $movieQuery);

    if ($transactionResult and $movieResult) {
        echo "<div id='form-container'>
                    <p><strong>The Transaction is complete!</strong></p>
                    <p> The movie " . $_POST['returnMovieTitle'] ." has been returned </p>
                    <a class='button is-primary' href=index.php>Home</a>
                </div>";
    }
    else{
        echo "<div id='form-container'>
                <p>The transcation could not go through due to a system error" . mysqli_error() . "</p>
                 <a class='button is-primary' href=index.php>Home</a></center>
              </div>"; 
    }

	mysqli_close($dbc);

	echo '</section>';
	include ("../includes/footer.php");
}

?>
