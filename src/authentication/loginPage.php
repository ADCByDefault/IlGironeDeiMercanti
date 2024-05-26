<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="authentication.css">
    <title>Login</title>
</head>

<body>
    <header>
        <h1>Pagina Login</h1>
    </header>
    <main>
        <div class="mainDiv">
            <?php
            echo '<div id="errorContainer" class="error-container">';
            if (isset($_SESSION["error"])) {
                echo "<p>" . $_SESSION["error"] . "</p>";
            }
            echo "</div>";
            unset($_SESSION["error"]);
            ?>
        </div>
        <form class="login-form" action="login.php" method="post" id="loginForm">
            <div>
                <label class="label" for="username">Username</label>
                <br>
                <input class="input" type="text" name="username" id="username" placeholder="username" required />
                <br>
            </div>
            <div>
                <label class="label" for="password">Password</label>
                <br>
                <input class="input" type="password" name="password" id="password" placeholder="password" required />
                <br>
            </div>
            <div>
                <button class="btn">Invia</button>
            </div>
        </form>
        <div>
            <a href="signupPage.php" class="link">Registrati &rarr;</a>
        </div>
        </div>
    </main>
</body>
<script>
    const form = document.getElementById("loginForm");
    const errorContainer = document.getElementById("errorContainer");
    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        errorContainer.textContent = "Loading...";
        const formData = new FormData(form);
        const response = await fetch("login.php", {
            method: "POST",
            body: formData,
        });
        const data = await response.json();
        console.log(response);
        console.log(data);


        errorContainer.textContent = data;
        let message;
        if (data.status == "252") {
            message = "Hai fatto il login, verrai reindirizzato alla tua pagina di profilo fra poco";
            window.location.assign("../dashboard/dashboard.php");
        } else if (data.status == "453") {
            message = "password sbagliata";
        } else if (data.status == "451") {
            message = "username o email sbagliati";
        } else {
            message = "errore generico";
        }
        console.log(message);
        errorContainer.textContent = message;
    });
</script>

</html>