<?php
$dsn = "mysql:host=localhost; dbname=db_camagru";
$username = "root";
$password = "mamppass";
try{
  $db = new PDO($dsn, $username, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "Connection to db established";
}catch (PDOException $ex){
  echo "Connection to db failed".$ex->getMessage();
}
?>
