<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You are not logged in!";
	exit();
}else{

	include ("../includes/header.php");

	require_once ('../../mysqli_connect.php');

	$id=$_GET['id']; 
	$query = "SELECT * FROM employee WHERE employeeId = $id" ; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	echo '<section class="section" id="form-container">';
	if ($num > 0) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
	<h2>Update Employee</h2>
	<form action="update.php" method="post" id="form-item">

		<div class="field">
 			<label class="field-label">First Name: (required)</label>
  			<div class="control">
    			<input class="input" name="firstName" type="text" size=50 required value="<? echo $row['firstName']; ?>">
  			</div>
		</div>

        <div class="field">
 			<label class="field-label">Last Name: (required)</label>
  			<div class="control">
    			<input class="input" name="lastName" type="text" size=50 required value="<? echo $row['lastName']; ?>">
  			</div>
		</div>
		
		<div class="field">
 			<label class="field-label">Role: (required)</label>
             <div class="select" >
                <select name="role" required>
                    <option value="">Select Role</option>
                    <option value="5">Manager</option>
                    <option value="4">Employee</option>
                </select>
            </div>
        </div>
        <div class="field">
			<label class="field-label ">Email Address: (required)</label>
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
		
	<input class="button is-primary" type=submit value=update>
	<input class="button is-light" type=reset value=reset>
	<input type=hidden name="employeeId" value="<? echo $row['employeeId']; ?>">
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