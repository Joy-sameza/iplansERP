<?php
$url = $_SERVER["REQUEST_URI"];
$query = parse_url($url, PHP_URL_QUERY);
if ($query == "lang=en") {
  $_SESSION["lang"] = "en";
  include_once "./lang/en.php";
} else {
  if (!$query) {
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
?>

<footer id="">

    <div class="">
        <div class="copyright">
            <center>    &copy; Copyright <strong><span><?= $lang['linkpay'] ?></span></strong>. <?= $lang['droits'] ?></center>
        </div>

</footer><!-- End Footer -->