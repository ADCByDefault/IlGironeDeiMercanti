<?php

    if(isset($_POST["price"])){
        $prezzo = $_POST["price"];

    }else{
        $res = new Response("451");
        echo $res -> json();
    }
