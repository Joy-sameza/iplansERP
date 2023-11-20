<?php
$title = 'accueil';
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$url = $_SERVER["REQUEST_URI"];
$query = parse_url($url, PHP_URL_QUERY);
if ($query == "lang=en") {
  $_SESSION["lang"] = "en";
  include_once "./lang/en.php";
} else {
  if ($query == NULL) {
    $lanuage = $_SESSION['lang'] ?? 'fr';
    if ($lanuage == 'en') {
      include_once "./lang/en.php";
    }
    if ($lanuage == 'fr') {
      include_once "./lang/fr.php";
    }
  } else {
    $_SESSION["lang"] = "fr";
    include_once "./lang/fr.php";
  }
}


ob_start();
?>

<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    
    </style>
    <title>Tooltip Personnalisé</title>
</head>
<body>

    <div class="container mt-4">
        <!-- Bouton avec Tooltip Personnalisé -->
        <div class="tooltip">
            <button type="button" class="btn btn-primary">Survolez-moi</button>
            <span class="tooltiptext">Mon Tooltip personnalisé</span>
        </div>
    </div>

</body>
</html>















<?php
$content = ob_get_clean();
include 'layout.php';
?>