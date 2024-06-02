<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="authentication.css">
</head>

<body>
    <header>
        <h1>Pagina Signup</h1>
    </header>
    <main>
        <div class="error-container" id="errorContainer"></div>
        <form action="signup.php" method="post" class="signup-form" id="signupForm">
            <div>
                <label for="first_name">Nome</label>
                <input class="input" type="text" name="first_name" id="first_name" placeholder="Mario" />
            </div>
            <div>
                <label for="last_names">Cognome</label>
                <input class="input" type="text" name="last_name" id="last_name" placeholder="Sturniolo" />
            </div>
            <div>
                <label for="username">Username</label>
                <input class="input" type="text" name="username" id="username" placeholder="sonoMarioSturniolo"
                    required />
            </div>
            <div>
                <label for="email">Email</label>
                <input class="input" type="email" name="email" id="email" placeholder="sono@mario.sturniolo" />
            </div>
            <div>
                <label for="password">Password</label>
                <input class="input" type="password" name="password" id="password" placeholder="sonoMarioSturniolo"
                    required />
            </div>
            <div>
                <label for="conferma">Conferma password</label>
                <input class="input" type="password" name="conferma" id="conferma" placeholder="sonoMarioSturniolo"
                    required />
            </div>
            <button class="btn">Invio</button>
        </form>
        <div>
            <a href="loginPage.php" class="link">&larr; Accedi</a>
        </div>
    </main>
</body>
<script>
    const signupForm = document.getElementById("signupForm");
    const errorContainer = document.getElementById("errorContainer");
    const password = document.getElementById("password");
    const conferma = document.getElementById("conferma");

    signupForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        event.submitter.disabled = true;
        if (password.value !== conferma.value) {
            errorContainer.textContent = "le due password non corrispondono";
            return;
        }
        errorContainer.innerHTML = "<span class='loader'></span>";
        const formData = new FormData(signupForm);
        const response = await fetch("signup.php", {
            method: "POST",
            body: formData,
        }).catch((error) => {
            errorContainer.textContent = "Errore nella comunicazione col server";
            event.submitter.disabled = false;
            return;
        })
        const data = await response.json();
        let message = "Errore sconosciuto";
        switch (data.status) {
            case "251":
                message = "Utente creato, reindirizzamento...";
                window.location.replace("../index.php");
                return;
                break;
            case "451":
                message = "Email o Username già in uso";
                break;
            case "452":
                message = "Le due password non corrispondono";
                break;
            case "450":
                message = "Campi obbligatori mancanti";
                break;
            case "550":
                message = "Errore nella creazione dell'utente";
                break;
            default:
                message = "Errore sconosciuto";
        }
        errorContainer.textContent = message;
        event.submitter.disabled = false;
    });
</script>

</html>