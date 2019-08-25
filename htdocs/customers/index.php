<?php
session_start(); 
include ('../includes/header.php'); 

if (!isset($_SESSION['email']) && $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	echo "<br><a href=../Home/index.php>Home</a>"; 
	exit();
}else{
	require_once ('../../mysqli_connect.php');

	echo ("<section class='section' id='form-container'>"); 

	$display = 5;

    if(isset($_GET['p'])&&is_numeric($_GET['p'])){
		$pages = $_GET['p'];
	}else{

        $query = "SELECT COUNT(customerId) FROM customer";
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

	$query = "SELECT * FROM customer LIMIT $start, $display"; 
	$result = @mysqli_query ($dbc, $query);

	echo "<div class='level-item has-text-centered'>
				<h2 class='is-size-2'>Customers</h2>
			</div>";
    echo "<table class='table is-fullwidth is-striped'>
            <tr>
                <th>Customer Id</th><th>Role</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th><th>*</th><th>*</th>
            </tr>"; 

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
	echo ("<a class='button is-primary' href=add.php>Add a new Customer</a><p>"); 
	echo "</div>
		<div class='level-item has-text-centered'>";
	echo ("<a class='button is-primary' href=searchform.php>Search Customer</a><p>"); 
	echo "</div>
	</nav>";
       
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


