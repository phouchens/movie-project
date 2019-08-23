<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

	include ("../includes/header.php");

	require_once ('../../mysqli_connect.php');

	$id=$_GET['id']; 
	$query = "SELECT * FROM customer WHERE customerId = $id" ; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	echo '<section class="section" id="form-container">';
	if ($num > 0) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
	<h2 class='is-size-2'>Update Record</h2>
	<form action="update.php" method="post" id="form-item">		
		<div class="field">
 			<label class="label">First Name:</label>
  			<div class="control">
    			<input class="input" name="firstName" type="text" size=50 required value="<? echo $row['firstName']; ?>">
  			</div>
		</div>

        <div class="field">
 			<label class="label">Last Name:</label>
  			<div class="control">
    			<input class="input" name="lastName" type="text" size=50 required value="<? echo $row['lastName']; ?>">
  			</div>
		</div>

        <div class="field">
			<label class="field-label ">Email Address:</label>
			<div class="control">
			<input class="input" type="text" name="email" size="20" maxlength="40" placeholder="youremail@provider.com"required value="<? echo $row['email']; ?>"/>
			</div>
		</div>

        <div class="field">
			<label class="field-label ">Phone Number</label>
			<div class="control">
			<input class="input" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" size="20" placeholder="111-111-1111" value="<? echo $row['phone']; ?>"/>
			</div>
		</div>

		<div class="field">
			<label class="field-label ">Address:</label>
			<div class="control">
			<input class="input" type="text" name="address" size="50" placeholder="123 something lane,  milwaukee, WI 53201" value="<? echo $row['address']; ?>" />
			</div>
		</div>
		
	<input class="button is-primary" type=submit value=update>
	<input class="button is-light" type=reset value=reset>
	<input type=hidden name="id" value="<? echo $row['customerId']; ?>">
	<a class='button is-light' href=index.php>back</a>
	</form>
<?
		} //end while statement
	} //end if statement

	echo '</section>';
	mysqli_close($dbc);

	include ("../includes/footer.php");
}
?>