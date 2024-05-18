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
    <header>
        <h1 class="name" id="name">Articolo</h1>
        <p class="username" id="username">username</p>
    </header>
    <main>
        <section>
            <p class="description" id="description">
                descrizione dell'articolo
            </p>
            <p>14/07/1397</p>
        </section>
        <section class="image-container" id="imageContainer">
            <img src="https://images.unsplash.com/photo-1567801527748-5225c65c5b91?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
            <img src="https://images.unsplash.com/photo-1500595046743-cd271d694d30?q=80&w=1174&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
            <img src="https://images.unsplash.com/photo-1503190766327-73a7d9e9e844?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
        </section>
        <section>
            <p>da mostrare solo se utente login != utente articolo</p>
            <h2>Fai una proposta</h2>
            <form action="" id="proposalForm">
                <div>
                    <label for="price">prezzo</label>
                    <input type="text" id="price" name="price" maxlength="16" />
                </div>
                <div>
                    <label for="description">descrizione</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </div>
                <button type="submit">invia</button>
            </form>
        </section>
        <section class="proposals" id="proposals">
            <p>da mostrare solo se utente login == utente articolo</p>
            <div class="proposal">
                <p>prezzo: 100</p>
                <p>descrizione: proposta</p>
                <p>username</p>
                <form action="">
                    <button>Rifiuta</button>
                </form>
                <form action="">
                    <button>Accetta</button>
                </form>
            </div>
        </section>
    </main>
</body>

</html>