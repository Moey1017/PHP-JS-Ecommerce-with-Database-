<?php
/* * ************************ You need to set the values below to match your project ************************ */

// localhost website and localhost database
$localHostSiteFolderName = "ecommerceWebsiteCA2";

$localhostDatabaseName = "Glich";
$localHostDatabaseHostAddress = "localhost";
$localHostDatabaseUserName = "root";
$localHostDatabasePassword = "";



// remotely hosted website and remotely hosted database       /* you will need to get the server details below from your host provider */
$serverWebsiteName = "http://mysql02.comp.dkit.ie/D00123456"; /* use this address if hosting website on the college students' website server */

$serverDatabaseName = "hadnett_Glich";
$serverDatabaseHostAddress = "localhost:3306";         /* use this address if hosting database on the college computing department database server */
$serverDatabaseUserName = "hadnett_william";
$serverDatabasePassword = "mfd=TED@22";

$useLocalHost = true;      /* set to false if your database is NOT hosted on localhost */

$useTestStripeKey = true;

if ($useTestStripeKey == true)
{
    $privateStripeKey = "sk_test_6Id6g8jwDyxOcyZyTSxmQs7A00h49KEroN"; 
    $publicStripeKey = "pk_test_OLmCLagNLAXWAXg8CaWz1dCi00S4VCyMRV"; 
}
else // live system
{
    $privateStripeKey = "sk_test_6Id6g8jwDyxOcyZyTSxmQs7A00h49KEroN"; 
    $publicStripeKey = "pk_test_OLmCLagNLAXWAXg8CaWz1dCi00S4VCyMRV"; 
}

// PayPal configuration
define('PAYPAL_ID', 'd00217@student.dkit.ie');
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE
define('PAYPAL_RETURN_URL', 'http://localhost/ecommerceWebsite_williamHadnett/confirmation_page.php'); // after finish purchases website
define('PAYPAL_CANCEL_URL', 'http://localhost/ecommerceWebsite_williamHadnett/cart.php'); // go back to cart
define('PAYPAL_NOTIFY_URL', 'http://localhost/ecommerceWebsiteCA2/ipn.php'); // notice successfully purchases details
define('PAYPAL_CURRENCY', 'EUR');
// Change not required
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");



/* * ******************************* WARNING                                 ******************************** */
/* * ******************************* Do not modify any code BELOW this point ******************************** */

if ($useLocalHost == true)
{
    $siteName = "http://localhost/" . $localHostSiteFolderName;
    $dbName = $localhostDatabaseName;
    $dbHost = $localHostDatabaseHostAddress;
    $dbUsername = $localHostDatabaseUserName;
    $dbPassword = $localHostDatabasePassword;
}
else  // using remote host
{
    $siteName = $serverWebsiteName;
    $dbName = $serverDatabaseName;
    $dbHost = $serverDatabaseHostAddress;
    $dbUsername = $serverDatabaseUserName;
    $dbPassword = $serverDatabasePassword;
}



//chmod("configuration.php", 0600); // do not allow anyone to view this file
?>
