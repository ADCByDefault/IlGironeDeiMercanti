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
</head>

<body>
    <header>
        <h1>
            Il Girone Dei Mercanti
        </h1>
    </header>
    <?php
    if (isset($_SESSION["error"])) {
        echo "<p>" . $_SESSION["error"] . "</p>";
    }
    echo "<h2>" . " Benvenuto " . $username . "</h2>";
    ?>
    <p>
        <a href="../index.php">Home</a>
    </p>
    <div id="errorContainer"></div>
    <section id="articles">
        <h2>i tuoi articoli sul mercato</h2>
    </section>
    <section id="proposals">
        <h2>le proposte che hai inviato</h2>
    </section>
    <div>
        <a href="../authentication/loginPage.php">go to login</a>
    </div>
    <div>
        <a href="../authentication/signupPage.php">go to signup</a>
    </div>
</body>

</html>
<?php
unset($_SESSION["error"]);
?>