<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Username</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="user.css">
    <script src="user.js" defer></script>
</head>

<body>
    <div class="information-container" id="informationContainer">
        <span class='loader'></span>
    </div>
    <header>
        <h1 id="username">
            Username
        </h1>
        <p>
            <a class="link" href="../index.php">🏠 Home</a>
        </p>
    </header>
    <main>
        <div class="user-info">
            <section>
                <img src="" alt="" id="user_image" class="image">
                <h2 class="name">Nome : <span id="first_name"></span></h2>
                <p>Cognome : <span id="last_name"></span></p>
            </section>
            <section>
                <h2 class="article-h2">Articoli dell'utente</h2>
                <div class="articles-container" id="articlesContainer"></div>
            </section>
        </div>
    </main>
</body>

</html>