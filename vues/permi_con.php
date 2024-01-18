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
<div class="container-fluid" style='position:relative;'>
     <button id="retour" class='ferme bout-bas' style='position:absolute;right: 60px;top:25px;'>
                        Retour
           <img src="<?= SITE_URL ?>/assets/img/previous.png" alt="" style="width: max-content; height: 20px;">
      </button>
     
</div>
    <div class="container">

      
            <div class=" text-center p-5 d-flex justify-content-center">
                <h1 class='text-uppercase mt-4 text-center'><b>permissions et congés</b></h1>
            </div>
       
         <div class="row text-center">
            <div class="col p-2 d-flex justify-content-center align-items-center   text-white">
                 
                  <a href="<?= SITE_URL ?>/list_abscences">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/question.png" alt=""style="width: 65px; height: 65px; margin-right:7px">
                            Abscences
                        </button>
                  </a>
            </div>
            <div class="col p-2 d-flex justify-content-center align-items-center    text-white">

               <a href="<?= SITE_URL ?>/list_mission">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/target.png" alt=""style="width: 65px; height: 65px; margin-right:7px">
                            Missions
                        </button>
                  </a>

            </div>
            <div class="col p-2 d-flex justify-content-center align-items-center     text-white">
             
             <a href="<?= SITE_URL ?>/tableau">
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/summer-holidays.png" alt=""style="width: 65px; height: 65px; margin-right:7px">
                            Congés
                        </button>
                  </a>

            </div>
        </div>
</div>
   <div class="container-fluid d-flex justify-content-end mt-5 my-3 px-4 align-items-right">
                        
                <img src="<?= SITE_URL ?>/assets/img/logo_minesec2.png" alt=""style="width: 170px; height: 170px; margin-right:7px">
            </div> 
       
<!-- 
        <div class='espace'  style='height:100px'>
           
                  <button id="fermer" class='ferme bout-bas'>
                        Fermer
                        <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                    </button>
       </div> -->




      <style>
          #retour{
            width: 120px;
            height: 45px;
            border-radius: 5px;
            border: 1px solid gray;
             transition: background-color 0.3s, color 0.3s;
           
            
            }
             #retour:hover {
            background-color: #45a049;
            color: #fff;
            }
         .bout-bas  {
            width: 130px;
            height: 49px;
            border-radius: 5px;
            float:right;
            margin-right:28px;
        }
     
        
     	.lange{
			font-size: 25px;
            margin-top: 47px;
			display: none;
		}
		.lang{
			    margin-top: 0px!important;
				padding-top: 43px;
                display:none;
		}
	    .lang	img{
				height: 24px;
				width: 24px;
			}

        .func {
            font-size: 30px;
            text-transform: capitalize;
            width: 18rem !important;
            height: 18rem !important;
            display: inline-block;
            text-align: center;
            border: 2px solid gray !important;
          
            font-weight: 500 !important;
           
            color: black;
            border-radius: 20px !important;
             transition: background-color 0.4s, color 0.4s, transform 0.5s;

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
        const boutonFermer = document.getElementById("fermer");
        
        boutonFermer.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home/resource_humaine";
        });
    </script>

       <!-- script pour le boutton retour  -->
         <script>
        const bouton = document.getElementById("retour");
       

        bouton.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home/resource_humaine";
        });
    </script>



  






























<?php
$content = ob_get_clean();
include 'layout.php';
?>