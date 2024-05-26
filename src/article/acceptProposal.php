<?php

include_once "../authentication/connessione.php";
include_once "../class/Response.php";

if (!isset($_SESSION["user_id"])) {
    $response = new Response(453); // user not found
    echo $response->json();
    exit();
}
if (!isset($_POST["proposal_id"])) {
    $response = new Response(452); // proposal_id not found
    echo $response->json();
    exit();
}
$proposal_id = $_POST["proposal_id"];
// $proposal_id = mysqli_real_escape_string($conn, $proposal_id);
$sql = "SELECT article_id FROM proposals WHERE proposal_id = $proposal_id";
$result = $conn->query($sql);
$article_id = $result->fetch_assoc()["article_id"];

$article_id = mysqli_real_escape_string($conn, $article_id);
$sql = "SELECT proposal_id FROM proposals join articles on articles.article_id = proposals.article_id where proposals.status = 1 and articles.article_id = $article_id";
$result = $conn -> query($sql);
if($result -> num_rows > 0){
    $res = new Response(454);
    echo $res->json();
}else{

    $article_id = mysqli_real_escape_string($conn, $article_id);
    $sql = "UPDATE proposals
            SET status = -1
            WHERE article_id = $article_id";
    $response = $conn->query($sql);

    $proposal_id = mysqli_real_escape_string($conn, $proposal_id);
    $sql = "UPDATE proposals
            SET status = 1
            WHERE proposal_id = $proposal_id";
    $response = $conn->query($sql);

    $res = new Response(251);
    echo $res->json();
}