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
    <div class="container-fluid conteneur my-5 conteneur0  border border-primary border-4" style='width:75%'>

        <form id="main_form" enctype="multipart/form-data" method="post" class="was-validated">
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
                            <!-- <img src="<?= SITE_URL ?>/assets/image/merveille.png" alt="" style='width: 100%'> -->
                            <h1 style='font-size:70px;color: #d7c80c ;text-shadow: 4px 4px 2px rgba(0,0,0,0.6);'>RH</h1>
                        </div>
                        <div class="zone2  text-center" style='width:70%'>
                            <h2 class='text-mission mt-3' style='font-weight:bold; color: #2c3e50; '>NOUVELLE MISSION</h2>
                        </div>
                        <div class="zone3" style="display: flex; justify-content: center; align-items:center; flex-direction: column;width: 25%;">
                            <img src="<?= SITE_URL ?>/assets/img/avatar.png" alt="" style='width: 100px;height: 100px;' class='border border-secondary border-1'>
                            <!-- <button type="button" class="bout" display='none'><i class="fas fa-search"></i></button> -->
                            <select id='personne' name="personne" required aria-required="true" class="form-select-sm" style='width:80%' required>
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                        <div style="display: flex;justify-content: space-between;align-items: center;width: 96%;">
                            <label for="destination" class="form-label">
                                Destination
                            </label>
                            <div style="display: flex; justify-content: left;width: 51%; ">
                                <select class="form-control-sm" style='width:100%' id="destination" name="destination" required>
                                    
                                    <option value=""></option>
                                    <option value="DOUALA">DOUALA</option>
                                    <option value="YAOUNDE">YAOUNDE</option>
                                    <option value="KRIBI">KRIBI</option>
                                    <option value="LIMBE">LIMBE</option>
                                    <option value="FDFS">FDFS</option>
                                </select>
                            </div>
                        </div>
                        <div style="width: 39%;display: flex;justify-content: space-between;">
                            <label for="via" class="form-label " style='margin-left: 16%;'>Via</label>
                            <select class="form-select-sm" id='via' name="via" required>
                                <option value=""></option>
                                <option value="EDEA">EDEA</option>
                                <option value="BONABERIE">BONABERIE</option>
                                <option value="FDSFDS">FDSFDS</option>
                            </select>
                        </div>
                    </div>
                    <!-- fin premiere ligne -->
                    <div style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                        <div style="display: flex; justify-content:space-between; align-items: center;  width: 96%; ">
                            <label for="deplacement" class="form-label">Mode de déplacement </label>
                            <span style='display: flex; justify-content: flex-end;'>
                                <select class="form-select-sm" style='width:72%' name="deplacement" id='deplacement'required>
                                    <option value=""></option>
                                    <option value="FDSFDS">FDSFDS</option>
                                    <option value="CAMION">CAMION</option>
                                    <option value="VEHICULE PERSONNEL">VEHICULE PERSONNEL</option>
                                </select>
                                <button type="button" class="bout1"><i class="fas fa-search"></i></button>
                            </span>
                        </div>
                        <div style="width: 48% ; display: flex;  ">
                            <label for="immatriculation" class="form-label mx-1 " id='text-reduire'>Immatriculation</label>
                            <select class="form-select-sm" style='width:75%' name="immatriculation" id='immatriculation'required>
                                <option value=""></option>
                                <option value="LT 893BG">LT 893BG</option>
                                <option value="LT 126 IA">LT 126 IA</option>
                                <option value="LT 278 EN">LT 278 EN</option>
                            </select>
                            
                        </div>
                    </div>
                    <!-- 2eme ligne -->
                    <div class='mt-3'>
                        <div>
                            <label for="cadre" class="form-label" style='width:34%;'>Cadre/Objectif de la Mission </label>
                            <select class="form-select-sm" style='width:36%;margin-left:1px;' name="cadre" id='cadre' required aria-required="true"required>
                                <option value=""></option>
                                <option value="FDSFDS">FDSFDS</option>
                                <option value="INTEGRATION IPLANS">INTEGRATION IPLANS</option>
                                <option value="LIVRAISON MARCHANDISE">LIVRAISON MARCHANDISE</option>
                            </select>
                            
                        </div>
                         <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class='mt-3' style=" display: flex;  width:100% ">
                        <div style=" display: flex; width:35% ">
                            <label for="cadre" class="form-label">Site/Tiers </label>
                        </div>
                        <div>
                            <select class="form-select-sm" style="display: flex; width:180% " name="site" id='site' required>
                                <option value=""></option>
                                <option value="CANALSAT">CANALSAT</option>
                                <option value="DEPOT DOUALA">DEPOT DOUALA</option>
                                <option value="DEPOT YAOUNDE">DEPOT YAOUNDE</option>
                                <option value="FDSFDSFDSFDS">FDSFDSFDSFDS</option>
                            </select>
                             <div class="valid-feedback">Valid.</div>
                                 <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <!-- fin 3eme ligne -->
                    <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; justify-content: space-between; align-items: center; width: 61%; ">
                            <label for="deplacement" class="form-label">Date de départ </label>
                            <input type="date" class="form-control-sm" id="dateDebut" value="" name="dateDebut" onchange="calculerJours()">
                        </div>
                        <div style="display: flex; justify-content: right;width: 42%; gap: 7px;">
                            <label for="immatriculation" class="form-label">Nombre de jour(s)</label>
                            <input type="number" min="0" class="form-control-sm" name="joursEcart" id="joursEcart" placeholder="0" oninput="modifierDateFin(); calculerJours()" style='width:23%;'>
                        </div>
                    </div>
                    <!-- fin 3eme ligne -->
                    <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                        <div style="display: flex; justify-content: space-between; align-items: center; width: 61%; ">
                            <label for="deplacement" class="form-label">Date de rétour</label>
                            <input type="date" class="form-control-sm" id="dateFin" value="" name="dateFin" onchange="calculerJours()">
                        </div>
                        <div style="display: flex; justify-content: right;width: 42%; gap: 7px;">
                            <label for="immatriculation" class="form-label">No BL/LTA</label>
                            <select class="form-select-sm" id='numere_ima' name="nobl_lta">
                                <option></option>
                                <option>LT 893BG</option>
                                <option>LT 126 IA</option>
                                <option>LT 278 EN</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                        <label for="nature" class="form-label" style="display: flex; justify-content: space-between; align-items: center; width: 35%; ">Nature du chargement </label>
                        <select class="form-select-sm" style='width:65%' name="nature" id='nature'>
                            <option value=""></option>
                        </select>
                    </div>
                    <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                        <label for="prise" class="form-label" style="display: flex; justify-content: space-between; align-items: center; width: 35%; ">Prise en charge</label>
                        <select class="form-select-sm" style='width:65%' name="prise" id='prise'>
                            <option selected>SURÉE PAR LA SOCIÉTÉ DEMO SUIVANT LE BARÈME EN VIGUEUR.</option>
                             
                        </select>
                        
                           
                    </div>
                    
                    <div class='mt-3' style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                        <div style="display: flex; justify-content: space-between; align-items: center; width:81%; ">
                            <label for="heuredebut">Durée travail par jour</label>
                            <input type="time" name="heuredebut" class='form-control' name="heurededebut" id="heurededebut" value="" style='width:39%'>
                        </div>
                        <div style="display: flex; justify-content: right;width: 63%; ">
                            <div class="form-check mt-2" style='width:43%;'>
                                <input type="checkbox" class="form-check-input" name="check1" id="check1" name="option1" value="something" checked>
                                <label class="form-check-label " id='text-reduire' for="check1">Bloquer le <br>pointage?</label>
                            </div>
                            <label for="immatriculation" class="form-label  mt-3 " id='text-reduire' style='width:29%;'>No Dossier</label>
                            <input type="text" class="form-control" style='width:35%' id='num_do'>
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
                        <div class="table-container debut_tableau" style='height: 150px;'>
                            <style>
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
                            <textarea class="form-control no-focus-outline zone-commentaire mt-3" name="comment" placeholder="Merci d'ecrire votre rapport de mission ci..." rows="30" style="resize: none;" id="comment" name="text" ></textarea>
                        </div>
                    </div>
                </div><!--  fin de la partie ou div droite -->
            </div>
            <div class="row d-flex justify-content-between bg-primary bout-bas p-2 ">
                <div style='width:10%;'>
                    <button type="submit" id='valider' onclick="saveDonnees()" name="iplans_submit">Valider<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>
                <!--  c2eme -->
                <div style='width:57%;'>
                    <button>Supprimer
                        <img src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
                    </button>
                    <button id="printData">Imprimer
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
        </form>

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

        /*< !-- le tableau -->*/
        .table-container {
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
            background-color: #ebedef;

        }

        /* footer de la page zonde des botton */
        .bout-bas button {
            width: 120px;
            height: 45px;
            border-radius: 5px;
        }

        /* header de la page */
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




    <!-- les script de la page -->

    <script>
        const ferme = document.querySelector(".close_window");
        const conteneur = document.querySelector(".conteneur0");

        ferme.addEventListener("click", (e) => {
            e.preventDefault()
            // conteneur.style.display = "none";
            window.location.href = "<?= SITE_URL ?>/list_mission";

        });
    </script>
    <script>
        const boutonFermer = document.getElementById("fermer");
        const conteneur0 = document.querySelector(".conteneur0");

        boutonFermer.addEventListener("click", (e) => {
            e.preventDefault();
            window.location.href = "<?= SITE_URL ?>/list_mission";
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

    <!-- fonction de tranfert de donnees  -->
    <script>
        function transfererDonnees() {

            document.getElementById("fees").addEventListener("click", function() {
                var personne = document.getElementById("personne").value;
                var destination = document.getElementById("destination").value;
                var joursEcart = document.getElementById("joursEcart").value;
                var via = document.getElementById("via").value;
                var heurededebut = document.getElementById("heurededebut").value;

                if (personne.trim() !== '' && joursEcart.trim() !== '' && destination.trim() !== '' && via.trim() !== '') {
                    //envoie des donnes au 

                    localStorage.setItem('joursEcart', joursEcart);
                    localStorage.setItem('destination', destination);
                    localStorage.setItem('via', via);
                    localStorage.setItem('heurededebut', heurededebut);
                    window.open("<?= SITE_URL ?>/details_mission");
                    // window.location.href = "<?= SITE_URL ?>/details_mission";
                } else {

                    swal({
                        icon: 'error',
                        text: 'Veuillez remplir tous les champs svp !!!',
                    });


                }

            })
        }
    </script>
    <script>
        function saveDonnees() {

            document.getElementById("valider").addEventListener("click", function() {
                var personne = document.getElementById("personne").value;
                var joursEcart = document.getElementById("joursEcart").value;
                
                var destination = document.getElementById("destination").value;
                var joursEcart = document.getElementById("joursEcart").value;
                var via = document.getElementById("via").value;

                if (personne.trim() !== '' && joursEcart.trim() !== '' && destination.trim() !== '' && via.trim() !== '') {

                    //code ici pour enregistrer dans la BD
                    window.open("<?= SITE_URL ?>/list_mission");
                    // window.location.href = "<?= SITE_URL ?>/details_mission";
                } else {

                    swal({
                        icon: 'error',
                        text: 'Veuillez remplir tous les champs svp !!!',
                    });


                }

            })
        }
    </script>

    <script type="module">
        const personne_employee = document.getElementById('personne');
        try {
            const response = await fetch(api_url_pers);
            const data = await response.json();
            for (const pers of data) {
                const option = document.createElement('option');
                option.value = pers.NEng;
                option.text = pers.nom + ' ' + pers.prenom;
                personne_employee.appendChild(option);
            }
        } catch (error) {
            // return;
            console.error(error);
        }
    </script>

    <script>
        // Submit main form to the sever
        const form = document.querySelector("form");
        form.addEventListener("submit", async function(event) {
            event.preventDefault();
            const totalFees = JSON.parse(localStorage.getItem('totalFrais'));

            if (totalFees === null || isNaN(totalFees?.totalFrais)) {
                swal({
                    icon: 'error',
                    text: 'Frais non valide',
                });
                return;
            }
            const formData = new FormData(this);
            formData.append('totalFees', JSON.stringify(totalFees));
            formData.append('iplans_submit', '');

            // submit data using fetch
            const response = await fetch("<?= SITE_URL ?>/forms/form_mission.php", {
                method: 'POST',
                body: formData,
            });

            if (response.status === 200 || response.status === 201 || response.ok) {
                const data = await response.json();
                console.log(data);
                await swal({
                    icon: 'success',
                    text: 'Mission enregistreé avec succès!',
                });
                setTimeout(() => {}, 6000);
                window.location.href = '<?= SITE_URL ?>/list_mission';
            } else {
                swal({
                    icon: 'error',
                    text: 'Une erreur est survenue',
                });
            }
        });
    </script>
    <script>
        const btns = document.querySelectorAll('button:not([type="submit"])');
        for (const btn of btns) {
            btn.type = 'button';
        }
    </script>


   <!-- envoie des donnees du formulaire a la page frais mission  -->
<script>
  function sendData(){
        document.getElementById("main_form").addEventListener("submit", function (event) {
    // Empêcher le comportement par défaut du formulaire (envoi direct)
    event.preventDefault();

    // Récupérer les valeurs des champs du formulaire
    var joursEcart = document.getElementById("joursEcart").value;
    var heurededebut = document.getElementById("heurededebut").value;
    var destination = document.getElementById("destination").value;
    var via = document.getElementById("via").value;
    // Ajouter d'autres champs selon vos besoins

    // Créer un objet FormData pour faciliter l'envoi des données
    var formData = new FormData();
    formData.append("joursEcart", joursEcart);
    formData.append("destination", destination);
    formData.append("via", via);
    formData.append("heurededebut", heurededebut);
    
    // Ajouter d'autres champs selon vos besoins

    // Utiliser Fetch pour envoyer les données à la page souhaitée
    fetch("<?= SITE_URL ?>/details_mission", {
         
        method: "POST",
        body: formData
    })
    .then(response => response.json())  // Vous pouvez ajuster cela en fonction du format de réponse attendu
    .then(data => {
        // Gérer la réponse si nécessaire
        console.log(data);
    })
    .catch(error => {
        console.error("Erreur lors de l'envoi des données :", error);
    });
});
  }

   </script>

   <script>
    function executerDeuxFonctions() {
    transfererDonnees()
    sendData()
}
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

  <!-- code pour remplir le formulaire  -->

  <script>
     document.addEventListener('DOMContentLoaded', function() {
        // Récupérer les données du formulaire depuis sessionStorage
        var formData = JSON.parse(sessionStorage.getItem('formData_Mission'));
        console.log(formData)

        // Vérifier si les données existent
        if (formData) {
            // Récupérer le champ select
            const selectOptions = document.getElementById('destination');
            const dateInput = document.getElementById('dateDebut');
            //const joursEcart = document.getElementById('joursEcart');

            // Ajouter l'option au champ select
            const optionElement = document.createElement('option');
            optionElement.value = formData.destination;
            optionElement.textContent = formData.destination;
            optionElement.selected = true; // Sélectionner l'option par défaut
            selectOptions.appendChild(optionElement);

            // pour la date

            const dateValue = formData.depart;
            const dateParts = dateValue.split('/');
             const formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
            dateInput.value = formattedDate;

            // pour les jour decart

            document.getElementById("joursEcart").value = formData.duree;
            document.getElementById("heurededebut").value = formData.duree_de_travail;
            document.getElementById("num_do").value = formData.numerodossier;

            //champs select site
            const select = document.getElementById('site');
            const optionEle = document.createElement('option');
            optionEle.value = formData.site;
            optionEle.textContent = formData.site;
            optionEle.selected = true; 
            select.appendChild(optionEle);
            //champs select cadre
            const select_cadre = document.getElementById('cadre');
            const option_cadre = document.createElement('option');
            option_cadre.value = formData.cadre;
            option_cadre.textContent = formData.cadre;
            option_cadre.selected = true; 
            select_cadre.appendChild(option_cadre);
            //champs select numero BLT
            const select_numere_ima = document.getElementById('numere_ima');
            const option_numere_ima = document.createElement('option');
            option_numere_ima.value = formData.numerobl_lta;
            option_numere_ima.textContent = formData.numerobl_lta;
            option_numere_ima.selected = true; 
            select_numere_ima.appendChild(option_numere_ima);
            //champs select numero BLT
            const select_immatriculation = document.getElementById('immatriculation');
            const option_immatriculation = document.createElement('option');
            option_immatriculation.value = formData.immatriculation;
            option_immatriculation.textContent = formData.immatriculation;
            option_immatriculation.selected = true; 
            select_immatriculation.appendChild(option_immatriculation);
           
            

        }

        });
    </script>



   

</body>

</html>

<?php

$content = ob_get_clean();
include './vues/layout.php';
?>