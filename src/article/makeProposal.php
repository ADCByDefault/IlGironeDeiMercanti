<?php

include_once "../authentication/connessione.php";
include_once "../class/Response.php";

if (!isset($_SESSION["user_id"]) || !isset($_POST["article_id"])) {
    $res = new Response(451); //user or article not found
    echo $res->json();
    die();
}

$user_id = $_SESSION["user_id"];

if (!isset($_POST["article_id"])) {
    $res = new Response(452); // article_id not found
    echo $res->json();
    die();
}
$article_id = $_POST["article_id"];

if (!isset($_POST["price"])) {
    $res = new Response(452); // price not found
    echo $res->json();
    die();
}
$price = $_POST["price"];

$user_id = mysqli_real_escape_string($conn, $user_id);
$article_id = mysqli_real_escape_string($conn, $article_id);
$price = mysqli_real_escape_string($conn, $price);
$sql = "SELECT proposal_id FROM proposals WHERE article_id = $article_id && user_id = $user_id";
$result = $conn -> query($sql);

if($result -> num_rows > 0){
    $proposal_id = $result->fetch_assoc()["proposal_id"];
    $sql = "SELECT status FROM proposals WHERE proposal_id = $proposal_id";
    $status = $conn->query($sql)->fetch_assoc()["status"];
    if($status != 0){
    	$res = new Response(453);
    	echo $res->json();
        die();
    }
    $sql = "UPDATE proposals
        SET price = $price
        WHERE proposal_id = '$proposal_id'";
    $conn -> query($sql);    
    $res = new Response(252); // proposal updated
    echo $res->json();
}else{
    $sql = "INSERT INTO proposals (user_id, article_id, price) value('$user_id', '$article_id', '$price')";
    $result = $conn->query($sql);
    $res = new Response(251); // proposal created
    echo $res->json();
}

