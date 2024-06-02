<?php
require_once "../authentication/connessione.php";
require_once "../class/Response.php";
require_once "../utils/articleMethods.php";

if (!isset($_GET['user_id'])) {
    Response::send(451); //user_id not set
    exit();
}

$user_id = $conn->real_escape_string($_GET['user_id']);

$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);
if ($result->num_rows <= 0) {
    Response::send(452); //user not found
    exit();
}
$row = $result->fetch_assoc();

$data = array(
    'username' => $row['username'],
    'first_name' => $row['first_name'],
    'last_name' => $row['last_name'],
);

$sql = "SELECT image_url FROM images JOIN users ON images.image_id = users.image_id WHERE user_id = '$user_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $data['image_url'] = $row['image_url'];
} else {
    $data['image_url'] = "";
}

$data['articles'] = getArticlesByUserId($conn, $user_id);
Response::send(250, $data);
