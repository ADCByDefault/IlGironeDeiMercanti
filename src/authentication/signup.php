<?php
include_once 'connessione.php';
include_once '../class/Response.php';

$username = $_POST["username"];
$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);

$sql = "SELECT user_id from users where username = '{$username}' OR email = '{$email}'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    $res = new Response("451"); // email o username già in uso
    echo $res->json();
    exit();
}

$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];


$sql = "INSERT INTO `users`(`username`, `password`,`email`, `first_name`, `last_name`) VALUES ('{$username}','{$password}','{$email}','{$first_name}','{$last_name}')";

if ($conn->query($sql) === TRUE) {
    $res = new Response("251"); // registrazione effettuata
} else {
    $res = new Response("450"); // errore nel inserimento
}
echo $res->json();