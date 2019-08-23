<?php 
session_start();

if (!isset($_SESSION['email'])){ 
	echo "You do not have permission to view this page!";
	exit();
}else{
	include ("../includes/header.php");
?>

<section class="section" id="form-container">
<h2>Search for a Movie</h2>
<form action="search.php" method="post" id="form-item">
	<div class="field">
		<label class="label">Title:</label>
		<div class="control">
			<input class="input" name="title" size=150 value="<? echo $row['title'];?>">
		</div>
	</div>

		<input class="button is-primary" type=submit value=search>
		<input class="button is-light" type=reset value=reset>
		<a class='button is-light' href=index.php>back</a>
</form>
</section>
<?
	include ("../includes/footer.php");
}
?>