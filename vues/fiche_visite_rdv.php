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




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Abscences</title>
</head>

<body>
    <div class="container-fluid conteneur0 my-5  border border-2 border-primary" style='width:75%;border-bottom:none;'>

        <div class="row bg-primary border-1  ">
            <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h6 class="fiche_sala" style='color:white;'>Fiche visites/Rendez-vous</h6>

                </div>
                 <div>
                    <button class="close_window" id='bout_rouge' style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                </div>

              
            </div>
        </div>
        <!-- fin du header  -->
<div>
         <div class='container-fluid ' style='background-color: #edf1f1;padding-top: 5px;position:relative'>
            
              <div style='width:100%; height: 91px;' class='p-2  border border-1 option_cont border-2 mt-3 border-secondary'>
                            <div class="text-divider-container2">
                                <div class="text-divider">
                                    <span>Details</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                                <label for="site" class="form-label">Site </label>
                                <select class="form-select-sm " style='width:80%' id="site">
                                    <option SELECTED>TOUS</option>
                                </select>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-1'>
                                <label for="departement" class="form-label">Tiers </label>
                                <select class="form-select-sm " style='width:80%;background:green' id="departement">
                                    <option SELECTED value="TOUS">TOUS</option>
                                    <option value="ADMINISTRATIF">ADMINISTRATIF</option>
                                    <option value="ADMINISTRATIION">ADMINISTRATION</option>
                                    <option value="APPLICATION">APPLICATION</option>
                                    <option value="COMMERCIAL">COMMERCIAL</option>
                                    <option value="ENTREPOT">ENTREPOT</option>
                                    <option value="TECHNIQUE">TECHNIQUE</option>
                                    <option value="PEDIATRIE">PEDIATRIE</option>
                                    <option value="CHAUFEUR">CHAUFEUR</option>
                                    <option value=" ">INCONNU</option>
                                </select>
                            </div>
                        </div>
        
        </div>
 </div>
        <!-- fin de la div qui suit  -->



        <!-- debut de la div tableau -->

      
        <!-- fin div tableau  -->
        <!-- la div du footer  -->



       <div class="row d-flex justify-content-between bg-primary bout-bas p-2 ">
                <div style='width:58%;'>
                    <button type="submit" id='valider'  name="iplans_submit">Valider
                        <img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
              
                </div>
               
                <!--  css du haut  -->
                <div style='width:13%;'>
                    <button id="fermer" class='ferme'>
                        Fermer
                        <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                    </button>
                </div>
                <!--  css du haut  -->
            </div>

        <!-- fin div footer  -->

    </div>
    <!-- fin de la grande div  -->




</body>
<!-- debut du css  -->
<style>
    /* css du header pour le futur */
    .ico_emplye {
        height: 20px;
        margin-right: 5px;
    }

    .englobe,
    .option_cont {
        background-color: #edf1f1;
    }

    .option_cont {
        border-radius: 6px;
        
    }

    /* Styles CSS personnalisés pour le séparateur de texte */
    .text-divider-container1 {
        position: absolute;
        top: 14%;
        left:23%;
        transform: translate(-50%, -50%);
        background-color: #edf1f1;
        padding: 0 7px;
        font-size: 14px;
    }
    .text-divider-container7 {
        position: absolute;
        top: 54%;
        left:18%;
        transform: translate(-50%, -50%);
        background-color: #edf1f1;
        padding: 0 7px;
        font-size: 14px;
    }

    .text-divider-container2 {
        position: absolute;
        top: 20%;
        left: 5%;
        transform: translate(-50%, -50%);
        background-color: #edf1f1;
        padding: 0 7px;
        font-size: 14px;
    }
    .text-divider-container6 {
        position: absolute;
        top: 10%;
        left: 20%;
        transform: translate(-50%, -50%);
        background-color: #edf1f1;
        padding: 0 7px;
        font-size: 14px;
    }

    .text-divider-container3 {
        position: absolute;
        top: 12%;
        left: 47%;
        transform: translate(-50%, -50%);
        background-color: #edf1f1;
        padding: 0 7px;
        font-size: 14px;
    }
    .text-divider-container5 {
        position: absolute;
        top: 12%;
        left: 35%;
        transform: translate(-50%, -50%);
        background-color: #edf1f1;
        padding: 0 7px;
        font-size: 14px;
    }


    .text-divider {

        padding: 0;
        text-align: center;
        font-weight: 600;
    }

    .boutton {
        border: 1px solid gray;
        position: absolute;
        top: 0%;
        left: 77%;
    }

    ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 5px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #0b9444;
        border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #238fce;
    }

    .bout-bas button {
        width: 125px;
        height: 45px;
        border-radius: 5px;
        font-size: 13px;
    }

    .bout-bas .taille_boutton {
        width: 100px;
        height: 45px;
        border-radius: 5px;
        font-size: 13px;
    }


    element.style {}

    .debut_tableau &:hover {}

    .debut_tableau {
        border-bottom: none;
        overflow-x: auto;
    }

    .w-100 {
        width: 100% !important;
    }

    .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .row>* {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .header {
        display: none;
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



<!-- evenement sur les bouttons  -->

   <script>
        const bouton = document.getElementById("fermer");
       

        bouton.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home";
        });
    </script>
   <script>
        const boutonRetour = document.getElementById("bout_rouge");
       

        boutonRetour.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home";
        });
    </script>




</html>

<?php

$content = ob_get_clean();
include 'layout.php';
?>