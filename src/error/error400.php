<?php
session_start();
if (isset($_SESSION["error"])) {
    header("Location: index.php");
} else {
    $_SESSION["error"] = "Bad request";
    header("Location: index.php");
}
die();
