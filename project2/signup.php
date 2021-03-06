<?php
    // Insert the page header
    $page_title = 'Sign Up';
    require_once('header.php');
    // Start the session
    require_once('startsession.php');
    //require_once('appvars.php');
    require_once('connectvars.php');

    // Show the navigation menu
    require_once('navmenu.php');

    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to database');

    if (isset($_POST['submit']))
    {
        // Grab the profile data from the POST
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
        $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));

        if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2))
        {
            // Make sure someone isn't already registered using this username
            $query = "SELECT * FROM exercise_user WHERE username = '$username'"
                      or die('Error connecting to database');
            $data = mysqli_query($dbc, $query) or die('!error connecting to database'.mysqli_error($dbc));
            if (mysqli_num_rows($data) == 0)
            {
                // The username is unique, so insert the data into the database
                $query = "INSERT INTO exercise_user (username, password)"
                        . " VALUES ('$username', SHA('$password1'))"
                        or die('error inserting into db');
                mysqli_query($dbc, $query)or die('error Inserting Username connecting to database'.mysqli_error($dbc));

                // Confirm success with the user
                echo '<p>Your new account has been successfully created. You\'re now ready to <a href="login.php">Log In!</a>.</p>';

                mysqli_close($dbc);
                exit();
            }
            else {
                // An account already exists for this username, so display an error message
                echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
                $username = "";
            }
          }
          else {
              echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
          }
        }

        mysqli_close($dbc);
?>

  <p>Please enter your username and desired password to sign up to Exercise Logger.</p>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Registration Info</legend>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
      <label for="password1">Password:</label>
      <input type="password" id="password1" name="password1" /><br />
      <label for="password2">Password (retype):</label>
      <input type="password" id="password2" name="password2" /><br />
    </fieldset>
    <input type="submit" value="Sign Up" name="submit" />
  </form>

<?php
  // Insert the page footer
  require_once('footer.php');
?>
