<?php

require_once("includes/config.php");
require_once("includes/classes/PriviewProvider.php");
require_once("includes/classes/Entity.php");

#check if user logged in by session
if(!isset($_SESSION["userLoggedIn"])){
    header("Location: register.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];

$preview = new PreviewProvider($con,$userLoggedIn);

echo $preview->createPreviewVideo(null);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Welcome to REFLIX</title>
    <link rel="stylesheet" type="text/css" href="assets/style/style.css" />
</head>

<body>

<div class="wrapper">
