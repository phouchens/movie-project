<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  <title>Brew City Rentals</title>
   <link rel="shortcut icon" href="../../favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css">
    <link rel="stylesheet" href="../includes/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>  
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="../includes/helper.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
  </head>
<body>
<nav class="navbar is-black">
  <div class="navbar-brand">
    <a class="navbar-item" href="../Home">
    <span style="font-family: 'Oswald', sans-serif;">Brew City Rentals</span>
    </a>
    <div class="navbar-burger burger" data-target="mainNav">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>

  <div id="mainNav" class="navbar-menu">
    <div class="navbar-start">
<?
if (isset($_SESSION['email'])){

      echo "<div class='navbar-item has-dropdown is-hoverable'>";
      if ($_SESSION['role'] != 3) {
          echo  "<a class='navbar-link' href=''>
              Employees
            </a>
        <div class='navbar-dropdown is-boxed'>";
        if ($_SESSION['role'] == 5) { 
            echo "<a class='navbar-item' href='../employee/index.php'>
                    Employee Management
                  </a>
                  <a class='navbar-item' href='../reports/index.php'>
                  Reports
                </a>";
        }
        if ($_SESSION['role'] != 3) {
          echo "<a class='navbar-item' href='../checkout/index.php'>
                  Checkout
                </a>
                <a class='navbar-item' href='../checkin/index.php'>
                Check-in
              </a>
                <a class='navbar-item' href='../customers/index.php'>
                  Customer Managment
                </a>";
        }
      echo "</div> ";
    }
echo <<< EOT
</div>
    <a class='navbar-item' href='../movies/index.php'>
       Movies
    </a>
    </div> <!--nav bar start end --> 

    <!--navbar end-->
    <div class="navbar-end">
    <div class="navbar-item">
      <div class="field is-grouped">
        <p class="control">
          <a class="button is-primary" href="../Home/logout.php">
            <span class="icon">
              <i class="fas fa-sign-out-alt"></i>
            </span>
            <span>Logout</span>
          </a>
        </p>
      </div>
    </div>
  </div>
</div>
</nav>
EOT;
} else {
echo <<< EOT
  </div> <!-- navbar start end -->
    <div class="navbar-end">
      <div class="navbar-item">
        <div class="field is-grouped">
          <p class="control">
            <a class="button is-primary" href="../Home/login.php">
              <span class="icon">
                <i class="far fa-user"></i>
              </span>
              <span>Login</span>
            </a>
          </p>
        </div>
      </div>
    <div class="navbar-item">
    <div class="field is-grouped">
      <p class="control">
        <a class="button is-primary" href="../Home/register.php">
          <span class="icon">
            <i class="fas fa-user-plus"></i>
          </span>
          <span>Register</span>
        </a>
      </p>
    </div>
  </div>
</div>
</div>
</nav>
EOT;
}
?>

<div id="wrapper">
<div id="main-body" class="column is-full"> <!-- main content container -->




