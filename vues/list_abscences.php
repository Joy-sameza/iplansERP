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
    <div class="container-fluid conteneur0 border border-2 border-primary" style='width:75%; height: 75vh;'>

        <div class="row bg-primary border-1 ">
            <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h6 class="fiche_sala" style='color:white;'>List des demandes d'abscences</h6>

                </div>

                <div>
                    <button class="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                </div>
            </div>
        </div>
        <!-- fin du header  -->
        <div>
            <form id="filterForm">
                <div class="row d-flex ">
                    <div class='englobe' style='width:25%;padding:0px;margin:0px;position:relative;'>
                        <div style='width:100%;height: 91px;' class='p-1 pt-2 border border-2 mt-3 border-secondary option_cont'>
                            <div class="text-divider-container1">
                                <div class="text-divider">
                                    <span>Periode</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                                <label for="date_debut" class="form-label">Date début </label>
                                <input type="date" class="form-control-sm" id="date_debut">
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-1'>
                                <label for="date_fin" class="form-label">Date fin </label>
                                <input type="date" class="form-control-sm" id="date_fin">
                            </div>
                        </div>
                    </div>
                    <div class='englobe mx-1' style='width:27%;padding:0px;margin:0px;position:relative;'>
                        <div style='width:100%; height: 91px;' class='p-2 border border-1 option_cont border-2 mt-3 border-secondary'>
                            <div class="text-divider-container2">
                                <div class="text-divider">
                                    <span>Selection</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                                <label for="site" class="form-label">Site </label>
                                <select class="form-select-sm " style='width:50%' id="site">
                                    <option SELECTED>TOUS</option>
                                </select>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-1'>
                                <label for="departement" class="form-label">Departement </label>
                                <select class="form-select-sm " style='width:50%' id="departement">
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
                    <div class='englobe' style='width:31%;padding:0px;margin:0px;position:relative;'>
                        <div style='width:100%;height: 91px;' class='p-2 border border-1 option_cont border-2 mt-3 border-secondary'>
                            <div class="text-divider-container3">
                                <div class="text-divider">
                                    <span>Etats</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                                <div class="form-check" style='width:60%'>
                                    <input type="radio" class="form-check-input" id="check1" name="etat" value="toutes">
                                    <label class="form-check-label" for="check1">Toutes</label>
                                </div>
                                <div class="form-check" style='width:40%'>
                                    <input type="radio" class="form-check-input" id="check2" name="etat" value="en_attentes">
                                    <label class="form-check-label" for="check2">En Attentes</label>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; " class='mt-2'>
                                <div class="form-check" style='width:60%'>
                                    <input type="radio" class="form-check-input" id="check1" name="etat" value="archivees">
                                    <label class="form-check-label" for="check1">Archivees(Accordees)</label>
                                </div>
                                <div class="form-check" style='width:40%'>
                                    <input type="radio" class="form-check-input" id="check2" value="accordees" name="etat">
                                    <label class="form-check-label" for="check2">Accordees</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='englobe1' style='width:16%;padding:0px;margin:0px;position:relative;'>
                        <button class='boutton'>
                            <img src="<?= SITE_URL ?>/assets/img/padlock.png" alt="" style="width: max-content; height: 20px;">
                        </button>
                        <select class="form-select-sm mt-5 " style='width:95%;margin-left:10px' id="salaire">
                            <option SELECTED>TOUS</option>
                            <option>UN SALAIRE</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <!-- fin de la div qui suit  -->


        <div class="row " style='height: clamp(400px, 80%, 55vh);'>
            <div class="table-responsive debut_tableau w-100 h-100">
                <table class="table table-bordered " style="position: relative; text-align: center;" id="absTable">
                    <thead style="position: sticky; top: 0;">
                        <tr class="table-secondary text-center table-dark">
                            <th style='font-size:13px;' class='px-5'>Site</th>
                            <th style='font-size:13px;' class='px-5'>Departement</th>
                            <th style='font-size:13px;' class='px-5'>Civilite</th>
                            <th style='font-size:13px;' class='px-5'>Nom</th>
                            <th style='font-size:13px;' class='px-5'>Prenom</th>
                            <th style='font-size:13px;' class='px-5'>Motif</th>
                            <th style='font-size:13px;' class='px-5'>Debut</th>
                            <th style='font-size:13px;' class='px-5'>Fin</th>
                            <th style='font-size:13px;' class='px-5'>justification</th>
                            <th style='font-size:13px;' class='px-5'>Block_pointage</th>
                            <th style='font-size:13px;' class='px-5'>Recupereble</th>
                            <th style='font-size:13px;' class='px-5'>DeduireSurConges</th>
                            <th style='font-size:13px;' class='px-5'>AnneeComptable</th>
                            <th style='font-size:13px;' class='px-5'>Matricule</th>
                            <th style='font-size:13px;' class='px-5'>CreePar</th>
                            <th style='font-size:13px;' class='px-5'>AccordeePar</th>
                            <th style='font-size:13px;' class='px-5'>Archive</th>
                        </tr>
                    </thead>
                    <tbody id="fillTableau">
                        <tr class="table-primary custom-row text-center text-white" style='background-color:#0D6EFD;'>
                            <td class='text-white' style='background-color:#0D6EFD;'>DEMO</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>APPLICATION</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>Mademoiselle</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>Kamsu Simo </td>
                            <td class='text-white' style='background-color:#0D6EFD;'>Liliane Diane</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>Repos</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>09/10/2023</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>09/10/2023</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>MEMO</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>oui</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>oui</td>
                            <td class='text-white' style='background-color:#0D6EFD;'></td>
                            <td class='text-white' style='background-color:#0D6EFD;'>2021</td>
                            <td class='text-white' style='background-color:#0D6EFD;'>Demo96e973e691</td>
                            <td class='text-white' style='background-color:#0D6EFD;'></td>
                            <td class='text-white' style='background-color:#0D6EFD;'></td>
                            <td class='text-white' style='background-color:#0D6EFD;'>2</td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- debut de la div tableau -->

        <style>
            table>tbody>tr:nth-of-type(2n +1)>td {
                color: #000 !important;
                background-color: #FFF !important;
                font-weight: 500;
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
        <!-- fin div tableau  -->
        <!-- la div du footer  -->
        <div class="row d-flex justify-content-between bg-primary bout-bas p-2 ">
            <div style='width:87%;' class=' d-flex justify-content-between'>
                <button class='taille_boutton' id='new'>
                    Nouveau
                    <img src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;">
                </button>

                <button class='taille_boutton'>
                    Modifier
                    <img src="<?= SITE_URL ?>/assets/img/set.png" alt="" style="width: max-content; height: 20px;">
                </button>

                <button>
                    Supprimer
                    <img src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button id="printData">
                    Imprimer Liste
                    <img src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button>
                    Voir Pointages
                    <img src="<?= SITE_URL ?>/assets/img/saving.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button class='taille_boutton'>
                    Conges
                    <img src="<?= SITE_URL ?>/assets/img/question.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button>
                    Planning
                    <img src="<?= SITE_URL ?>/assets/img/pc.png" alt="" style="width: max-content; height: 20px;">
                </button>
            </div>
            <!--  css du haut  -->
            <div style='width:12%;justify-content:flex-end;' class=' d-flex '>
                <button id="fermer">
                    Fermer
                    <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                </button>

            </div>
            <!--  css du haut  -->
        </div>

        <!-- fin div footer  -->

    </div>
    <!-- fin de la grande div  -->

    <template id="absTemplate">
        <tr class="table-primary custom-row text-center text-white">
            <td class='text-white' style='background-color:#0D6EFD;' data-site></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-departement></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-civilite></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-nom></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-prenom></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-motif></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-debut></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-fin></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-justification></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-block_pointage></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-recuperable></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-deduiresurconges></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-anneecomptable></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-matricule></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-creepar></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-accordeepar></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-archive></td>
        </tr>
    </template>


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
        background-color: #bfc9ca;
    }

    .option_cont {
        border-radius: 6px;
    }

    /* Styles CSS personnalisés pour le séparateur de texte */
    .text-divider-container1 {
        position: absolute;
        top: 10%;
        left: 17%;
        transform: translate(-50%, -50%);
        background-color: #BFC9CA;
        padding: 0 7px;
        font-size: 14px;
    }

    .text-divider-container2 {
        position: absolute;
        top: 10%;
        left: 17%;
        transform: translate(-50%, -50%);
        background-color: #BFC9CA;
        padding: 0 7px;
        font-size: 14px;
    }

    .text-divider-container3 {
        position: absolute;
        top: 12%;
        left: 10%;
        transform: translate(-50%, -50%);
        background-color: #BFC9CA;
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
</style>




<!-- jsvascript -->
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


<!-- evenement sur les bouttons  -->

<script>
    document.getElementById("new").addEventListener("click", () => window.location.href = "<?= SITE_URL ?>/gestion_abscences");
</script>


<script type="module">
    const absTemplate = document.getElementById("absTemplate");
    const fillTableau = document.getElementById("fillTableau");
    const site = document.getElementById("site");

    /**
     * Updates the table with the given data by cloning an element and setting its values.
     *
     * @param {Element} table - The table element to update.
     * @param {Object} data - The data object containing the values to set.
     * @param {DocumentFragment} elementClone - The cloned element to update with the data values.
     */
    function updatePERMISSIONTable(table, data = {}, elementClone) {
        const element = elementClone.content.cloneNode(true);
        const pers = {
            Site: "site",
            departement: "departement",
            type: "motif",
            debut: "debut",
            fin: "fin",
            Notes: "justification",
            block_pointage: "block_pointage",
            reccuperable: "recuperable",
            deduireSurConges: "deduiresurconges",
            anneeComptable: "anneecomptable",
            matricule: "matricule",
            CreePar: "creepar",
            AccordeePar: "accordeepar",
            Archive: "archive",
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

    /**
     * Sets the value of an element with a specific data attribute.
     *
     * @param {string} dataAttribute - The data attribute to search for.
     * @param {any} value - The value to set on the element.
     * @param {Object} options - The options object.
     * @param {HTMLElement} options.parent - The parent element to search within (default: document).
     */
    function setValue(dataAttribute, value, {
        parent = document
    } = {}) {
        const element = parent.querySelector(`[data-${dataAttribute}]`);
        if (element) {
            element.textContent = value;
        }
    }

    const responseSitesIplans = await fetch("<?= COURRIER_API_URL . "site" ?>");
    const sitesIplans = await responseSitesIplans.json();
    for (const siteIplan of sitesIplans) {
        const option = document.createElement("option");
        option.value = siteIplan;
        option.text = siteIplan;
        site.appendChild(option);
    }

    const response = await fetch("<?= PERMISSION_API_URL ?>");
    const absences = await response.json();


    fillTableau.innerHTML = '';
    for (const absence of absences) {
        updatePERMISSIONTable(fillTableau, absence, absTemplate);
    }

    let siteFiltre, departementFiltre, etatFiltre, salaireFiltre;

    const filterForm = document.getElementById("filterForm");
    const dateDebut = document.getElementById("date_debut");
    const dateFin = document.getElementById("date_fin");

    filterForm.addEventListener("change", (event) => {
        let absOutput = absences;
        const start = filterForm.querySelector("#date_debut").value;
        const end = filterForm.querySelector("#date_fin").value;
        if (event.target.id === "date_debut" || event.target.id === "date_fin")
            absOutput = useDateFiltre(start, end, absOutput);
        if (event.target.id === "site") siteFiltre = event.target.value;
        if (event.target.id === "departement") departementFiltre = event.target.value;
        if (event.target.name === "etat") etatFiltre = event.target.value;
        if (event.target.id === "salaire") salaireFiltre = event.target.value;

        if (siteFiltre) absOutput = useSiteFiltre(siteFiltre, absOutput)
        if (departementFiltre) absOutput = useDepartementFiltre(departementFiltre, absOutput);
        if (etatFiltre) absOutput = useEtatFiltre(etatFiltre, absOutput);
        if (salaireFiltre) absOutput = useSalaireFiltre(salaireFiltre, absOutput);

        fillTableau.innerHTML = '';
        for (const absence2 of absOutput) {
            updatePERMISSIONTable(fillTableau, absence2, absTemplate);
        }
    });

    /**
     * @param {string} start
     * @param {string} end
     * @param {Array} data 
     */
    function useDateFiltre(start, end, data) {
        if (start && end) {
            return data.filter(
                (absence, index) => {
                    absence.debut = absence.debut.split('/').reverse().join('-');
                    absence.fin = absence.fin.split('/').reverse().join('-');
                    const dateDebut = new Date(absence.debut);
                    const dateFin = new Date(absence.fin);
                    return dateDebut >= new Date(start) && dateFin <= new Date(end);
                }
            )
        }
    }

    /**
     * @param {string} site
     * @param {Array} data
     * @returns {Array}
     */
    function useSiteFiltre(site, data) {
        if (!site) return data
        if (site === "TOUS") return data
        return data.filter((absence) => absence?.Site === site)
    }
    /**
     * @param {string} departement
     * @param {Array} data
     * @returns {Array}
     */
    function useDepartementFiltre(departement, data) {
        if (!departement) return data
        if (departement === "TOUS") return data
        return data.filter((absence) => absence?.departement === departement);
    }
    /**
     * @param {string} etat
     * @param {Array} data
     * @returns {Array}
     */
    function useEtatFiltre(etat, data) {
        if (etat === "toutes") return data
        if (etat === "archivees") {
            return data.filter(
                (absence) => absence?.Archive > 0
            )
        } else {
            return data.filter(
                (absence) => absence?.etat === etat
            )
        }
    }
    /**
     * @param {string} salaire
     * @param {Array} data
     * @returns {Array}
     */
    function useSalaireFiltre(salaire, data) {
        if (!salaire) return data
        if (salaire === "TOUS") return data
        return data.filter(
            (absence) => absence?.salaire === salaire
        )
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
        const iplans = "\nLISTE D'ABSCENCES";
        pdf.setFontSize(10);
        pdf.text(iplans, 10, 25);
        const jsonData = pdf.autoTableHtmlToJson(
            document.getElementById("absTable"),
            false
        );
        const printableRowsAbs = {
            Site: 0,
            Departement: 1,
            Civilite: 2,
            Nom: 3,
            Prenom: 4,
            Motif: 5,
            Debut: 6,
            Fin: 7,
            AccordeePar: 15,
        };

        const filteredData = [];
        const headings = [];

        Object.entries(printableRowsAbs).forEach(([key]) => headings.push(key));

        for (const row of jsonData.data) {
            let filteredRow = [];
            Object.entries(printableRowsAbs).forEach(([, value]) => {
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
        pdf.save("table_employee.pdf");
    }
</script>

</html>

<?php

$content = ob_get_clean();
include 'layout.php';
?>