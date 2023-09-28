<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>IplansERP</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="<?= SITE_URL ?>/assets/img/iplans favicon 1.png" rel="icon">
<link href="<?= SITE_URL ?>/assets/img/iplans favicon.png" rel="apple-touch-icon">
<link rel="shortcut icon" href="<?= SITE_URL ?>/assets/img/iplans favicon.png" type="image/x-icon" />
<!-- Google Fonts -->
<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i,900" rel="stylesheet"> -->

<!-- Template Main CSS File -->
<link href="<?= SITE_URL ?>/assets/css/style.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="<?= SITE_URL ?>/assets/js/jquery-3.1.1.min.js"> -->
<script type="text/javascript" src="<?= SITE_URL ?>/assets/js/jquery.min.js" defer></script>
<script type="text/javascript" src="<?= SITE_URL ?>/assets/js/sweetalert2.js" defer></script>

<script src="<?= SITE_URL ?>/assets/js/iplans.courrier.js" defer></script>

<?php
//require_once './include/functions.php';
//$url = $_SERVER["REQUEST_URI"];
//$insert_string = '';
//__add__($url, 'courrier', $insert_string);
header('Accept-Encoding: gzip, compress, br', true);
header("Content-Encoding: compress", true);
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0", true);
header("Expires: Thu, 01 Jan 1970 00:00:00 GMT", true);
?>

<script>
    const API_URL = "<?= COURRIER_API_URL ?>";
    const SITE_URL = "<?= SITE_URL ?>";
    let SAVE = false;
</script>
<?php
if (array_key_exists('save', $_SESSION) and $_SESSION['save']) {
    echo "<script> SAVE = true; </script>";
    $_SESSION['save'] = false;
}
?>