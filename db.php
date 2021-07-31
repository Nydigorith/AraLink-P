<?php

/* Connection */
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "classvideo";

try {
  $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
  $conn = new PDO($dsn, $dbUser, $dbPassword);
} catch(PDOException $e) {
  echo "DB Connection Failed: " . $e->getMessage();
}

/*  To  Error */
/*  function error_found(){
    header("Location: error.php");
  }
  set_error_handler('error_found');  */