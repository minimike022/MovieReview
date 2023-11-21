<?php

//start session on web page
session_start();

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('664943467864-efulhqiu8dqt1pg6j4ft5m766rb5o49k.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('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');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/MovieReview/src/index.php');

// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');

?>