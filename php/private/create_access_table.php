<?php
/* Include "configuration.php" file */
require_once "configuration.php";



/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* If the table already exists, then delete it */
$query = "DROP TABLE IF EXISTS access_level";
$statement = $dbConnection->prepare($query);
$statement->execute();



/* Create table */
$query = "CREATE TABLE access_level (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                               name VARCHAR(50) NOT NULL
                              )";
$statement = $dbConnection->prepare($query);
$statement->execute();

$query = "INSERT INTO access_level (name) VALUES ('Admin')";
$statement = $dbConnection->prepare($query);
$statement->execute();

$query = "INSERT INTO access_level (name) VALUES ('Normal')";
$statement = $dbConnection->prepare($query);
$statement->execute();

/* Provide feedback to the user */
echo "Table 'access_level' created.";
?>

