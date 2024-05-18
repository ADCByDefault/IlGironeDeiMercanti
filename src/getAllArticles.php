<?php
include_once "authentication/connessione.php";
include_once "class/Response.php";
include_once "utils/articleMethods.php";

$sql = "SELECT * FROM articles";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $rows = [];
    while ($row = $res->fetch_assoc()) {
        $rows[] = getArticle($conn, $row["article_id"]);
    }
    $response = new Response("251", $rows);
} else {
    $response = new Response("551"); // Internal error
}

if (!$response) {
    $response = new Response("551"); // Internal error
}

echo $response->json();
