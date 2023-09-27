<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

if (array_key_exists('save', $_SESSION) and $_SESSION['save']) {
    echo "<script>
          swal({
          icon: 'success',
          closeOnClickOutside: true,
          text: 'Courrier enregistré...',
          timer: 3000,
          onOpen: function(){
          swal.showLoading()
          }
          });
        </script>";
    $_SESSION['save'] = false;
}
if (array_key_exists('update', $_SESSION) and $_SESSION['update']) {
    echo "<script>
          swal({
          icon: 'success',
          closeOnClickOutside: true,
          text: 'Courrier a été modifier...',
          timer: 3000,
          onOpen: function(){
          swal.showLoading()
          }
          });
        </script>";
    $_SESSION['save'] = false;
}
if (array_key_exists('error', $_SESSION) and $_SESSION['error']) {
    echo "<script>
          swal({
          icon: 'warning',
          closeOnClickOutside: true,
          text: 'Une erreur est survenue. Ressayez!',
          timer: 3000,
          onOpen: function(){
          swal.showLoading()
          }
          });
        </script>";
    $_SESSION['error'] = false;
}
?>

<footer id="">
</footer><!-- End Footer -->
<script>
    const courrier = document
        .querySelector("[data-courrier]")
        ?.addEventListener("click", () => (location.href = "<?= SITE_URL ?>/courrier"));
</script>