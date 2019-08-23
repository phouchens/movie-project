<?php
	require_once ('../../mysqli_connect.php');
    $query="SELECT * FROM movie ORDER BY movieId ASC";
    $result = @mysqli_query ($dbc, $query);
    $num = mysqli_num_rows($result);
    $new_csv = fopen('/tmp/report.csv', 'w');
    $columnHeaders = ['movieId', 'title', 'genre', 'year', 'language', 'actors', 'directors', 'rating', 'date added', 'rented', 'return date', 'price'];
    fputcsv($new_csv, $columnHeaders);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        fputcsv($new_csv, $row);
    }
	fclose($new_csv);
  
	header("Content-type: text/csv");
	header("Content-disposition: attachment; filename = report.csv");
    readfile("/tmp/report.csv");
    mysqli_close($dbc); 
?>