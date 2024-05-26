<?php
include_once "authentication/connessione.php";
include_once "class/Response.php";
if (!isset($_SESSION["user_id"])) {
    $_SESSION["error"] = "devi fare il login";
    header("Location: authentication/loginPage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="index.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
</head>

<body class="position-relative">
    </nav>
    <Header>
        <h1>Benvenuto nel Girone dei Mercanti</h1>
        <p><a href="authentication/logout.php">logout</a></p>
        <p><a href="dashboard/dashboard.php">dashboard</a></p>
        <p><a href="addArticle/addArticle.php">aggiungi articolo</a></p>
    </Header>
    <main>
        <div class="error-container" id="errorContainer"></div>
        <div class="articles-container" id="articlesContainer"></div>
    </main>

</body>

</html>