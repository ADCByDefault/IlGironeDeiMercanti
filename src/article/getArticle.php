<?php
include_once "../authentication/connessione.php";
include_once "../class/Response.php";
include_once "../utils/articleMethods.php";


if (!isset($_SESSION["user_id"])) {
    $response = new Response(453); // user not found
    echo $response->json();
    exit();
}
$user_id = $_SESSION['user_id'];
$request_user_id = $user_id;
$request_username = null;
$user_id = mysqli_real_escape_string($conn, $user_id);
$sql = "SELECT username FROM users
            WHERE user_id = $user_id";
$res = $conn->query($sql);
$request_username = $res->fetch_assoc()["username"];


if (!isset($_GET['article_id'])) {
    Response::send(451); // article_id not found
    exit();
}
$article_id = $_GET['article_id'];
$article_id = mysqli_real_escape_string($conn, $article_id);
$sql = "SELECT article_id FROM articles
            WHERE article_id = $article_id";
$res = $conn->query($sql);
if ($res->num_rows <= 0) {
    Response::send(452); // article not found
    exit();
}

$data = null;
try {
    $article_user_id = getArticleUserId($conn, $article_id);
    if ($article_user_id == $request_user_id) {
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
