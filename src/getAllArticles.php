<?php
include_once "authentication/connessione.php";
include_once "class/Response.php";
include_once "utils/articleMethods.php";

$type_id = "";
$string = "";
if(isset($_GET["type_id"])){
    $type_id=$_GET["type_id"];
}

$type_id = $conn->real_escape_string($type_id);
$sql = "SELECT type_id, name FROM types WHERE type_id = '$type_id' ";
$result = $conn -> query($sql);
if($result -> num_rows > 0){
    $string = " AND type_id = '$type_id' ";
}

if (!isset($_SESSION["user_id"])) {
    $response = new Response("551"); // Internal error
    echo $response->json();
    exit();
}
$user_id = $_SESSION["user_id"];

$sql = "SELECT * FROM articles 
    WHERE NOT user_id = $user_id $string
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
    $response = new Response("551"); // No articles found
}

if (!$response) {
    $response = new Response("551"); // Internal error
}

echo $response->json();
