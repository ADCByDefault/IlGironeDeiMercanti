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
        $res = new Response("452");
        echo $res->json();
        return;
    }

    $temp = $_FILES["img"]["tmp_name"];
    $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    
    if (!move_uploaded_file($temp, "../../upload/users/$user_id.$imageFileType")) {
        $res = new Response("453");
        echo $res->json();
        
        $sql = "DELETE Articles where article_id = $article_id";
        $conn -> query($sql);
        return;
    }

    $sql = "SELECT image_url FROM users JOIN images ON images.image_id = users.image_id WHERE user_id = $user_id";
    $image_url = $conn -> query($sql) -> fetch_assoc()["image_url"];
    if($image_url != "upload/noProfile.png"){
        $sql = "DELETE FROM images WHERE image_url = '$image_url'";
        $conn -> query($sql);
    }
    
    $sql = "INSERT INTO images(image_url) VALUE ('upload/users/$user_id.$imageFileType')";
    $conn -> query($sql);
    $image_id = $conn->insert_id;

    $sql = "UPDATE users SET image_id = $image_id WHERE user_id = $user_id";
    $conn->query($sql);

    $res = new Response("251");
    echo $res->json();
} else {
    $res = new Response("451");
    echo $res->json();
    return;
}
