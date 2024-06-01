<?php
include_once "../authentication/connessione.php";
if (!isset($_SESSION["user_id"])) {
    $_SESSION["error"] = "devi essere loggato per accedere a questa pagina";
    header("Location: ../authentication/loginPage.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>articolo</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="addArticle.css">
    <script src="addArticle.js" defer></script>
</head>

<body>
    <header>
        <h1>Aggiungi il tuo articolo</h1>
        <div>
            <a href="../index.php" class="link">🏠 Home</a>
        </div>
    </header>
    <main>
        <p class="error-container" id="errorContainer"></p>
        <p class="information-container" id="informationContainer"></p>
        <section class="addArticle" id="addArticle">
            <form action="makeArticle.php" method="post" id="articleForm" enctype="multipart/form-data">
                <div>
                    <label class="label" for="img">📸 Immagine</label>
                    <input class="input" type="file" name="img" id="img">
                    <!-- <p>Estensioni Consentite -> .jpg .jpeg .png .gif .webp</p> -->
                </div>
                <div>
                    <label class="label" for="name">Nome</label>
                    <input class="input" type="text" name="nome" id="name" placeholder="Elitropia">
                </div>
                <div>
                    <label class="label" for="price">Breve Descrizione</label>
                    <input class="input" type="text" name="descrizione" placeholder="Preziosa pietra trovata lungo il Mugnone">
                </div>
                <div>
                    <label for="type">Tipologia</label>
                    <select class="input" name="type_id" id="type">
                        <?php
                        $sql = "SELECT type_id, name FROM types ORDER BY name ASC";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"{$row["type_id"]}\">{$row["name"]}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <button class="btn" type="submit">invia</button>
                </div>
            </form>
        </section>
        <section class="proposals-container" id="proposalsContainer">
        </section>
    </main>
</body>

</html>