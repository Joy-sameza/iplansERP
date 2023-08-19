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

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="<?= SITE_URL ?>/assets/vendor/purecounter/purecounter.js"></script>
<script src="<?= SITE_URL ?>/assets/vendor/aos/aos.js"></script>
<script src="<?= SITE_URL ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= SITE_URL ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= SITE_URL ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= SITE_URL ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= SITE_URL ?>/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= SITE_URL ?>/assets/js/custom-selectbox.js"></script>
<script src="<?= SITE_URL ?>/assets/js/main.js"></script>