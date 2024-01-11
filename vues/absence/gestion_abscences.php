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
    <title>Gestion Abscences</title>
</head>

<body>
    <form action="<?= PERMISSION_API_URL ?>">
        <div class="container-fluid conteneur my-5 border  border-2 border-secondary" style='width:80%;'>
            <!-- le header  -->
            <div class="row bg-secondary border-1 ">
                <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                    <div style="display: flex;">
                        <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                        <h6 class="fiche_sala" style='color:white;'>Gestion des abscences</h6>
                    </div>
                    <div>
                        <button class="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                    </div>
                </div>
            </div>
            <!-- fin header  -->
            <h2 class='text-center titre py-1'>GESTIONS DES ABSCENCES</h2>
            <div class="row">
                <div class="col-8 param m-1 ">
                    <div class='row border border-2 para mt-3'>
                        <div class="col-6 param1 " style='position: relative;'>
                            <!-- ceci ne concerne que text divider -->
                            <div class="text-divider-container">
                                <div class="text-divider">
                                    <span>Parametres</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; " class='mt-3'>
                                <label for="motif" class="form-label">Motif </label>
                                <select class="form-select-sm " style='width:80%' name="motif" required aria-required="true">
                                    <option selected></option>
                                    <option>FERRIE</option>
                                    <option>REPOS</option>
                                    <option>ECOLE</option>
                                    <option>GREVES</option>
                                    <option>MISSIONS</option>
                                    <option>PERMISSION</option>
                                    <option>SUSPENSION</option>
                                    <option>MATERNITE</option>
                                    <option>RECUPERATION</option>
                                    <option>FAUTE TECHNIQUE</option>
                                    <option>CONGE ANNUEL</option>
                                    <option>PROLONGEMENT MISSION</option>
                                </select>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-2'>
                                <label for="date_debut" class="form-label">Debut </label>
                                <input type="date" class="form-control-sm" id="date_debut" name="date_debut" required aria-required="true">
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-2'>
                                <label for="date_debut" class="form-label">Fin </label>
                                <input type="date" class="form-control-sm" id="date_fin" name="date_fin" required aria-required="true">
                            </div>
                            <div class='mt-2' style="display: flex; justify-content: space-between; align-items: center; ">
                                <div class="form-check" style='width:50%'>
                                    <input type="checkbox" class="form-check-input" id="appliquer_check" name="appliquer" checked>
                                    <label class="form-check-label" for="check1">Appliquer a</label>
                                </div>
                                <div class="form-check" style='width:50%'>
                                    <select class="form-select-sm " style='width:100%' required aria-required="true">
                                        <option selected>TOUS</option>
                                        <option>ADMINISTRATIF</option>
                                        <option>ADMINISTRATION</option>
                                        <option>APPLICATION</option>
                                        <option>CHAUFFEUR</option>
                                        <option>COMMERCIAL</option>
                                        <option>ENTREPOT</option>
                                        <option>INFO</option>
                                        <option>PEDIATRIE</option>
                                        <option>TECHNIQUE</option>
                                    </select>
                                </div>
                            </div>
                            <div class='mt-2' style="display: flex; justify-content: space-between; align-items: center; ">
                                <div class="form-check" style='width:50%'>
                                    <input type="checkbox" class="form-check-input" id="deduire_check" name="deduire_check">
                                    <label class="form-check-label" for="deduire_check">Déduire des congés</label>
                                </div>
                                <div class="form-check" style='width:50%'>
                                    <select class="form-select-sm " style='width:71%' required aria-required="true" name="deduire">
                                        <option selected></option>
                                        <option>OUI</option>
                                        <option>NON</option>
                                    </select>
                                    <button class='boutton'>
                                        <img src="<?= SITE_URL ?>/assets/img/question.png" alt="" style="width: max-content; height: 20px;">
                                    </button>
                                </div>
                            </div>
                            <div class="form-check mt-1" style='width:100%'>
                                <input type="checkbox" class="form-check-input" id="bloquer_check" name="bloquer" checked>
                                <label class="form-check-label" for="check1">Bloquer Pointages</label>
                            </div>
                            <div class="form-check mt-2" style='width:100%'>
                                <input type="checkbox" class="form-check-input" id="recuperable_check" name="recuperable" checked style="pointer-events: none;">
                                <label disabled class="form-check-label" for="recuperable_check">Recuperable en cas de travail</label>
                            </div>
                            <div class='mt-2' style="display: flex; justify-content: space-between; align-items: center; ">
                                <div class="form-check" style='width:30%'>
                                    <input type="checkbox" class="form-check-input" id="accorder_check" name="accorder">
                                    <label class="form-check-label text-danger " style='font-weight:bold' for="check1">Accorder</label>
                                </div>
                                <div class="form-check" style='width:70%'>
                                    <div class="tooltip47 my-2">
                                        <button class='boutton' id='accorder'>
                                            <img src="<?= SITE_URL ?>/assets/img/book.png" alt="" style="width: 60px; height: 35px;">
                                            <span class="tooltiptext47">Faite un courrier de confirmation</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class='mt-2 anne_com  d-flex justify-content-end border border-2 p-1' style='width:83%'>
                                <div class="text-divider-container2">
                                    <div class="text-divider">
                                        <span>Annee Comptable</span>
                                    </div>
                                </div>
                                <select class="form-select-sm " style='width:29%; pointer-events: none;' name="annee">
                                    <?php
                                    for ($i = 2010; $i <= (int)date('Y') - 1; $i++) {
                                        echo '<option value="' . $i . '">' . $i . '</option>';
                                    }
                                    ?>
                                    <option value="<?= date('Y') ?>" selected><?= date('Y') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 ">
                            <div class='mt-2 note border border-2 p-1 mt-3' style='width:100%'>
                                <div class="text-divider-container3">
                                    <div class="text-divider">
                                        <span>Note de justification</span>
                                    </div>
                                </div>
                                <textarea class="form-control mt-0  shadow-none" id="exampleTextarea" rows="14" style="resize: none;" name="justification"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 param2" style='margin-left: -10px; margin-right: -10px;'>
                    <div class="zone3 mt-3 " style='margin-left:10px;'>
                        <img src="<?= SITE_URL ?>/assets/img/avatar.png" alt="" style='width: 270px;height: 300px;' class='border border-secondary border-1'>
                        <button type="button" class="bout"><i class="fas fa-search"></i></button>
                        <input type="text" inputmode="numeric" name="identifiant" class="form-control-sm backinput mt-3 border border-0" style='width: 270px; color: #eee; background: #333 !important' placeholder="L'identifiant de l'employé" list="persList" required aria-required="true">
                        <datalist id="persList"></datalist>
                    </div>
                </div>
            </div>
            <!-- debut du bas de page  -->
            <div class="row d-flex justify-content-between bg-primary bout-bas p-2 ">
                <div style='width:15%;'>
                    <button type="submit">Valider<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>
                <!--  c2eme -->
                <div style='width:30%;' class="d-flex justify-content-end">
                    <button>Rechercher
                        <img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 20px;">
                    </button>
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
        </div>
        <input type="text" name="id" id="identifiant" readonly aria-readonly="true" style="display: none;">
    </form>
    <!-- fin du contanaire  -->

    <style>
        .bout-bas button {
            width: 120px;
            height: 45px;
            border-radius: 5px;
        }

        .ico_emplye {
            height: 18px;
            margin-right: 5px;
        }

        .backinput {
            background-color: black;
        }

        .titre {
            font-weight: 600;
            color: gray;
        }

        .param {

            background-color: #EBEDEF;

        }

        /* Styles CSS personnalisés pour le séparateur de texte */
        .text-divider-container {
            position: absolute;
            top: 0%;
            left: 15%;
            transform: translate(-50%, -50%);
            background-color: #EBEDEF;
            padding: 0 10px;
            font-size: 16px;
        }

        .text-divider-container2 {
            position: absolute;
            top: -5%;
            left: 27%;
            transform: translate(-50%, -50%);
            background-color: #EBEDEF;
            padding: 0 6px;
            font-size: 14px;

        }

        .text-divider-container3 {
            position: absolute;
            top: -2%;
            left: 22%;
            transform: translate(-50%, -50%);
            background-color: #EBEDEF;
            padding: 0 6px;
            font-size: 14px;

        }


        .text-divider {
            font-weight: 500;
            padding: 0;
            text-align: center;
        }

        .note,
        .anne_com {
            position: relative;
            border-radius: 3px;
        }

        label {
            font-weight: 400;
        }

        .bout {
            position: absolute;
            z-index: 10;
            left: 0;
            top: 260px;
            margin: 5px;
        }

        .zone3 {
            position: relative;
        }

        button {
            border: 2px solid gray;
            border-radius: 4px;
        }




        .tooltip47 {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip47 .tooltiptext47 {
            visibility: hidden;
            width: 230px;
            background-color: #f0f004;
            color: #080808;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 10;
            top: 110%;
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


    <!-- js de la page  -->
    <script>
        const btns = document.querySelectorAll('button:not([type="submit"])');
        for (const btn of btns) {
            btn.type = 'button';
        }
    </script>



    <!-- les script de la page -->

    <!-- ... Autres parties du code HTML ... -->

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ferme = document.querySelector(".close_window");
            const conteneur = document.querySelector(".conteneur");

            ferme.addEventListener("click", (e) => {
                e.preventDefault();
                window.location.href = "<?= SITE_URL ?>/list_abscences";
            });

            const boutonFermer = document.getElementById("fermer");
            boutonFermer.addEventListener("click", (e) => {
                e.preventDefault();
                window.location.href = "<?= SITE_URL ?>/list_abscences";
            });
        });
    </script>

    <!-- ... evenements sur les bouttons ... -->

    <script type="module">
        const persList = document.getElementById("persList");

        const persData = await fetch("<?= PERS_API_URL ?>");
        const pers = await persData.json();

        for (const person of pers) {
            const option = document.createElement("option");
            option.value = person.NEng;
            option.textContent = person.nom + " " + person.prenom;
            persList.appendChild(option);
        }


        const form = document.querySelector("form");
        form.addEventListener("submit", async (event) => {
            event.preventDefault();
            const formData = new FormData(form);

            if (form.action !== '<?= PERMISSION_API_URL ?>') {
                formData.append('iplans_submit', "");
                const response = await fetch(form.action, {
                    method: "POST",
                    body: formData,
                })
                if (response.status === 200 || response.status === 201 || response.ok) {
                    const data = await response.json();
                    await swal({
                        icon: 'success',
                        text: form.getAttribute('success') ?? 'Abscence enregistreé avec succès!',
                    });
                    setTimeout(() => {}, 6000);
                    window.location.href = '<?= SITE_URL ?>/list_abscences';
                } else {
                    swal({
                        icon: 'error',
                        text: 'Une erreur est survenue',
                    });
                }
            } else {
                const userData = Object.fromEntries(formData);
                const submitData = {
                    debut: userData['date_debut'],
                    fin: userData['date_fin'],
                    type: userData['motif'],
                    AccordeePar: userData['identifiant'],
                    deduireSurConges: userData['deduire'],
                    anneeComptable: userData?.annee === "" ? new Date().getFullYear() : userData['annee'],
                    reccuperable: "non",
                    block_pointage: "123",
                    Demande: userData['identifiant'],
                    IDBlockPointage: "123",
                    IndexGroupement: "123",
                    id: userData['id'],
                };

                const response = await fetch(form.action, {
                    method: "POST",
                    body: JSON.stringify(submitData),
                });
                if (response.status === 200 || response.status === 201 || response.ok) {
                    const data = await response.json();
                    await swal({
                        icon: 'success',
                        text: form.getAttribute('success') ?? 'Abscence enregistreé avec succès!',
                    });
                    setTimeout(() => {}, 6000);
                    window.location.href = '<?= SITE_URL ?>/list_abscences';
                } else {
                    swal({
                        icon: 'error',
                        text: 'Une erreur est survenue',
                    });
                }
            }

        });
    </script>

    <script>
        const extractedData = localStorage.getItem('extractedData');
        if (extractedData) {
            const data = JSON.parse(extractedData);
            localStorage.removeItem('extractedData');
            const loopObject = {
                debut: 'date_debut',
                fin: 'date_fin',
                motif: 'motif',
                deduiresurconges: 'deduire',
                anneecomptable: 'annee',
                reccuperable: 'recuperable',
                neng: 'id',
                justification: 'justification',
            }
            // set the data in the form
            const form = document.querySelector('form');
            form.action = '<?= SITE_URL ?>/forms/formpermissionupdate.php';
            form.setAttribute('success', 'L\'abscence à été mis à jour avec succès!');
            for (let [key, value] of Object.entries(data)) {
                for (const [k, v] of Object.entries(loopObject)) {
                    if (key === k) {
                        if (key == 'debut' || key == 'fin') {
                            //format the value to date format (yyyy-MM-dd)
                            value = value.split('/').reverse().join('-');
                        }
                        if (key == 'recuperable') {
                            value = value === 'oui' ? 'on' : 'off';
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
    </script>

    <script>
        document.getElementById("accorder").addEventListener("click", function() {
            // Spécifiez l'URL de la nouvelle page que vous souhaitez ouvrir
            var nouvellePageURL = "http://localhost/Iplans/fiche_message";
            // Ouvrir la nouvelle page dans une nouvelle fenêtre
            window.location.href = "<?= SITE_URL ?>/fiche_message";
        });
    </script>
</body>

</html>

<?php

$content = ob_get_clean();
include './vues/layout.php';
?>