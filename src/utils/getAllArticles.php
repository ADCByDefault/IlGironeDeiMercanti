<?php
include_once "../authentication/connessione.php";
include_once "../class/Response.php";

function getArticles($conn, $article_id)
{
    $data = [];
    $sql = "SELECT * FROM articles
            WHERE article_id = $article_id";
    $res = $conn->query($sql);
    if ($res->num_rows < 0) {
        return null;
    }
    while ($row = $res->fetch_assoc()) {
        $user_id = $row["user_id"];
        $type_id = $row["type_id"];
        $data["article_id"] = $row["article_id"];
        $data["name"] = $row["name"];
        $data["description"] = $row["description"];
        $data["created_at"] = $row["created_at"];
    }
    // user
    $sql = "SELECT username FROM users
            WHERE user_id = $user_id";
    $res = $conn->query($sql);
    $data["username"] = $res->fetch_assoc()["username"];
    // type
    $sql = "SELECT name FROM types
            WHERE type_id = $type_id";
    $res = $conn->query($sql);
    $data["type"] = $res->fetch_assoc()["name"];
    // images
    $sql = "SELECT * FROM images
            WHERE article_id = $article_id";
    $images = [];
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
        $images[] = $row["image_url"];
    }
    $data["images"] = $images;
    // $proposals = [];
    // $sql = "SELECT * FROM proposals
    //         JOIN users ON proposals.user_id = users.user_id
    //         WHERE article_id = $article_id";
    // $res = $conn->query($sql);
    // while ($row = $res->fetch_assoc()) {
    //     $proposals[] = [
    //         "username" => $row["username"],
    //         "proposal_id" => $row["proposal_id"],
    //         "price" => $row["price"],
    //         "created_at" => $row["created_at"]
    //     ];
    // }
    // $data["proposals"] = $proposals;
    return $data;
}

$sql = "SELECT * FROM articles";
$res = $conn->query($sql);
if ($res->num_rows > 0) {
    $rows = [];
    while ($row = $res->fetch_assoc()) {
        $rows[] = getArticles($conn, $row["article_id"]);
    }
    $response = new Response("251", $rows);
} else {
    $response = new Response("551"); // Internal error
}

if (!$response) {
    $response = new Response("551"); // Internal error
}

echo $response->json();