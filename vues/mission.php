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
    <title>Mission</title>
</head>

<body>
    <div class="container-fluid conteneur conteneur0  border border-primary border-4" style='width:75%'>

        <div class="row bg-primary border-1 ">
            <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h6 class="fiche_sala" style='color:white;'>Fiche Mission</h6>

                </div>

                <div>
                    <button class="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7 p-2" style='background-color: #f4f6f6  ;'>

                <div class="d-flex justify-content-between  mb-3">
                    <div class="zone1" style='width:15%'>
                        <img src="<?= SITE_URL ?>/assets/image/merveille.png" alt="" style='width: 100%'>
                    </div>
                    <div class="zone2  text-center" style='width:70%'>
                        <h2 class='text-mission mt-3' style='font-weight:bold; color: #2c3e50; '>NOUVELLE MISSION</h2>
                    </div>
                    <div class="zone3">
                        <img src="<?= SITE_URL ?>/assets/img/avatar.png" alt="" style='width: 100px;height: 100px;' class='border border-secondary border-1'>
                        <!-- <button type="button" class="bout" display='none'><i class="fas fa-search"></i></button> -->
                        <select id='personne' class="form-select-sm" style='width:67%'>
                            <option></option>
                            <option>jordan</option>
                            <option>ulrich</option>
                            <option>gildas</option>
                            <option>etoo</option>

                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                    <div style="display: flex;justify-content: space-between;align-items: center;width: 96%;">

                        <label for="destination" class="form-label">
                            Destination
                        </label>

                        <div style="display: flex; justify-content: left;width: 51%; ">
                            <select class="form-select-sm" style='width:100%' id='destination'>
                                <option></option>
                                <option>DOUALA</option>
                                <option>YAOUNDE</option>
                                <option>KRIBI</option>
                                <option>LIMBE</option>
                                <option>FDFS</option>
                            </select>
                        </div>
                    </div>
                    <div style="width: 39%;display: flex;justify-content: space-between;">
                        <label for="via" class="form-label " style='margin-left: 16%;'>Via</label>
                        <select class="form-select-sm" id='via'>
                            <option></option>
                            <option>EDEA</option>
                            <option>BONABERIE</option>
                            <option>FDSFDS</option>

                        </select>
                    </div>
                </div>
                <!-- fin premiere ligne -->
                <div style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                    <div style="display: flex; justify-content:space-between; align-items: center;  width: 96%; ">

                        <label for="deplacement" class="form-label">Mode de déplacement </label>

                        <span style='display: flex; justify-content: flex-end;'>
                            <select class="form-select-sm" style='width:72%' id='deplacement'>
                                <option></option>
                                <option>FDSFDS</option>
                                <option>CAMION</option>
                                <option>VEHICULE PERSONNEL</option>

                            </select>
                            <button type="button" class="bout1"><i class="fas fa-search"></i></button>
                        </span>

                    </div>

                    <div style="width: 48% ; display: flex;  ">
                        <label for="immatriculation" class="form-label mx-1 " id='text-reduire'>Immatriculation</label>
                        <select class="form-select-sm" style='width:75%' id='immatriculation'>
                            <option></option>
                            <option>LT 893BG</option>
                            <option>LT 126 IA</option>
                            <option>LT 278 EN</option>

                        </select>
                    </div>
                </div>
                <!-- 2eme ligne -->
                <div class='mt-3'>

                    <div>
                        <label for="cadre" class="form-label" style='width:34%;'>Cadre/Objectif de la Mission </label>
                        <select class="form-select-sm" style='width:36%;margin-left:1px;' id='cadre'>
                            <option></option>
                            <option>FDSFDS</option>
                            <option>INTEGRATION IPLANS</option>
                            <option>LIVRAISON MARCHANDISE</option>

                        </select>

                    </div>
                </div>
                <div class='mt-3' style=" display: flex;  width:100% ">
                    <div style=" display: flex; width:35% ">
                        <label for="cadre" class="form-label">Site/Tiers </label>
                    </div>
                    <div>
                        <select class="form-select-sm" style="display: flex; width:180% " id='site'>
                            <option></option>
                            <option>CANALSAT</option>
                            <option>DEPOT DOUALA</option>
                            <option>DEPOT YAOUNDE</option>
                            <option>FDSFDSFDSFDS</option>

                        </select>

                    </div>
                </div>

                <!-- fin 3eme ligne -->
                <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 61%; ">
                        <label for="deplacement" class="form-label">Date de départ </label>
                        <input type="date" class="form-control-sm" id="dateDebut" onchange="calculerJours()">

                    </div>
                    <div style="display: flex; justify-content: right;width: 42%; gap: 7px;">
                        <label for="immatriculation" class="form-label">Nombre de jour(s)</label>

                        <input type="number" class="form-control-sm" id="joursEcart" placeholder="0" oninput="modifierDateFin(); calculerJours()" style='width:23%;'>


                    </div>
                </div>

                <!-- fin 3eme ligne -->
                <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 61%; ">
                        <label for="deplacement" class="form-label">Date de rétour</label>
                        <input type="date" class="form-control-sm" id="dateFin" onchange="calculerJours()">

                    </div>
                    <div style="display: flex; justify-content: right;width: 42%; gap: 7px;">
                        <label for="immatriculation" class="form-label">No BL/LTA</label>
                        <select class="form-select-sm" id='numere_ima'>
                            <option></option>
                            <option>LT 893BG</option>
                            <option>LT 126 IA</option>
                            <option>LT 278 EN</option>

                        </select>
                    </div>
                </div>


                <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                    <label for="cadre" class="form-label" style="display: flex; justify-content: space-between; align-items: center; width: 35%; ">Nature du chargement </label>
                    <select class="form-select-sm" style='width:65%'>
                        <option value=""></option>
                    </select>

                </div>
                <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                    <label for="cadre" class="form-label" style="display: flex; justify-content: space-between; align-items: center; width: 35%; ">Prise en charge</label>
                    <select class="form-select-sm" style='width:65%' id='prise'>
                        <option selected>SURÉE PAR LA SOCIÉTÉ DEMO SUIVANT LE BARÈME EN VIGUEUR.</option>
                    </select>

                </div>
                <div class='mt-3' style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                    <div style="display: flex; justify-content: space-between; align-items: center; width: 52%; ">
                        <label for="">Durée travail par jour</label>
                        <input type="time" name="heuredebut" class='form-control' id="heurededebut" value="<?= date('H:i:s') ?>" style='width:33%'>
                    </div>

                    <div style="display: flex; justify-content: right;width: 48%; ">
                        <div class="form-check mt-2" style='width:58%;'>
                            <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
                            <label class="form-check-label " id='text-reduire' for="check1">Bloquer le pointage?</label>
                        </div>
                        <label for="immatriculation" class="form-label  mt-3 " id='text-reduire' style='width:25%;'>No Dossier</label>
                        <input type="text" class="form-control" style='width:15%'>
                    </div>

                </div>
                <div class="custom-form mt-4 ">
                    <!-- ceci ne concerne que text divider -->
                    <div class="text-divider-container">
                        <div class="text-divider">
                            <span>Pièce jointe</span>
                        </div>
                    </div>
                    <!-- le tableau a lintereieur -->
                    <div class="option-boutton d-flex justify-content-end ">


                        <div class="tooltip47" onclick="showTooltip()">
                            <button>
                                <img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: max-content; height: 20px;">
                                <span class="tooltiptext1">Charger une pièce jointe</span>
                            </button>

                        </div>


                        <div class="tooltip47" onclick="showTooltip()">
                            <button>
                                <img src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width: max-content; height: 20px;">
                                <span class="tooltiptext47">Verrouiller</span>
                            </button>

                        </div>
                        <div class="tooltip47" onclick="showTooltip()">
                            <button>
                                <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                                <span class="tooltiptext1">Supprimer pièce jointe</span>
                            </button>

                        </div>

                    </div>
                    <div class="table-container">

                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-dark">
                                    <th width=2% class="text-center">T</th>
                                    <th text-center class="text-center">pièce jointe </th>
                                    <th width=20% class="text-center">Taille</th>
                                </tr>
                            </thead>
                            <tbody>

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




            </div> <!--  div fermante de la col -->






            <!-- debut de la partie gauche -->
            <div class="col-sm-5 text-dark" style='background-color:  #f4f6f6  ;'>

                <div class="option-boutton d-flex justify-content-end "> <!-- boutton gauche -->

                    <!-- <button>
                          <img  src="<?= SITE_URL ?>/assets/img/padlock.png" alt="" style="width: max-content; height: 20px;">
                          <span class="tooltiptext">Mon Tooltip personnalisé</span>
                       </button> -->
                    <div class="tooltip47 my-2">
                        <button>
                            <img src="<?= SITE_URL ?>/assets/img/padlock.png" alt="" style="width: max-content; height: 20px;">
                            <span class="tooltiptext47">Verrouiller</span>
                        </button>

                    </div>


                </div>
                <div class="custom-form" style='width:100%;height:93%;'>
                    <!-- ceci ne concerne que text divider -->
                    <div class="text-divider-container2">
                        <div class="text-divider2">
                            <span>Rapport de mission</span>
                        </div>

                    </div>

                    <div class="commentaire mt-1">
                        <textarea class="form-control no-focus-outline zone-commentaire mt-3" placeholder="Merci d'ecrire votre rapport de mission ci..." rows="28" id="comment" name="text"></textarea>
                    </div>
                </div>


            </div><!--  fin de la partie ou div droite -->
        </div>

        <div class="row d-flex justify-content-between bg-primary bout-bas p-2 ">
            <div style='width:10%;'>

                <button>Valider<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
            </div>

            <!--  c2eme -->

            <div style='width:57%;'>
                <button>Supprimer
                    <img src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button>Imprimer
                    <img src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button id='fees' onclick="transfererDonnees()">Frais
                    <img src="<?= SITE_URL ?>/assets/img/argent.png" alt="" style="width: max-content; height: 20px;">
                </button>
            </div>
            <!--  css du haut  -->
            <div style='width:15%;'>
                <button id="fermer" class='ferme'>
                    Fermer
                    <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                </button>



            </div>
            <!--  css du haut  -->
        </div>

    </div>

    <!--  css du haut  -->
    <style>
        .no-focus-outline:focus {
            outline: none;
            /* Supprime la bordure de focus */
        }

        .bout {
            position: absolute;
            z-index: 10;
            left: 0;
            top: 60px;
            margin: 5px;
        }

        .zone3 {
            position: relative;
        }

        /* Style pour le formulaire */
        .custom-form {
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 175px;
            position: relative;
        }

        /* Styles CSS personnalisés pour le séparateur de texte */
        .text-divider-container {
            position: absolute;
            top: 0%;
            left: 10%;
            transform: translate(-50%, -50%);
            background-color: #f4f6f6;
            padding: 0 10px;
            font-size: 16px;
        }


        .text-divider {

            padding: 5px 0;
            text-align: center;
        }

        /* les 3 bouttons qui sont au bout pour manipuler */
        .option-boutton button {
            border: 1px solid gray;
            padding: 4px;
        }

        < !-- le tableau -->.table-container {
            width: 700px;
            max-height: 300px;
            /* Hauteur maximale du conteneur avec défilement */
            overflow-y: auto;
            /* Ajoute une barre de défilement vertical si nécessaire */
        }

        /* le css de la div 2 */

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

        .commantaire {
            border: 1px solid #d6dbdf;

        }

        .zone-commantaire {
            border: 1px solid #d6dbdf;
            padding: 2px;
            background-color: # #ebedef;

        }

        /* footer de la page zonde des botton */
        .bout-bas button {
            width: 120px;
            height: 45px;
            border-radius: 5px;
        }

        /* header de la page         */
        .ico_emplye {
            height: 20px;
            margin-right: 5px;
        }

        /* css du tooltip sur les bouttons acteur vs chefban */

        .tooltip47 {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip47 .tooltiptext47 {
            visibility: hidden;
            width: 90px;
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

        /* fin tooltip */
        #text-reduire {
            font-size: 13px;
        }

        /* .row{
            background-color:#1f34f1;
        } */
        .text-mission {
            font-size: 34px;
            color: #f8f9f9;
            /* text-shadow: 4px 0px 0px rgba(206,202,202,0.79); */
        }

        textarea {
            background-color: #d6dbdf;
            padding: 10px;
            border-radius: 5px;
        }

        .commentaire {
            background-color: #ebedef;
            border-radius: 7px;
        }

        body {
            background-color: #f4f6f6;
            /* Remplacez cette couleur par celle que vous souhaitez utiliser */
        }
    </style>




    <!-- les script de la page -->

    <script>
        const ferme = document.querySelector(".close_window");
        const conteneur = document.querySelector(".conteneur0");

        ferme.addEventListener("click", (e) => {
            e.preventDefault()
            conteneur.style.display = "none";

        });
    </script>
    <script>
        const boutonFermer = document.getElementById("fermer");
        const conteneur0 = document.querySelector(".conteneur0");

        boutonFermer.addEventListener("click", (e) => {
            e.preventDefault();
            conteneur0.style.display = "none";
        });
    </script>




    <script>
        // Fonction pour calculer le nombre de jours d'écart entre deux dates
        function calculerJours() {
            const dateDebut = new Date(document.getElementById("dateDebut").value);
            const dateFin = new Date(document.getElementById("dateFin").value);

            if (!isNaN(dateDebut) && !isNaN(dateFin)) {
                const difference = Math.ceil((dateFin - dateDebut) / (1000 * 60 * 60 * 24));
                document.getElementById("joursEcart").value = difference;
            }
        }

        // Fonction pour modifier la date de fin en fonction du nombre de jours d'écart
        function modifierDateFin() {
            const dateDebut = new Date(document.getElementById("dateDebut").value);
            const joursEcart = parseInt(document.getElementById("joursEcart").value) || 0;
            const dateFin = new Date(dateDebut);
            dateFin.setDate(dateDebut.getDate() + joursEcart);
            document.getElementById("dateFin").valueAsDate = dateFin;
        }
    </script>


    <!-- evenements sur frais  -->


    <!-- evement sur les bouttons  -->

    <script>
        // document.getElementById("fees").addEventListener("click", function() {
        //  Récupérer la valeur des champs

        //  var heurededebut = document.getElementById("heurededebut").value;
        // var personne = document.getElementById("personne").value;

        //  var dateFin = document.getElementById("dateFin").value;
        //  var dateDebut = document.getElementById("dateDebut").value;
        //  var numere_ima = document.getElementById("numere_ima").value;

        //  var via = document.getElementById("via").value;


        // if (  personne.trim() !== '' ) {

        // Spécifiez l'URL de la nouvelle page que vous souhaitez ouvrir
        // var nouvellePageURL = "http://localhost/Iplans/details_mission";

        // Ouvrir la nouvelle page dans une nouvelle fenêtre
        // window.open(nouvellePageURL, "_blank");



        // function transfererDonnees() {
        // Récupérer les données du formulaire
        // var joursEcart = document.getElementById('joursEcart').value;


        // Stocker les données dans le stockage local
        // localStorage.setItem('joursEcart', joursEcart);


        // Rediriger vers la deuxième page
        // window.location.href = 'http://localhost/Iplans/details_mission';
        // }else{
        // swal({
        // icon: 'warning',
        //text: 'Désolé! Le mot de passe ou le login est incorrects',
        //  });
        // }



        //  }
        //  });
    </script>

    <!-- fonction de tranfert de donnees  -->
    <script>
        function transfererDonnees() {

            document.getElementById("fees").addEventListener("click", function() {
                var personne = document.getElementById("personne").value;
                var joursEcart = document.getElementById("joursEcart").value;

                if (personne.trim() !== '' && joursEcart.trim() !== '') {

                    localStorage.setItem('joursEcart', joursEcart);
                    window.location.href = 'http://localhost/Iplans/details_mission';
                } else {

                    swal({
                        icon: 'error',
                        text: 'Veuillez remplir tous les champs svp !!!',
                    });


                }

            })



        }
    </script>







</body>

</html>



<?php

$content = ob_get_clean();
include 'layout.php';
?>