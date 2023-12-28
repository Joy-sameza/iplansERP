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
      
     <div class="container-fluid mb-5">
               <div class="row">
                  <div class="col-sm-12   d-flex justify-content-center align-items-left">
                    <h1 class='text-uppercase mt-4'><b>Gestion administrative</b></h1>
                  </div>
              
               </div>

        </div>
    <div class="container">
       
         <div class="row text-center">

          <div class="col gauche ml-2">

               <div class="custom-form mt-0 " style='height: 350px;'>
                        <!-- ceci ne concerne que text divider -->
                        <div class="text-divider-container">
                            <div class="text-divider">
                                <span>Pièce jointe</span>
                            </div>
                        </div>
                        <!-- le tableau a lintereieur -->
                        <div class="option-boutton d-flex justify-content-end ">
                            <div class="tooltip47">
                                <input type="file" id="fileInput" style="display: none;">
                                <button id="piece_add">
                                    
                                    <img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: max-content; height: 20px;">
                                    <span class="tooltiptext1">Charger une pièce jointe</span>
                                </button>
                            </div>
                            <div class="tooltip47">
                                <button id="piece_remove">
                                    <img src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width: max-content; height: 20px;">
                                    <span class="tooltiptext47">Supprimer pièce jointe</span>
                                </button>
                            </div>
                            <div class="tooltip47">
                                <button id="remove_all">
                                    <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                                    <span class="tooltiptext1">Supprimer tous</span>

                                </button>
                            </div>
                        </div>
                        <div class="table-container debut_tableau" style='height: 350px;'>
                            <style>
                                   .custom-form {
                                    border: 1px solid #ccc;
                                    border-radius: 10px;
                                    height: 175px;
                                    position: relative;
                                }
                                .option-boutton button {
                                    border: 1px solid gray;
                                    padding: 4px;
                                }
                                
                                .text-divider-container2 {
                                    position: absolute;
                                    top: 0%;
                                    left: 25%;
                                    transform: translate(-50%, -50%);
                                    background-color: #f4f6f6;
                                    padding: 0 10px;
                                    font-size: 16px;
                                    z-index: 20;
                                }
                                .tooltip47 {
                                    position: relative;
                                    display: inline-block;
                                    cursor: pointer;
                                }

                                .tooltip47 .tooltiptext47 {
                                    visibility: hidden;
                                    width: 140px;
                                    background-color: #f0f004;
                                    color: #080808;
                                    text-align: center;
                                    border-radius: 6px;
                                    padding: 5px;
                                    position: absolute;
                                    z-index: 10;
                                    top: 125%;
                                    left: 50%;
                                    margin-left: -60px;
                                    opacity: 0;
                                    transition: opacity 0.3s;
                                    font-size: 14px;
                                }

                                .tooltip47 .tooltiptext1 {
                                    visibility: hidden;
                                    width: 180px;
                                    background-color: #f0f004;
                                    color: #080808;
                                    text-align: center;
                                    border-radius: 6px;
                                    padding: 5px;
                                    position: absolute;
                                    z-index: 10;
                                    top: 125%;
                                    left: 50%;
                                    margin-left: -60px;
                                    opacity: 0;
                                    transition: opacity 0.3s;
                                    font-size: 14px;
                                }

                                .tooltip47:hover .tooltiptext47 {
                                    visibility: visible;
                                    opacity: 1;
                                }

                                .tooltip47:hover .tooltiptext1 {
                                    visibility: visible;
                                    opacity: 1;
                                }
                                 .text-divider-container {
                                        position: absolute;
                                        top: 0%;
                                        left: 10%;
                                        transform: translate(-50%, -50%);
                                        background-color: #fff;
                                        padding: 0 10px;
                                        font-size: 16px;
                                    }


                                    .text-divider {

                                        padding: 5px 0;
                                        text-align: center;
                                    }
                                  .debut_tableau {

                            border-bottom: none;
                            overflow-x: auto;


                            &::-webkit-scrollbar {
                                height: 15px;
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
                            </style>
                            <table class="table table-bordered">
                                <a title="pièces jointes" >
                                    
                                    
                                </a>
                                <thead>
                                    <tr class="table-dark">
                                        <th width=2% class="text-center">Type</th>
                                        <th text-center class="text-center">Pièce jointe </th>
                                        <th width=20% class="text-center">Taille</th>
                                    </tr>
                                </thead>
                                <tbody id="tableau">
                                    <tr class="table-primary custom-row">
                                        <td style='background-color:#0D6EFD;'>
                                            <p></p>
                                        </td>
                                        <td style='background-color:#0D6EFD;'>
                                            <p></p>
                                        </td>
                                        <td style='background-color:#0D6EFD;'>
                                            <p></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!--  fin de la partie gauche -->


          </div>


          <div class="col droite">
                <div class="  d-flex justify-content-center align-items-center   text-white">
                    
                         <button type="button" class="func" id="rhumain" onclick="redirectToRH()">
            
                        <img src="<?= SITE_URL ?>/assets/img/human.png" alt="" style="width: 40px; height: 40px; margin-right:7px">GRH
                
                </button>
                </div>
                <div class="  d-flex justify-content-center align-items-center  my-3  text-white">

              
             <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/conversation.png" alt=""
                                style="width: 40px; height: 40px; margin-right:7px">GED
                        </button>

                </div>
                <div class="  d-flex justify-content-center align-items-center     text-white">
                
                
                        <button type="button" class="func">
                            <img src="<?= SITE_URL ?>/assets/img/video.png" alt=""
                                style="width: 40px; height: 40px; margin-right:7px">Médiathèque
                        </button>

                </div>
            </div>
          
        </div>




       

        
      
       
    </div>
       <div class="container-fluid">
               <div class="row">
                  
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
            width: 25rem !important;
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




   <!-- script pour le boutton retour  -->
     <script>
        const bouton = document.getElementById("retour");
       

        bouton.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home";
        });
    </script>

     <script>
    $(document).ready(function () {
      $("#piece_add").click(function () {
        $("#fileInput").click();
      });

      $("#fileInput").change(function (event) {
        var files = event.target.files;

        if (files.length > 0) {
          var pieceJointe = {
            type: "Fichier",
            nom: files[0].name,
            taille: formatSize(files[0].size)
          };

          // Ajout de la pièce jointe au tableau avec animation
          var newRow = $("<tr class='table-primary custom-row'>"
            + "<td>" + pieceJointe.type + "</td>"
            + "<td><a href='#' onclick='telechargerPieceJointe(\"" + pieceJointe.nom + "\")'>" + pieceJointe.nom + "</a></td>"
            + "<td>" + pieceJointe.taille + "</td>"
            + "</tr>").hide().fadeIn();

          $("#tableau").append(newRow);

          // Effacer la valeur du champ de fichier pour permettre le téléchargement du même fichier plusieurs fois
          $("#fileInput").val("");
        }
      });

      $("#piece_remove").click(function () {
        $("#tableau tr:last").fadeOut("slow", function () {
          $(this).remove();
        });
      });

      $("#remove_all").click(function () {
        $("#tableau tr").fadeOut("slow", function () {
          $(this).remove();
        });
      });

      // Fonction pour formater la taille du fichier
      function formatSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Byte';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
      }

      // Fonction pour télécharger la pièce jointe
     // Fonction pour télécharger la pièce jointe
    window.telechargerPieceJointe = function (nomPieceJointe) {
    var chemin = SITE_URL + '/chemin/vers/votre/dossier/' + nomPieceJointe;

    // Créer un lien de téléchargement et déclencher le téléchargement
    var link = document.createElement('a');
    link.href = chemin;
    link.download = nomPieceJointe;
    link.target = '_blank';

    // Ajouter le lien à la page et déclencher le téléchargement
    document.body.appendChild(link);
    link.click();

    // Retirer le lien de la page
    document.body.removeChild(link);
};

    });
  </script>
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
        function redirectToCP() {
       
            window.location.href = '<?= SITE_URL ?>/home/com_pro';
        }
        function redirectToGA() {
       
            window.location.href = '<?= SITE_URL ?>/home/gestion_administrative';
        }
    </script>



<?php
$content = ob_get_clean();
include 'layout.php';
?>