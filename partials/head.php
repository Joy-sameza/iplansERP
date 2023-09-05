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


<!-- Scripts -->
<?php
require_once './include/functions.php';
$url = $_SERVER["REQUEST_URI"];
$insert_string = '<script src="' . SITE_URL . '/assets/js/iplans.courrier.js" defer></script>';
__add__($url, 'courrier', $insert_string);
?>