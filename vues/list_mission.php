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
    <title>List Mission</title>
</head>

<body>

    <div class="container-fluid conteneur0" style='width:80%; height: 75vh;'>
        <!-- debut du header -->
        <div class="row head bg-primary">
            <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h6 class="fiche_sala" style='color:white;'>Listes des Missions</h6>

                </div>

                <div>
                    <button class="close_window" id="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                </div>
            </div>
        </div>
        <!-- fin du haeder -->
        <!-- zone ou il ya le temps -->
        <div class="row" style='background-color: #ebedef '>
            <div style="display: flex; justify-content: space-between; align-items: center;">

                <div style="display: flex; justify-content: space-between; align-items: center; width:40%;">
                    <div style="display: flex; justify-content: space-between; align-items: center; width:53%">
                        <label for="deplacement" class="form-label"><strong>Période Du</strong> </label>
                        <input type="date" class="form-control-sm">

                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; width:42% ">
                        <label for="deplacement" class="form-label"><strong>Au</strong> </label>
                        <input type="date" class="form-control-sm">

                    </div>

                </div>

                <div class="tooltip47 my-2"">
                         <button  class='border border-secondary bg-secondary border-1'>
                            <img  src=" <?= SITE_URL ?>/assets/img/padlock.png" alt="" style="width: max-content; height: 20px;">
                    <span class="tooltiptext47">Verrouiller</span>
                    </button>

                </div>
            </div>



        </div>
        <!-- fin de la zone date -->
        <!-- debut de la zone de tableau -->
        <div class="row " style='border:1px solid gray; overflow: scroll scroll !important; height: clamp(400px, 90%, 65vh);'>
            <table class="table table-bordered " style="position: relative; text-align: center;">
                <thead style="position: sticky; top: 0;">
                    <tr class="table-secondary text-center table-dark ">
                        <th style='font-size:13px;' class='px-5'>Nom</th>
                        <th style='font-size:13px;' class='px-5'>Prenom</th>
                        <th style='font-size:13px;' class='px-5'>Depart</th>
                        <th style='font-size:13px;' class='px-5'>Duree</th>
                        <th style='font-size:13px;' class='px-5'>Destination</th>
                        <th style='font-size:13px;' class='px-5'>Site</th>
                        <th style='font-size:13px;' class='px-5'>Cadre</th>
                        <th style='font-size:13px;' class='px-5'>Departement</th>
                        <th style='font-size:13px;' class='px-5'>Passant Par</th>
                        <th style='font-size:13px;' class='px-5'>Duree de travail/Jour</th>
                        <th style='font-size:13px;' class='px-5'>Vehicule</th>
                        <th style='font-size:13px;' class='px-5'>Immatriculation</th>
                        <th style='font-size:13px;' class='px-5'>Chargement</th>
                        <th style='font-size:13px;' class='px-5'>PriseEnCharge</th>
                        <th style='font-size:13px;' class='px-5'>Matricule</th>
                        <th style='font-size:13px;' class='px-5'>NumeroDossier</th>
                        <th style='font-size:13px;' class='px-5'>NumeroBL_LTA</th>
                    </tr>
                </thead>
                <tbody id="tbody">
                    <tr class="table-primary custom-row" style='background-color:#0D6EFD;'>

                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
                        <td style='background-color:#0D6EFD;'>
                            <p></p>
                        </td>
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

        <!-- debut des boutton du bas -->

        <div class="row d-flex justify-content-between bg-primary bout-bas p-2 mb-2">
            <div style='width:50%;' class=' d-flex justify-content-between'>
                <button id='new'>
                    Nouveau
                    <img src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;">
                </button>

                <button>
                    Ouvrir
                    <img src="<?= SITE_URL ?>/assets/img/folder.png" alt="" style="width: max-content; height: 20px;">
                </button>

                <button>
                    Supprimer
                    <img src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button>
                    Rechercher
                    <img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 20px;">
                </button>
            </div>
            <!--  css du haut  -->
            <div style='width:50%;justify-content:flex-end;' class=' d-flex '>
                <button id="fermer">
                    Fermer
                    <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                </button>

            </div>
            <!--  css du haut  -->
        </div>

        <!--  fin des boutton du bas -->
    </div>

    <template id="listTemplate">
        <tr class="table-primary custom-row" style='background-color:#0D6EFD;'>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-nom></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-prenom></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-depart></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-duree></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-destination></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-site></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-cadre></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-departement></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-passant></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-duree_de_travail></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-vehicule></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-immatriculation></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-chargement></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-priseencharge></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-matricule></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-numerodossier></p>
            </td>
            <td style='background-color:#0D6EFD; color: #FFF;'>
                <p data-numerobl_lta></p>
            </td>
        </tr>
    </template>
    <!-- fin du container fluid -->

    <!-- css de cette page -->
    <style>
        table>tbody>tr:nth-of-type(2n +1)>td {
            color: #000 !important;
            background-color: #FFF !important;
            font-weight: 500;
        }

        /* css du header  */
        .ico_emplye {
            height: 20px;
            margin-right: 5px;
        }

        /* .head{
            background-color:#1f34f1;
        } */

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
        .bout {
            position: absolute;
            z-index: 10;
            left: 0;
            top: 60px;
            margin: 5px;
        }

        .bout-bas button {
            width: 120px;
            height: 45px;
            border-radius: 5px;
        }


        /* scrollbar du tableau */

        ::-webkit-scrollbar {
            width: 2px;
        }



        /* Track */
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
    </style>
</body>


<!-- les script de la page -->

<script>
    // Fonction pour afficher le tooltip
    function showTooltip() {
        var tooltip = document.getElementById("customTooltip");
        tooltip.style.visibility = "visible";
        tooltip.style.opacity = 1;

        // Vous pouvez ajouter du contenu dynamique ici si nécessaire
    }
</script>


<script>
    const boutonsFermer = document.querySelectorAll("#close_window, #fermer");
    const conteneur0 = document.querySelector(".conteneur0");

    if (conteneur0) {
        boutonsFermer.forEach((bouton) => {
            bouton.addEventListener("click", (e) => {
                e.preventDefault();
                conteneur0.style.display = "none";
            });
        });
    }
</script>

<!-- evenements sur les bouttons  -->

<script>
    const listTemplate = document.getElementById("listTemplate");
    const tbl = document.querySelector("tbody");

    /**
     * Updates the table with the given data by cloning an element and setting its values.
     *
     * @param {Element} table - The table element to update.
     * @param {Object} data - The data object containing the values to set.
     * @param {DocumentFragment} elementClone - The cloned element to update with the data values.
     */
    function updateMISSIONTable(table, data = {}, elementClone) {
        const element = elementClone.content.cloneNode(true);
        const pers = {
            // nom: "",
            // prenom: "",
            dat: "depart",
            duree: "duree",
            Lieux: "destination",
            site: "site",
            cadre: "cadre",
            Departement: "departement",
            via: "passant",
            "duree_travail": "duree_de_travail",
            motor: "vehicule",
            // immatriculation: "",
            charge: "chargement",
            PriseEnCharge: "priseencharge",
            matricule: "matricule",
            NumeroDossier: "numerodedossier",
            NumeroBL_LTA: "numerobl_lta",
        };

        Object.entries(data).forEach(([key, value]) => {
            if (key in pers) {
                setValue(pers[key], value, {
                    parent: element
                });
            }
        });
        table.appendChild(element);
    }

    try {
        const response = await fetch("<?= MISSION_API_URL ?>");
        const missions = await response.json();
        tbl.innerHTML = "";
        for (let rowData of missions)
            updateMISSIONTable(tbl, rowData, listTemplate);
    } catch (error) {
        null;
    }
</script>

<script>
    document.getElementById("new").addEventListener("click", function() {
        // Ouvrir la nouvelle page dans une nouvelle fenêtre
        window.location.href = "<?= SITE_URL ?>/mission";
    });


    window.addEventListener("unload", (event) => {
        event.preventDefault();
        localStorage.clear();
        close();
    });
</script>

<!-- rendre le lien accessible seulement par click sur le boutton  -->

</html>

<?php

$content = ob_get_clean();
include 'layout.php';
?>