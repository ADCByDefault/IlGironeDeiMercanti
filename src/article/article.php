<?php session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    die();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>articolo</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="article.css">
    <script src="article.js" defer></script>
</head>

<body>
    <div class="error-container" id="errorContainer"></div>
    <div class="information-container" id="informationContainer">
        <span class='loader'></span>
    </div>
    <header>
        <p>
            <a class="link" href="../index.php" role="button">🏠 Home</a>
        </p>
    </header>
    <main>
        <section class="content">
            <div class="slider-wrapper">
                <div class="slider" id="imagesContainer"></div>
                <div class="dots" id="dots"></div>
            </div>
            <div class="">
                <h1 class="name" id="name">Articolo</h1>
                <p class="description" id="description">
                    descrizione dell'articolo
                </p>
                <a class="username link" id="username">username</a>
                <p class="created_at" id="created_at">14/07/1397</p>
            </div>
        </section>
        <div class="proposal-functions">
            <section class="make-proposal" id="makeProposal">
                <h2>Fai una proposta</h2>
                <form action="makeProposal.php" method="post" id="proposalForm" class="proposal-form">
                    <input type="number" name="article_id" id="article_id" hidden>
                    <div>
                        <label class="label" for="price">prezzo</label>
                        <input class="input" type="number" id="price" name="price" maxlength="16" />
                    </div>
                    <button class="btn" type="submit">invia</button>
                </form>
            </section>
            <section class="proposals-container" id="proposalsContainer">
                <h2>Proposte</h2>
            </section>
        </div>
    </main>
</body>

</html>