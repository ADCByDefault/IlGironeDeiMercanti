<?php
$dbHost="";
$dbUsername="root";
$dbPassword="";
$dbName="ilgirone";
$conn = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
if($conn->connect_error){
    header("Location: ");
    die();
}
?>