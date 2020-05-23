<?php

/* Include "configuration.php" file */
require_once "configuration.php";



/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception


/* If the table already exists, then delete it */
$query = "DROP TABLE IF EXISTS users";

$statement = $dbConnection->prepare($query);
$statement->execute();

/* create table */
$query = "CREATE TABLE users(id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
          name VARCHAR(50) NOT NULL,
          email VARCHAR(100) NOT NULL,
          password VARCHAR(200) NOT NULL,
          access_level int(6) NOT NULL)";
$statement = $dbConnection->prepare($query);
$statement->execute();

/* Provide feedback to the user */
echo "Table 'users' created.";
?>
