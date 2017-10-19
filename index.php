<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Database connection</title>
  </head>
  <body>
    <h2>
      User Authentication System
    </h2><hr>
    <?php include_once './database/database.php' ?>
    <p>You are not signed in: <a href="login.php">Login</a></p>
    <p>Not yet a member? <a href="signup.php">Sign up</a></p>
    <p>You are logged in as {username} <a href="logout.php">Logout</a></p>
  </body>
</html>
