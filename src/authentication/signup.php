<?php
include_once 'connessione.php';
include_once '../class/Response.php';

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if (($username == "" && $email == "") || $password == "") {
    $res = new Response("450"); //campi obbligatori vuoti
    echo $res->json();
    exit();
}
if (($_POST["password"] != $_POST["conferma"])) {
    $res = new Response("452"); // password non corrispondono
    echo $res->json();
    exit();
}

$password = hash('sha256', $_POST["password"]);
$username = $conn->real_escape_string($username);
$email = $conn->real_escape_string($email);

$sql = "SELECT user_id from users where username = '{$username}' OR email = '{$email}'";
if ($email == "") {
    $sql = "SELECT user_id from users where username = '{$username}'";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $res = new Response("451"); // email o username già in uso
    echo $res->json();
    exit();
}

$first_name = $conn->real_escape_string($_POST["first_name"]);
$last_name = $conn->real_escape_string($_POST["last_name"]);

$sql = "INSERT INTO `users`(`username`, `password`,`email`, `first_name`, `last_name`, `image_id`) VALUES ('{$username}','{$password}','{$email}','{$first_name}','{$last_name}', 1)";
if($email == ""){
    $sql = "INSERT INTO `users`(`username`, `password`, `first_name`, `last_name`) VALUES ('{$username}','{$password}','{$first_name}','{$last_name}')";
}
$res = $conn->query($sql);
if ($res) {
    $res = new Response("251"); // registrazione effettuata
    $user_id = $conn->insert_id;
    $_SESSION["user_id"] = $user_id;
} else {
    $res = new Response("550"); // errore nel inserimento
}

echo $res->json();
