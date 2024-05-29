<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("Location: ../index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>articolo</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="article.css">
    <script src="article.js" defer></script>
</head>

<body>


    <div class="error-container" id="errorContainer"></div>
    <div class="information-container" id="informationContainer"></div>
    <header>
        <div class="text-center bg-primary text-light">
        <h1 class="name" id="name">Articolo</h1>
       
    </div>

    <div class="text-center">
        <p> Informazioni:</p>
     <p  class="username text-center" id="username">username</p>
    </header>
    <main>
        <section class="content">
            <div class="text-center">
                <p class="description" id="description">
                    descrizione dell'articolo
                </p>
                <p class="created_at" id="created_at">14/07/1397</p>
            </div >
            <div class="images-container text-center" id="imagesContainer"></div>
        </section>
    
    </div>
        <section class="make-proposal text-center" id="makeProposal">
            <h2>Fai una proposta</h2>
            <form action="makeProposal.php" method="post" id="proposalForm">
                <input type="number" name="article_id" id="article_id" hidden>
                <div>
                    <label for="price">prezzo</label>
                    <input type="text" id="price" name="price" maxlength="16" />
                </div>
                <button type="submit">invia</button>
            </form>
        </section>
        <section class="proposals-container" id="proposalsContainer">
        </section>

        <div class="text-center">
        <a class="btn btn-primary" href="../index.php" role="button">Home</a>
    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>