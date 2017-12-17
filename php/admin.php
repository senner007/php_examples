<?php
session_start();
require_once('inc/functions.php');
require_once('inc/config.php');

ensure_user_is_authenticated();

echo $_SESSION['email'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin Page</title>
  </head>
  <body>
      <h1>The admin page</h1>
      <form action="logout.php" method="POST">
        <input type="submit" value="logout"/>
        <!-- call logout.php -->
      </form>

  </body>
</html>
