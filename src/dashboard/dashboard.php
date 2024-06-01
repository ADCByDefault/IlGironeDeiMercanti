<?php
include_once "../authentication/connessione.php";
if (!isset($_SESSION["user_id"])) {
    $_SESSION["error"] = "devi fare il login";
    header("Location: ../authentication/loginPage.php");
    exit();
}
$user_id = $_SESSION["user_id"];
$sql = "SELECT username FROM users WHERE user_id = $user_id";
$username = $conn->query($sql)->fetch_assoc()["username"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="dashboard.js" defer></script>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
    <header>
        <h1>
            Il Girone Dei Mercanti
        </h1>
        <?php
        if (isset($_SESSION["error"])) {
            echo "<p>" . $_SESSION["error"] . "</p>";
        }
        echo "<h2 class=\"text-center\">" . " Benvenuto " . $username . "</h2>";
        ?>
        <nav>
            <p>
                <a class="link" href="../index.php">&#127968; Home</a>
            </p>
        </nav>
    </header>
    <main>
        <div id="errorContainer" class="error-container">Loading...</div>
        <div class="container">
            <h2>i tuoi articoli sul mercato</h2>
            <section id="articles" class="articles-container"></section>
        </div>
        <div>
            <h2>le proposte che hai inviato</h2>
            <section id="proposals" class="proposals-container"></section>
        </div>
    </main>
</body>

</html>
<?php
unset($_SESSION["error"]);
?>