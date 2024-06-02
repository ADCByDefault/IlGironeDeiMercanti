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
                <input class="input" type="text" name="username" id="username" placeholder="sonoMarioSturniolo" required />
            </div>
            <div>
                <label class="label" for="password">Password</label>
                <input class="input" type="password" name="password" id="password" placeholder="sonoMarioSturniolo" required />
            </div>
            <div>
                <button class="btn">Accedi</button>
            </div>
        </form>
        <div>
            <a href="signupPage.php" class="link">Pagina Signup &rarr;</a>
        </div>
    </main>
</body>
<script>
    const form = document.getElementById("loginForm");
    const errorContainer = document.getElementById("errorContainer");
    form.addEventListener("submit", async (event) => {
        event.preventDefault();
        event.submitter.disabled = true;
        errorContainer.textContent = "Loading...";
        const formData = new FormData(form);
        const response = await fetch("login.php", {
            method: "POST",
            body: formData,
        }).catch((error) => {
            console.error(error);
            errorContainer.textContent = "Errore di connessione";
            event.submitter.disabled = false;
            return;
        });

        const data = await response.json();
        console.log(response);
        console.log(data);

        errorContainer.textContent = data;
        let message;
        switch (data.status) {
            case "252":
                message = "Hai fatto il login, verrai reindirizzato alla Home";
                window.location.assign("../index.php");
                errorContainer.textContent = message;
                return;
                break;
            case "453":
                message = "Password sbagliata";
                break;
            case "451":
                message = "Username o Email sbagliati";
                break;
            case "450":
                message = "Campi vuoti";
                break;
            default:
                message = "Errore generico";
        }
        console.log(message);
        errorContainer.textContent = message;
        event.submitter.disabled = false;
    });
</script>

</html>