<?php

include_once "../authentication/connessione.php";
include_once "../class/Response.php";

if (!isset($_SESSION["user_id"])) {
    $response = new Response(453); // user not found
    echo $response->json();
    exit();
}
if (!isset($_POST["proposal_id"])) {
    $response = new Response(452); // proposal_id not found
    echo $response->json();
    exit();
}
$proposal_id = $conn->real_escape_string($_POST["proposal_id"]);
// $proposal_id = mysqli_real_escape_string($conn, $proposal_id);
$sql = "SELECT article_id FROM proposals WHERE proposal_id = $proposal_id";
$result = $conn->query($sql);
$article_id = $result->fetch_assoc()["article_id"];

/*
$article_id = mysqli_real_escape_string($conn, $article_id);
$sql = "SELECT email, articles.name FROM proposals 
        join users on users.user_id = proposals.user_id
        join articles on articles.article_id = proposals.article_id 
        WHERE proposals.status = 0 AND articles.article_id = $article_id AND proposals.proposal_id != $proposal_id";
$result = $conn -> query($sql);
while($row = $result -> fetch_assoc()){
    $email = $row["email"];
    $articolo = $row["name"];
    mail($email, "RIFIUTO DELLA SUA PROPOSATA", "La sua proposta per l'oggetto $articolo è stata rifiutata &#9747;");
}
*/

$result = $conn -> query($sql);
if($result -> num_rows > 0){
    $res = new Response(454);
    echo $res->json();
}else{

    $article_id = mysqli_real_escape_string($conn, $article_id);
    $sql = "UPDATE proposals
            SET status = -1
            WHERE article_id = $article_id";
    $response = $conn->query($sql);

    $proposal_id = mysqli_real_escape_string($conn, $proposal_id);
    $sql = "UPDATE proposals
            SET status = 1
            WHERE proposal_id = $proposal_id";
    $response = $conn->query($sql);

    /*
    $sql = "SELECT email, articles.name FROM users JOIN proposals ON users.user_id = proposals.user_id JOIN articles ON articles.article_id = proposals.article_id WHERE articles.article_id = $article_id AND status = 1";
    $email = $conn -> query($sql) -> fetch_assoc()["email"];
    $articolo = $conn -> query($sql) -> fetch_assoc()["name"];
    mail($email, "APPROVATA LA SUA PROPOSATA", "La sua proposta per l'oggetto $articolo è stata accettata &#9745;", 'From: ndreu1@altervista.org\n');
    */

    $res = new Response(251);
    echo $res->json();
}