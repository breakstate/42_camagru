<?php
  include_once 'resources/database.php';
  include_once 'resources/utilities.php';
  var_dump($_POST);

  if (isset($_POST['submit'])) //&& $username !== "" && $email !== "" && $password !== "")
  {
    // initialize arrray to store error messages
    $form_errors = array();
    // stores list of required fields
    $required_fields = array('email', 'username', 'password');
    // add list of required fields that are missing to form_errors array
    $form_errors = array_merge($form_errors, check_empty_fields($required_fields));
    // set minimum lengths of fields
    $field_lengths = array('email' => 3, 'username' => 4, 'password' => 6);
    // add list of entries that are too short
    $form_errors = array_merge($form_errors, check_min_length($field_lengths));


    if (empty($form_errors))
    {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $hashedpw = password_hash($password, PASSWORD_DEFAULT);// check if this is the most secure way

      try
      {
          $sqlInsert = "INSERT INTO tb_users (username, password, email)
                      VALUES (:username, :hashedpw, :email)";
          $statement = $db->prepare($sqlInsert);
          $statement->execute(array(':username' => $username, ':hashedpw' => $hashedpw, ':email' => $email));

          if ($statement->rowCount() == 1)
          {
            $result = "<p>Registration successful</p>";
            //echo "yes";
          }
      }
      catch(PDOException $ex)
      {
        $result = "<p>An error occurred: " . $ex->getMessage() . "</p>";
        //echo "no";
      }
    }
    else
    {
      $result = "<p>Errors: " . count($form_errors) . "<br>";
      $result .= "<ul>";
      foreach($form_errors as $error)
      {
        $result .= "<li>{$error}</li>";
      }
      $result .= "</ul></p>";
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign up</title>
  </head>
  <body>
    <h2>
      User Authentication System
    </h2><hr>
    <?php if(isset($result)) echo $result;?>
    <form method="post" action="">
      <table>
        <tr><td>Email:</td><td><input type="email" aciton="" value="" name="email"></td></tr>
        <tr><td>Username:</td><td><input type="text" aciton="" value="" name="username"></td></tr>
        <tr><td>Password:</td><td><input type="password" aciton="" value="" name="password"></td></tr>
        <tr><td></td><td><input type="submit" value="submit" name="submit"></td>
      </table>
    </form>
    <a href="index.php">Back</a>
  </body>
</html>
