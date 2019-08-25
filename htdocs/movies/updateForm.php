<?php
session_start();



if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

	include ("../includes/header.php");

	require_once ('../../mysqli_connect.php');

	$movieId=$_GET['id']; 
	$query = "SELECT * FROM movie WHERE movieId = $movieId" ; 
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	echo '<section class="section" id="form-container">';
	if ($num > 0) {
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
	<h4>Update movie</h4>
	<form action="update.php" method="post" id="form-item">
		<div class="field">
 			<label class="field-label">Title:</label>
			 <div class="control">
    			<input value="<? echo $row['title']; ?>" class="input" name="title" type="text" size=50 required>
  			</div>
        </div>
		
		<div class="field">
 			<label class="field-label">Genre:</label>
  			<div class="control">
    			<input value="<? echo $row['genre']; ?>" class="input" name="genre" type="text" size=50 required>
  			</div>
		</div>
		<div class="field is-horizontal flex-container">

			<div class="field">
				<label class="field-label">Year:</label>
				<div class="select" required>
					<select name="year">
<?
					for ($i = 2019; $i > 1920; $i--) {
						echo "<option value='$i'>$i</option>";
					}      
?>
					</select>
				</div>
			</div>

			<div class="field ">
			 <label class="field-label">Rating:</label>
				<div class="select" >
					<select name="rating" required>
						<option value="R">R</option>
						<option value="PG">PG</option>
						<option value="PG-13">PG-13</option>
						<option value="G">G</option>
						<option value="NR">NR</option>
						<option value="NC-17">NC-17</option>
						<option value="X">X</option>
					</select>
				</div>
			</div>

			<div class="field ">
			 <label class="field-label">Price:</label>
				<div class="select" >
					<select name="price" required>
						<option value="10">$10.00</option>
						<option value="7">$7.00</option>
						<option value="5">$5.00</option>
					</select>
				</div>
		 	</div>
		</div>

        <div class="field">
			<label class="field-label ">Language:</label>
			<div class="control">
			<input value="<? echo $row['language']; ?>" class="input" type="text" name="language" size="20" maxlength="40"/>
			</div>
		</div>

        <div class="field">
			<label class="field-label ">Actors:</label>
			<div class="control">
			<input value="<? echo $row['actors']; ?>"class="input" type="text" name="actors"  size="40" required />
			</div>
		</div>

        <div class="field">
			<label class="field-label ">Directors:</label>
			<div class="control">
			<input value="<? echo $row['directors']; ?>" class="input" type="text" name="directors"  size="40" />
			</div>
		</div>
		

	<input class="button is-primary" type=submit value=submit>
	<input class="button is-light" type=reset value=reset>
	<input type=hidden name="movieId" value=" <? echo $row['movieId']; ?>">
	<a class='button is-light' href=index.php>back</a>
	</form>
</section>
<?
		} //end while statement
	} //end if statement

	echo '</section>';
	mysqli_close($dbc);

	include ("../includes/footer.php");
}
?>