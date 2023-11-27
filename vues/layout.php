<?php
$dirs = __DIR__;
$dirs = str_replace("vues", "", $dirs);
require_once $dirs . '/include/config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php require_once $dirs . '/partials/head.php'; ?>
</head>

<body>

    <noscript><h1>You need to enable JavaScript to run this app.</h1></noscript>
    <?php require_once $dirs . '/partials/header.php'; ?>
    <?php echo $content ?>
    <?php require_once $dirs . '/partials/footer.php'; ?>

</body>

</html>