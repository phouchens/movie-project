<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	exit();

}else{
	include ('../includes/header.php');

	require_once ('../../mysqli_connect.php');

	echo '<section class="section">';
	 
	
	if (empty($_POST['firstName'])||!empty($_POST['lastName'])){
		//$id = mysqli_real_escape_string($dbc, $_POST['id']); 
		$firstName = mysqli_real_escape_string($dbc, $_POST['firstName']); 
		$lastName = mysqli_real_escape_string($dbc, $_POST['lastName']); 
		
		$query="SELECT * FROM customer WHERE (firstName LIKE '%$firstName%')
		AND (lastName LIKE '%$lastName%')";
	}else {
		$query="SELECT * FROM customer";
	}
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { 

		echo "<p><b>Your search returns $num entries.</b></p>";
		echo "<table class='table is-fullwidth is-striped'><tr>
		<th>Employee Id</th><th>Role</th><th>First Name</th><th>Last Name</th><th>email</th><th>Phone Number</th><th>*</th><th>*</th></tr>"; 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<tr><td>".$row['customerId']."</td>"; 
			echo "<td>".$row['role']."</td>"; 
			echo "<td>".$row['firstName']."</td>";
			echo "<td>".$row['lastName']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['phone']."</td>";
			echo "<td>".$row['address']."</td>";
			echo "<td><a class='button is-light' href=deleteconfirm.php?id=".$row['customerId'].">Delete</a></td>"; 
			echo "<td><a class='button is-primary' href=updateform.php?id=".$row['customerId'].">Update</a></td></tr>"; 
		} 
		echo "</table>"; 

		echo "<nav class='level'>
		<div class='level-item has-text-centered'>";
		echo ("<a class='button is-primary' href=index.php>All Employees</a><p>");
		echo 		"</div>
				<div class='level-item has-text-centered'>";
		echo ("<a class='button is-primary' href=searchform.php>Back</a><p>");
		echo   		"</div>
		</nav>";
		       
	} else { 
		echo "<p>Your search hits no result.</p><br/> <a class='button is-primary' href=searchform.php>Back</a><p>";
	}
	mysqli_close($dbc); 
echo '</section>';

	include ("../includes/footer.php");
}

?>