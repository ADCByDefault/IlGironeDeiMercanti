<?php
include_once "../authentication/connessione.php";
include_once "../class/Response.php";


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
$result = $conn->query($sql);
$data = [];

while ($row = $result->fetch_assoc()) {
    $l = count($data);
    $data[$l]["article_id"] = $row["article_id"];
    $data[$l]["name"] = $row["name"];
    $data[$l]["description"] = $row["description"];
    $data[$l]["created_at"] = $row["created_at"];
    $type_id = $row["type_id"];
    $data[$l]["type"] = $types[$type_id];
}

$res = new Response("251", $data); // articles found
echo $res->json();
