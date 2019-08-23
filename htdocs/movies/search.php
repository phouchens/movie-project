<?php
session_start();
include ('../includes/header.php');

if (!isset($_SESSION['email'])){ 
	echo "You do not have permission to view this page!";
	exit();

}else{

	require_once ('../../mysqli_connect.php');

	echo '<section class="section" id="form-container">';
	 
	if (!empty($_POST['title'])){
        $title = mysqli_real_escape_string($dbc, $_POST['title']);  
        $query="SELECT * FROM movie WHERE (title LIKE '%$title%')";
        
	}else {
		$query="SELECT * FROM movie";
	}
	$result = @mysqli_query ($dbc, $query);
	$num = mysqli_num_rows($result);
	if ($num > 0) { 

		echo "<p><b>Your search returns $num entries.</b></p>";
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<div class='card movie-card'>
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
          </div>
          <footer class='card-footer'>";
      
          if ($_SESSION['role'] == 5){ //if manager you can update and delete movies
          echo   "<a class='button is-primary  card-footer-item' href=updateForm.php?id=".$row['movieId'].">Update</a>
                  <a class='button is-danger card-footer-item' href=deleteconfirm.php?id=".$row['movieId'].">Delete</a>";
              }
          echo "</footer>
          </div>
          <br/>";
          } 
          
	} else { 
        echo '<p>Your search hits no result.</p>';
    }
    echo "<nav class='level'>
    <div class='level-item has-text-centered'>";
    echo ("<a class='button is-primary' href=index.php>All Movies</a><p>");
    echo 		"</div>
            <div class='level-item has-text-centered'>";
    echo ("<a class='button is-primary' href=searchform.php>Back</a><p>");
    echo   		"</div>
    </nav>";
	mysqli_close($dbc); 
echo '</section>';

	include ("../includes/footer.php");
}

?>