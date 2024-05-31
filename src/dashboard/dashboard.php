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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
    <div id="errorContainer"></div>
    <div>
        <h2>i tuoi articoli sul mercato</h2>
        <section id="articles" class="articles-container">
        </section>
    </div>
    <div>
        <h2>le proposte che hai inviato</h2>
        <section id="proposals" class="proposal-container">
        </section>
    </div>










    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
<?php
unset($_SESSION["error"]);
?>