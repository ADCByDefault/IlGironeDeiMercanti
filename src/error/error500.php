<?php
session_start();
if (isset($_SESSION["error"])) {
    header("Location: index.php");
} else {
    $_SESSION["error"] = "Internal server error";
    header("Location: index.php");
}
die();
