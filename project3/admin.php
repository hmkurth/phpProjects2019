<?php
    require_once('authorize.php');


    $page_title = 'Blog Admin';
    require_once('header.php');

    require_once('connectvars.php');

    // Show the navigation menu
    require_once('navmenu.php');
    ?>

<body>
  <h2>Blog Administration</h2>
  <p>Below is a list of all Blogs. Use this page to remove blogs as needed.</p>
  <hr />

<?php

  require_once('connectvars.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  // Retrieve the score data from MySQL
  $query = "SELECT * FROM editor ORDER BY created"
          or die("error selecting from database");
  $data = mysqli_query($dbc, $query);

  // Loop through the array of blog data, formatting it as HTML
  echo '<table>';
  echo '<tr><th>Title</th><th>Date</th><th>Preview</th><th>Action</th></tr>';
  while ($row = mysqli_fetch_array($data)) {
    // Display the blog
    echo '<tr class="titlerow"><td><strong>' . $row['title'] . '</strong></td>';
    echo '<td>' . $row['created'] . '</td>';
    echo '<td>' . $row['content'] . '</td>';
    echo '<td><a href="removeblog.php?id=' . $row['id'] . '&amp;created=' . $row['created'] .
      '&amp;title=' . $row['title'] . '&amp;content=' . $row['content'] .
        '">Remove</a>';

    }//end while
    echo '</td></tr>';

  echo '</table>';

  mysqli_close($dbc);
?>

</body>
</html>
