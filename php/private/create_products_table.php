<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Create Database Table Example</title>
    </head>
    <body>

        <?php
        /* Include "configuration.php" file */
        require_once "configuration.php";



        /* Connect to the database */
        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



        /* If the table already exists, then delete it */
        $query = "DROP TABLE IF EXISTS products";
        $statement = $dbConnection->prepare($query);
        $statement->execute();



        /* Create table */
        $query = "CREATE TABLE products(product_id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    product_name VARCHAR(55) NOT NULL,
                    category VARCHAR(55) NOT NULL,
                    brand VARCHAR(55),
                    product_image VARCHAR(255) NOT NULL,
                    price DOUBLE(10,2) NOT NULL,
                    description VARCHAR(255) NOT NULL
                    availability INT(3) UNSIGNED NOT NULL)";
        $statement = $dbConnection->prepare($query);
        $statement->execute();



        /* Provide feedback to the user */
        echo "Table 'products' created.";
        ?>

    </body>
</html>

