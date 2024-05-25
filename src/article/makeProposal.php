<?php

include_once "../authentication/connessione.php";
include_once "../class/Response.php";

if (!isset($_SESSION["user_id"]) || !isset($_POST["article_id"])) {
    $res = new Response(451); //user or article not found
    echo $res->json();
    die();
}

$user_id = $_SESSION["user_id"];
$article_id = $_POST["article_id"];

if (!isset($_POST["price"])) {
    $res = new Response(452); // price not found
    echo $res->json();
    die();
}
$price = $_POST["price"];

$sql = "INSERT INTO proposals (user_id, article_id, price) value('$user_id', '$article_id', '$price')";
$result = $conn->query($sql);

$res = new Response(251);
echo $res->json();
