<?
	require_once ('../../mysqli_connect.php');
	$request = mysqli_real_escape_string($dbc, $_POST["query"]);
	$query="SELECT * FROM movie WHERE (title LIKE '%$request%') AND rented=0";

	$result = mysqli_query($dbc, $query);

	$data = array();

	if(mysqli_num_rows($result) > 0){
	    while($row = mysqli_fetch_assoc($result)){
	        $data[] = $row;
	    }
	echo json_encode($data);
    }
    mysqli_close($dbc);

?>