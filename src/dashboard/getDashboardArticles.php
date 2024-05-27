<?php
include_once "../authentication/connessione.php";
include_once "../class/Response.php";
include_once "../utils/articleMethods.php";


if (!$_SESSION["user_id"]) {
    $res = new Response("451"); // user not found
    echo $res->json();
    die();
}
$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM types";
$result = $conn->query($sql);
$types = [];

while ($row = $result->fetch_assoc()) {
    $type_id = $row["type_id"];
    $types[$type_id] = $row["name"];
}

$sql = "SELECT * FROM articles WHERE user_id = $user_id";
$res = $conn->query($sql);
$data = [];
if ($res->num_rows > 0) {
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = getArticle($conn, $row["article_id"]);
    }
    $res = new Response("251", $data); // articles found
} else {
    $res = new Response("551"); // Internal error

}
echo $res->json();
