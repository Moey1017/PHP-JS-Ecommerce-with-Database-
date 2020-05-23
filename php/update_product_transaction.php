<?php

session_start();
?>
<?php

$product_id = filter_input(INPUT_POST, "product_id", FILTER_SANITIZE_NUMBER_INT);
if (!isset($product_id)) {
    if (!filter_var($product_id, FILTER_VALIDATE_INT)) {
        header("location: ../index.php"); // deal with invalid input
        exit();
    }
}
$name = ltrim(rtrim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING)));
if (empty($name)) {
    header("location: ../index.php"); // deal with invalid input
    exit();
}

$category = ltrim(rtrim(filter_input(INPUT_POST, "category", FILTER_SANITIZE_STRING)));
if (empty($category)) {
    header("location: ../index.php"); // deal with invalid input
    exit();
}

$brand = ltrim(rtrim(filter_input(INPUT_POST, "brand", FILTER_SANITIZE_STRING)));
if (empty($brand)) {
    header("location: ../index.php"); // deal with invalid input
    exit();
}

$price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_STRING);
if (!isset($price)) {

    header("location: ../index.php"); // deal with invalid input
    exit();
}

$description = ltrim(rtrim(filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING)));
if (empty($description)) {
    header("location: ../index.php"); // deal with invalid input
}

$availability = filter_input(INPUT_POST, "availability", FILTER_SANITIZE_NUMBER_INT);
if (!isset($availability)) {
    if (!filter_var($availability, FILTER_VALIDATE_INT)) {
        header("location: ../index.php"); // deal with invalid input
        exit();
    }
}

/* Include "configuration.php" file */
require_once "configuration.php";

/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception

/* Perform query */
$query = "UPDATE products SET product_name = :name, category = :category, brand = :brand, price = :price, description = :description, availability = :avail WHERE product_id = :product_id";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":product_id", $product_id, PDO::PARAM_INT);
$statement->bindParam(":name", $name, PDO::PARAM_STR);
$statement->bindParam(":category", $category, PDO::PARAM_STR);
$statement->bindParam(":brand", $brand, PDO::PARAM_STR);
$statement->bindParam(":price", $price, PDO::PARAM_INT);
$statement->bindParam(":description", $description, PDO::PARAM_STR);
$statement->bindParam(":avail", $availability, PDO::PARAM_INT);
$statement->execute();

/* Provide feedback that the record has been deleted */
if ($statement->rowCount() > 0) {
    echo "<p>Record successfully updated.</p>";
} else {
    echo "<p>Record could not be updated</p>";
}



/* Provide a link for the user to proceed to a new webpage or automatically redirect to a new webpage */
//echo "<a href=" . $siteName . "/insert.php>Click here to add another record</>";
header("location: ../update_comfirmation.php");
?>   

