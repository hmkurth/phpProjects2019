<?php
    // Start the session
    require_once('startsession.php');

    // Insert the page header
    $page_title = 'Create or Edit Profile';
    require_once('header.php');

    //require_once('appvars.phfooter p');
    require_once('connectvars.php');

    // Make sure the user is logged in before going any further.
    if (!isset($_SESSION['user_id']))
    {
        echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
        exit();
    }

    // Show the navigation menu
    require_once('navmenu.php');

    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('Error connecting to database');

    if (isset($_POST['submit']))
    {
        // Grab the profile data from the POST
        $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $first_name = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
        $last_name = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
        $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
        $birthdate = mysqli_real_escape_string($dbc, trim($_POST['birthdate']));
        $weight = mysqli_real_escape_string($dbc, trim($_POST['weight']));
        $error = false;
        // Update the profile data in the database
        if (!$error)
        {
            if (!empty($username) && !empty($first_name) && !empty($last_name) && !empty($gender) && !empty($birthdate) && !empty($weight))
            {
                $query = "UPDATE exercise_user SET username = '$username', first_name = '$first_name',"
                          . " last_name = '$last_name', gender = '$gender',birthdate = '$birthdate',"
                          . " weight = '$weight' WHERE id = '" . $_SESSION['user_id'] . "'";

                mysqli_query($dbc, $query) or die('error updating variables'.mysqli_error($dbc));
                // Confirm success with the user
                echo '<p>Your profile has been successfully updated. Would you like to <a href="viewprofile.php">view your profile</a>?</p>';
                mysqli_close($dbc);
                exit();
              }
              else {
                echo '<p class="error">You must enter all of the profile data (the picture is optional).</p>';
              }
          }
     } // End of check for form submission
     else {
          // Grab the profile data from the database
          $query = "SELECT username, first_name, last_name, gender, birthdate, weight FROM exercise_user WHERE id = '" . $_SESSION['user_id'] . "'"
                  or die('error connecting to database'.mysqli_error($dbc));
        $data = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($data);

        if ($row != NULL)
        {
            $username = $row['username'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $gender = $row['gender'];
            $birthdate = $row['birthdate'];
            $weight = $row['weight'];
            //echo $first_name;

        }
        else {
            echo '<p class="error">There was a problem accessing your profile.</p>';
        }
      }

      mysqli_close($dbc);
?>

  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Personal Information</legend>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />
      <label for="firstname">First name:</label>
      <input type="text" id="firstname" name="firstname" value="<?php if (!empty($first_name)) echo $first_name; ?>" /><br />
      <label for="lastname">Last name:</label>
      <input type="text" id="lastname" name="lastname" value="<?php if (!empty($last_name)) echo $last_name; ?>" /><br />
      <label for="gender">Gender:</label>
      <select id="gender" name="gender">
        <option value="M" <?php if (!empty($gender) && $gender == 'M') echo 'selected = "selected"'; ?>>Male</option>
        <option value="F" <?php if (!empty($gender) && $gender == 'F') echo 'selected = "selected"'; ?>>Female</option>
      </select><br />
      <label for="birthdate">Birthdate:</label>
      <input type="text" id="birthdate" name="birthdate" value="<?php if (!empty($birthdate)) echo $birthdate; else echo 'YYYY-MM-DD'; ?>" /><br />
      <label for="weight">Weight in Lbs:</label>
      <input type="text" id="weight" name="weight" value="<?php if (!empty($weight)) echo $weight; ?>" /><br />

    </fieldset>
    <input type="submit" value="Save Profile" name="submit" />
  </form>

<?php
  // Insert the page footer
  require_once('footer.php');
?>
