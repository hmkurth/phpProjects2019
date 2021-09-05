<?PHP
    // Start the session
    require_once('startsession.php');

    // Insert the page header
    $page_title = 'Remove An Exercise';
    require_once('header.php');
    require_once('connectvars.php');


    if (isset($_GET['id']) && isset($_GET['created']) && isset($_GET['content'])
            && isset($_GET['title']))
    {
        // Grab the blog data from the GET
        $id = $_GET['id'];
        $created = $_GET['created'];
        $title = $_GET['title'];
        $content= $_GET['content'];


        // Connect to the database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                  or die('error removing blog');

        // Delete the score data from the database
        $query = "DELETE FROM editor WHERE id = $id LIMIT 1";
        mysqli_query($dbc, $query.mysqli_error($dbc));
        mysqli_close($dbc);

        // Confirm success with the user
        echo '<p>The blog was successfully removed.';
        }
        else {
            echo '<p class="error">The blog was not removed.</p>';
        }

        echo '<p><a href="index.php">&lt;&lt; Back to blogger</a></p>';
        // Insert the page footer
        require_once('footer.php');
?>
