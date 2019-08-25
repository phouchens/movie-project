<?php 
include ('../includes/header.php');

if (isset($_POST['submitted'])) {
	require_once ('../../mysqli_connect.php'); 
	$errors = array();

	
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, $_POST['email']);
	}

	if (empty($errors)) { 
		
		$query = "SELECT * FROM customer WHERE email='$e'"; 
		$result = mysqli_query ($dbc, $query);
		if (mysqli_num_rows($result)==1) {
			while ($row=mysqli_fetch_array($result)){
				$p=$row['password']; 
			}								
				
			$to=$e; 
			$subject="Brew City Rentals Member!";
			$body="
			Thank you very much for being a member BCR.\n\n
			Here is your password information.\n\n
			Password: ".$p."\n\n
			Thanks again!\n\n";

			$headers="From: Perry Houchens <houchen4@uwm.edu>\n";  
			mail ($to, $subject, $body, $headers); 

			echo "<section id='form-container'><h1 has-text-centered id='mainhead'>Thank you!</h1>
			<p>Please, check your email to get your username and password.</p></section>"; 

			include ('../includes/footer.php');
			exit();
		} else { 
			echo '
			<section class="section" id="form-container">
				<font color=red><h4>Error!</h4>
				<p>The email address is not in our database.</p></font>
			</section>';
		}

	} else {
		echo '<section class="section" id="form-container">
				<font color=red>
					<h4>Error!</h4>
					<p>The following error(s) occurred:<br />';
					foreach ($errors as $msg) { 
						echo " - $msg<br />\n";
					}
		echo '		</p>
					<p>Please try again.</p>
					<br />
				</font>
			</section>';
	} 

		mysqli_close($dbc);
	}
?>
<section class='section' id='form-container'>
<h3>Forgot username or password?</h3>
<form action="forgot.php" method="post">
<div class="field">
	<label class="field-label">Email Address:</label>
	<div class="control">
	<input class="input" required type="text" name="email" size="20" maxlength="40" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> 
    </div>
</div>
	<input class="button is-primary" type="submit" name="submit" value="Submit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
</form>
</section>

<?php
include ('../includes/footer.php');
?>
