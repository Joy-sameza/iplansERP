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
                display:none;
		}
	    .lang	img{
				height: 24px;
				width: 24px;
			}


	</style>

<main>
    <div class="container-fluid" style='position:relative;'>
     <button id="retour" class='ferme bout-bas' style='position:absolute;right: 60px;top:25px;'>
                        Retour
           <img src="<?= SITE_URL ?>/assets/img/previous.png" alt="" style="width: max-content; height: 20px;">
      </button>
     
</div>
    <div class="container   d-flex justify-content-center align-items-center">
                <h2 class='text-uppercase text-muted  mt-4'><b><ul id="displayData">accueil</ul></b></h2>
    </div>
    <div class="container">
       
         <div class="row text-center">
            <div class="col p-5 d-flex justify-content-center align-items-center   text-white">
                 
                     <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/message.png" alt=""
                                style="width: 40px; height: 40px; margin-right:7px">Messagerie
                     </button>
            </div>
            <div class="col p-5 d-flex justify-content-center align-items-center    text-white">


             
                <button type="button" class="func" data-courrier>
                    <img src="<?= SITE_URL ?>/assets/img/food.png" alt="" style="width: 40px; height: 40px; margin-right:7px">
                    Courrier&nbsp;E/S
                </button>
            </div>
            <div class="col p-5 d-flex justify-content-center align-items-center     text-white">
             
             
              
    <button type="button" class="func" data-hotel onclick="redirectToRA()">
                   
           <img src="<?= SITE_URL ?>/assets/img/receptionist.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Réception/Accueil
       
    </button>

            </div>
        </div>




        <div class="row text-center d-flex justify-content-center align-items-center">
            <div class="col p-5 text-center  d-flex justify-content-center align-items-center d-flex justify-content-center align-items-center     text-white">
                 <button type="button" class="func" id="rhumain" onclick="redirectToRH()">
                    
                            <img src="<?= SITE_URL ?>/assets/img/human.png" alt="" style="width: 40px; height: 40px; margin-right:7px">GRH
                   
                 </button>

                
            </div>
            <div class="col p-5 d-flex justify-content-center align-items-centertext-white">
                  <button type="button" class="func">
        <img src="<?= SITE_URL ?>/assets/img/video.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">Médiathèque
    </button>
            </div>
            <div class="col p-5 d-flex justify-content-center align-items-center text-white">
               
             <button type="button" class="func">
        <img src="<?= SITE_URL ?>/assets/img/conversation.png" alt=""
            style="width: 40px; height: 40px; margin-right:7px">GED
    </button>

            </div>
        </div>
      
       
    </div>



     <div class="container-fluid">
               <div class="row">
                  <div class="col-sm-12  p-2 d-flex justify-content-center align-items-left">
                    <button type="button" class="func" style='bottom: 1%;'>
                         <img src="<?= SITE_URL ?>/assets/img/setting.png" alt="" style="width: 40px; height: 40px; margin-right:7px">Paramètres
                    </button>
                  </div>
                  <div class="col-sm-12  d-flex justify-content-end align-items-center  text-white">
                    <img src="<?= SITE_URL ?>/assets/img/logo_minesec2.png" alt=""style="width: 170px; height: 170px; margin-right:0px">
                  </div>
               </div>

        </div>

  
</main>

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
            text-decoration:none;
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




   <!-- script pour le boutton retour  -->
     <script>
        const bouton = document.getElementById("retour");
       

        bouton.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home";
        });
    </script>
    
 <!-- gestion des clique sur les boutton -->

    <script>
        function redirectToRH() {
       
            window.location.href = '<?= SITE_URL ?>/home/resource_humaine';
        }
    </script>
    <script>
        function redirectToRA() {
       
            window.location.href = '<?= SITE_URL ?>/home/list-visit-rdv';
        }
    </script>
    <script>
        function redirectToACC() {
       
            window.location.href = '<?= SITE_URL ?>/home/acceuil';
        }
    </script>



<?php
$content = ob_get_clean();
include 'layout.php';
?>