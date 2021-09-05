<?php
    // Start the session
    require_once('startsession.php');

    // Insert the page header
    $page_title = 'Exercise Logger Page';
    require_once('header.php');

    //require_once('appvars.php');
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
    //if the user entered data from the form
    if (isset($_POST['submit']))
    {
        // Grab the exercise data from the POST
        $type = mysqli_real_escape_string($dbc, trim($_POST['type']));
        $dateOfExercise = mysqli_real_escape_string($dbc, trim($_POST['dateOfExercise']));
        $timeDone = mysqli_real_escape_string($dbc, trim($_POST['time']));
        $heartrate = mysqli_real_escape_string($dbc, trim($_POST['heartrate']));
        $user_id = $_SESSION['user_id'];

        //get birthdate from SQLiteDatabase
        $query = "SELECT birthdate, weight FROM exercise_user WHERE id = '" . $_SESSION['user_id'] . "'"
                or die('error getting birthdate');
        $result = mysqli_query($dbc, $query) or die('error getting birthdate');
        while($row = mysqli_fetch_array($result)){
            $birthdate = $row['birthdate'];
            $weight = $row['weight'];
          }
          
        // Validate the entries, all should be numeric
        // Update the exercise data in the database
        //  if they aren't empty
        if (!empty($type) && !empty($dateOfExercise) && !empty($timeDone) && !empty($heartrate))
        {
            // if they are numeric
            if (is_numeric($timeDone) && is_numeric($heartrate))
            {
              //caculate age from birthdate cookie and currrent dateOfExercise
              $age = date_diff(date_create($birthdate), date_create($dateOfExercise));
              $age = $age->format('%y');
              //echo 'age is : . ' $age

              //if male
              if ($_COOKIE['gender'] == "M" )
              {
                $calories = ((-55.0969 + (0.6309 * $heartrate) + (0.090174 * $weight) + (0.2017 * $age)) / 4.184) * $timeDone;
                //echo $calories;
              } else {
                //female calculations
                $calories = ((-20.4022 + (0.4472 * $heartrate)-(0.057288 * $weight) + (0.074 * $age)) / 4.184) * $timeDone;

              }
              //display calories burned
              echo '<h3>You Burned ' . $calories . ' Calories!  Way to go!</h3>';
                //insert into database
              $query = "INSERT INTO exercise_log (user_id, type, dateOfExercise, time_in_minutes, heartrate, calories)"
                        . " VALUES ('$user_id', '$type', '$dateOfExercise', '$timeDone', '$heartrate', '$calories')"
                          or die('Error connecting to database');


                mysqli_query($dbc, $query) or die('error inserting'.mysqli_error($dbc));

                // Confirm success with the user
                echo '<p>Your exercise has been successfully added to the database. Would you like to <a href="logExercise.php"> log another exercise?</a>?<br/>
                        or <a href="viewprofile.php"> view your exercises?</a></p>';

                mysqli_close($dbc);
                exit();
              }
       }
       else {
         echo '<p class="error">You must enter all of the exercise data in the form as requested.</p>';
       }
     }



  ?>



  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <fieldset>
      <legend>Log your Exercise Module</legend>
      <label for="type">Type of Exercise:</label>
      <select id="type" name="type">
          <option value="Walking">Walking</option>
          <option value="Running">Running</option>
          <option value="Yoga">Yoga</option>
          <option value="Zumba">Zumba</option>
          </select>
          <br>
      <label for="dateOfExercise">Date:</label>
      <input type="text" id="dateOfExercise" name="dateOfExercise" value="<?php if (!empty($date)) echo $date; else echo 'YYYY-MM-DD'; ?>" /><br />

      <label for="time">Time in Minutes:</label>
      <input type="text" id="time" name="time" value="<?php if (!empty($timeDone)) echo $timeDone; ?>" /><br />
      <label for="heartrate">Heartrate in beats per minute:</label>
      <input type="text" id="heartrate" name="heartrate" value="<?php if (!empty($heartrate)) echo $heartrate; ?>" /><br />

    </fieldset>
    <input type="submit" value="Save This Exercise" name="submit" />
  </form>
  <?php

    // Insert the page footer
    require_once('footer.php');
  ?>
