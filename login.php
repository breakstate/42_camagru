<?php
include_once 'resources/session.php';
include_once 'resources/database.php';
include_once 'resources/utilities.php';

if (isset($_POST['loginBtn']))
{
  $form_errors = array();
  $required_fields = array('username', 'password');
  $field_lengths = array('username' => 4, 'password' => 6);

  $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
  $form_errors = array_merge($form_errors, check_min_length($field_lengths));
  if (empty($form_errors))
  {

    $username = $_POST['username'];
    $password = $_POST['password'];
    // check if user exists
    $sqlQuery = "SELECT * FROM tb_users WHERE username = :username";
    $statement = $db->prepare($sqlQuery);
    $statement->execute(array(':username' => $username));

    while ($row = $statement->fetch())
    {
      $id = $row['id'];
      $hashed_pw = $row['password'];
      $username = $row['username'];

      if (password_verify($password, $hashed_pw))
      {
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        header("location: index.php");
      }
      else
      {
        $result = "<p>Invalid username or password</p>";
      }
    }
  }
  else
  {
    $result = show_form_errors($form_errors);
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
  </head>
  <body>
    <h2>
      User Authentication System
    </h2><hr>
    <?php if (isset($result)) echo $result; ?>
    <form method="post" action="">
      <table>
        <tr><td>username:</td><td><input type="text" aciton="" value="" name="username"></td></tr>
        <tr><td>password:</td><td><input type="password" aciton="" value="" name="password"></td></tr>
        <tr><td></td><td><input type="submit" value="login" name="loginBtn"></td>
      </table>
    </form>
    <a href="index.php">Back</a>
  </body>
</html>
