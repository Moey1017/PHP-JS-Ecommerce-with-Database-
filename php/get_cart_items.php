<?php
session_start();
?>
<?php
/* Include "configuration.php" file */
require_once "configuration.php";

$user_id = $_SESSION["user_id"];
/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

/* Perform query */
$query = "SELECT p.product_id, p.product_name, p.product_image, quantity, p.price, (quantity * price) AS item_total
FROM products p, order_lines ol, orders o, users u
WHERE ol.product_id = p.product_id
AND o.id = ol.order_id
AND u.id = o.user_id
AND (u.id = $user_id AND o.status = '0')";
$statement = $dbConnection->prepare($query);       
$statement->execute();

$_SESSION["order_total"] = 0;
/* Manipulate the query result */
$json = "[";
if ($statement->rowCount() > 0)
{
    /* Get field information for all fields */
    $isFirstRecord = true;
    
    $result = $statement->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $row)
    {
        if(!$isFirstRecord)
        {
            $json .= ",";
        }
        
        $_SESSION["order_total"] += $row->item_total; 
        
        /* NOTE: json strings MUST have double quotes around the attribute names, as shown below */
        $json .= '{"product_id":"' . $row->product_id . '","product_name":"' . $row->product_name . '","product_image":"' . $row->product_image  . '","quantity":"' . $row->quantity  . '","item_total":"' . $row->item_total  .'","price":"' . $row->price  .'"}';
        
        $isFirstRecord = false;
    }  
}     
$json .= "]";

/* Send the $json string back to the webpage that sent the AJAX request */
echo $json;
?>


