<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>s
</head>
<body>






<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

<nav class="navbar bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand text-light">Il Girone <br>dei Mercanti
    </a>
    <form class="d-flex" role="search">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success text-light" type="submit">Search</button>
    </form>
  </div>
</nav>

    <?php


        include_once "authentication/connessione.php";
        include_once "class/Response.php";
        session_unset();

        if (isset($_POST["user_id"])) {
            $user_id = $_POST["user_id"];

        } else if (isset($_POST["username"])) {
            $username = $_POST["username"];

            $sql = "SELECT user_id FROM users WHERE username = '$username'";
            $user_id = $conn->query($sql)->fetch_assoc()["user_id"];

        } else if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            
        }


        if(!isset($user_id)) {









            echo "
            <div class=\"registrazione\">
                <h4>prima di visualizzare le offerte fai il login oppure se non lo hai mai fatto registrati</h4>
                
                <a href=\"./authentication/login.html\">login</a>
                <a href=\"./authentication/singup.html\">singup</a>
            </div>
            ";
        }
        else{
            include_once "utils/getArticles.php";

        }

    ?>
    



</body>
</html>