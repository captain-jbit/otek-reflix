<?php

ob_start(); //Turns on output buffering
session_start(); //store the sessin

date_default_timezone_set("Israel");

try {
    $con =new PDO("mysql:dbname=reflix;host=localhost", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

}
catch(PDOException $e){

    exit("Connection failed: " . $e->getMessage());
}

?>