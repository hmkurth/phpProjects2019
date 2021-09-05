=<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>project01</title>
  <link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
    <h1>It's time to make a MadLib!</h1>
    <p>Fill Out the following form and we will output a story just for you!</p>
  
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="noun">Enter a noun:</label>
        <input type="text" id="noun" name="noun" /><br />
        <label for="verb">Enter a verb:</label>
        <input type="text" id="verb" name="verb" /><br />
        <label for="adjective">Enter an adjective:</label>
        <input type="text" id="adjective" name="adjective" /><br />
        <label for="adverb">Enter an adverb:</label> 
        <input type="text" id="adverb" name="adverb"/><br/>
        <input type="submit" name="submit" value="submit" />
  </form>

<?php

    if (isset($_POST['submit'])) {
    //grab the form data so it can be displayed
    $noun = $_POST['noun'];
    $verb = $_POST['verb'];
    $adjective = $_POST['adjective'];
    $adverb = $_POST['adverb'];
    $whole_story = '';
        if(!empty($noun) && !empty($verb) && !empty($adjective)
            && !empty($adverb)) {
            
            //create the story line  inserting the variables
            $title = 'The Story of the ' . $adjective . ' Princess';
            $whole_story = 'Once upon a time,in a land far, far away lived a fairy 
                    princess with a very ' . $adjective . ' story to tell.  Day after
                    day she would she would ' . $adverb . ' share her story with all 
                    who would listen.  Soon, the whole kingdom knew her ' . $adjective
                    .' story.  She knew that she would soon have to ' . $verb .
                    ' into the wilderness with her beloved pet ' . $noun . '. In the end
                     she lived happily ever after!';
                    echo '<h3> '. $title . '</h3><br/>';
                    echo '<p id="yourStory"> This is your new story:<br/>' . $whole_story 
                            . "</p><br/>";
         } else {
                echo"Please fill out all of the form fields to continue.";
         }
    
    //connect to database
    $dbc = mysqli_connect ('localhost', 'student', 'student', 'madlibdatabase')
            or die ('Error connecting to database');
    $query = "INSERT INTO words (noun, verb, adverb, adjective, whole_story)"
            . "VALUES ('$noun', '$verb', '$adverb', '$adjective',"
            . " '$whole_story')";
    mysqli_query($dbc, $query)
            or die ('Error connecting to database'); 
    //$row = mysqli_fetch_array($result);  //Ithink this doesn't have to be declared here
    
    //while($row = mysqli_fetch_array($result)) {
    //echo'result =' . $result;
       // $noun = $row['noun'];
       // $noun = $row['verb'];
       // $noun = $row['adjective'];
      //  $noun = $row['adverb'];
      //  $whole_story = $row['whole_story'];
  //  }
    mysqli_close($dbc);
    //echo($whole_story);   
 }           
    //make a new query to select wholestory from database and display it
    $dbc = mysqli_connect ('localhost', 'student', 'student', 'madlibdatabase')
           or die ('Error connecting to database');
    $newquery = "SELECT whole_story FROM words ORDER BY whole_story DESC";
    $newresult = mysqli_query($dbc, $newquery)
           or die('Error connecting to database');
    $row = mysqli_fetch_array($newresult);
    echo "<h3>Here are some old stories</h3><br/>";
    while ($row = mysqli_fetch_array($newresult)) {
        //display each story that is stored
        //echo $row . '<br/>';
        //echo $row['whole_story'];
        $whole_story = $row['whole_story'];
         
         echo $row['whole_story'] . "<br/><br/>";
       }
    
         
     mysqli_close($dbc);
?>


</body>
</html>
