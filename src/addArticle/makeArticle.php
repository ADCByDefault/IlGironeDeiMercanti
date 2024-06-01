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
if(!isset($_POST["nome"]) || !isset($_POST["type_id"]) || !isset($_POST["descrizione"])){
    $res = new Response("451");
    echo $res->json();
    return;
}

$type_id = $_POST["type_id"];
$type_id = $conn->real_escape_string($type_id);
$name = $_POST["nome"];
$name = $conn->real_escape_string($name);
$description = $_POST["descrizione"];
$description = $conn->real_escape_string($description);
$sql ="SELECT * FROM types WHERE type_id = $type_id";
$result = $conn->query($sql);
if($result->num_rows <= 0 || $name == "" || $description == ""){
    $res = new Response("451");
    echo $res->json();
    return;
}
$sql = "INSERT INTO articles (user_id, type_id, name, description) VALUE ($user_id, $type_id, '$name', '$description')";
$conn->query($sql);
$article_id = $conn->insert_id;

$temp = $_FILES["img"]["tmp_name"];
$imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));

if (!move_uploaded_file($temp, "../../upload/$article_id.$imageFileType")) {
    $res = new Response("452");
    echo $res->json();

    $sql = "DELETE Articles where article_id = $article_id";
    $conn -> query($sql);
    return;
}
$sql = "INSERT INTO images (article_id, image_url) VALUE ($article_id, 'upload/$article_id.$imageFileType')";
$conn->query($sql);


$res = new Response("251", ["article_id" => $article_id]);
echo $res->json();
