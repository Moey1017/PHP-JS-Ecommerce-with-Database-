<?php
session_start();
?>
<?php
/* Validate and assign input data */
$product_id = ltrim(rtrim(filter_input(INPUT_GET, "product_id", FILTER_SANITIZE_NUMBER_INT)));
if ((empty($product_id)) || (!filter_var($product_id, FILTER_VALIDATE_INT)))
{
    header("location: ../index.php");
    exit();
}


/* Include "configuration.php" file */
require_once "configuration.php";



/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* Perform query */
$query = "DELETE FROM products WHERE product_id = :product_id";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":product_id", $product_id, PDO::PARAM_INT);
$statement->execute();



/* Provide feedback that the record has been deleted */
if ($statement->rowCount() > 0)
{
    echo "<p>Record successfully deleted.</p>";   
}
else
{
    echo "<p>Record does not exist, so it cannot be deleted.</p>";
}



/* Provide a link for the user to proceed to a new webpage or automatically redirect to a new webpage */
//echo "<a href=" . $siteName . "/insert.php>Click here to add another record</>";
header("location: ../confirm_deletion.php");
?>   
