<?php
session_start();
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "ilgirone";
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
if ($conn->connect_error) {
    $_SESSION["error"] = "Internal server error";
    header("Location: error/error500.php");
    exit();
}
