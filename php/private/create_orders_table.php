<?php

/* Include "configuration.php" file */
require_once "configuration.php";



/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* If the table already exists, then delete it */
$query = "DROP TABLE IF EXISTS orders";
$statement = $dbConnection->prepare($query);
$statement->execute();



/* Create table */
$query = "CREATE TABLE orders(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
user_id INT(6) NOT NULL,
date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
total FLOAT NOT NULL)
FOREIGN KEY (user_id) REFERENCES users(user_id))";
$statement = $dbConnection->prepare($query);
$statement->execute();

/* Provide feedback to the user */
echo "Table 'orders' created.";
?>
