<?php
include_once "authentication/connessione.php";
include_once "class/Response.php";
if (!isset($_SESSION["user_id"])) {
    $_SESSION["error"] = "Devi fare il login";
    header("Location: authentication/loginPage.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

</html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="index.js" defer></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="index.css">
</head>

<body class="position-relative">
    </nav>
    <Header>
        <h1>Benvenuto nel Girone dei Mercanti </h1>
        <nav>
            <p><a class="link" href="dashboard/dashboard.php">📌 dashboard</a></p>
            <p><a class="link" href="comunications/comunication.php">✅ comunicazioni</a></p>
            <p><a class="link" href="addArticle/addArticle.php">&#9741; aggiungi articolo</a></p>
            <select class="select input" name="type_id" id="typeSelect" value="0">
                <option value="0">🌍 Tutto</option>
                <?php
                $sql = "SELECT type_id, name FROM types ORDER BY name ASC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo $row["name"];
                    echo "<option value=\"{$row["type_id"]}\">{$row["name"]}</option>";
                }
                ?>
            </select>
            <p><a class="link" href="authentication/logout.php">logout &#9758;</a></p>
        </nav>
    </Header>
    <main>
        <div class="error-container" id="errorContainer">Loading...</div>
        <div class="articles-container" id="articlesContainer"></div>
    </main>
</body>

</html>