<?php
$dirs = __DIR__;
$dirs = str_replace("vues", "", $dirs);
require_once $dirs . '/include/config.php'; ?>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>MCS Cameroun</title>

    <?php require_once $dirs . '/partials/head.php'; ?>

</head>

<body>

    <div id="wrapper" class="">
        <?php require_once $dirs . '/partials/header.php'; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <?php echo $content ?>
            </div>
        </div>
    </div>
    <?php require_once  $dirs . '/partials/footer.php'; ?>
</body>

</html>