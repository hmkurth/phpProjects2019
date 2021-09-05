<?php
  // User name and password for authentication
  $username = 'project';
  $password = 'babies';

  if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) ||
    ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password)) {
    // The user name/password are incorrect so send the authentication headers
    header('HTTP/1.1 401 Unauthorized');
    header('WWW-Authenticate: Basic realm="ProjectBabies"');
    exit('<h2>Project Babies Admin</h2>Sorry, you must enter a valid user name and password to access this page.');
  }
?>
