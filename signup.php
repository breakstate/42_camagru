<?php
  include_once 'resources/database.php';
  include_once 'resources/utilities.php';
  if (isset($_POST['signupBtn'])) //&& $username !== "" && $email !== "" && $password !== "")
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
    // check validity of email address
    $form_errors = array_merge($form_errors, check_email($_POST));


    // if no form errors: do the following
    if (empty($form_errors))
    {
      var_dump($_POST);
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
            $result = "<p>Registration successful!</p><br><p>Verification email has been sent.</p>";
            $msg = "Registration successful";
            $msg = wordwrap($msg, 70);
            //mail('juganaught72@gmail.com', 'My Subject', "Poop IN my Mouth");
            $mail_result = mail($email, 'Camagru registration test', $msg, $header);
            $debug = "<p>email containing [$msg] should be sent to [$email]</p>";//debug message to check if execution
            echo "mail_result = [$mail_result]";
            //short timer?
            //header("location: login.php");
          }
      }
      catch(PDOException $ex)
      {
        $result = "<p>An error occurred: " . $ex->getMessage() . "</p>";
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
    <title>Sign up</title>
  </head>
  <body>
    <h2>
      User Authentication System
    </h2><hr>
    <?php if(isset($result)) echo $result;?>
    <?php if(isset($debug)) echo $debug;?><!debug message to check if statement execution>
    <form method="post" action="">
      <table>
        <tr><td>email:</td><td><input type="text" aciton="" value="" name="email"></td></tr>
        <tr><td>username:</td><td><input type="text" aciton="" value="" name="username"></td></tr>
        <tr><td>password:</td><td><input type="password" aciton="" value="" name="password"></td></tr>
        <tr><td></td><td><input type="submit" value="signup" name="signupBtn"></td>
      </table>
    </form>
    <a href="index.php">Back</a>
  </body>
</html>
