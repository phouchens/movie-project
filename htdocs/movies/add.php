<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] != 5){ 
	echo "You do not have permission to view this page!";
	exit();
}else{

    include ("../includes/header.php");
    
    require_once ('../../mysqli_connect.php'); 
    
	echo '<section class="section" id="form-container">';
	if ($_POST['submitted']){
		$title=$_POST['title']; 
		$genre=$_POST['genre']; 
        $year=$_POST['year']; 
        $language=$_POST['langauge'];
        $actors=$_POST['actors'];
		$directors=$_POST['directors'];
		$rating = $_POST['rating'];
		$price = $_POST['price'];
		$query="INSERT INTO movie (title, genre, year, language, actors, directors, rating, price)
			Values ('$title', '$genre', '$year', '$language', '$actors', '$directors', '$rating', '$price')"; 
		$result=@mysqli_query ($dbc, $query); 
		if ($result){
			echo "<center><p><b>Movie has been added.</b></p>"; 
			echo "<a class='button is-primary' href=index.php>Show All Movies</a></center>"; 
		}else {
			echo "<p>The record could not be added due to a system error" . mysqli_error() . "</p>"; 
		}
	} 

	mysqli_close($dbc);
?>
<h4>Add a new movie</h4>
	<form action="<? echo $PHP_SELF;?>" method="post" id="form-item">
		<div class="field">
 			<label class="field-label">Title:</label>
			 <div class="control">
    			<input class="input" name="title" type="text" size=50 required>
  			</div>
        </div>
		
		<div class="field">
 			<label class="field-label">Genre:</label>
  			<div class="control">
    			<input class="input" name="genre" type="text" size=50 required>
  			</div>
		</div>
		<div class="field is-horizontal flex-container">

			<div class="field">
				<label class="field-label">Year:</label>
				<div class="select" >
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
				<div class="select"  >
					<select name="price"required>
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
			<input class="input" type="text" name="language" size="20" maxlength="40"/>
			</div>
		</div>

        <div class="field">
			<label class="field-label ">Actors:</label>
			<div class="control">
			<input class="input" type="text" name="actors"  size="40" />
			</div>
		</div>

        <div class="field">
			<label class="field-label ">Directors:</label>
			<div class="control">
			<input class="input" type="text" name="directors"  size="40" />
			</div>
		</div>
		

	<input class="button is-primary" type=submit value=submit>
	<input class="button is-light" type=reset value=reset>
	<input type=hidden name=submitted value=true>
	<a class='button is-light' href=index.php>back</a>
	</form>
</section>
<?
	//include the footer
	include ("../includes/footer.php");
}
?>