<?php
include_once "authentication/connessione.php";
include_once "class/Response.php";
include_once "utils/articleMethods.php";

if (!isset($_SESSION["user_id"])) {
    $response = new Response("551"); // Internal error
    echo $response->json();
    exit();
}
$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM articles 
    WHERE NOT user_id = $user_id 
    AND article_id NOT IN 
        (SELECT article_id FROM proposals 
        WHERE status = '1')";
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
