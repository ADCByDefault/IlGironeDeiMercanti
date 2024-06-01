<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 500 - Internal Server Error</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        * {
            transition: all .1s ease-in-out;
        }

        body {
            min-width: 100vw;
            min-height: 100vh;
            display: grid;
            place-content: center;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            margin: 2rem;
            word-break: break-all;
        }
    </style>
</head>

<body>
    <h1 id="h1">
    </h1>
</body>
<script>
    const h1 = document.getElementById("h1");
    let string = "SCUSATE PER IL * DISSAAAAAAAAAAAAAAAAAAAAAGGIIIOOOOOO";
    const speed = 3000 / string.length;
    const interval =
        setInterval(() => {
            if (string.charAt(0) === "*") {
                h1.innerHTML += "<br>";
                string = string.slice(1);
            }
            h1.innerHTML += string.charAt(0);
            string = string.slice(1);
        }, speed);
    setTimeout(() => {
        clearInterval(interval);
        window.location.href = "https://www.youtube.com/watch?v=S-jsQyc1-Zg&t=59s";
    }, 3000);
</script>

</html>