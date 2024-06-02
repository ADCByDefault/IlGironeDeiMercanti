<?php
include_once "../authentication/connessione.php";
if (!isset($_SESSION["user_id"])) {
    $_SESSION["error"] = "devi fare il login";
    header("Location: ../authentication/loginPage.php");
    exit();
}
$user_id = $_SESSION["user_id"];
$sql = "SELECT username, image_url, email FROM users JOIN images on users.image_id = images.image_id WHERE user_id = '$user_id'";

$username = $conn->query($sql)->fetch_assoc()["username"];
$image_url = $conn->query($sql)->fetch_assoc()["image_url"];
$email = $conn->query($sql)->fetch_assoc()["email"];

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
    <div class="information-container" id="informationContainer">
        <span class='loader'></span>
    </div>
    <header>
        <h1>
            Il Girone Dei Mercanti
        </h1>
        <?php
        if (isset($_SESSION["error"])) {
            echo "<p>" . $_SESSION["error"] . "</p>";
        }
        ?>
        <nav>
            <p>
                <a class="link" href="../index.php">&#127968; Home</a>
            </p>
        </nav>
    </header>
    <main>
        <div class="img-container">
            <?php
            echo "<div><img src = '../../$image_url' alt='profilo' class='profile-img'>
                <form action='makeArticle.php' method='post' id='articleForm' enctype='multipart/form-data'>
                    <label class='label' for='modificaInput' id='modificaImg'>📸 Modifica Immagine</label>
                    <input class='input' type='file' name='img' id='modificaInput' style = 'display: none'>
                </form></div>";
            //echo "<h2>Benvenuto " . $username . "</h2>";
            echo "<a class='link' href = 'https://mail.google.com' ></a>$email"
            ?>
        </div>
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