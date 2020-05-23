<?php
session_start();
?>
<?php
header("Content-Type: application/json; charset=UTF-8");
/* read the json data that was sent to this file */
$jsonData = json_decode(file_get_contents('php://input'), true);
/* Validate and assign input data */

$shipping = $jsonData['shipping'];
$client_total = $jsonData['total'];
if (empty($client_total)) {
    exit();
}


/* Include "configuration.php" file */
require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception

$order_correct = false;

/* Perform query */
$query_total = "SELECT quantity, p.price, (quantity * price) AS item_total, SUM(quantity * price) AS order_total
FROM products p, order_lines ol, orders o, users u
WHERE ol.product_id = p.product_id
AND o.id = ol.order_id
AND u.id = o.user_id
AND (u.id = " . $_SESSION["user_id"] . " AND o.status = '0')";
$statement_total = $dbConnection->prepare($query_total);
$statement_total->execute();

if ($statement_total->rowCount() > 0) {
    $row = $statement_total->fetch(PDO::FETCH_OBJ);
    $order_total = $row->order_total;

    if ($order_total + $shipping === $client_total) {
        $order_correct = true;
        $_SESSION['order_total'] = ($client_total + $shipping);
    }
}


/* Manipulate the query result */


if ($order_correct === true) {
    $json = "[";
    $json .= '{"correct":"' . $order_correct . '"}';
    $json .= "]";
    echo $json;
}
else
{
    $_SESSION['error'] = $ERROR_ORDER_NOT_CORRECT;  
    header("location: error.php");                              // deal with invalid input
    exit();
}



