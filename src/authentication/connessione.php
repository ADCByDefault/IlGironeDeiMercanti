<?php
session_start();
$dbHost = "localhost";
$dbUsername = "ndreu1";
$dbPassword = "";
$dbName = "my_ndreu1";
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    $_SESSION["error"] = "Internal server error";
    header("Location: error/error500.php");
    exit();
}
