<?php
include_once "../authentication/connessione.php";
include_once "../class/Response.php";
include_once "../utils/articleMethods.php";
$request_username = null;
$request_user_id = null;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT username FROM users
            WHERE user_id = $user_id";
    $res = $conn->query($sql);
    $request_user_id = $user_id;
    $request_username = $res->fetch_assoc()["username"];
}
$article_id = null;
if (isset($_GET['article_id'])) {
    $article_id = $_GET['article_id'];
}
$article_user_id = null;
if (isset($_GET['user_id'])) {
    $article_user_id = $_GET['user_id'];
}

if ($article_id == null) {
    Response::send(451); // article_id not found
    exit();
}

$data = null;
try {
    if ($article_user_id == $request_user_id || $request_user_id == null) {
        $data = getArticleWithProposals($conn, $article_id);
    } else {
        $data = getArticle($conn, $article_id);
    }
} catch (Exception $e) {
    Response::send(551); // could not get article
    exit();
}

$response = null;
if ($data == null) {
    $response = new Response(452); // article not found
} else {
    $data["request_username"] = $request_username;
    $response = new Response(251, $data); // article found
}
echo $response->json();
