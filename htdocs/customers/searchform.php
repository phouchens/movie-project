<?php 
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	exit();
}else{
	include ("../includes/header.php");
?>

<section class="section" id="form-container">
<h2>Search for a Customer</h2>
<form action="search.php" method="post" id="form-item">
	<div class="field">
		<label class="label">First Name:</label>
		<div class="control">
			<input class="input" name="firstName" size=50 value="<? echo $row['firstName'];?>">
		</div>
	</div>
	<div class="field">
		<label class="label">Last Name:</label>
		<div class="control">
			<input class="input" name="lastName" size=50 value="<? echo $row['lastName'];?>">
		</div>
	</div>

		<input class="button is-primary" type=submit value=search>
		<input class="button is-light" type=reset value=reset>
		<a class='button is-light' href=index.php>back</a>
	<input type=hidden name="id" value="<? echo $row['customerId'];?>">
</form>
</section>
<?
	include ("../includes/footer.php");
}
?>