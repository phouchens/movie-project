<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['role'] == 3){ 
    echo "You do not have permission to view this page!";
    echo "<br><a href=../Home/index.php>Home</a>"; 
	exit();

}else{
    include ('../includes/header.php');
    include ('../includes/helpers.php');

	require_once ('../../mysqli_connect.php');


	echo "<h2 class='is-size-2 has-text-centered'>Rented Movies</h2>";
	echo "<section class='section'>";
	 
	

    $query="SELECT * FROM movie WHERE rented=1";
    $nonRented = "SELECT * FROM movie WHERE rented=0";
    $result = @mysqli_query ($dbc, $query);
    $nonRentedresult = @mysqli_query ($dbc, $nonRented);


    $rentedNum = mysqli_num_rows($result);
    $nonRentedNum = mysqli_num_rows($nonRentedresult);
    $total = $rentedNum + $nonRentedNum;

    $rentedDataPoint = ($rentedNum/$total) * 100;
    $nonRentedDataPoint = ($nonRentedNum/$total) * 100;
    $dataPoints = array( 
        array("label"=>"rented movies", "y"=>$rentedDataPoint),
        array("label"=>"available movies", "y"=>$nonRentedDataPoint),
    );

	if ($rentedNum > 0) { 
        echo  "<div class=columns>
                <div class=column><div id='chartContainer' style='height: 370px; width: 100%;'></div></div>
                <div class=column is-three-quarters>";
            echo "<p><b>Total movies rented: $rentedNum.</b></p>";
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
            echo "</table>
                </div>
            </div>";

		       
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

<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Movie Stock"
	},
	subtitles: [{
		text: "As of " + new Date()
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
}
</script>