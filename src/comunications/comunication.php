<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>articolo</title>
    <link rel="stylesheet" href="../style.css">
    <script src="comunication.js" defer></script>
</head>
<body>
    <div class="error-container" id="errorContainer"></div>
    <div class="information-container" id="informationContainer"></div>
    <section class="content">
        <div id="proposals">
        </div>
    </section>
</body>
</html>
