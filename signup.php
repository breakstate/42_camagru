<?php
  include_once 'database/database.php';
  var_dump($_POST);

  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $hashedpw = password_hash($password, PASSWORD_DEFAULT);// check if this is the most secure way
  $submit = $_POST['submit'];
  if ($submit === "submit" && $username !== "" && $email !== "" && $password !== "")
  {
    try{
        $sqlInsert = "INSERT INTO tb_users (username, password, email)
                    VALUES (:username, :hashedpw, :email)";
        $statement = $db->prepare($sqlInsert);
        $statement->execute(array(':username' => $username, ':hashedpw' => $hashedpw, ':email' => $email));

        if ($statement->rowCount() == 1)
        {
          echo "yes";
        }
    }catch(PDOException $ex){
      echo "no";
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
