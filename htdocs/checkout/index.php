<?php
session_start();
include ('../includes/header.php');

if (!isset($_SESSION['email']) && $_SESSION['role'] == 3){
	echo "You do not have permission to view this page!";
	echo "<br><a href=../Home/index.php>Home</a>";
	exit();
}else{

	?>

    <h2 class='is-size-2  has-text-centered'>Checkout</h2>
<form action="checkout.php" method="post" id="form-container">
	<div class='columns'>
            <div class='column'>

                    <div class="field">
                        <label class="label">Last Name:</label>
                        <div class="control">
                            <input class="input" name="lastName" type="text" size=50 required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">First Name:</label>
                        <div class="control">
                            <input class="input" name="firstName" type="text" size=50 required>
                        </div>
                    </div>

                    <div class="field">
                            <label class="label">Customer ID:</label>
                            <div class="control">
                                <input class="input" name="customerId" type="number" required>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Rental Date</label>
                            <div class="control">
                                <input class="input" readonly name="rentalDate" type="date" value="<? echo date('Y-m-d'); ?>">
                            </div>
                        </div>

                        <div class="field">
                            <label class="label">Rental Return Date</label>
                            <div class="control">
                                <input class="input" readonly name="returnDate" type="date"  value="<? $today=date("Y-m-d"); echo date('Y-m-d', strtotime("$today +7 days")); ?>">
                            </div>
                        </div>
            </div>

            <div class='column'>
                    <div class="field">
                        <div class="field-body">
                            <div class="field">
                                <label class="label">Movie Title </label>
                                <input required type="text" name="movieTitle" id="movieTitle" class="input" autocomplete="off" placeholder="Type Movie Title" />
                            </div>
                            <div class="field">
                                <label class="label">Price</label>
                                <input type="text" readonly name="moviePrice" id="moviePrice" class="input"/>
                            </div>
                        </div>
                    </div>

                    <div class="field">
                        <div class="field-body">
                            <div class="field">
                                <label class="label">Credit Card Number</label>
                                <div class="control">
                                    <input class="input" name="creditCardNumber" type="text" size=16 required>
                                </div>
                            </div>
                            <div class="field">
                                <label class="label">Credit Card Type:</label>
                                <div class="select" >
                                    <select name="creditCardType" required>
                                        <option value="">Credit Card Type</option>
                                        <option value="Visa">Visa</option>
                                        <option value="MasterCard">MasterCard</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>
                <br/>
                <br/>
                <input class="button is-large is-fullwidth is-primary" type=submit value="checkout"/>
                <input type="hidden" name="movieId" id="movieId">
            </div>
    </div>
</form>

<script>
// Jquery for typeahead functionality
$(document).ready(function(){
    $('.typeahead').typeahead('destroy')
    var movies = []
    $('#movieTitle').typeahead({
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
                    newData.push(this.title)
                })
                return process(newData);
                }
            })
        },
        afterSelect: function(data){
            $.each(movies, function(){
                if(this.title === data){
                    $('#moviePrice').val("$" + this.price + ".00");
                    $('#movieId').val(this.movieId);
                }
            })
        }
    })
});
</script>

<?
    echo '</section>';
    include ("../includes/footer.php");
} // end auth else
?>