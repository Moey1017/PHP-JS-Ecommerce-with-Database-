<?php
session_start();
?>
<?php
/* Include "configuration.php" file */
require_once "configuration.php";


/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

/* Perform query */
$query = "SELECT u.name, u.email, SUM(quantity * price) AS order_total, SUM(quantity) AS quantity
FROM products p, order_lines ol, orders o, users u
WHERE ol.product_id = p.product_id
AND o.id = ol.order_id
AND u.id = o.user_id
AND (u.id = ".$_SESSION["user_id"]." AND o.status = '0')";
$statement = $dbConnection->prepare($query);       
$statement->execute();

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
        
        $_SESSION["payment_email"]= $row->email;
        $_SESSION["payment_amount"]= $row->order_total;
        
        /* NOTE: json strings MUST have double quotes around the attribute names, as shown below */
        $json .= '{"name":"' . $row->name . '","email":"' . $row->email . '","order_total":"' . $_SESSION['order_total'] . '","quantity":"' . $row->quantity. '"}';
         
        $isFirstRecord = false;
    }  
}     
$json .= "]";

/* Send the $json string back to the webpage that sent the AJAX request */
echo $json;
?>

