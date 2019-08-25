<?php
session_start(); 
include ('../includes/header.php'); 

if (!isset($_SESSION['email']) && $_SESSION['role'] == 3){ 
	echo "You do not have permission to view this page!";
	echo "<br><a href=../Home/index.php>Home</a>"; 
	exit();
}else{
	echo "<h1 class='is-size-2 has-text-centered'>Check-in</h1>";
?>
<form action="checkin.php" method="post" id="form-container">
		<div class="field is-fullwidth">
			<div class="field-body">
				<div class="field">
					<label class="label">Movie Title </label>
					<input required type="text" name="returnMovieTitle" id="returnMovieTitle" class="input" autocomplete="off" placeholder="Type Movie Title" />
				</div>
				<div class="field">
					<label class="label">Due Date</label>
					<input type="text" readonly required name="returnDate" id="returnDate" class="input"/>
				</div>
			</div>
		</div>
		<input class="button is-large is-primary" type=submit value="check-in"/>
		<input type="hidden" name="movieId" id="movieId">
		<input type="hidden" name="transactionId" id="transactionId">
</form>
<script>
// Jquery for typeahead functionality
$(document).ready(function(){
	$('.typeahead').typeahead('destroy')
    var movies = []
    $('#returnMovieTitle').typeahead({
        source: function(query, process){
            $.ajax({
                url:"typeahead.php",
                method:"POST",
                data:{query:query},
                dataType:"json",
                success:function(data){
					var newData =[];
					movies = data.slice()
					$.each(data, function(){
						newData.push(this.movieTitle)
					})
						return process(newData);
				}	
        	})
    	},
        afterSelect: function(data){
            $.each(movies, function(){
				console.log(movies)
                if(this.movieTitle === data){
                   $('#returnDate').val(this.returnDate);
				   $('#movieId').val(this.movieId);
				   $('#transactionId').val(this.transactionId);
				 }
				
            })
        }
    })
});
</script>
<?
    include ("../includes/footer.php");
 } // end auth else
?>