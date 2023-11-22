<?php

session_start();
session_destroy();

if(!isset($_SESSION['token'])) {
    header("location: login.php");exit;
}else {
    require "config.php";
    $client->setAccessToken($_SESSION['token']);
    $client->revokeToken();
    session_destroy();
}


header("location:login.php");
?>