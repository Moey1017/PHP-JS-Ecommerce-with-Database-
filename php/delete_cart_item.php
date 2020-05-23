<?php

session_start();
?>
<?php

/* Validate and assign input data */
$product_id = ltrim(rtrim(filter_input(INPUT_GET, "product_id", FILTER_SANITIZE_NUMBER_INT)));
if ((empty($product_id)) || (!filter_var($product_id, FILTER_VALIDATE_INT))) {
    header("location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* Include "configuration.php" file */
require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

/* Perform query */
$query = "UPDATE order_lines ol JOIN orders ON ol.order_id = orders.id 
        SET quantity = (quantity - 1)
        WHERE (product_id = :product_id AND user_id = $user_id)";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":product_id", $product_id, PDO::PARAM_INT);
$statement->execute();

$query_check = "SELECT quantity FROM order_lines ol, orders o
                WHERE ol.order_id = o.id
                AND (product_id = :product_id AND user_id = $user_id)";
$statement_check = $dbConnection->prepare($query_check);
$statement_check->bindParam(":product_id", $product_id, PDO::PARAM_INT);
$statement_check->execute();

if ($statement_check->rowCount() > 0) {
    
    $row = $statement_check->fetchAll(PDO::FETCH_OBJ);
    if ($row->quantity <= 0) {
        $query = "DELETE FROM order_lines 
                USING order_lines, orders
                WHERE order_lines.order_id = orders.id AND (product_id = :product_id AND user_id = $user_id)";
        $statement = $dbConnection->prepare($query);
        $statement->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $statement->execute();
    }
}

header("location: ../cart.php");
?>   
