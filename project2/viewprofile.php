<?php
    // Start the session
    require_once('startsession.php');
    // Insert the page header
    $page_title = 'View Profile';
    require_once('header.php');
    require_once('connectvars.php');
    // Make sure the user is logged in before going any further.
    if (!isset($_SESSION['user_id']))
    {
        echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
        exit();
    }
    // Show the navigation menu
    require_once('navmenu.php');//
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('error connecting to database');

    // Grab the profile data from the database
    if (!isset($_GET['user_id']))
    {
        $query = "SELECT username, first_name, last_name, gender, birthdate, weight FROM exercise_user WHERE id = '" . $_SESSION['user_id'] . "'"
            or die('Error connecting to database');
    }
    else
    {
        $query = "SELECT username, first_name, last_name, gender, birthdate, weight FROM exercise_user WHERE id = '" . $_GET['user_id'] . "'"
                or die('Error connecting to database');
    }
    $data = mysqli_query($dbc, $query.mysqli_error($dbc));

    if (mysqli_num_rows($data) == 1)
    {
        // The user row was found so display'; the user data
        $row = mysqli_fetch_array($data);
        echo '<table>';
            if (!empty($row['username']))
            {
                echo '<tr><td class="label">Username:</td><td>' . $row['username'] . '</td></tr>';
            }
            if (!empty($row['first_name']))
            {
                echo '<tr><td class="label">First name:</td><td>' . $row['first_name'] . '</td></tr>';
            }
            if (!empty($row['last_name']))
            {
            echo '<tr><td class="label">Last name:</td><td>' . $row['last_name'] . '</td></tr>';
            }
            if (!empty($row['gender']))
            {
                echo '<tr><td class="label">Gender:</td><td>';
                if ($row['gender'] == 'M')
                {
                    echo 'Male';
                }
                else if ($row['gender'] == 'F')
                {
                    echo 'Female';
                }
            else
            {
                echo '?';
            }
            echo '</td></tr>';
            }

            if (!empty($row['birthdate']))
            {
                if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id']))
                {
                    // Show the user their own birthdate
                    echo '<tr><td class="label">Birthdate:</td><td>' . $row['birthdate'] . '</td></tr>';
                }
            if (!empty($row['weight']))
            {
                if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id']))
                {
                    // Show the user their own weight
                    echo '<tr><td class="label">Weight:</td><td>' . $row['weight'] . ' lbs </td></tr>';
                }
            }

            echo '</table>';
            if (!isset($_GET['user_id']) || ($_SESSION['user_id'] == $_GET['user_id']))
            {
                echo '<p>Would you like to <a href="editprofile.php">edit your profile</a>?</p>';
            }
          }
          } // End of check for a single row of user results
    else {
    echo '<p class="error">There was a problem accessing your profile.</p>';
    }

    //display exercise table
    $query = "SELECT * FROM exercise_log WHERE user_id = '" . $_SESSION['user_id'] . "'Order by dateOfExercise desc LIMIT 15"
            or die('Error connecting to database');

    $data = mysqli_query($dbc, $query);

    echo '<table id="exercise">';
    echo '<th class="label">Exercise Date</th>';
    echo '<th class="label">Exercise Type</th>';
    echo '<th class="label">Time</th>';
    echo '<th class="label">Hearrate</th>';
    echo '<th class="label">Calories Burned</th>';
    echo '<th class="label">Remove This Exercise</th></tr>';
    //loop through db table and display
    while ($row = mysqli_fetch_array($data))
    {
        //$id =$row['id'] ;//for GET??
        echo '<tr><td>' . $row['dateOfExercise'] . '</td>';
        echo '<td>' . $row['type'] . '</td>';
        echo '<td>' . $row['time_in_minutes'] . '</td>';
        echo '<td>' . $row['heartrate'] . '</td>';
        echo '<td>' . $row['calories'] . '</td>';
        echo '<td><a href="removeexercise.php?id=' . $row['id'] . '&amp;dateOfExercise=' . $row['dateOfExercise'] .
          '&amp;type=' . $row['type'] . '&amp;time_in_minutes=' . $row['time_in_minutes'] .
          '&amp;heartrate=' . $row['heartrate'] . '&amp;calories=' . $row['calories'] . '">Remove</a></td></tr>';
      }
    echo '</table>';
    mysqli_close($dbc);

    // Insert the page footer
    require_once('footer.php');
?>
