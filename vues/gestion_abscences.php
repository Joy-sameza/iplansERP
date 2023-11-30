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
    <form action="">
        <div class="container-fluid conteneur border  border-2 border-secondary" style='width:80%;'>
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
                                <select class="form-select-sm " style='width:80%' name="motif" id="motif" required aria-required="true">
                                    <option></option>
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
                                <label for="date_debut" class="form-label">Début </label>
                                <input type="date" class="form-control-sm" id="date_debut" name="date_debut" required aria-required="true">
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-2'>
                                <label for="date_fin" class="form-label">Fin </label>
                                <input type="date" class="form-control-sm" id="date_fin" name="date_fin" required aria-required="true">
                            </div>
                            <div class='mt-2' style="display: flex; justify-content: space-between; align-items: center; ">
                                <div class="form-check" style='width:50%'>
                                    <input type="checkbox" class="form-check-input" id="check1" name="appliquer_check" checked>
                                    <label class="form-check-label" for="check1">Appliquer à</label>
                                </div>
                                <div class="form-check" style='width:50%'>
                                    <select class="form-select-sm " style='width:100%' name="appliquer">
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
                                    <input type="checkbox" class="form-check-input" id="check2" name="deduire_check">
                                    <label class="form-check-label" for="check2">Déduire des congés</label>
                                </div>
                                <div class="form-check" style='width:50%'>
                                    <select class="form-select-sm " style='width:71%' name="deduire">
                                        <option selected></option>
                                    </select>
                                    <button class='boutton'>
                                        <img src="<?= SITE_URL ?>/assets/img/question.png" alt="" style="width: max-content; height: 20px;">
                                    </button>
                                </div>
                            </div>
                            <div class="form-check mt-1" style='width:100%'>
                                <input type="checkbox" class="form-check-input" id="check3" name="bloquer_check" checked>
                                <label class="form-check-label" for="check3">Bloquer Pointages</label>
                            </div>
                            <div class="form-check mt-2" style='width:100%'>
                                <input type="checkbox" class="form-check-input" id="check4" name="recuperable_check" checked disabled>
                                <label disabled class="form-check-label" for="check4">Recuperable en cas de travail</label>
                            </div>
                            <div class='mt-2' style="display: flex; justify-content: space-between; align-items: center; ">
                                <div class="form-check" style='width:30%'>
                                    <input type="checkbox" class="form-check-input" id="check5" name="accorder_check">
                                    <label class="form-check-label text-danger " style='font-weight:bold' for="check5">Accorder</label>
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
                                <select class="form-select-sm " style='width:29%' name="anneeComptable" required aria-required="true">
                                    <option></option>
                                    <option>2023</option>
                                    <option>2022</option>
                                    <option>2021</option>
                                    <option>2020</option>
                                    <option>2019</option>
                                    <option>2018</option>
                                    <option>2017</option>
                                    <option>2016</option>
                                    <option>2015</option>
                                    <option>2014</option>
                                    <option>2013</option>
                                    <option>2012</option>
                                    <option>2011</option>
                                    <option>2010</option>
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
                        <input type="text" class="form-control-sm backinput mt-3 border border-0" style='width: 270px; color: #FFF;' list="personList" name="person" required aria-required="true">
                        <datalist id="personList"></datalist>
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

            background-color: #F4F6F6;

        }

        /* Styles CSS personnalisés pour le séparateur de texte */
        .text-divider-container {
            position: absolute;
            top: 0%;
            left: 15%;
            transform: translate(-50%, -50%);
            background-color: #F4F6F6;
            padding: 0 10px;
            font-size: 16px;
        }

        .text-divider-container2 {
            position: absolute;
            top: -5%;
            left: 27%;
            transform: translate(-50%, -50%);
            background-color: #F4F6F6;
            padding: 0 6px;
            font-size: 14px;

        }

        .text-divider-container3 {
            position: absolute;
            top: -2%;
            left: 22%;
            transform: translate(-50%, -50%);
            background-color: #F4F6F6;
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
    </style>


    <!-- js de la page  -->
    <script>

    </script>
</body>



<!-- les script de la page -->

<!-- ... Autres parties du code HTML ... -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ferme = document.querySelector(".close_window");
        const conteneur = document.querySelector(".conteneur");

        ferme.addEventListener("click", (e) => {
            e.preventDefault();
            conteneur.style.display = "none";
        });

        const boutonFermer = document.getElementById("fermer");
        boutonFermer.addEventListener("click", (e) => {
            e.preventDefault();
            conteneur.style.display = "none";
        });
    });
</script>

<script>
    const btns = document.querySelectorAll('button:not([type="submit"])');
    for (const btn of btns) {
        btn.type = 'button';
    }
</script>

<script>
    document.querySelector('form').addEventListener('submit', async (event) => {
        event.preventDefault();
        const form = event.currentTarget
        const formData = new FormData(form);
        // formData.append('iplans_submit', "");
        const formProps = Object.fromEntries(formData);
        formProps['iplans_submit'] = '';
        console.log(JSON.stringify(formProps));

        const start = new Date(formProps['date_debut']);
        const end = new Date(formProps['date_fin']);
        if (start.getTime() > end.getTime()) {
            swal({
                icon: 'error',
                title: 'La date de fin est invalide',
                text: 'La date de fin doit être supérieur à la date de début',
            })
        }

        const submitResponse = await fetch('<?= SITE_URL ?>/forms/formabscences.php', {
            method: 'POST',
            body: JSON.stringify(formProps),
            cache: "reload",
        });
        const data = await submitResponse.text();
        if (!submitResponse.ok || submitResponse.status !== 200) {
            swal({
                icon: 'error',
                text: 'Une erreur est survenue'
            });
        }
    });
</script>

<!-- ... evenements sur les bouttons ... -->


    <script>
        document.getElementById("accorder").addEventListener("click", function() {
            // Spécifiez l'URL de la nouvelle page que vous souhaitez ouvrir
            var nouvellePageURL = "http://localhost/Iplans/fiche_message";
             console.log('click')
            // Ouvrir la nouvelle page dans une nouvelle fenêtre
            window.open(nouvellePageURL, "_blank");
        });
    </script>

<script>
    document.getElementById("accorder").addEventListener("click", function() {
        // Spécifiez l'URL de la nouvelle page que vous souhaitez ouvrir
        var nouvellePageURL = "http://localhost/Iplans/fiche_message";

        // Ouvrir la nouvelle page dans une nouvelle fenêtre
        window.open(nouvellePageURL, "_blank");
    });
</script>

<script type="module">
    const personList = document.getElementById("personList");

    try {
        const response = await fetch('<?= PERS_API_URL ?>');
        if (!response.ok) {
            throw new Error('Failed to fetch persons');
        }
        const persons = await response.json();

        for (const person of persons) {
            const option = document.createElement("option");
            option.value = person.NEng;
            option.text = `${person.nom} ${person.prenom}`;
            personList.appendChild(option);
        }
    } catch (error) {
        console.error(error);
    }
</script>


</html>

<?php

$content = ob_get_clean();
include 'layout.php';
?>