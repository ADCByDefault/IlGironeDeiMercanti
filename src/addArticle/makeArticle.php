<?php

    include_once "../authentication/connessione.php";
    include_once "../class/Response.php";

    if(!isset($_SESSION["user_id"])) {
        $res = new Response("453");
        echo $res -> json();
        return;
    }

    if(isset($_FILES["img"])) 
        $img = $_FILES["img"]["name"];
    //TODO filtrare solo immagini
    if(isset($_POST["nome"])) 
        $name = $_POST["nome"];
    if(isset($_POST["type"]))
        $type = $_POST["type"];
    else {
        $res = new Response("451");
        echo $res -> json();
        return;
    }

    $description = $_POST["descrizione"];

    $sql = "INSERT INTO articles (user_id, type_id, name, description) VALUE ({$_SESSION["user_id"]}, $type, '$name', '$description')";
    $conn -> query($sql);

    $sql = "INSERT INTO images (article_id, image_url) VALUE ($type, 'upload/$img')";
    $conn -> query($sql);

    $temp = $_FILES["img"]["tmp_name"];
    if(!move_uploaded_file($temp, "../../upload/$img")){
        $res = new Response("452");
        echo $res -> json();
        return;
    }

    $res = new Response("251");
    echo $res -> json();