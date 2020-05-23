<?php
session_start();

/* Read posted data */
require_once "error_messages.php";  // contains a list of error messages that can be assigned to $_SESSION["error_message"]

$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
if ((empty($name)) || (!filter_var($name, FILTER_SANITIZE_STRING)))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: register.php"); // deal with invalid input
    exit();
}

$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
if ((empty($email)) || (!filter_var($email, FILTER_VALIDATE_EMAIL)))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: register.php"); // deal with invalid input
    exit();
}

$password = trim(filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING));
if ((empty($password)) || (!filter_var($password, FILTER_SANITIZE_STRING)))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: register.php"); // deal with invalid input
    exit();
}

$confirmPassword = trim(filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_STRING));
if ((empty($confirmPassword)) || (!filter_var($confirmPassword, FILTER_SANITIZE_STRING)))
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_INVALID_OR_EMPTY_FIELD;
    header("location: register.php"); // deal with invalid input
    exit();
}


/* Validate input data */
if ($password != $confirmPassword)
{
    $_SESSION["error_message"] = "Password doesnt match";
    header("location: register.php");
}


/* Connect to the database */
require_once "configuration.php";



/* Connect to the database */
$dbConnection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUsername, $dbPassword);
$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   // set the PDO error mode to exception



/* Check that user is not already user_added  */
$query = "SELECT email FROM users WHERE email = :email";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->execute();

if ($statement->rowCount() > 0)
{
    $_SESSION["error_message"] = $ERROR_MESSAGE_EMAIL_ALREADY_REGISTERED;
    header("location: ../login.php");
    exit();
}

$salted = "12345qwert".$password."09876";
$hashed = hash("sha512", $salted);

$query = "INSERT INTO users VALUES(DEFAULT, :name, :email, :password, 2)";
$statement = $dbConnection->prepare($query);
$statement->bindParam(":name", $name, PDO::PARAM_STR);
$statement->bindParam(":email", $email, PDO::PARAM_STR);
$statement->bindParam(":password", $hashed, PDO::PARAM_STR);
$statement->execute();

///* Check that the user is not already pending */
//$query = "DELETE FROM pending_users WHERE email = :email";
//$statement = $dbConnection->prepare($query);
//$statement->bindParam(":email", $email, PDO::PARAM_STR);
//$statement->execute();

//
///* Create new pending user */
//$expiry_time_stamp = 1200 + $_SERVER["REQUEST_TIME"]; // 1200 = 20 minutes from now
//$token = sha1(uniqid($email, true));
//
//$query = "INSERT INTO pending_users (token, email, expiry_time_stamp) VALUES (:token, :email, :expiry_time_stamp)";
//$statement = $dbConnection->prepare($query);
//$statement->bindParam(":token", $token, PDO::PARAM_STR);
//$statement->bindParam(":email", $email, PDO::PARAM_STR);
//$statement->bindParam(":expiry_time_stamp", $expiry_time_stamp, PDO::PARAM_INT);
//$statement->execute();
//
//
///* remove all old pending users from database */
//$query = "DELETE FROM pending_users WHERE expiry_time_stamp < :expiry_time_stamp";
//$statement = $dbConnection->prepare($query);
//$statement->bindParam(":expiry_time_stamp", $_SERVER["REQUEST_TIME"], PDO::PARAM_INT);
//$statement->execute();
header("location: ../login.php");
?>
