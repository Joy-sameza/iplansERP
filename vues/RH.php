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


<link href="<?= SITE_URL ?>/assets/css/index5.css" rel="stylesheet">
<link href="<?= SITE_URL ?>/assets/css/styleRH.css" rel="stylesheet">
 <style>
		.lange{
			font-size: 25px;
            margin-top: 47px;
			display: none;
		}
		.lang{
			    margin-top: 0px!important;
				padding-top: 43px;
		}
	    .lang	img{
				height: 24px;
				width: 24px;
			}


	</style>

<main>
    <div class="container   d-flex justify-content-center align-items-center">
                <h2 class='text-uppercase text-muted  mt-4'><b><ul id="displayData"></ul></b></h2>
    </div>
    <div class="container">
       
         <div class="row text-center">
            <div class="col p-5 d-flex justify-content-center align-items-center   text-white">
                 
                  <a href="<?= SITE_URL ?>/employes">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/staff1.png" alt=""style="width: 40px; height: 40px; margin-right:7px">
                            Employés
                        </button>
                  </a>
            </div>
            <div class="col p-5 d-flex justify-content-center align-items-center    text-white">

               <a href="<?= SITE_URL ?>/tableau">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/timetable.png" alt=""style="width: 40px; height: 40px; margin-right:7px">
                            Pointage
                        </button>
                  </a>

            </div>
            <div class="col p-5 d-flex justify-content-center align-items-center     text-white">
             
             <a href="<?= SITE_URL ?>/tableau">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/evaluation.png" alt=""style="width: 40px; height: 40px; margin-right:7px">
                            Plannings Horaires
                        </button>
                  </a>

            </div>
        </div>




        <div class="row text-center d-flex justify-content-center align-items-center">
            <div class="col p-5 text-center  d-flex justify-content-center align-items-center d-flex justify-content-center align-items-center     text-white">

                 <a href="<?= SITE_URL ?>/permi_con">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/permission.png" alt=""style="width: 40px; height: 40px; margin-right:7px">
                            Permissions/Congés
                        </button>
                  </a>
            </div>
            <div class="col p-5 d-flex justify-content-center align-items-centertext-white">
                  <a href="<?= SITE_URL ?>/tableau">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/business-credit-score.png" alt=""style="width: 40px; height: 40px; margin-right:7px">
                            Accompte/Déduction
                        </button>
                  </a>
            </div>
            <div class="col p-5 d-flex justify-content-center align-items-center text-white">
               
               <a href="<?= SITE_URL ?>/tableau">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/payment.png" alt=""style="width: 40px; height: 40px; margin-right:7px">
                            Paie
                        </button>
                  </a>

            </div>
        </div>
        <div class="row">
           
            <div class="col-sm-9  p-5 d-flex justify-content-left align-items-left">
                <h1 class='text-uppercase mt-4'><b>gestion des ressources humaines</b></h1>
            </div>
            <div class="col-sm-3  d-flex justify-content-center align-items-center  text-white">
              
                        
                            <img src="<?= SITE_URL ?>/assets/img/logo_minesec2.png" alt=""style="width: 170px; height: 170px; margin-right:7px">
                            
                        
                 
            </div>
        </div>

     
      
    
    </div>

  
</main>

<style>


        .func {
            font-size: 23px;
            text-transform: capitalize;
            width: 17rem !important;
            height: 6rem !important;
            display: inline-block;
            text-align: center;
            border: 2px solid gray !important;
          
            font-weight: 500 !important;
           
            color: black;
            border-radius: 20px !important;
             transition: background-color 0.3s, color 0.3s, transform 0.5s;

        }

        /* Styles pour le survol du bouton */
        .func:hover {
            background-color: #0D6EFD !important;
            /* Nouvelle couleur de fond au survol */
            color: #fff !important;
            /* Nouvelle couleur du texte au survol */
         

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




   <script>
        // Récupérer la dernière valeur depuis le localStorage
        var storedData = JSON.parse(localStorage.getItem("etablissement"));

        // Afficher la dernière valeur sur la page
        var displayElement = document.getElementById("displayData");

        if (storedData && storedData.length > 0) {
            var lastSelectedValue = storedData[storedData.length - 1];
            displayElement.textContent = lastSelectedValue;
        } else {
            displayElement.textContent = "Aucune donnée disponible.";
        }
    </script>




<?php
$content = ob_get_clean();
include 'layout.php';
?>