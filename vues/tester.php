<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ouvrir une nouvelle page</title>
</head>

<body>

    <button id="ouvrirPage">Ouvrir une nouvelle page</button>

    <script>
        document.getElementById("ouvrirPage").addEventListener("click", function() {
            // Spécifiez l'URL de la nouvelle page que vous souhaitez ouvrir
            var nouvellePageURL = "https://www.example.com/nouvelle-page.html";

            // Ouvrir la nouvelle page dans une nouvelle fenêtre
            window.open(nouvellePageURL, "_blank");
        });
    </script>

</body>

</html>