<?php

    include_once "../authentication/connessione.php";
    include_once "../class/Response.php";

    if(!isset($_SESSION["user_id"])) {
        $res = new Response("453");
        echo $res -> json();
        return;
    }

    if(isset($_FILES["img"])){
        $img = $_FILES["img"]["name"];
        $imageFileType = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "webp"){
            $res = new Response("453");
            echo $res -> json();
            return; 
        }
    }
    else {
        $res = new Response("451");
        echo $res -> json();
        return;
    }
    //TODO filtrare solo immagini
    if($_POST["nome"] != "" && isset($_POST["type"])) 
        $name = $_POST["nome"];
    else {
        $res = new Response("451");
        echo $res -> json();
        return;
    }

    $temp = $_FILES["img"]["tmp_name"];
    if(!move_uploaded_file($temp, "../../upload/$img")){
        $res = new Response("452");
        echo $res -> json();
        return;
    }

    $description = $_POST["descrizione"];

    $sql = "INSERT INTO articles (user_id, type_id, name, description) VALUE ({$_SESSION["user_id"]}, $type, '$name', '$description')";
    $conn -> query($sql);

    $sql = "SELECT max(article_id) FROM articles";
    $result = $conn -> query($sql);

    $article_id = $result -> fetch_assoc()["max(article_id)"];

    $sql = "INSERT INTO images (article_id, image_url) VALUE ($article_id, 'upload/$img')";
    $conn -> query($sql);


    $res = new Response("251",["article_id"=>$article_id]);
    echo $res -> json();