<?php

include_once "../authentication/connessione.php";
include_once "../class/Response.php";

if (!isset($_SESSION["user_id"])) {
    $res = new Response("453");
    echo $res->json();
    return;
}
$user_id = $_SESSION["user_id"];

if (isset($_FILES["img"])) {
    $img = $_FILES["img"]["name"];
    $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp") {
        $res = new Response("453");
        echo $res->json();
        return;
    }
} else {
    $res = new Response("451");
    echo $res->json();
    return;
}

if (!($_POST["nome"] != "" && isset($_POST["type_id"]))) {
    $res = new Response("451");
    echo $res -> json();
    return;
}
$name = $_POST["nome"];
$type_id = $_POST["type_id"];
$temp = $_FILES["img"]["tmp_name"];
if (!move_uploaded_file($temp, "../../upload/$img")) {
    $res = new Response("452");
    echo $res->json();
    return;
}

$description = $_POST["descrizione"];
$sql = "INSERT INTO articles (user_id, type_id, name, description) VALUE ($user_id, $type_id, '$name', '$description')";
$conn->query($sql);

$article_id = $conn->insert_id;

$sql = "INSERT INTO images (article_id, image_url) VALUE ($article_id, 'upload/$img')";
$conn->query($sql);


$res = new Response("251", ["article_id" => $article_id]);
echo $res->json();
