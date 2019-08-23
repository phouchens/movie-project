<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You are not logged in!";
	exit();
}else{
  
    include ("../includes/header.php");
    include '../includes/helpers.php';
	require_once ('../../mysqli_connect.php');

     $customerId = mysqli_real_escape_string($dbc, $_POST['customerId']);
     $employeeId = mysqli_real_escape_string($dbc, $_SESSION['id']);
     $rentalDate = mysqli_real_escape_string($dbc, $_POST['rentalDate']);
     $returnDate = mysqli_real_escape_string($dbc, $_POST['returnDate']);
     $movieId =  mysqli_real_escape_string($dbc, $_POST['movieId']);
     $movieTitle = mysqli_real_escape_string($dbc, $_POST['movieTitle']);
     $creditCardNumber = mysqli_real_escape_string($dbc, $_POST['creditCardNumber']);
     $creditCardType = mysqli_real_escape_string($dbc, $_POST['creditCardType']);
     $price =  mysqli_real_escape_string($dbc, preg_replace("/[^0-9.]/", "", $_POST['moviePrice']));
     $returnDate = mysqli_real_escape_string($dbc, $_POST['returnDate']);

    $transactionQuery =  "INSERT INTO rental_transaction (customerId, employeeId, returnDate, movieId, movieTitle, creditCardNumber, creditCardType, price, completed)
            Values ('$customerId', '$employeeId', '$returnDate', '$movieId', '$movieTitle', '$creditCardNumber', '$creditCardType', '$price', 0)";
    $movieQuery = "UPDATE movie SET rented=1, returnDate='$returnDate' WHERE movieId='$movieId'";
    $customerQuery = "SELECT * FROM customer WHERE customerId = '$customerId'";
    $cusomerResult =  @mysqli_query ($dbc, $customerQuery);
	$num = mysqli_num_rows($cusomerResult);

    if ($num == 0) {
        echo "<div id='form-container'>
        <p>The transcation could not go through due to a system error" . mysqli_error() . "</p>
        <p>customer does not exist, please add customer first.</p>
         <a class='button is-primary' href=../customers/add.php>Add Customer</a>
      </div>";  
    }
    elseif (@mysqli_query($dbc, $transactionQuery) and @mysqli_query($dbc, $movieQuery)) {
        echo "<div id='form-container'>
                    <p><strong>The Transaction is complete!</strong></p>
                    <p> The movie " . $_POST['movieTitle'] ." is due back on ". $_POST['returnDate']. "</p>
                    <a class='button is-primary' href=index.php>Home</a>
                </div>";
    }
    else{
        echo "<div id='form-container'>
                <p>The transcation could not go through due to a system error" . mysqli_error() . "</p>
                 <a class='button is-primary' href=index.php>Home</a>
              </div>"; 
    }

	mysqli_close($dbc);

	echo '</section>';
	include ("../includes/footer.php");
}

?>
