<?php

    include_once '../authentication/connessione.php';
    include_once '../class/Response.php';

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT status, proposals.article_id, articles.user_id, type_id, name FROM proposals JOIN articles on articles.article_id = proposals.article_id WHERE articles.user_id = '$user_id'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $data = [];
        while($row = $result->fetch_assoc()){
            $article_id = $row['article_id'];
            $status = $row['status'];
            $type_id = $row['type_id'];
            $name = $row['name'];
            $data = ["article" => [ "article_id" => $article_id, "status" => $status, "type_id" => $type_id, "name" => $name]];
        }
        $res = new Response("251", $data);
        echo $res->json();
    }else{
        $res = new Response(451);
        echo $res->json();
        return;
    }


    