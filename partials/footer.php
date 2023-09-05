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
</footer><!-- End Footer -->

<?php
require_once './include/functions.php';

$insert_string = '
<script>
  const courrier = document
    .querySelector("[data-courrier]")
    ?.addEventListener("click", () => (location.href = "' . SITE_URL . '/courrier"));
</script>';
__add__($url, '', $insert_string);
__add__($url, '/', $insert_string);
__add__($url, 'home', $insert_string);
?>