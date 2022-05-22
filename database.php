<?php
$servername = "localhost";
$username = "username";
$password = "password";
$databasename = "course_registration"; 
$databasetable = "student_details"; 

$fieldseparator = ","; 
$lineseparator = "\n";

$csvfile = "data.csv";


if(!file_exists($csvfile)) 
{
  die("File not found. Make sure you specified the correct path.");
  
}


try {
  $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password,
  // set the PDO error mode to exception
  array
  (
    PDO::MYSQL_ATTR_LOCAL_INFILE => true,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  )
  );
  
  echo "Connected successfully";
} 
catch (PDOException $e) 
{
  die("database connection failed: ".$e->getMessage());
}


$affectedRows = $conn->exec
(
  "LOAD DATA LOCAL INFILE "
  .$conn->quote($csvfile)
  ." INTO TABLE `$databasetable` FIELDS TERMINATED BY "
  .$conn->quote($fieldseparator)
  ."LINES TERMINATED BY "
  .$conn->quote($lineseparator)
);
?>