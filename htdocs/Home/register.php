<?php 
// Include header.php
include("../includes/header.php");
// Check if the form has been submitted.
if (isset($_POST['submitted'])) {
	require_once ('../../mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.

	// Check for a first name.
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$first_name = mysqli_real_escape_string($dbc, $_POST['first_name']);
	}

	// Check for a last name.
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$last_name = mysqli_real_escape_string($dbc, $_POST['last_name']);
	}

	// Check for an phone address.
	if (empty($_POST['phone'])) {
		$errors[] = 'You forgot to enter your phone number.';
	} else {
		$email = mysqli_real_escape_string($dbc, $_POST['phone']);
	}

	// Check for an email address.
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($dbc, $_POST['email']);
	}

	// Check for a password and match against the confirmed password.
	if (!empty($_POST['password1']) && !empty($_POST['password2'])) {
		if ($_POST['password1'] != $_POST['password2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$password = mysqli_real_escape_string($dbc, $_POST['password1']);
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

	if (empty($errors)) { // If everything's OK.
		// Register the user in the database.
		// Check for previous registration.
		$query = "SELECT customerId FROM customer WHERE email='$email'";
		$result = mysqli_query($dbc, $query);
		if (mysqli_num_rows($result) == 0) { // if there is no such email address
			// Make the query.
			$role = 3;
			$lateFeeFlag = false;
			$query = "INSERT INTO customer (role, firstName, lastName,  email, phone, address,  lateFeeFlag, password) 
			VALUES ('$role', '$first_name', '$last_name', '$email', '$phone', null, '$lateFeeFlag', '$password' )";		
			$result = mysqli_query ($dbc, $query); // Run the query.
			if ($result) { // If it ran OK.
				echo "<p>You are now registered. Please, login to view our movies!.</p>";
				echo "<a href=login.php>Login</a>";
				exit();
			} else { // If it did not run OK.
				$errors[] = 'You could not be registered due to a system error. We apologize for any inconvenience.'; // Public message.
				$errors[] = mysqli_error($dbc); // MySQL error message.
			}

		} else { // Email address is already taken.
			$errors[] = 'The email address has already been registered.';
		}

	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.

} else { // Form has not been submitted.
	$errors = NULL;
} // End of the main Submit conditional.

// Begin the page now.
if (!empty($errors)) { // Print any error messages.
	echo '<h1>Error!</h1>
	<p>The following error(s) occurred:<br />';
	foreach ($errors as $msg) { // Print each error.
		echo "$msg<br />";
	}
	echo '</p>';
	echo '<p>Please try again.</p>';
}

// Create the form.
?>
<section class="section" id="form-container">
<h1>Register</h1>
	<form action="register.php" method="post" id="form-item">
		<div class="field">
			<label class="field-label ">First Name:</label>
			<div class="control">
			<input class="input" type="text" name="first_name" size="15" maxlength="15" required value="<?php echo $_POST['first_name']; ?>" />
			</div>
		</div>

		<div class="field">
			<label class="field-label ">Last Name:</label>
			<div class="control">
			<input class="input" type="text" name="last_name" size="15" maxlength="30" required value="<?php echo $_POST['last_name']; ?>" />
			</div>
		</div>

		<div class="field">
			<label class="field-label ">Email Address:</label>
			<div class="control">
			<input class="input" type="text" name="email" size="20" maxlength="40" placeholder="youremail@provider.com"required value="<?php echo $_POST['email']; ?>"  />
			</div>
		</div>

		<div class="field">
			<label class="field-label ">Phone Number</label>
			<div class="control">
			<input class="input" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" size="20" placeholder="111-111-1111" required value="<?php echo $_POST['phone']; ?>"  />
			</div>
		</div>

		<div class="field">
			<label class="field-label ">Password:</label>
			<div class="control">
			<input class="input" type="password" name="password1" size="10" maxlength="20" required/>
			</div>
		</div>

		<div class="field">
			<label class="field-label ">Confirm Password:</label>
			<div class="control">
			<input class="input" type="password" name="password2" size="10" maxlength="20" required/>
			</div>
		</div>
		<br>
		<div class="control">
			<input class="button is-primary" type="submit" name="submit" value="Register" />
		</div>
		<input type="hidden" name="submitted" value="TRUE" />
	</form>
</section>
<?php
// Include footer.php
include("../includes/footer.php");
?>
