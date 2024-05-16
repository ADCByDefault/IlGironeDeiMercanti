<?php
include_once 'connessione.php';
include_once '../class/Response.php';

$username = $_POST["username"];
$email = $_POST["email"];
$password = hash('sha256', $_POST["password"]);

if ($_POST["password"] == $_POST["conferma"]) {
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
        $sql = "SELECT user_id from users where username = '{$username}'";
        $result = $conn->query($sql);
        $user_id = $result->fetch_assoc()["user_id"];
        $_SESSION["user_id"] = $user_id;
    } else {
        $res = new Response("450"); // errore nel inserimento
    }
} else {
    $res = new Response("452");
}
echo $res->json();
