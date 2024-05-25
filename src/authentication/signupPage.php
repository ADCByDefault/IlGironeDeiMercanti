<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
    <link rel="stylesheet" href="log-sing.css">
</head>

<body>
    <header>
        <h1>Pagina Signup</h1>
    </header>
    <main>
        <div class="mainDiv">
            <div id="errorContainer"></div>
            <form action="signup.php" method="post" id="signupForm">
                <div>
                    <label for="first_name">nome</label>
                    <br>
                    <input type="text" name="first_name" id="first_name" placeholder="first_name" />
                </div>
                <div>
                    <label for="last_______names">cognome</label>
                    <br>
                    <input type="text" name="last_name" id="last_name" placeholder="last_name" />
                </div>
                <div>
                    <label for="username">username</label>
                    <br>
                    <input type="text" name="username" id="username" placeholder="username" required />
                </div>
                <div>
                    <label for="email">email</label>
                    <br>
                    <input type="email" name="email" id="email" placeholder="email" />
                </div>
                <div>
                    <label for="password">password</label>
                    <br>
                    <input type="password" name="password" id="password" placeholder="password" required />
                </div>
                <div>
                    <label for="conferma">conferma password</label>
                    <br>
                    <input type="password" name="conferma" id="conferma" placeholder="password" required />
                </div>
                <br>
                <button>Invio</button>
            </form>
            <div>
                <br>
                <a href="loginPage.php">Accedi</a>
            </div>
        </div>
    </main>
</body>
<script>
    const signupForm = document.getElementById("signupForm");
    const errorContainer = document.getElementById("errorContainer");

    signupForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        errorContainer.textContent = "";
        const formData = new FormData(signupForm);
        const response = await fetch("signup.php", {
            method: "POST",
            body: formData,
        });
        const data = await response.json();
        console.log(response);
        console.log(data);
        let message;
        if (data.status == "251") {
            message = "utente creato";
            window.location.replace("../index.php");
        } else if (data.status == "451") {
            message = "email o username già esistenti";
        } else if (data.status == "452") {
            message = "le due password non corrispondono";
        }
        else {
            message = "errore generico";
        }
        console.log(message);
        errorContainer.textContent = message;
    });
</script>

</html>