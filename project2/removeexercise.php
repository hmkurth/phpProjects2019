<?PHP
    // Start the session
    require_once('startsession.php');

    // Insert the page header
    $page_title = 'Remove An Exercise';
    require_once('header.php');
    require_once('connectvars.php');


    if (isset($_GET['id']) && isset($_GET['dateOfExercise']) && isset($_GET['type'])
            && isset($_GET['time_in_minutes']) && isset($_GET['heartrate']) && isset($_GET['calories']))
    {
        // Grab the score data from the GET
        $id = $_GET['id'];
        $dateOfExercise = $_GET['dateOfExercise'];
        $type = $_GET['type'];
        $time = $_GET['time_in_minutes'];
        $heartrate = $_GET['heartrate'];
        $calories = $_GET['calories'];

        // Connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                  or die('error removing exercise');

        // Delete the score data from the database
        $query = "DELETE FROM exercise_log WHERE id = $id LIMIT 1";
        mysqli_query($dbc, $query.mysqli_error($dbc));
        mysqli_close($dbc);

        // Confirm success with the user
        echo '<p>The exercise was successfully removed.';
        }
        else {
            echo '<p class="error">The exercise was not removed.</p>';
        }

        echo '<p><a href="viewprofile.php">&lt;&lt; Back to exercises</a></p>';
        // Insert the page footer
        require_once('footer.php');
?>
