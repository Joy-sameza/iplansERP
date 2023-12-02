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

<!---------------- Main section ------------------------>
<link href="<?= SITE_URL ?>/assets/css/style.css" rel="stylesheet">
<main class="main">
    <!--  Main start -->

    <div class="pictures" style="height: 62%; border-radius: 15px!important;border:0;background:none;">
        <img src="<?= SITE_URL ?>/assets/img/avatar.png" alt=""
            style='width: 270px;height: 300px; border-radius: 15px!important;'>



        <style>
        .lange {
            font-size: 25px;
            margin-top: 47px;
            display: none;
        }

        .lang {
            margin-top: 0px !important;
            padding-top: 43px;
        }

        .lang img {
            height: 24px;
            width: 24px;
        }

        button {
            display: inline-block;

            font-size: 10px;
            font-weight: 500;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            border: 2px solid #3498db;
            /* Couleur de la bordure */
            color: #3498db;
            /* Couleur du texte */
            background-color: #fff;
            /* Couleur de fond */
            border-radius: 5px;
            /* Coins arrondis */
            transition: background-color 0.3s, color 0.3s, transform 0.5s;

            /* Transition fluide */
        }

        .main>.func {
            text-transform: capitalize;
            width: 15.5rem !important;
            height: 4rem !important;
            display: inline-block;
            text-align: center;
            border: 2px solid gray !important;
            position: absolute;
            font-weight: 500 !important;
            font-size: large;
            color: black;
            border-radius: 15px !important;

        }

        /* Styles pour le survol du bouton */
        .func:hover {
            background-color: #0D6EFD !important;
            /* Nouvelle couleur de fond au survol */
            color: #fff !important;
            /* Nouvelle couleur du texte au survol */
            zoom: 1.1;

        }

        a {

            color: black !important;
        }

        a:hover {
            color: white !important;
        }



        /* Styles pour le clic sur le bouton */
        .func:active {
            transform: translateY(2px) !important;
            color: #fff !important;
            /* Légère descente au clic */
        }
        </style>


    </div>

    <button type="button" class="func" style='top:1%'>
        <img src="<?= SITE_URL ?>/assets/img/house.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Accueil
    </button>
    <button type="button" class="func"><img src="<?= SITE_URL ?>/assets/img/debate.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Communication personnelle</button>
    <button type="button" class="func"><img src="<?= SITE_URL ?>/assets/img/message.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Messagerie</button>
    <button type="button" class="func" data-courrier>
        <img src="<?= SITE_URL ?>/assets/img/food.png" alt="" style="width: 40px; height: 40px; margin-right:7px">
        Courrier&nbsp;E/S
    </button>
    <button type="button" class="func" data-hotel><img src="<?= SITE_URL ?>/assets/img/receptionist.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Réception/Accueil</button>
    <button type="button" class="func" style='bottom: 1%;'><img src="<?= SITE_URL ?>/assets/img/setting.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Paramètres</button>
    <button type="button" class="func"><img src="<?= SITE_URL ?>/assets/img/video.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Médiathèque</button>
    <button type="button" class="func"><img src="<?= SITE_URL ?>/assets/img/conversation.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">GED</button>
    <button type="button" class="func" id="rhumain"><a href="<?= SITE_URL ?>/rhumain"
            style="width: 40px; height: 40px; margin-right:7pxlor: black"><img
                src="<?= SITE_URL ?>/assets/img/human.png" alt=""
                style="width: 40px; height: 40px; margin-right:7px">GRH</a></button>
    <button type="button" class="func"><img src="<?= SITE_URL ?>/assets/img/data-management.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Gestion Administrative</button>
</main>
<!--  main end -->



<?php
$content = ob_get_clean();
include 'layout.php'
?>