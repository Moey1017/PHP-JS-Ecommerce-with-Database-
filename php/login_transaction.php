<?php
session_start();

// if it exists, then destroy any previous session 
session_unset();
session_destroy();
session_start();

$error_message = "";
/* Validate and assign input data */
$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL)));
if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        header("location: login.php"); // deal with invalid input
        $error_message = "Invalid Login";
    }
}

$password = ltrim(rtrim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING)));
if (empty($password))
{
    header("location: login.php"); // deal with invalid input
}

/* Connect to the database */
require_once "configuration.php";



/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* Check that user is not already user_added  */
$query = "SELECT id, name , password, access_level FROM users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->execute();

$logged_in = false;
$_SESSION["user_name"] = "";

if($statement->rowCount() === 0)
{
    $_SESSION["error_message"] = "Username or Password Incorrect!";
}

$salted = "12345qwert".$password."09876";
$hashed = hash("sha512", $salted);

if ($statement->rowCount() > 0)
{
    $row = $statement->fetch(PDO::FETCH_OBJ);
    if ($hashed === $row->password)
    {
        // set session user_id
        $_SESSION["user_id"] = $row->id;
        $_SESSION["user_name"] = $row->name;
        $_SESSION["access_level"] = $row->access_level;
        $_SESSION['logged_in'] = true;
        $_SESSION["error_message"] = "";
        $logged_in = true;
    }
    else
    {
        $_SESSION["error_message"] = "Username or Password Incorrect!";
    }
}
// Go to password protected webpage. 
// Note, if the $_SESSION["user_id"] has not been set in the "if" statement above, then the "home.php" file will redirect the user back to the login webpage

if($logged_in === true)
{
    header("location: ../categories.php?page_number=1");
}
else
{
    header("location: ../login.php");
}
?>
