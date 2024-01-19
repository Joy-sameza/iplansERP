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

    <div class="container-fluid mt-5 conteneur0" style='width:80%; height: 75vh;'>
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

                <div class="tooltip47 my-2">
                    <button class='border border-secondary bg-secondary border-1'>
                        <img src=" <?= SITE_URL ?>/assets/img/padlock.png" alt="" style="width: max-content; height: 20px;">
                        <span class="tooltiptext47">Verrouiller</span>
                    </button>

                </div>
            </div>



        </div>
        <!-- fin de la zone date -->
        <!-- debut de la zone de tableau -->
        <div class="row " style='border:1px solid gray; overflow: scroll scroll !important; height: clamp(400px, 90%, 65vh);'>
            <table class="table table-bordered " style="position: relative; text-align: center;" id="mytable_mission">
                <thead style="position: sticky; top: 0; z-index:9999;overflow: scroll scroll !" class='mt-1'>
                    <tr class="table-secondary text-center table-dark " >
                        <th style='font-size:13px;' class='px-5'>Options</th>
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
                    
                </tbody>
            </table>
        </div>

        <style>
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

        <div class="row d-flex justify-content-between bg-primary bout-bas  p-2 mb-2">
            <div style='width:60%;' class=' d-flex justify-content-between'>
                <button id='new'>
                    Nouveau
                    <img src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;">
                </button>

                <button id="modify">
                    Ouvrir
                    <img src="<?= SITE_URL ?>/assets/img/folder.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button ID="printData">Imprimer
                    <img src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;">
                </button>

                <button id="delete">
                    Supprimer
                    <img src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button>
                    Rechercher
                    <img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 20px;">
                </button>
            </div>
            <!--  css du haut  -->
            <div style='width:40%;justify-content:flex-end;' class=' d-flex '>
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
        <tr class="table-primary custom-row" style='background-color:#0D6EFD; pointer-events: all !important; cursor: pointer;'>
         

                 
        <td id='option' style='background-color:#0D6EFD; color: #FFF;'>
            <div class="d-flex">

                <!-- <button class="bouton bg-success "  id="set">
                    <i class="fas fa-edit"></i>

                </button> -->
                <div class="tooltip47">
                    <button class="bouton bg-success btn-modif"><i class="fas fa-edit"></i>
                
                      <span class="tooltiptext47">Modifier</span>
                    </button>
                </div>

                <div class="tooltip47 mx-1">
                    <button class="bouton btn-open "  id="open">
                        <i class="fas fa-folder-open "></i>
                           <span class="tooltiptext47">Ouvrir</span>
                    </button>
                </div> 
                
                <div class="tooltip47">
                    <button class="bouton bg-danger" onclick='supprimerLigne(this)'  id='delete'>
                        <i class="fas fa-trash "></i>
                            <span class="tooltiptext47">Supprimer</span>        
                    </button>
                </div>   

                <style>
                   #option .bouton {
                        background-color: #238fce;
                        color: #fff;
                         padding: 8px 20px;
                        font-size: 17px;

                        border: none;
                        border-radius: 5px;
                        cursor: pointer;
                        transition: background-color 0.4s ease;
                        width: max-content;
                        height: 43px;


                    }
                    
        .tooltip47 {
            position: relative;
            display: inline-block;
            cursor: pointer;
             z-index: 9999;
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
            z-index: 9999;
            top: 116%;
            left: 50%;
            margin-left: -32px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 14px;
        }

        
        .tooltip47:hover .tooltiptext47 {
            visibility: visible;
            opacity: 1;
             z-index: 9999;
        }
                </style>
            </div>

        </td>
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
            <td data-neng style="display: none;"></td>
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
        .header {
            display: none;
        }

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
            left: 110%;
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


<script>
    // const openMission = document.getElementById("open");
    //
    // let missionDataAction = '';
    // openMission.addEventListener("click", function(event) {
    //
    // })
</script>

<script>
    // const deleteMission = document.getElementById("delete");
    // deleteMission.addEventListener("click", () => missionDataAction = "delete");
</script>

<!-- les script de la page -->
<script>
    const ferme = document.querySelector(".close_window");
    const conteneur = document.querySelector(".conteneur0");

    ferme.addEventListener("click", (e) => {
        e.preventDefault()
        window.location.href = "<?= SITE_URL ?>/permi_con";

    });
</script>
<script>
    const boutonFermer = document.getElementById("fermer");
    const conteneur0 = document.querySelector(".conteneur0");

    boutonFermer.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "<?= SITE_URL ?>/permi_con";
    });
</script>

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
    // const conteneur0 = document.querySelector(".conteneur0");

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

<script type="module">
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
            nom: "nom",
            prenom: "prenom",
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
            NEng: "neng",
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

    const persData1 = await fetch("<?= PERS_API_URL ?>");
    const pers = await persData1.json();

    const response = await fetch("<?= MISSION_API_URL ?>");
    const missions = await response.json();

    for (const person of pers) {
        for (const mission of missions) {
            if (mission.matricule === person.Indexe) {
                mission.nom = person.nom;
                mission.prenom = person.prenom;
            }
        }
    }
    tbl.innerHTML = "";
    for (let rowData of missions)
        updateMISSIONTable(tbl, rowData, listTemplate);



        const site = document.getElementById("site");


        document.getElementById("new").addEventListener("click",
        () => window.location.href = "<?= SITE_URL ?>/mission");
   // const extractedData = localStorage.getItem('extractedData');
    const extractedData = localStorage.getItem('extractedData');
    if (extractedData) {
        const data = JSON.parse(extractedData);
        localStorage.removeItem('extractedData');
        const loopObject = {
            nom: "nom",
            prenom: "prenom",
            dat: "depart",
            duree: "duree",
            Lieux: "destination",
            site: "site",
            cadre: "cadre",
            Departement: "departement",
            via: "passant",
            duree_travail: "duree_de_travail",
            motor: "vehicule",
            // immatriculation: "",
            charge: "chargement",
            PriseEnCharge: "priseencharge",
            matricule: "matricule",
            NumeroDossier: "numerodedossier",
            NumeroBL_LTA: "numerobl_lta",
            NEng: "neng",
        }
        // set the data in the form
        const form = document.querySelector('form');
        form.action = '<?= SITE_URL ?>/forms/formmissionupdate.php';
        form.setAttribute('success', 'La\'mission à été mis à jour avec succès!');
        for (let [key, value] of Object.entries(data)) {
            for (const [k, v] of Object.entries(loopObject)) {
                if (key === k) {
                    if (key == 'depart' ) {
                        //format the value to date format (yyyy-MM-dd)
                        value = value.split('/').reverse().join('-');
                    }

                    const input = form.querySelector(`[name="${v}"]`);
                    if (input) {
                        input.value = value;
                    } else {
                        console.error(`Input with name "${key}" not found in the form.`);
                    }
                }
            }
        }
    }

        const allRows = document.querySelectorAll("tr");
        let missionDataAction = "";
        const openBtn = document.getElementById("modify");
        const deleteBtn = document.getElementById("delete");

        openBtn.addEventListener("click", () => missionDataAction = "modify");
       // deleteBtn.addEventListener("click", () => actionData = "delete");
    deleteBtn.addEventListener("click", () => missionDataAction = "delete");
        Array.from(allRows).forEach((row) => {
        row.addEventListener("click", async (e) => {
            const targetRow = e.target.parentNode;
            const extractedData = extractDataFromRow(targetRow);
            switch (missionDataAction) {
                case "modify":
                    missionDataAction = "";
                    localStorage.setItem("extractedData", JSON.stringify(extractedData));
                    window.open("<?= SITE_URL ?>/list_mission", "_self");
                    break;
                case "delete":
                    missionDataAction = "";
                    await deleteMission(parseInt(extractedData.neng));
                    setTimeout(() => {}, 1500);
                    window.location.href = "<?= SITE_URL ?>/list_mission";
                    break;
                default:
                    break;
            }
        });
    });

        /**
        * Extract data from a row
        * @param {HTMLTableRowElement} row Row from which data is to be extracted
        * @returns {Object} The extracted data
        */
        function extractDataFromRow(row) {
        const pers = {
            nom: "nom",
            prenom: "prenom",
            dat: "depart",
            duree: "duree",
            Lieux: "destination",
            site: "site",
            cadre: "cadre",
            Departement: "departement",
            via: "passant",
            duree_travail: "duree_de_travail",
            motor: "vehicule",
            // immatriculation: "",
            charge: "chargement",
            PriseEnCharge: "priseencharge",
            matricule: "matricule",
            NumeroDossier: "numerodedossier",
            NumeroBL_LTA: "numerobl_lta",
            NEng: "neng",
    };
        let obj = {};
        for (const [, value] of Object.entries(pers)) {
        obj[value] = row.querySelector(`[data-${value}]`);
    }
        return obj;
    }






/**
     * @param {number} id The id of the abscence to delete
     * @returns {Promise<void>}
     */
    async function deleteMission(id) {
        const val = await swal({
            icon: "warning",
            title: "Etes-vous sûr de vouloir supprimer?",
            text: "Cette action est irreversible!",
            dangerMode: true,
            closeOnClickOutside: false,
            closeOnEsc: false,
            buttons: {
                cancel: {
                    text: "Non!",
                    value: false,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Oui, supprimer!",
                    value: true,
                    className: "",
                    closeModal: true,
                },
            },
        });
        if (!val) return;
        const formData = new FormData();
        formData.append("id", id);
        formData.append("iplans_submit", "");
        const response = await fetch("<?= SITE_URL ?>/forms/formdeletemission.php", {
            method: "POST",
            body: formData,
        });
        if (!response.ok) return showAlert("la mission n'a pas pu être supprimé", "error");
        return showAlert("La mission a été supprimé avec succès", "success");

        // if (response["rows"] >= 1 && response["message"])
        // return showAlert("L'absence n'a pas pu être supprimé", "error");
    }
</script>
<script>
    document.getElementById('printData').addEventListener('click', printDataAction);

    function printDataAction() {
        const pdf = new jspdf.jsPDF({
            orientation: "landscape",
            format: "a4"
        });
        pdf.addImage(
            SITE_URL + "/assets/img/iplans logo.png",
            "PNG",
            10,
            10,
            2.969 * 50 * 0.25,
            1 * 50 * 0.25
        );
        const iplans = "\nLISTE DES MISSIONS";
        pdf.setFontSize(10);
        pdf.text(iplans, 10, 25);
        const jsonData = pdf.autoTableHtmlToJson(
            document.getElementById("mytable_mission"),
            false
        );
        const printableRowsMission = {
            Nom: 0,
            Prenom: 1,
            Depart: 2,
            Duree: 3,
            Destination: 4,
            'Duree de travail/Jour': 10,
            Site: 5,
            'Passant Par': 9,
        };

        const filteredData = [];
        const headings = [];

        Object.entries(printableRowsMission).forEach(([key]) => headings.push(key));

        for (const row of jsonData.data) {
            let filteredRow = [];
            Object.entries(printableRowsMission).forEach(([, value]) => {
                filteredRow.push(row[value]);
            });
            filteredData.push(filteredRow);
        }
        pdf.autoTable({
            head: [headings],
            body: filteredData,
            styles: {
                fontSize: 10,
            },
            startY: 35,
        });
        pdf.save("LISTE_MISSION.pdf");
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

<script>
    const allRows = document.getElementsByTagName("tr");
    console.log(allRows);
    Array.from(allRows).forEach(function(row) {
        row.addEventListener("click", function(event) {
            console.log(event.target);

        });
    });
</script>

<!-- rendre le lien accessible seulement par click sur le boutton  -->




<!-- liste des foction sur le tableau  -->


<script>
      
        function supprimerLigne(button) {

            const row = button.closest('tr');

            const neng = row.querySelector("[data-neng]").textContent;
            console.log('id:',neng)


            const url = `http://localhost/mission/${neng}`;
           // row.remove();
         

            // Effectuer la requête DELETE
            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Erreur de suppression : ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Suppression réussie :', data);
                // Mettez à jour l'interface utilisateur ou effectuez d'autres actions nécessaires
                // par exemple, supprimer la ligne du tableau
                row.remove();
                showAlert('Suppression réussie', 'success', 'L\'élément a été supprimé avec succès.');

            })
            .catch(error => {
                console.error('Erreur lors de la suppression :', error);
                // Gérer les erreurs ou informer l'utilisateur
            });
        }
</script>
 <script>
    $(document).ready(function() {
        $('#mytable_mission').on('click', '.btn-modif', function(event) {

            const targetRow = event.target.closest("tr");

            var neng = targetRow.querySelector('[data-neng]').textContent;
            var prenom = targetRow.querySelector('[data-prenom]').textContent;
            var nom = targetRow.querySelector('[data-nom]').textContent;
            var depart = targetRow.querySelector('[data-depart]').textContent;
            var duree = targetRow.querySelector('[data-duree]').textContent;
            var destination = targetRow.querySelector('[data-destination]').textContent;
            var site = targetRow.querySelector('[data-site]').textContent;
            var cadre = targetRow.querySelector('[data-cadre]').textContent;
            var departement = targetRow.querySelector('[data-departement]').textContent;
            var passant = targetRow.querySelector('[data-passant]').textContent;
            var duree_de_travail = targetRow.querySelector('[data-duree_de_travail]').textContent;
            var vehicule = targetRow.querySelector('[data-vehicule]').textContent;
            var immatriculation = targetRow.querySelector('[data-immatriculation]').textContent;
            var chargement = targetRow.querySelector('[data-chargement]').textContent;
            var priseencharge = targetRow.querySelector('[data-priseencharge]').textContent;
            var matricule = targetRow.querySelector('[data-matricule]').textContent;
            var numerodossier = targetRow.querySelector('[data-numerodossier]').textContent;
            var  numerobl_lta = targetRow.querySelector('[ data-numerobl_lta]').textContent;
           



            var formData_Mission = {
                neng:neng,
                nom: nom,
                prenom: prenom,
              
       
                matricule: matricule,
                depart:depart,
                duree:duree,
                destination:destination,
                site:site,
                cadre:cadre,
                departement:departement,
                passant:passant,
                duree_de_travail:duree_de_travail,
                vehicule:vehicule,
                immatriculation:immatriculation,
                chargement:chargement,
                priseencharge:priseencharge,
                numerodossier:numerodossier,
                numerobl_lta:numerobl_lta



            };
           

            sessionStorage.setItem('formData_Mission', JSON.stringify(formData_Mission));
            $.ajax({
                    type: "POST",
                    url: "http://localhost/Iplans/openMission", 
                    data: { formData_Mission: JSON.stringify(formData_Mission) },
                    success: function(response) {
                        
                        console.log(response);
                        console.log('reussi donc ok')
                    },
                    error: function(error) {
                       
                        console.error(error);
                        console.error('des erreurs');
                    }
                });


           window.location.href = 'http://localhost/Iplans/openMission';



        });
    });
</script> 

</html>

<?php

$content = ob_get_clean();
include './vues/layout.php';
?>