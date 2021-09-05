<?php

   // Insert the page header
   $page_title = 'View Blogs';
   require_once('header.php');

   //require_once('appvars.php');
   require_once('connectvars.php');
   // Show the navigation menu
   require_once('navmenu.php');
  ?>
  <header class="page-header header container-fluid">
    <div class="overlay">  </div>
    <div class="description">
      <h1>What are people saying?!</h1>
      <p>Opinions are like arms, everyone has them, why not read them?</p>
    </div>
  </header>
  <?php

   // Connect to the database
   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
          or die('Error connecting to database');
   //get blogs from dbwords
   $query = "SELECT * FROM words order by datecreated desc";

   $result = mysqli_query($dbc, $query) or die('error getting blogs');
   //insert table head
   echo '<table class=”table-dark”>';
   echo '<thead><tr><th scope=”col”>Date</th><th scope=”col”>Title</th><th scope=”col”>Blog</th></tr></thead>';
   echo '<tbody>';
   while($row = mysqli_fetch_array($result))
   {

        echo '<th scope=”row”>*</th><tr><td>' . $row['datecreated'] . '</td>';
        echo '<td>' . $row['title'] . '</td>';
        echo '<td>' . $row['content'] . '</td></tr>';

    }
    echo '</tbody></table>';
    mysqli_close($dbc);

   //require_once('columncontainerthing.php');
   require_once('footer.php');
   ?>
