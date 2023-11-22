<?php

include('fbConfig.php');

$facebook_output = '';
$facebook_helper = $facebook->getRedirectLoginHelper();
if (isset($_GET['code'])) {
    if (isset($_GET['access_token'])) {
        $access_token = $_SESSION['access_token'];
    } else {
        $access_token = $facebook_helper->getAccessToken();
        $_SESSION['access_token'] = $access_token;

        $facebook->setDefaultAccessToken($_SESSION['access_token']);
    }
    $graph_response = $facebook->get(
        "/me?fields=name,email"
        ,
        $access_token
    );
    $facebook_user_info = $graph_response->getGraphUser();
    if (!empty($facebook_user_info['id'])) {

    }
} else{
    $facebook_permissions = ['email'];
    $facebook_login_url = $facebook_helper->getLoginUrl('http://localhost/MovieReview/src/login.php', $facebook_permissions);

    $facebook_login_url = ' <a href="'. $facebook_login_url .'"></a>';
}
?>