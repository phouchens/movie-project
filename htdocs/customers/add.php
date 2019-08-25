<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

    include ("../includes/header.php");
    
    require_once ('../../mysqli_connect.php'); 
    
	echo '<section class="section" id="form-container">';
	if ($_POST['submitted']){
		$role=3; 
		$firstName=$_POST['firstName']; 
        $lastName=$_POST['lastName']; 
        $email=$_POST['email'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];
        $password=$_POST['password'];
		$query="INSERT INTO customer (role, firstName, lastName, email, phone, address, password)
			Values ('$role', '$firstName', '$lastName', '$email', '$phone', '$address', '$password')"; 
		$result=@mysqli_query ($dbc, $query); 
		if ($result){
			echo "<center><p><b>Customer has been added.</b></p>"; 
			echo "<a class='button is-primary' href=index.php>Show All Customers</a></center>"; 
		}else {
			echo "<p>The record could not be added due to a system error" . mysqli_error() . "</p>"; 
		}
	} 
	mysqli_close($dbc);
?>
	<h4>Add a new customer</h4>
	<form action="<? echo $PHP_SELF;?>" method="post" id="form-item">
		<div class="field">
 			<label class="field-label">First Name: (Required)</label>
  			<div class="control">
    			<input class="input" name="firstName" type="text" size=50 required>
  			</div>
		</div>

        <div class="field">
 			<label class="field-label">Last Name: (Required)</label>
  			<div class="control">
    			<input class="input" name="lastName" type="text" size=50 required>
  			</div>
		</div>

        <div class="field">
			<label class="field-label ">Email Address: (Required)</label>
			<div class="control">
			<input class="input" type="text" name="email" size="20" maxlength="40" placeholder="youremail@provider.com"required/>
			</div>
		</div>

        <div class="field">
			<label class="field-label ">Phone Number</label>
			<div class="control">
			<input class="input" type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="phone" size="20" placeholder="111-111-1111"/>
			</div>
		</div>

		<div class="field">
			<label class="field-label ">Address:</label>
			<div class="control">
			<input class="input" type="text" name="address" size="50" placeholder="123 something lane,  milwaukee, WI 53201" />
			</div>
		</div>

		<div class="field">
			<label class="field-label ">Password: (Required)</label>
			<div class="control">
			<input class="input" type="password" name="password" size="10" maxlength="20" required/>
			</div>
		</div>
		
	<input class="button is-primary" type=submit value=submit>
	<input class="button is-light" type=reset value=reset>
	<input type=hidden name=submitted value=true>
	<a class='button is-light' href=index.php>back</a>
	</form>
</section>
<?

include ("../includes/footer.php");
}
?>