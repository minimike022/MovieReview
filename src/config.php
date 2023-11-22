<?php
require_once 'vendor/autoload.php';

// init configuration
$clientID = '664943467864-bb0pubsh06s6kvrot0d2l4mcvg37hm00.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/MovieReview/src/login.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
?>