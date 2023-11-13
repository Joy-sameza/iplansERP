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
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/style.css">
<div style="
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 80%;
        justify-content: center;
        align-items: center;
    ">
    <h1 style="font-size: 5rem; letter-spacing: 0.5ch;">404</h1>
    <strong style="font-size: 1.5rem;">The page you're looking was not found</strong>
</div>
<?php
$content = ob_get_clean();
include 'layout.php';
?>