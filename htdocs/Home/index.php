<?php 
session_start();

if (!isset($_SESSION['email'])){
include ('../includes/header.php'); //may not need this
}else {
include ('../includes/header.php');
}
?>

<section id="movies" class="hero is-dark is-fullheight">
  <div class="hero-body">
    <div class="container">
        <h1 id="title-text" class="title has-text-weight-bold">
            Brew City Rentals
        </h1>
        <h2 class="subtitle">
            Your family movie night provider.
        </h2>
    </div>
  </div>
</section>

<?php
include ('../includes/footer.php');
?>
