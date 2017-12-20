<?php
$dsn = "mysql:host=localhost; dbname=db_camagru";
$username = "root";
$password = "mamppass";
$header = "From: poop@butt.com";

try{
  // creates instance of PDO class
  $db = new PDO($dsn, $username, $password);
  // set PDO error mode to exception
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // dislpay message on success
  echo "Connection to db established\n";
}catch (PDOException $ex){
  // display message on failure
  echo "Connection to db failed".$ex->getMessage()."\n";
}
?>
