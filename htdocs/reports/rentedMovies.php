<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
    echo "You do not have permission to view this page!";
    echo "<br><a href=../Home/index.php>Home</a>"; 
	exit();

}else{
	include ('../includes/header.php');
	require_once ('../../mysqli_connect.php');


	echo "<h2 class='is-size-2 has-text-centered'>Rented Movies</h2>";
	echo "<section class='section' id='form-container'>";
	 
	

    $query="SELECT * FROM movie WHERE rented=1";
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { 

		echo "<p><b>Total movies rented: $num.</b></p>";
		echo "<table class='table is-fullwidth is-striped'><tr>
		<th>Movie Id</th><th>Title</th><th>Genre</th><th>Year</th><th>Actors</th><th>Directors</th><th>Rating</th><th>Rented</th></tr>"; 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<tr><td>".$row['movieId']."</td>"; 
			echo "<td>".$row['title']."</td>"; 
			echo "<td>".$row['genre']."</td>";
			echo "<td>".$row['year']."</td>";
			echo "<td>".$row['actors']."</td>";
            echo "<td>".$row['directors']."</td>";
            echo "<td>".$row['rating']."</td>";
            echo "<td>".$row['rented']."</td>";
		} 
		echo "</table>"; 


		       
	} else { 
		echo '<p>There are no rented movies</p>';
		echo "<nav class='level'>
			  <div class='level-item has-text-centered'>";
		echo ("<a class='button is-primary' href=index.php>Back</a><p>");
		echo  "</div>
		      </nav>";
	}
	mysqli_close($dbc); 
echo '</section>';

	include ("../includes/footer.php");
}
?>