<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>articolo</title>
    <link rel="stylesheet" href="article.css">
    <script src="article.js" defer></script>
</head>

<body>
    <div>
        <a href="../index.php">home</a>
    </div>
    <div class="error-container" id="errorContainer"></div>
    <header>
        <h1 class="name" id="name">Articolo</h1>
        <p class="username" id="username">username</p>
    </header>
    <main>
        <section class="content">
            <div>
                <p class="description" id="description">
                    descrizione dell'articolo
                </p>
                <p class="created_at" id="created_at">14/07/1397</p>
            </div>
            <div class="images-container" id="imagesContainer"></div>
        </section>
        <section class="make-proposal" id="makeProposal">
            <h2>Fai una proposta</h2>
            <form action="makeProposal.php" method="post" id="proposalForm">
                <input >
                <div>
                    <label for="price">prezzo</label>
                    <input type="text" id="price" name="price" maxlength="16" />
                </div>
                <button type="submit">invia</button>
            </form>
        </section>
        <section class="proposals-container" id="proposalsContainer">
            <!-- <div class="proposal">
                <p>prezzo: 100</p>
                <p>descrizione: proposta</p>
                <p>username</p>
                <form action="">
                    <button>Rifiuta</button>
                </form>
                <form action="">
                    <button>Accetta</button>
                </form>
            </div> -->
        </section>
    </main>
</body>

</html>