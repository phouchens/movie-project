<?php
session_start(); 
include ('../includes/header.php'); 

if (!isset($_SESSION['email'])){ 
	echo "You do not have permission to view this page!";
	echo "<br><a href=../Home/index.php>Home</a>"; 
	exit();
}else{
	require_once ('../../mysqli_connect.php');

	echo ("<section class='section' id='form-container' >"); 

	$display = 6;

    if(isset($_GET['p'])&&is_numeric($_GET['p'])){
		$pages = $_GET['p'];
	}else{

        $query = "SELECT COUNT(movieId) FROM movie";
		$result = @mysqli_query ($dbc, $query); 
		$row = @mysqli_fetch_array($result, MYSQLI_NUM);
		$records = $row[0]; 

        if($records > $display){
			$pages = ceil($records/$display);
		}else{
			$pages = 1;
		}
	}

	if(isset($_GET['s'])&&is_numeric($_GET['s'])){
		$start = $_GET['s'];
	}else{
		$start = 0;
	}

	$query = "SELECT * FROM movie LIMIT $start, $display"; 
	$result = @mysqli_query ($dbc, $query);

	echo "<div class='level-item has-text-centered'>
				<h2 class='is-size-2'>Movies</h2>
			</div>";
			echo "<nav class='level'>";
			if ($_SESSION['role'] == 5) {
				echo "<div class='level-item'>
						<div class='level-left'>
							<a class='button is-primary' id='nav-button' href=add.php>Add a New Movie</a><p>
						</div>	
			   		</div>";
			}
			echo  "<div class='level-item'>
						<div class='level-item level-right'>
							<a class='button is-primary' id='nav-button' href=searchform.php>Search Movies</a><p>
						</div>
					</div>
			</nav>";

echo "<div class='columns is-multiline is-centered'>";
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
echo  "<div class='column'><div class='card' id='movie-card'>
			<header class='card-header'>
				<p class='card-header-title'>".$row['title']."</p>
				<span class='icon'>
					<i class='fas fa-ticket-alt' aria-hidden='true'></i>
				</span>
				</a>
			</header>
			<div class='card-content'>
				<div class='content'>
					<span>year: ".$row['year']."</span>
					<br>
					<span>actors: ".$row['actors']."</span>
					<br>
					<span>directors: ".$row['directors']."</span>
					<br>
					<span>rating: ".$row['rating']."</span>
					<br>
				</div>
			</div> <!-- end of card content -->
			<footer class='card-footer'>";
	if ($_SESSION['role'] == 5){ //if manager you can update and delete movies
	echo   "<a class='button is-primary  card-footer-item' href=updateForm.php?id=".$row['movieId'].">Update</a>
			<a class='button is-dark card-footer-item' href=deleteconfirm.php?id=".$row['movieId'].">Delete</a>";
		}
	echo    "</footer>
		</div></div> <!--end of card-->";
	} 
	echo "</div>";

	mysqli_close($dbc); 

	if($pages>1){
		echo "<br/><nav class='pagination'>";
		$current_page = ($start/$display) + 1;
		if($current_page != 1){
			echo '<a class="pagination-link" href="index.php?s='. ($start - $display) . '&p=' . $pages. '"> Previous </a>';
		}
		echo '<ul class="pagination-list">';
		for($i = 1; $i <= $pages; $i++){
			if($i != $current_page){
				
				echo '<li><a class="pagination-link" href="index.php?s='. (($display*($i-1))). '&p=' . $pages .'"> ' . $i . ' </a></li>';
			}else{ 
				echo ''. $i. '';
			}
		} 
		echo '</ul>';
		
		if($current_page != $pages){
			echo '<a class="pagination-link" href="index.php?s=' .($start + $display). '&p='. $pages. '"> Next </a>';
		}
		
		echo '</nav>';  
		echo "</section>";
	}
	
	include ('../includes/footer.php');
}
?>
 }

?>


