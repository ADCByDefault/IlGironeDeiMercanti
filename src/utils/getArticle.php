<?php
include_once "../authentication/connessione.php";
include_once "../class/Response.php";

$article_id = null;
$user_id = null;
$permission = null;

if (isset($_GET["article_id"])) {
    $article_id = $_GET["article_id"];
    $permission = "1";
}
if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT user_id FROM articles WHERE article_id = $article_id";
    $res = $conn->query($sql);
    $user_id = $res->fetch_assoc()["user_id"];
    if ($_SESSION["user_id"] == $user_id) {
        $permission = "2";
    }
}
$sql = "";
$res = null;
switch ($permission) {
    case '1':
        $sql = "SELECT articles*, users.username FROM articles 
            JOIN images ON images.article_id = articles.article_id
            JOIN users ON users.user_id = articles.user_id
            WHERE articles.article_id = $article_id";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $res = new Response("200", $row);
        }
        break;
    case '2':
        $sql = "SELECT articles.*,users.username, images.image_url FROM articles 
            JOIN users ON users.user_id = articles.user_id
            JOIN types ON types.type_id = articles.article_id
            LEFT JOIN images ON images.article_id = articles.article_id
            LEFT JOIN proposals ON proposals.article_id = articles.article_id
            WHERE articles.article_id = $article_id";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $response = new Response("200", $row);
        }
        break;

    default:
        $response = new Response("451"); // bad request
        break;
}
if (!$response) {
    $res = new Response("551"); // Internal error
}
