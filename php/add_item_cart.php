<?php

session_start();
?>
<?php

header("Content-Type: application/json; charset=UTF-8");
/* read the json data that was sent to this file */
$jsonData = json_decode(file_get_contents('php://input'), true);
/* Validate and assign input data */

$product_id = $jsonData['product_id'];
$quantity = $jsonData['quantity'];
if (empty($product_id) || empty($quantity)) {
    echo "[]"; // send back an empty JSON string
    exit();
}

/* Include "configuration.php" file */
require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception


$query_status = "SELECT id, user_id, Status FROM orders WHERE user_id = " . $_SESSION["user_id"] . " AND status = '0'";
$statement_status = $dbConnection->prepare($query_status);
$statement_status->execute();

$order_id = "";

if ($statement_status->rowCount() > 0) {
    $row = $statement_status->fetch(PDO::FETCH_OBJ);
    $order_id = $row->id;
}
else 
    {
    $query = "INSERT INTO orders VALUES(default, " . $_SESSION["user_id"] . ", default, '0' , 0)";
    $statement = $dbConnection->prepare($query);
    $statement->execute();

    $query_order_id = "SELECT id, user_id, status FROM orders WHERE user_id = " . $_SESSION["user_id"] . " AND status = '0'";
    $statement_order_id = $dbConnection->prepare($query_order_id);
    $statement_order_id->execute();

    if ($statement_order_id->rowCount() > 0) {
        $row = $statement_order_id->fetch(PDO::FETCH_OBJ);
        $order_id = $row->id;
    }
}

$query_product = "SELECT ol.product_id, order_id, ol.quantity, p.availability
FROM order_lines ol, products p
WHERE ol.product_id = p.product_id
AND (ol.product_id = " . $product_id . " AND ol.order_id =  " . $order_id . ")";
$statement_product = $dbConnection->prepare($query_product);
$statement_product->execute();

$current_quantity;

if ($statement_product->rowCount() === 0) { 
    
    $query_availability = "SELECT availability FROM products WHERE product_id = ".$product_id."";
    $statement_availability = $dbConnection->prepare($query_availability);
    $statement_availability->execute();

    if ($statement_availability->rowCount() > 0) {
        $row = $statement_availability->fetch(PDO::FETCH_OBJ);
        $availability = $row->availability;
    }
    
    if($quantity > $availability)
    {
        $quantity = $availability;
    }
    
    $query = "INSERT INTO order_lines VALUES(default, " . $order_id . " , " . $product_id . " , " . $quantity . ")";
    $statement = $dbConnection->prepare($query);
    $statement->bindParam(":product_id", $product_id, PDO::PARAM_INT);
    $statement->execute();
} else {

    if ($statement_product->rowCount() > 0) {
        $row = $statement_product->fetch(PDO::FETCH_OBJ);
        $current_quantity = $row->quantity;
        $max_quantity = $row->availability;
    }

    $new_quantity = $quantity + $current_quantity;
    if ($new_quantity > $max_quantity) {
        $new_quantity = $max_quantity;
    }

    $query_update = "UPDATE order_lines SET quantity= " . $new_quantity . " WHERE product_id = " . $product_id . ";";
    $statement_update = $dbConnection->prepare($query_update);
    $statement_update->execute();
}

$query_total = "SELECT quantity, p.price, (quantity * price) AS item_total, SUM(quantity * price) AS order_total
FROM products p, order_lines ol, orders o, users u
WHERE ol.product_id = p.product_id
AND o.id = ol.order_id
AND u.id = o.user_id
AND (u.id = ".$_SESSION["user_id"].")";
$statement_total = $dbConnection->prepare($query_total);       
$statement_total->execute();

if ($statement_total->rowCount() > 0)
{
    $row = $statement_total->fetch(PDO::FETCH_OBJ);
    $_SESSION["order_total"] = $row->order_total; 
}



