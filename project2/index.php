<?php
  // Start the session
  require_once('startsession.php');

  // Insert the page header
  $page_title = 'Welcome to exercise logger';
  require_once('header.php');

  //require_once('appvars.php');
  require_once('connectvars.php');

  // Show the navigation menu
  require_once('navmenu.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

?>
<body>
  <h1> Welcome to the Exercise Logger App!</h1>
  <h2>Please <a href="signup.php">Create an Account</a> or <a href="login.php">Login</a> to begin tracking your exercise</h2>


</body>
<?php
  // Insert the page footer
  require_once('footer.php');
?>
