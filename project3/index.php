<?php
    // Insert the page header
    $page_title = 'Welcome to Blogger';
    require_once('header.php');
    require_once('connectvars.php');
    // Show the navigation menu
    require_once('navmenu.php');

?>
<header class="page-header header container-fluid">
  <div class="overlay">  </div>
  <div class="description">
    <h1>Welcome to Our Blogger!</h1>
    <p>Opinions are like arms, everyone has them, why not add your voice to the cacaphony?</p>
  </div>
</header>
<?php
    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
          or die('Error connecting to database');
    //if the user entered data from the form
    if (isset($_POST['submit']))
    {
        // Grab the  data from the POST
        $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
        $created = mysqli_real_escape_string($dbc, trim($_POST['created']));
        $content = mysqli_real_escape_string($dbc, trim($_REQUEST['editor']));

       // Validate the entries, all should be numeric
       // Update theblog data in the database
       //  if they aren't empty
       if (!empty($title) && !empty($created) && !empty($content))
       {
            //insert into database
            $query = "INSERT INTO editor (title ,content, created)"
                    . " VALUES ( '$title', '$content', '$created')"
                    or die('Error connecting to database.mysqli_error($dbc)');


            mysqli_query($dbc, $query) or die('error inserting'.mysqli_error($dbc));

            // Confirm success with the user
            echo '<p>Your blog has been successfully added to the database.<br/>
                      Would you like to <a href="viewblogs.php"> view blogs?</a></p>';

            mysqli_close($dbc);
            exit();
       }
       else {
       echo '<p class="error">You must enter all of the fields in the form as requested.</p>';
   }
 }
 ?>


<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <fieldset>
    <legend>Blog Your Feelings</legend>

        <br>
    <label for="created">Date:</label>
    <input type="date" id="created" name="created" value="<?php if (!empty($created)) echo $created; else echo 'YYYY-MM-DD'; ?>" /><br />
    <label for="title">Give Your Blog A Title:</label>
    <input type="text" id="title" name="title" value="<?php if (!empty($title)) echo $title; ?>" /><br />
    <label for="editor">Enter your blog here:</label>
    <div id="editor">
    <textarea id="editor" name="editor" rows="10"cols="80"></textarea><br />
    </div>

<script>
CKEDITOR.replace('editor');
</script>

  </fieldset>
  <input type="submit" value="Save This Blog" name="submit" />
</form>

<?php
    //require_once('columncontainerthing.php');
    require_once('footer.php');
 ?>
