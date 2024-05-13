<?php
include_once "authentication/connessione.php";
include_once "class/Response.php";

$article_id = null;
$user_id = null;
$permission = "1";

if(isset($_POST["article_id"])){
    $article_id = $_POST["article_id"];
}
if(isset($_POST["user_id"])){
    $user_id = $_POST["user_id"];
}
if(isset($_SESSION["user_id"])){
    if($_SESSION["user_id"] == $user_id){
        $permission = "2";
    }
}
$sql = "";
switch ($permission) {
    case '1':
        $sql = "SELECT articles.*, images.image_url FROM articles 
            JOIN images ON images.article_id = articles.article_id";
        break;
    
    default:
        $sql = "SELECT * FROM ";
        break;
}
?>