<?php

include 'connessione.php';
include_once '../class/Response.php';

$username = $_POST["username"];
$password = hash('sha256', $_POST["password"]);

$sql = "SELECT user_id, password from users where username = '{$username}' or email = '{$username}'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row["user_id"];
    $hash = $row["password"];
    if ($password == $hash) {
        $res = new Response("252"); //login effettuato
        $_SESSION["user_id"] = $user_id;
    } else {
        $res = new Response("453"); //password sbagliata
    }
} else {
    $res = new Response("451"); //email o username sbagliati
}

echo $res->json();
//header("location: ../profile.php");
