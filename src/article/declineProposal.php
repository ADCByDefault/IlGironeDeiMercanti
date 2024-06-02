<?php

    include_once "../authentication/connessione.php";
    include_once "../class/Response.php";

    if (!isset($_SESSION["user_id"])) {
        $response = new Response(453); // user not found
        echo $response->json();
        exit();
    }

    $proposal_id = $_POST["proposal_id"];

    $proposal_id = mysqli_real_escape_string($conn,$proposal_id);

    $sql = "SELECT article_id FROM proposals WHERE proposal_id = $proposal_id";
    $result = $conn -> query($sql);
    $article_id = $result -> fetch_assoc()["article_id"];

    /*
    $sql = "SELECT email, articles.name FROM users JOIN proposals ON users.user_id = proposals.user_id JOIN articles ON articles.article_id = proposals.article_id WHERE proposals.proposal_id = $proposal_id";
    $email = $conn -> query($sql) -> fetch_assoc()["email"];
    $articolo = $conn -> query($sql) -> fetch_assoc()["name"];
    mail($email, "RIFIUTO DELLA SUA PROPOSATA", "La sua proposta per l'oggetto $articolo è stata rifiutata &#9747;");
    */

    $sql = "UPDATE proposals
        SET status = -1
        WHERE proposal_id = $proposal_id";
    $response = $conn -> query($sql);

    $res = new Response(251);
    echo $res -> json();