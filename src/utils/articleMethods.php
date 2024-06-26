<?php

function getArticle($conn, $article_id)
{
    $data = [];
    $sql = "SELECT * FROM articles
            WHERE article_id = $article_id";
    $res = $conn->query($sql);
    if ($res->num_rows < 0) {
        return [];
    }
    while ($row = $res->fetch_assoc()) {
        $user_id = $row["user_id"];
        $type_id = $row["type_id"];
        $data["user_id"] = $row["user_id"];
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
    return $data;
}

function getArticleWithProposals($conn, $article_id)
{
    $data = getArticle($conn, $article_id);
    if ($data == []) {
        return [];
    }
    $proposals = [];
    $sql = "SELECT * FROM proposals
            JOIN users ON proposals.user_id = users.user_id
            WHERE article_id = $article_id";
    $res = $conn->query($sql);
    echo $res->num_rows;
    $proposals = [];
      while ($row = $res->fetch_assoc()) {
        $proposals[] = [
          "username" => $row["username"],
          "proposal_id" => $row["proposal_id"],
          "price" => $row["price"],
          "created_at" => $row["created_at"],
          "status" => $row["status"]
        ];
    }
    $data["proposals"] = $proposals;
    return $data;
}

function getArticleUserId($conn, $article_id)
{
    $sql = "SELECT user_id FROM articles
            WHERE article_id = $article_id";
    $res = $conn->query($sql);
    if ($res->num_rows < 0) {
        return [];
    }
    return $res->fetch_assoc()["user_id"];
}

function getProposalsWithUserIdAndArticleId($conn, $user_id, $article_id)
{
    $sql = "SELECT * FROM proposals
            JOIN users ON proposals.user_id = users.user_id
            WHERE article_id = $article_id";
    $res = $conn->query($sql);
    if ($res->num_rows <= 0) {
        return [];
    }
    $proposals = [];
    while ($row = $res->fetch_assoc()) {
        $proposals[] = [
            "username" => $row["username"],
            "proposal_id" => $row["proposal_id"],
            "price" => $row["price"],
            "created_at" => $row["created_at"],
            "status" => $row["status"]
        ];
    }
    return $proposals;
}

function getArticlesByUserId($conn, $user_id)
{
    $sql = "SELECT * FROM articles
            WHERE user_id = $user_id";
    $res = $conn->query($sql);
    if ($res->num_rows < 0) {
        return [];
    }
    $data = [];
    while ($row = $res->fetch_assoc()) {
        $data[] = getArticle($conn, $row["article_id"]);
    }
    return $data;
}
