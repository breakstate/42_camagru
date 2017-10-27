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
    <?php include_once './resources/database.php' ?>
    <?php include_once './resources/session.php' ?>
    <?php var_dump($_SESSION) ?>
    <?php if (!isset($_SESSION['id'])): ?>
    <p>You are not signed in: <a href="login.php">Login</a></p>
    <p>Not yet a member? <a href="signup.php">Sign up</a></p>
    <?php else: ?>
    <p>You are logged in as <?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?> <a href="logout.php">Logout</a></p>
    <?php endif ?>
  </body>
</html>
