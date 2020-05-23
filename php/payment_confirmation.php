<?php
$stripeToken = ltrim(rtrim(filter_input(INPUT_POST, "stripeToken", FILTER_SANITIZE_STRING)));
if (empty($stripeToken)) {
    echo "1"; die();
    header("location: ../cart.php"); // deal with invalid input
    exit();
}

$email = ltrim(rtrim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING)));
if (empty($email) || (!filter_var($email, FILTER_VALIDATE_EMAIL))) {
    echo "2"; die();
    header("location: ../cart.php"); // deal with invalid input
    exit();
}

$paymentAmount = filter_input(INPUT_POST, "paymentAmount", FILTER_SANITIZE_NUMBER_INT);
if (!isset($paymentAmount)) {
    if (!filter_var($paymentAmount, FILTER_VALIDATE_INT)) {
        header("location: ../cart.php"); // deal with invalid input
        exit();
    }
}

require_once 'configuration.php';
// make stripe payment
require_once('../Stripe/init.php');
\Stripe\Stripe::setApiKey($privateStripeKey);
try {
    $charge = \Stripe\Charge::create(array(
                "amount" => $paymentAmount,
                "currency" => "eur",
                "card" => $stripeToken,
                "description" => "Stripe Sales Example")
    );
} catch (Stripe_CardError $e) {
    echo("Your card has been declined.<br>Error Details: " . $e . "<br><br><a href='index.html'>Click here to continue</a>");
    die();
} catch (Exception $e) {
    echo("Your card has been declined.<br>Error Details: " . $e . "<br><br><a href='index.html'>Click here to continue</a>");
    die();
}

header("location: ../confirmation_page.php");
?>