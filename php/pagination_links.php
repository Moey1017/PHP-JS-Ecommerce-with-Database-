<?php
require_once "configuration.php";

$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

$results_per_page = 12;

$query = "SELECT product_id FROM products";
$statement = $dbConnection->prepare($query);       
$statement->execute();
$num_rows = $statement->rowCount();

$num_rows;

$num_of_links = ceil($num_rows/$results_per_page);

$num_of_links;

$json = "[";
if ($statement->rowCount() > 0)
{
    $json .= '{"num_of_links":"'. $num_of_links .'"}';
}
$json .= "]";

echo $json;
?>