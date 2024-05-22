<?php

    include_once "../authentication/connessione.php";
    include_once "../class/Response.php";

    $user_id = $_SESSION["user_id"];
    $article_id = $_POST["article_id"];

    if($_POST["price"] !== null){
        $price = $_POST["price"];

        $sql = "INSERT INTO proposals (user_id, article_id, price) value('$user_id', '$article_id', '$price')";
        $result = $conn -> query($sql);

        $res = new Response("251");
        echo $res -> json();

    }else{
        $res = new Response("452");
        echo $res -> json();
    }
