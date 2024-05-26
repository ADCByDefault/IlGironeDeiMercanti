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

$sql = "SELECT proposal_id FROM proposals WHERE article_id = $article_id && user_id = $user_id";
$result = $conn -> query($sql);
$proposal_id = $result->fetch_assoc()["proposal_id"];


if($result -> num_rows > 0){
    $sql = "UPDATE proposals
        SET price = $price
        WHERE proposal_id = $proposal_id";
    $conn -> query($sql);    
    $res = new Response(251);
    echo $res->json();
}else{
    echo "[$article_id]";
    $sql = "INSERT INTO proposals (user_id, article_id, price) value('$user_id', '$article_id', '$price')";
    $result = $conn->query($sql);
    $res = new Response(251);
    echo $res->json();
}

