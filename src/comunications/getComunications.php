<?php

include_once '../authentication/connessione.php';
include_once '../class/Response.php';

if (!isset($_SESSION["user_id"])) {
    $_SESSION["error"] = "devi essere loggato per accedere a questa pagina";
    header("Location: ../authentication/loginPage.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT status, proposals.article_id, proposals.proposal_id, proposals.price, articles.user_id, name FROM proposals JOIN articles on articles.article_id = proposals.article_id WHERE proposals.user_id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $l = count($data);
        $data[$l]["name"] = $row["name"];
        $data[$l]["proposal_id"] = $row["proposal_id"];
        $data[$l]["article_id"] = $row["article_id"];
        $data[$l]["user_id"] = $row["user_id"];
        $data[$l]["price"] = $row["price"];
        $data[$l]["status"] = $row["status"];
    }
    $res = new Response("251", $data);
    echo $res->json();
} else {
    $res = new Response(451);
    echo $res->json();
    return;
}