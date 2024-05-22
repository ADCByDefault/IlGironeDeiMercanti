<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>articolo</title>
    <link rel="stylesheet" href="addArticle.css">
    <script src="addArticle.js" defer></script>
</head>

<body>
    <div>
        <a href="../index.php">home</a>
    </div>
    <div class="error-container" id="errorContainer"></div>
    <div class="information-container" id="informationContainer"></div>
    <main>
        <section class="addArticle" id="addArticle">
            <h2>aggiungi il tuo articolo</h2>
            <form action="makeArticle.php" method="post" id="articleForm" enctype="multipart/form-data">
                <input type="file" id="img">
                <br><br>
                <input type="text" name="nome" placeholder="articolo">
                <input type="text" name="descrizione" placeholder="breve descrizione">
                <select name="type" id="">
                    <?php
                        include_once "../authentication/connessione.php";

                        $sql = "SELECT type_id, name FROM types";
                        $result = $conn -> query($sql);

                        while($row = $result -> fetch_assoc()){
                            echo $row["name"];
                            echo "<option value=\"{$row["type_id"]}\">{$row["name"]}</option>";
                        }
                    ?>
                </select>
                <button type="submit">invia</button>
            </form>
        </section>
        <section class="proposals-container" id="proposalsContainer">
        </section>
    </main>
</body>
</html>