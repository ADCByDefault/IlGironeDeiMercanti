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
    if (empty(array_filter($_FILES["img"]["name"]))) {
        $res = new Response("451"); //empty file
        echo $res->json();
        return;
    }
} else {
    $res = new Response("451"); //empty file
    echo $res->json();
    return;
}
if (!isset($_POST["nome"]) || !isset($_POST["type_id"]) || !isset($_POST["descrizione"])) {
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
$sql = "SELECT * FROM types WHERE type_id = $type_id";
$result = $conn->query($sql);
if ($result->num_rows <= 0 || $name == "" || $description == "") {
    $res = new Response("451");
    echo $res->json();
    die();
}
$sql = "INSERT INTO articles (user_id, type_id, name, description) VALUE ($user_id, $type_id, '$name', '$description')";
$conn->query($sql);
if($conn->affected_rows <= 0){
    $res = new Response(553);
    echo $res->json();
    die();
}
$article_id = $conn->insert_id;

// $temp = $_FILES["img"]["tmp_name"];
// $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// if (!move_uploaded_file($temp, "../../upload/$article_id.$imageFileType")) {
//     $res = new Response("452");
//     echo $res->json();

//     $sql = "DELETE Articles where article_id = $article_id";
//     $conn -> query($sql);
//     return;
// }
// $sql = "INSERT INTO images (article_id, image_url) VALUE ($article_id, 'upload/$article_id.$imageFileType')";
// $conn->query($sql);

// $res = new Response("251", ["article_id" => $article_id]);
// echo $res->json();

foreach ($_FILES['img']['tmp_name'] as $key => $value) {
    // Configure upload directory and allowed file types
    $upload_dir = 'upload/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif', "webp");

    // Define maxsize for files i.e 2MB
    $maxsize = 2 * 1024 * 1024;

    $file_tmpname = $_FILES['img']['tmp_name'][$key];
    $file_name = $_FILES['img']['name'][$key];
    $file_size = $_FILES['img']['size'][$key];
    $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
    //remove not supported characters from file name
    $characters = array(" ", "(", ")", "[", "]", "{", "}", ",", ":", ";", "!", "?", "/", "\\", "|", "<", ">", "*", "&", "^", "%", "$", "#", "@", "€", "£", "§", "°", "ç", "à", "è", "é", "ì", "ò", "ù", "€", "£", "§", "°", "ç", "à", "è", "é", "ì", "ò", "ù");
    $file_name = str_replace($characters, "_", $file_name);
    if (!is_dir("../../" . $upload_dir . $article_id)) {
        mkdir("../../".$upload_dir . $article_id);
    }

    // Check file type is allowed or not
    if (in_array(strtolower($file_ext), $allowed_types)) {
        // Verify file size - 2MB max 
        if ($file_size < $maxsize) {
            $abs =  $upload_dir . $article_id . "/" . $file_name;
            $filepath = "../../" . $abs;
            if (move_uploaded_file($file_tmpname, $filepath)) {
                // If file uploaded successfully
                $sql = "INSERT INTO images (article_id, image_url) VALUE ($article_id, '$abs')";
                $conn->query($sql);
            }

        }
    }
}

$res = new Response("251", ["article_id" => $article_id]);
echo $res->json();