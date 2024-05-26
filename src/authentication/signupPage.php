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
                <label for="first_name">nome</label>
                <input class="input" type="text" name="first_name" id="first_name" placeholder="Mario" />
            </div>
            <div>
                <label for="last_names">cognome</label>
                <input class="input" type="text" name="last_name" id="last_name" placeholder="Sturniolo" />
            </div>
            <div>
                <label for="username">username</label>
                <input class="input" type="text" name="username" id="username" placeholder="sonoMarioSturniolo" required />
            </div>
            <div>
                <label for="email">email</label>
                <input class="input" type="email" name="email" id="email" placeholder="sono@mario.sturniolo" />
            </div>
            <div>
                <label for="password">password</label>
                <input class="input" type="password" name="password" id="password" placeholder="sonoMarioSturniolo" required />
            </div>
            <div>
                <label for="conferma">conferma password</label>
                <input class="input" type="password" name="conferma" id="conferma" placeholder="sonoMarioSturniolo" required />
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
        if(password.value !== conferma.value){
            errorContainer.textContent = "le due password non corrispondono";
            return;
        }
        errorContainer.textContent = "Loading...";
        const formData = new FormData(signupForm);
        const response = await fetch("signup.php", {
            method: "POST",
            body: formData,
        });
        const data = await response.json();
        let message;
        if (data.status == "251") {
            message = "utente creato, reindirizzamento...";
            window.location.replace("../dashboard/dashboard.php");
        } else if (data.status == "451") {
            message = "email o username già in uso";
        } else if (data.status == "452") {
            message = "le due password non corrispondono";
        }
        else {
            message = "errore sconosciuto";
        }
        errorContainer.textContent = message;
    });
</script>

</html>