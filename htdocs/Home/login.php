<?php
// sets session
function setSession($row) {
	session_start(); 
	$_SESSION['id'] = $row[0];
	$_SESSION['role'] = $row[1];
	$_SESSION['firstName'] = $row[2];
	$_SESSION['lastName'] = $row[3];
	$_SESSION['email'] = $row[4];
}

// Check if the form has been submitted.
if (isset($_POST['submitted'])) {
	require_once ('../../mysqli_connect.php'); // Connect to the db.
	$errors = array(); // Initialize error array.
	// Check for an email address.
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	// Check for a password.
	if (empty($_POST['password'])) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$p = mysqli_real_escape_string($dbc, $_POST['password']);
	}
	if (empty($errors)) { 
	
		$customerQuery = "SELECT * FROM customer WHERE email='$e' AND password='$p'"; 
		$employeeQuery = "SELECT * FROM employee WHERE email='$e' AND password='$p'";
		$customerRow = mysqli_fetch_array (@mysqli_query ($dbc, $customerQuery), MYSQLI_NUM);
		$employeeRow = mysqli_fetch_array(@mysqli_query($dbc, $employeeQuery), MYSQLI_NUM);
		if ($customerRow) {
			setSession($customerRow);
			header("Location:../movies/index.php");
			exit(); 
		} elseif ($employeeRow) {
			setSession($employeeRow);
			header("Location:../checkout/index.php");
			exit(); 
		} else { // No record matched either query.
			$errors[] = 'The email address and password entered do not match those on file.';
		}
	} // End of if (empty($errors)) IF.
	mysqli_close($dbc); 
} else { // Form has not been submitted.
	$errors = NULL;
} // End of the main Submit conditional.

// Begin the page.
$page_title = 'Login';
include ('../includes/header.php');
if (!empty($errors)) { // Print any error messages.
	echo '<h1 id="mainhead">Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($errors as $msg) { // Print each error.
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
}

// form.
?>
<section class="section" id="form-container">
<h2>Please login here.</h2>
	<form action="login.php" method="post" id="form-item">
		<div class="field">
			<label class="field-label is-small">Email Address:</label>
			<div class="control">
			<input class="input" type="text" name="email" size="20" maxlength="40" required/>
			</div>
		</div>
		<div class="field">
			<label class="field-label is-small">Password:</label>
			<div class="control">
			<input class="input" type="password" name="password" size="20" maxlength="20" required/>
			</div>
		</div>
		<input class="button is-primary" type="submit" name="submit" value="Login" />
		<input type="hidden" name="submitted" value="TRUE" />
		<a class="button is-light" href="../Home/forgot.php">Forgot Password?</a>
	</form>
</section>
<?php
include ('../includes/footer.php');
?>
