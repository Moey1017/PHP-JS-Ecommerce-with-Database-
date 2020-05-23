<?php
session_start();
?>
<?php
/* Include "configuration.php" file */
require_once "configuration.php";
$user_id = $_SESSION['user_id'];

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

$order_complete = false;
/* Perform query */
$query = "UPDATE products AS p, orders AS o, order_lines AS ol
SET p.availability = p.availability - ol.quantity
WHERE ol.order_id = o.id AND ol.product_id = p.product_id
AND user_id = $user_id";
$statement = $dbConnection->prepare($query);
$statement->execute();

$_SESSION['order_total'] = 0;

$query_complete = "UPDATE orders
SET status = '1'
WHERE user_id = $user_id";
$statement_complete = $dbConnection->prepare($query_complete);
if($statement_complete->execute())
{
    $order_complete = true;
}



