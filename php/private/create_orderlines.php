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
        require_once "../configuration.php";



        /* Connect to the database */
        $dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



        /* If the table already exists, then delete it */
        $query = "DROP TABLE IF EXISTS order_lines";
        $statement = $dbConnection->prepare($query);
        $statement->execute();



        /* Create table */
        $query = "CREATE TABLE order_lines(order_lines_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    order_id INT(11) NOT NULL,
                    product_id INT(6) UNSIGNED NOT NULL,
                    quantity INT NOT NULL,
                    FOREIGN KEY (order_id) REFERENCES orders(id),
                    FOREIGN KEY (product_id) REFERENCES products(product_id));";
        $statement = $dbConnection->prepare($query);
        $statement->execute();



        /* Provide feedback to the user */
        echo "Table 'order_lines' created.";
        ?>

    </body>
</html>
