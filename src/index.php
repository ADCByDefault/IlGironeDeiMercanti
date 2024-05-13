<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php

        include_once "authentication/connessione.php";
        include_once "class/Response.php";

        $user_id = null;

        if (isset($_POST["user_id"])) {
            $user_id = $_POST["user_id"];

        } else if (isset($_POST["username"])) {
            $username = $_POST["username"];

            $sql = "SELECT user_id FROM users WHERE username = '$username'";
            $user_id = $conn->query($sql)->fetch_assoc()["user_id"];

        } else if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            
        }

        var_dump($user_id);

        if (!$user_id) {
            echo "
            <div>
                <a href \"login.html\">login</a>
                <a href \"singup.html\">singup</a>
            </div>
            ";
        }
        else{
            include_once "utils/getArticles.php";

        }

    ?>
    



</body>
</html>