<?php
include_once "authentication/connessione.php";
//$_SESSION["user_id"] = null;
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
    <script src="home.js" defer></script>
</head>

<body>
    <header>
        <h1>
            Il Gran coglione Dei Mercanti
        </h1>
    </header>
    <?php
    if (isset($_SESSION["error"])) {
        echo "<p>" . $_SESSION["error"] . "</p>";
    }
    echo "<h2>" . " Benvenuto " . $username . "</h2>";
    ?>
    <div id="errorContainer"></div>
    <section id="articles">
        <h2>i tuoi articoli sul mercato</h2>
    </section>
    <section id="proposals">
        <h2>le proposte che hai inviato</h2>
    </section>
    <div>
        <a href="authentication/login.html">go to login</a>
    </div>
    <div>
        <a href="authentication/signup.html">go to signup</a>
    </div>
</body>

</html>
<?php
unset($_SESSION["error"]);
?>