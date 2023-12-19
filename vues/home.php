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


           <div class="container   d-flex justify-content-center align-items-center">
                <h1 class='text-uppercase text-muted text-decoration-underline mt-4'><b><ul id="displayData"></ul></b></h1>
            </div>
<main class="main mt-4">
    <!--  Main start -->

    

    <div class="pictures " style="height: 62%; border-radius: 15px!important;border:0;background:none;">
        <img src="<?= SITE_URL ?>/assets/img/avatar.png" alt=""
            style='width: 270px;height: 300px; border-radius: 15px!important;'>



        <style>
            a {
                    text-decoration: none;
                }

        .lange {
            font-size: 25px;
            margin-top: 47px;
            display: none;
        }

        .lang {
            margin-top: 0px !important;
            padding-top: 43px;
            display:none;
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
        .cent-bout{
                    display: flex!important;
                    justify-content: center!important;
                    align-items: center!important;
        }

        /* Styles pour le survol du bouton */
        .func:hover {
            background-color: #0D6EFD !important;
            /* Nouvelle couleur de fond au survol */
            color: #fff !important;
            /* Nouvelle couleur du texte au survol */
            /* zoom: 1.1; */

        }

        a {

            color: black !important;
        }

        a:hover {
            color: white !important;
        }



        /* Styles pour le clic sur le bouton */
        .func:active {
            /* transform: translateX(1px) !important; */
            color: #fff !important;
            /* Légère descente au clic */
        }


          body {

            border-bottom: none;
            overflow-x: auto;


            &::-webkit-scrollbar {
                height: 10px;
                /* Ajuster la hauteur de la barre de défilement horizontale */
            }

            &::-webkit-scrollbar-thumb {
                background-color: #3498db;
                /* Couleur du curseur de défilement */
            }

            &::-webkit-scrollbar-track {
                background-color: #ecf0f1;
                /* Couleur de la piste de défilement */
            }

            &:hover {
                &::-webkit-scrollbar-thumb {
                    background-color: #0b9444;
                    /* Changement de couleur au survol */
                }
            }
        }

              /* scrollbar du tableau */

        ::-webkit-scrollbar {
            width: 15px;
        }



        /* Track */
        ::-webkit-scrollbar-track {
            box-shadow: inset 0 0 5px grey;
            border-radius: 10px;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #238fce;
            border-radius: 10px;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #0b9444;
        }
        </style>


    </div>

    <button type="button" class="func" style='top:1%'>
        <img src="<?= SITE_URL ?>/assets/img/house.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Accueil
    </button>


    <button type="button" class="func cent-bout">
        <img src="<?= SITE_URL ?>/assets/img/debate.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Communication personnelle
    </button>


    <button type="button" class="func">
        <img src="<?= SITE_URL ?>/assets/img/message.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Messagerie
    </button>

    <button type="button" class="func" data-courrier>
        <img src="<?= SITE_URL ?>/assets/img/food.png" alt="" style="width: 40px; height: 40px; margin-right:7px">
        Courrier&nbsp;E/S
    </button>


    <button type="button" class="func" data-hotel onclick="redirectToRA()">
        

             <a href="<?= SITE_URL ?>/list-visit-rdv"style="width: 40px; height: 40px; margin-right:7pxlor: black">
           <img src="<?= SITE_URL ?>/assets/img/receptionist.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Réception/Accueil
       </a>
    </button>


    <button type="button" class="func" style='bottom: 1%;'>
      <img src="<?= SITE_URL ?>/assets/img/setting.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Paramètres
    </button>


    <button type="button" class="func">
        <img src="<?= SITE_URL ?>/assets/img/video.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Médiathèque
    </button>


    <button type="button" class="func">
        <img src="<?= SITE_URL ?>/assets/img/conversation.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">GED
    </button>


    <button type="button" class="func" id="rhumain" onclick="redirectToRH()">
       <a href="<?= SITE_URL ?>/resource_humaine"style="width: 40px; height: 40px; margin-right:7pxlor: black">
            <img src="<?= SITE_URL ?>/assets/img/human.png" alt="" style="width: 40px; height: 40px; margin-right:7px">GRH
       </a>
    </button>


    <button type="button" class="func cent-bout">
        <img src="<?= SITE_URL ?>/assets/img/data-management.png" alt=""style="width: 40px; height: 40px; margin-right:7px">Gestion Administrative
    </button>
</main>

  <div class="container-fluid d-flex justify-content-end pb-5 align-items-right">
              
    <img src="<?= SITE_URL ?>/assets/img/logo_minesec2.png" alt=""style="width: 130px; height: 130px; margin-right:7px">
  </div>
<!--  main end -->



    <script>
        // Récupérer la dernière valeur depuis le localStorage
        var storedData = JSON.parse(localStorage.getItem("etablissement"));

        // Afficher la dernière valeur sur la page
        var displayElement = document.getElementById("displayData");

        if (storedData && storedData.length > 0) {
            var lastSelectedValue = storedData[storedData.length - 1];
            displayElement.textContent = lastSelectedValue;
        } else {
           
        }
    </script>

 <!-- gestion des clique sur les boutton -->

    <script>
        function redirectToRH() {
       
            window.location.href = '<?= SITE_URL ?>/resource_humaine';
        }
    </script>
    <script>
        function redirectToRA() {
       
            window.location.href = '<?= SITE_URL ?>/list-visit-rdv';
        }
    </script>



<?php
$content = ob_get_clean();
include 'layout.php'
?>