<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You are not logged in!";
	exit();
}else{
  
	include ("../includes/header.php");
	require_once ('../../mysqli_connect.php');

     $customerId = mysqli_real_escape_string($dbc, $_POST['customerId']);
     $employeeId = mysqli_real_escape_string($dbc, $_SESSION['id']);
     $rentalDate = mysqli_real_escape_string($dbc, $_POST['rentalDate']);
     $movieId =  mysqli_real_escape_string($dbc, $_POST['movieId']);
     $creditCardNumber = mysqli_real_escape_string($dbc, $_POST['creditCardNumber']);
     $creditCardType = mysqli_real_escape_string($dbc, $_POST['creditCardType']);
     $returnDate = mysqli_real_escape_string($dbc, $_POST['returnDate']);

    $transactionQuer =  "INSERT INTO rental_transaction (customerId, employeeId, rentalDate, movieId, creditCardNumber, creditCardType)
            Values ('$customerId', '$employeeId', '$rentalDate', '$movieId' , '$creditCardNumber', '$creditCardType')";
    $movieQuer = "UPDATE movie SET rented=1, returnDate='$returnDate' WHERE movieId='$movieId'";
    

    if ($transactionQuery and $movieQuery) {
        $transactionResult = @mysqli_query ($dbc, $transactionQuery); 
        $movieResult = @mysqli_query($dbc, $movieQuery);
        echo "<div id='form-container'>
                    <p><strong>The Transaction is complete!</strong></p>
                    <p> The movie " . $_POST['movieTitle'] ." is due back on ". $_POST['returnDate']. "</p>
                    <a class='button is-primary' href=index.php>Home</a></center>
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
