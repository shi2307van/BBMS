<?php
$servername = "localhost";
$username = "root";
$password = "";

try {
  $conn = new PDO("mysql:host=$servername;dbname=bbms", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  session_start();
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

  $str=$conn->prepare("UPDATE `tblbloodcamp` SET `status`=1 where CURRENT_DATE()>date_of_camp");
  $str->execute();

  $sql=$conn->prepare("UPDATE `tblbloodbag` SET `status`='-1' where CURRENT_DATE()=valid_upto");
  $sql->execute();
?>