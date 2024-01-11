
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

// traitement des informations des employers
if (isset($_POST['ajouter_pers'])) {

// Get the form data
    $civilite = $_POST['civilite'];
    $genre = $_POST['genre']??0;
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cni = $_POST['cni'];
    $fait = $_POST['fait'];
    $expire = $_POST['expire'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel'];
    $telpro = $_POST['telpro'];
    $siteagence = $_POST['siteagence'];
    $direction = $_POST['direction'];
    $sousdirection = $_POST['sousdirection'];
    $service = $_POST['service'];
    $departement = $_POST['departement1'];
    $posteoccupe = $_POST['fonction'];
    $datenaissssance = $_POST['datenaissssance'];
    $lieunaissance = $_POST['lieunaissance'];
    $nompere = $_POST['nompere'];
    $nommere = $_POST['nommere'];
    $nomurgence = $_POST['nomurgence'];
    $numerourgence = $_POST['numerourgence'];
    $email = $_POST['email'];
    $emailpro = $_POST['emailpro'];


    $lundi1 = $_POST['lundi1']??0;
    $mardi1 = $_POST['mardi1']??0;
    $mercredi1 = $_POST['mercredi1']??0;
    $jeudi1 = $_POST['jeudi1']??0;
    $vendredi1 = $_POST['vendredi1']??0;
    $samedi1 = $_POST['samedi1']??0;
    $dimanche1 = $_POST['dimanche1']??0;

    $loge = $_POST['loge']??0;
    $assure = $_POST['assure']??0;
    $nouri = $_POST['nouri']??0;


    $nombreenfant = $_POST['nombreenfant'];
    $heuredebut = $_POST['heuredebut'];
    $heurefin = $_POST['heurefin'];
    $conventioncollective = $_POST['conventioncollective'];
    $echellon = $_POST['echellon'];
    $categorie = $_POST['categorie'];
    $salairebase = (int)$_POST['salairebase'];
    $heuresemaine = $_POST['heuresemaine'];
    $tauxhoriare = $_POST['tauxhoriare'];
    $gradesalarie = $_POST['gradesalarie'];
    $genresalarie2 = $_POST['genresalarie2'];
    $contrat = $_POST['contrat'];
    $identifiantinterne = $_POST['identifiantinterne'];
    $matriculeinterne = $_POST['matriculeinterne'];
    $matriculesocial = $_POST['matriculesocial'];
    $numenregistrement = $_POST['numenregistrement'];
    $NIU = $_POST['NIU'];
    $dateentree = $_POST['dateentree'];
    $datecontrat = $_POST['datecontrat'];
    $datedepart = $_POST['datedepart'];
    $motifdepart = $_POST['motifdepart'];

    $data = json_encode([
        "Site" => "mcs",
        "civilite" => $civilite,
        "nom" => $nom,
        "prenom" => $prenom,
        "Matricule" => $matriculeinterne,
        "MatriculeInterne" => $matriculeinterne,
        "cni" => $cni,
        "LieuDelivranceCNI" => $fait,
        "DateExpirationCNI" => $expire,
        "Fonction" => 0,
        "departement1" => $posteoccupe,
        "Direction" => $direction,
        "SousDirection" => $sousdirection,
        "Service" => $service,
        "Email" => $email,
        "EmailProfessionnel" => $emailpro,
        "phone" => $tel,
        "TelephoneProfessionne" => $telpro,
        "Adresse" => "douala",
        "Sexe" => $genre,
        "dnais" => $datenaissssance,
        "npere" => $nompere,
        "nmere" => $nommere,
        "vnais" => $lieunaissance,
        "nurg" => $nomurgence,
        "nuurg" => $numerourgence,
        "Convention" => $conventioncollective,
        "categorie" => $categorie,
        "Echelon" => $echellon,
        "SalaireBaseMensuel" => $salairebase,
        "genre_salarie" => $gradesalarie,
        "date_entree" => $dateentree,
        "date_contrat" => $datecontrat,
        "type_contrat" =>  $contrat,
        "motif_depart" => $motifdepart,
        "NombreEnfant" =>  $nombreenfant,

        "CodeAgence" => "252525"

    ]);
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => PERS_API_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
    ]);

    $response = curl_exec($curl);
    var_dump($response);
    header('Location: '.'/Iplans/employes');
    if ($response) {

        echo "<script>
             swal({
             icon: 'success',
             text: 'employes enregistree avec succès...',
             timer: 1000,
             onOpen: function(){
             swal.showLoading()
             }
             }).then(function(){
                 window.open('" . SITE_URL . "/employees','_self');
             });
            </script>";

    } else {
        echo "<script>
                    swal({
                        icon: 'error',
                        text: 'une erreur s est produite',
                    });
                </script>";
    }
}


ob_start();

?>
<?php
require_once "./include/config.php";
ini_set("date.timezone", "Africa/Douala");

//var_dump($d);
//exit();
?>
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/tableau.css">
<link rel="stylesheet" href="<?= SITE_URL ?>/assets/css/index5.css">
<link href="<?= SITE_URL ?>/assets/css/Divers.css" rel="stylesheet">

<link href="<?= SITE_URL ?>/assets/css/portrait.css" rel="stylesheet">
<link href="<?= SITE_URL ?>/assets/css/tableau.css" rel="stylesheet">
<link href="<?= SITE_URL ?>/assets/css/styleRH.css" rel="stylesheet">




<main>
    <div class="haut_avec_label mt-3"> <!--le haut avec les label-->
        <div class="d-flex">
            <div class="d-flex p-2">
                <span class="m-2">Site(Agence) </span>
                <select name="" id="" class="form-select p-2">
                    <option value="">Demo</option>
                </select>
            </div>
            <div class="d-flex p-2">
                <span class="m-2">Departement</span>
                <select name="" id="" class="form-select p-2">
                    <option value="">TOUS</option>
                </select>
            </div>
            <div class="d-flex p-2">
                <span class="m-2">Genre</span>
                <select name="" id="" class="form-select p-2">
                    <option value="">Permanent</option>
                </select>
            </div>

            <input type="checkbox" class="form-check-input mt-3" name="" id=" ">
            <span class="m-2">
                Archivés
            </span>
        </div>


        <!-- <div>
            <button>
                <img src="<?= SITE_URL ?>/assets/image/SAV.webp" alt="">
            </button>
        </div>
        -->
    </div> <!---fin le haut avec les label -->

    <div class="aphabet "> <!--debut lettre de l'aphabet-->
        <p class="a-z">A-Z</p>

        <p>A</p>
        <p>B</p>
        <p>C</p>
        <p>D</p>
        <p>E</p>
        <p>F</p>
        <p>G</p>
        <p>H</p>
        <p>I</p>
        <p>J</p>
        <p>K</p>
        <p>L</p>
        <p>M</p>
        <p>N</p>
        <p>O</p>
        <p>P</p>
        <p>Q</p>
        <p>R</p>
        <p>S</p>
        <p>T</p>
        <p>U</p>
        <p>V</p>
        <p>W</p>
        <p>X</p>
        <p>Y</p>
        <p>Z</p>

    </div> <!--fin lettre de l'alphabet-->




    <!-- zone de recherche -->
    <div class="container text-center" id="zone_recherche" style="display:none">
        <form>
            <input type="text" id="myInput" onkeyup="myFunction()" name="search" placeholder="Nom...">
        </form>
    </div>
    <!-- style de ma zone de recherche  -->
    <style>
        #myInput {
            width: 200px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 21px;
            background-color: white;
            background-image: url('<?= SITE_URL ?>/assets/img/searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 5px 20px 5px 40px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }

        #myInput:focus {
            width: 40%;
        }
    </style>

    <!-- fonction de recherche  -->

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <!-- fin zone de recherche  -->


    <div class="debut_tableau mt-3"> <!--debut tableau-->

        <table class="table table-striped table-hover  container" id="myTable">
            <thead class="table-success">

            <tr>
            <td role="columnheader">Options</td>
                 <td role="columnheader">id</td> 
                <td role="columnheader">Civilite</td>
                <td role="columnheader">Nom</td>
                <td role="columnheader">Prenom</td>
                <td role="columnheader">Fonction</td>
                <td role="columnheader">Telephone</td>
                <td role="columnheader">Pseudo</td>
                <td role="columnheader">Matricule</td>
                <td role="columnheader">Identifiant</td>
                <td role="columnheader">CNI</td>
                <td role="columnheader">Email</td>
                <td role="columnheader">DateNaissance</td>
                <td role="columnheader">Nom_du_Pere</td>
                <td role="columnheader">Nom_de_la_mere</td>
                <td role="columnheader">Ville_de_Naissance</td>
                <td role="columnheader">Nom_D'urgence</td>
                <td role="columnheader">Numero_D'urgence</td>
                <td role="columnheader">AgenceBanque</td>
                <td role="columnheader">CodeBanque</td>
                <td role="columnheader">CodeGuichetBanque</td>
                <td role="columnheader">NumeroCompletBanque</td>
                <td role="columnheader">CleRibBanque</td>
                <td role="columnheader">VcodeSwittBanque</td>
                <td role="columnheader">CodeUtilisateur</td>
                <td role="columnheader">Categorie</td>
                <td role="columnheader">Grade </td>
                <td role="columnheader">Convention</td>
                <td role="columnheader">Departement</td>
                <td role="columnheader">GenreSalarie</td>
                <td role="columnheader">Direction</td>
                <td role="columnheader">SousDirection</td>
                <td role="columnheader">Service</td>
                <td role="columnheader">MotifDepart </td>
                <td role="columnheader">DateSortie</td>
                <td role="columnheader">DateEntree</td>
                <td role="columnheader">GenreSalarie</td>
                <td role="columnheader">TypeContrat</td>
                <td role="columnheader">IDDate_Contrat</td>
                <td role="columnheader">IDDate_Sortie</td>
                <td role="columnheader">LieuDelivranceCNI</td>
                <td role="columnheader">DateExpirationCNI</td>
                <td role="columnheader">IDDateExpirationCNI</td>
                <td role="columnheader">IDDate_Contrat</td>
                <td role="columnheader">IDDate_Sortie</td>
            </tr>
            </thead>
            <tbody id="pers_table"> </tbody>
        </table>


    </div><!--fin de zone du tableau-->



    <form id="categie_form" >
        <div class="zonne_dinformation"> <!--zone d'information -->
            <div class="zone1 ">
                <div class="zone">
                    <label for="direction_filtre">Direction</label>
                    <select name="direction_filtre" id="direction_filtre" class="form-select ">
                        <option value="MEDICALE">MEDICALE</option>
                        <option value="TOUTES" selected>TOUTES</option>
                    </select>
                    <label for="sous_direction_filtre">Sous Dir~</label>
                    <select name="sous_direction_filtre" id="sous_direction_filtre" class="form-select ">
                        <option value="MEDICALE">MEDICALE</option>
                        <option value="TOUTES" selected>TOUTES</option>
                    </select>
                    <label for="services_filtre">Services</label>
                    <select name="services_filtre" id="services_filtre" class="form-select">
                        <option value="SSMEDICALE">SSMEDICALE</option>
                        <option value="TOUS" selected>TOUS</option>
                    </select>
                </div>
                <div class="zone">
                    <label for="grade_filtre">Grade</label>
                    <select name="grade_filtre" id="grade_filtre" class="form-select">
                        <option value="CADRE_SUPERIEUR">CADRE SUPERIEUR</option>
                        <option value="TOUS" selected>TOUS</option>
                    </select>
                    <label for="convention_filtre">Convention</label>
                    <select name="convention_filtre" id="convention_filtre" class="form-select">
                        <option value="FONCTION">FONCTION</option>
                        <option value="TOUTES" selected>TOUTES</option>
                    </select>
                    <label for="categorie_filtre">Categ~</label>
                    <select name="categorie_filtre" id="categorie_filtre" class="form-select">
                        <option value="0">0</option>
                        <option value="03">03</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="8">8</option>
                        <option value="A">A</option>
                        <option value="I">I</option>
                        <option value="IX">IX</option>
                        <option value="VI">VI</option>
                        <option value="XII">XII</option>
                        <option value="TOUTES" selected>TOUTES</option>


                    </select>
                    <label for="fonction_filtre">Fontion</label>
                    <select name="fonction_filtre" id="fonction_filtre" class="form-select">
                        <option value="TOUTES" selected>TOUTES</option>
                        <option value="AGENT_D_ENTRETIEN">AGENT D'ENTRETIEN</option>
                        <option value="AIDE_MAGSINIER">AIDE MAGSINIER</option>
                        <option value="ASSISTANCE_TECHNIQUE">ASSISTANCE TECHNIQUE</option>
                        <option value="CHAUFFEUR_COURRIER">CHAUFFEUR/COURRIER </option>
                        <option value="COMMERCIAL">COMMERCIAL</option>
                        <option value="COMPTABLE">COMPTABLE</option>
                        <option value="CHAUFFEUR_LIVREUR">CHAUFFEUR/LIVREUR</option>
                        <option value="CONTROLLEUR_DE_GESTION">CONTROLLEUR DE GESTION</option>
                        <option value="DIRECTEUR_COMMERCIAL">DIRECTEUR COMMERCIAL</option>
                        <option value="DIRECTEUR_GENERAL">DIRECTEUR GENERAL</option>
                        <option value="DIRECTRICE_GENERALE_ADJOINTE">DIRECTRICE GENERALE ADJOINTE</option>
                        <option value="FACTURIERE">FACTURIERE</option>
                        <option value="GARDIEND_DE_NUIT">GARDIEND DE NUIT</option>
                        <option value="HOETESSE_DE_VENTES">HOETESSE DE VENTES</option>
                        <option value="IT">IT </option>
                        <option value="MAGASINIER">MAGASINIER</option>
                        <option value="PEDIATRE">PEDIATRE</option>
                        <option value="PRESTATAIRE">PRESTATAIRE</option>
                        <option value="PROJECT_MANAGER">PROJECT MANAGER</option>
                        <option value="RECEPTIONNISTE">RECEPTIONNISTE</option>
                        <option value="RESPONSABLE_DU_PERSONNEL">RESPONSABLE DU PERSONNEL</option>
                        <option value="RESPONSABLE_D_ENTREPOT">RESPONSABLE D ENTREPOT</option>
                        <option value="RESPONSABLE_PROMO">RESPONSABLE PROMO</option>
                    </select>
                </div>
            </div>



            <div class="zone_de_categorie"><!--zone de categorie-->
                <div> <!--sexe-->
                    <p style="font-size: 15px;">
                        Sexe
                    </p>
                    <div>
                        <input type="radio" name="genre" class="form-check-input" value="male">
                        <label for="">M</label>
                    </div>
                    <div>
                        <input type="radio" name="genre" class="form-check-input" value="female">
                        <label for="">F</label>
                    </div>
                    <div>
                        <input type="radio" name="genre" class="form-check-input" value="all" checked>
                        <label for="">Tous</label>
                    </div>
                </div>
                <div> <!--Prestataire-->
                    <p style="font-size: 15px;">
                        Prestataire
                    </p>
                    <div>
                        <input type="radio" class="form-check-input" name="prestataire" value="no">
                        <label for="">Non</label>
                    </div>
                    <div>
                        <input type="radio" class="form-check-input" name="prestataire" value="yes">
                        <label for="">Oui</label>
                    </div>
                    <div>
                        <input type="radio" class="form-check-input" name="prestataire" value="all" checked>
                        <label for="">Tous</label>
                    </div>
                </div>
                <div> <!--Conforme-->
                    <p style="font-size: 15px;">
                        Conforme
                    </p>
                    <div>
                        <input type="radio" class="form-check-input" name="conforme" value="no">
                        <label for="">Non</label>
                    </div>
                    <div>
                        <input type="radio" class="form-check-input" name="conforme" value="yes">
                        <label for="">Oui</label>
                    </div>
                    <div>
                        <input type="radio" class="form-check-input" name="conforme" value="all" checked>
                        <label for="">Tous</label>
                    </div>
                </div>
                <div> <!--Periode de naissance-->
                    <p style="font-size: 15px;">
                        Periode Naissance
                    </p>
                    <div>
                        <label for="">Actif</label>
                        <input type="checkbox" class="form-check-input" name="actif" id="">
                    </div>
                    <div>
                        <input type="date" id="date_debut" value="<?= date('Y-m-d') ?>">
                        <label for="">Debut</label>
                    </div>
                    <div>
                        <input type="date" id="date_fin" value="<?= date('Y-m-d') ?>">
                        <label for="">Fin</label>
                    </div>
                </div>
            </div>
    </form>
    </div><!--fin d'information-->

    <!--debut de mes boutton-->
    <div class="container-fluid d-flex justify-content-between mb-4">
        <div class="col-sm-9 ">

            <button class="bouton Nouveau" id="new_data"><i class="fas fa-external-link-alt svg"></i>Nouveau</button>
            <button class="bouton" id="open_data"><i class="fas fa-folder-open svg"></i>Ouvrir</button>
            <button class="bouton" id="delete_data"><i class="fas fa-trash svg"></i>Suprimer</button>
            <button class="bouton" id="print_table"><i class="fas fa-print svg"></i>Imprimer</button>
            <button class="bouton"> <i class="fas fa-clock svg"></i>Pointages</button>
            <button class="bouton email"> <i class="fas fa-envelope svg"></i>Envoyer un Email </button>
        </div>
        <div class="col-sm-3 d-flex justify-content-end ">
            <button class="bouton" id="recherche"> <i class="fas fa-search svg"></i></i>Recherche</button>
            <button class="bouton fermer" id="fermons"> <i class="fas fa-close svg"></i>Fermer</button>
        </div>

    </div>
    <div style='visibility: hidden;'>
        <p>juste de lespace</p>
    </div>
    <style>
        .container-fluid {
            margin-bottom: 4rem;
        }

        .bouton {
            background-color: #238fce;
            color: #fff;
            padding: 8px 20px;
            font-size: 17px;
            font-weight: medium;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.4s ease;
            width: max-content;
            height: 50px;
            margin-right: 8px;
        }

        .bouton:hover {
            background-color: #0b9444;
        }

        .fermer {
            background-color: #BB2D3B !important;
        }

        .svg {
            width: 19px !important;
            margin-right: 3px !important;
        }

        .zone select {
            width: 100%;
            height: 45px;

        }

        .header {
            display: none;
        }

        .aphabet p {
            background-color: #248CCC !important;
            width: 100%;
            text-align: center;

        }

        .aphabet .a-z {
            background-color: white !important;
        }


        body {
            padding: 0 20px 0 20px !important;
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


    <!--fin de mes boutton-->

    <!--
    <div class="cont_button_bas" style="display:none;">
        <div style="display: flex; justify-content: center; align-items: center; gap: 10px; width: max-content;">



            <button class="btn_bass bout Nouveau" >Nouveau</button>
            <button class="btn_bass" >Ouvrir</button>
            <button class="btn_bass" >Suprimer</button>
            <button class="btn_bass"  id="print_table">Imprimer</button>
            <button class="btn_bass" >Pointages</button>
            <button class="btn_bass email" >Envoyer un Email47 </button>
        </div>
        <div style="display: flex; gap: 10px;">
            <button class="btn_bass" >Recherche</button>
            <button class="btn_bass" >Fermer</button>
        </div>
    </div> -->
</main>

<!--- debut du formulaire generale---->

<form data-form enctype="multipart/form-data" method="post" id='' action="">



    <div class="cont_employer " style="display: none;">
        <!----employer formulaire------->
        <div class="contenue_employers mb-4">
            <div class="cont_titre ">
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h2 class="fiche_sala">Fiche Salarié</h2>
                </div>

                <div>
                    <button class="close_window" id="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close"></i></button>
                </div>
            </div>


            <div class="cont_employer2 mb-3">
                <div class="list_gauche">
                    <div class="se1">
                        <p>Mission</p>
                        <p>Evenements</p>
                        <p>La paie</p>
                        <p>Congés</p>
                    </div>
                    <div class="se1">
                        <p>Frais de Deplacement</p>
                        <p>Acomptes</p>
                        <p class="divers">Divers</p>
                        <p class="acti">Employés</p>
                    </div>
                </div>
                <style>
                    .list_gauche:hover {
                        cursor: pointer;

                    }
                </style>


                <div class="econte row" >

                   <div class="col">

                      <div class="econte1 employe47 px-1" id='47' style='width:100%;border-right: 2px solid gray;'>
                        <h1 style="background-color: black;color: white;width:100%; padding: 12px;">Employé</h1>
                        <section class="div_1">
                            <h3 style="font-size: 25px;">Identité</h3>
                            <div class="idntite1">
                                <div>
                                    <label for="">Civilité</label>
                                    <select name="civilite" class="form-select form-select" id='civilite' style="width: 100%;">
                                        <option value="Monsieur">Monsieur</option>
                                        <option value="Madame">Madame</option>
                                    </select>
                                    <div style="display: flex; flex-direction: column;">
                                        <h3 style="margin-top: -10px; margin-left:-40px;">sexe</h3>
                                        <div style="display: flex ; gap: 7px; margin-top: -7px;">
                                            <label for="">Masculin</label>

                                            <input type="radio" value="1" name="genre">

                                            <label for="">Feminin</label>
                                            <input type="radio" value="1" name="genre">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="idntite2">
                                <label for="" class="mt-3">Nom</label>
                                <input type="text" class="form-control mt-3" name="nom" id='nom' required>
                            </div>
                            <div class="idntite3">
                                <label for="" class="mt-3">Prenom</label>
                                <input type="text" class="form-control mt-3" name="prenom" id='prenom'>
                            </div>
                            <div class="idntite4">
                                <label class="mt-3" for="" style="width: 80%">N* Carte national</label>
                                <input type="text" class="form-control mt-3" name="cni" id='cni'>
                                <label class="mt-3" for="" style="width: 40%" >Fait a</label>
                                <input type="text" class="form-control mt-3" name="fait" id='LieuDelivranceCNI' required>
                                <label class="mt-3" for="" style="width: 70%">Expire le</label>
                                <input type="date" name="expire" id='IDDateExpirationCNI' class="form-control mt-3" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="idntite5">
                                <label class="mt-3" for="">Adresse</label>
                                <input type="text" class="form-control mt-3" name="adresse">
                            </div>
                            <div class="idntite6">
                                <label class="mt-3" for="">Telephone</label>
                                <input type="tel" class="form-control mt-3" name="tel">
                            </div>
                            <div class="idntite7">
                                <label class="mt-3" for="">Telephone Pro~</label>
                                <input type="tel" class="form-control mt-3" name="telpro">
                            </div>
                            <div class="idntite8">
                                <label class="mt-3" for="">Site (Agence)</label>
                            <input type="text" class="form-control mt-3" name="siteagence" id="">
                            </div>
                            <div class="idntite9">
                                <label class="mt-3" for="">Direction </label>
                                <input type="text" class="form-control mt-3" name="direction" id="Direction">
                            </div>
                            <div class="idntite10">
                                <label class="mt-3" for="">Sous-Direction </label>
                               <input type="text" class="form-control mt-3" name="sousdirection" id="SousDirection">
                            </div>
                            <div class="idntite11">
                                <label class="mt-3" for="">Service </label>
                               <input type="text" class="form-control mt-3" name="service" id='Service' required>
                            </div>
                            <div class="idntite12">
                                <label class="mt-3" for="">Departement </label>
                                <input type="text" class="form-control mt-3" name="departement1" id='departement1' required>
                            </div>
                            <div class="idntite13">
                                <label class="mt-3" for="">Poste Occupé </label>
                               <input type="text" class="form-control mt-3" name="fonction" id='fonction' required>
                            </div>
                            <style>
                                .form-vert {
                                    background-color: #3498db;
                                }

                                .form-bleu {
                                    background-color: #0b9444
                                }

                                .form-vert>select option {
                                    background-color: #3498db;
                                }

                                .form-bleu>select option {
                                    background-color: #0b9444
                                }
                            </style>
                        </section>

                        <!-- css interne de employer -->

                        <style>
                            .svg-close {
                                width: 25px !important;
                                color: white;
                            }

                            .ico_emplye {
                                margin-right: 3px !important;
                            }

                            .se1 p {
                                color: black;
                            }

                            /* identite css */
                            .div_1 {
                                padding-left: 10px;
                            }

                            .div_1 label {
                                font-size: 18px
                            }

                            /* taille du containeur*/
                            .contenue_employers {
                                height: 600px;
                                overflow: auto;
                                width:90%!important
                            }
                        </style>



                        <div class="div_2 bordure">
                            <h4 class='p-2 mt-3 '>Info Personnelles</h4>
                            <div>
                                <div class="te1">
                                    <label class="mt-3" for="">Date de Naissance</label>
                                    <input type="date" class="form-control mt-3" name="datenaissssance" id="dnais" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div>
                                    <label class="mt-3" for="" >Lieu de Naissance</label>

                                    <input type="text" class="form-control mt-3" style="width: 80%; margin-right: 30%;" name="lieunaissance" id='vnais'>
                                </div>
                                <div>
                                    <label class="mt-3" for="">Nom du Pere</label>
                                    <input type="text" class="form-control mt-3" name="nompere" id="npere">
                                </div>
                                <div>
                                    <label class="mt-3" for="">Nom de la mere</label>
                                    <input type="text" class="form-control num mt-3" name="nommere" id="nmere">
                                </div>
                                <div>
                                    <label class="mt-3" for="">nom durgence</label>
                                    <input type="text" class="form-control mt-3" name="nomurgence" id="nurg">
                                </div>
                                <div>
                                    <label class="mt-3" for="">Numero D'urgence</label>
                                    <input type="tel" class="form-control num mt-3" name="numerourgence" id="nuurg">
                                </div>
                                <div>
                                    <label class="mt-3" for="">Adresse email</label>
                                    <input type="email" class="form-control mt-3" name="email" id="email">
                                </div>
                                <div>
                                    <label class="mt-3" for="">Adresse email pro~</label>
                                    <input type="email" class="form-control mt-3" name="emailpro" id="">
                                </div>
                                <div class="situation">
                                    <h3 class='mt-3'>situation matrimonial</h3>
                                    <div>
                                        <div style="display: flex; align-items: center;
                                        justify-content: center; margin-top: 20px;">
                                            <label for="">Nombre d'enfants</label>
                                            <input type="number" class="form-control " value="1" class="enfant" name="nombreenfant">
                                        </div>
                                        <div>

                                            <div style="display: flex; flex-direction: column;">
                                                <p>Celebataire <input type="radio" id="radio1" name="optradio" value="option1" checked></p>
                                                <p>Marié <input type="radio" id="radio1" name="optradio" value="option1"></p>
                                                <p>Divorcé <input type="radio" id="radio1" name="optradio" value="option1"></p>
                                                <p> <input type="radio" id="radio1" name="optradio" value="option1">Veuf \ Veuve</p>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>










                    </div>
                     <div class="col px-1 diver47" id='diver47' style='display:none;width:100%;'>
                               <div class="econte1 gauche-divers" style="border-right: 2px solid gray;">
                                   <h1 style="background-color: black;color: white; padding: 12px;">Divers</h1>
                                   <div style="padding-top: 10px;">
                                       <ul class="pagination">
                                           <li class="page-item d-flex justify-content-center"><a id='activer' class="page-link page-link0 px-4  m-0 text-dark  " href="#"> <span>Categorie</span></a></li>
                                           <li class="page-item"><a class="page-link page-link0 px-4 text-dark m-0 " href="#"><span> Banque</span></a></li>


                                       </ul>
                                   </div>
                                   <div class="Autre"> <!--le carre autre commence ici -->
                                       <span style="font-size: 30px;margin-left:10px ;">Autres</span>
                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Convention Collective</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <select class="form-select form-select-sm" name="conventioncollective" id="Convention" style='background-color:#238fce ;'>
                                                       <option></option>
                                                       <option>FONCTIONNAIRE</option>
                                                   </select>
                                                   <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt=""></button>
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex;   gap: 7px;">
                                               <label for="">echellon</label>
                                               <select class="form-select form-select-sm" style='background-color:#238fce ;' name="echellon" id="Grade">
                                                   <option value="">E</option>
                                               </select>
                                               <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: 20px;"></button>
                                           </div>
                                       </div><!--ligne 1 fini ici-->


                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content:space-between; align-items: center; width: 100%; ">
                                               <p>Categorie</p>
                                               <div style="display: flex; justify-content: left; width: 50%; gap: 7px;">
                                                   <select class="form-select form-select-sm" style='background-color:#238fce ;' name="categorie" id="categorie" style="width: 150px;">
                                                       <option value="">VI</option>
                                                   </select>
                                                   <button style="height: 25px; height: 25px; padding-top:2px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: 20px;"></button>
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex;   gap: 7px;">
                                               <label for="">Indice</label>
                                               <select class="form-select form-select-sm" style='background-color:#238fce ;' name="" id="" style="width: 100%;">
                                                   <option value="">E</option>
                                               </select>
                                               <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: 20px;"></button>
                                           </div>
                                       </div>


                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Salaire De base Par semaine</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <input class="form-control " type="number" name="salairebase">
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex;  ">
                                               <input type="checkbox" class="form-check-input" name="loge" id="" value="oui">
                                               <label for=""><b>logé</b></label>
                                           </div>
                                       </div>


                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Heure par Semaine</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <select class="form-select form-select-sm" name="heuresemaine" id="" style="width: 140px;" style='background-color:#238fce ;'>
                                                       <option value="0">0</option>
                                                       <option value="5">5</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex; ">
                                               <input type="checkbox" class="form-check-input" name="nouri" id="" value="oui">
                                               <label for=""><b>Nourie</b></label>
                                           </div>
                                       </div>


                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Taux Horaires</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <select class="form-select form-select-sm" name="tauxhoriare" id="" style="width: 140px;">
                                                       <option value="0">0</option>
                                                       <option value="5">5</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex;   ">
                                               <input type="checkbox" class="form-check-input" name="assure" id="" value="oui">
                                               <label for=""><b>Assuré</b></label>
                                           </div>
                                       </div>



                                       <div style="display: flex; justify-content: center; align-items: center; width: 67%;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Cumul Heure</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <input type="text" style='background-color:#0b9444 ;' class="form-control " name="cumulheure" id="">
                                               </div>
                                           </div>
                                       </div>


                                       <div style="display: flex; justify-content: center; align-items: center; width: 67%;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Grade de Salarié</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <input type="text" style='background-color:#FFFF00 ;' class="form-control " name="gradesalarie" id="" style="width: 70%; ">
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div style="width: 100%;  height: 200px; "><!--Diplomes-->
                                       <p>
                                           <b>Diplomes</b>
                                       </p>
                                       <div style="display: flex; justify-content: right; align-items: end;  width: 100%; height: 80%;">
                                           <div style="display: flex; padding-left:0px;padding-right:0px; flex-direction: column; align-items: end; justify-content: space-between; height: 100%;">
                                               <button style="height: 35px; height: 35px; padding-top:2px; border:2px solid gray; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: 10px;"></button>
                                               <button style="height: 35px; height: 35px; padding-top:2px; border:2px solid gray; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width: 20px;"></button>
                                           </div>
                                           <div style="width: 100%; height: 100%; padding-left:0px;">
                                               <div style="width: 100%; height: 100%; padding-left:0px; padding-right:0px; border: 1px solid gray;">

                                                   <div style="display: flex; width: 100%; height: 0px;">

                                                   </div>
                                                   <style>
                                                       .econte1 div {}
                                                   </style>

                                                   <table class="table table-bordered">
                                                       <thead>
                                                           <tr class='table-dark text-center'>
                                                               <th class='px-5'>Nom</th>
                                                               <th class="text-center">Année</th>
                                                               <th class="text-center">Mention</th>

                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                           <tr class='table-primary'>
                                                               <td>
                                                                   <p>
                                                                   <p>
                                                               </td>
                                                               <td></td>
                                                               <td></td>





                                                           </tr>
                                                       </tbody>
                                                   </table>

                                               </div>
                                           </div>
                                       </div>

                                   </div>
                                   <style>
                                       .bleauta {
                                           background: #2169EC !important;
                                       }
                                   </style>

                                   <div> <!--contrat-->
                                       <p>
                                           <b>Contrat</b>
                                       </p>
                                       <div style="display: flex; align-items: center; justify-content: space-around;">
                                           <label for="">Genre de Salarié</label>
                                           <select class="form-select form-select-sm" name="genresalarie2" id="">
                                               <option value="PERMANENT">PERMANENT</option>
                                               <option value="STAGIAIRE">STAGIAIRE</option>
                                           </select>
                                           <button style="height: 25px; height: 25px; padding-top:3px; padding-right:45px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: 20px;"></button>
                                           <label for="">Type De Contrat</label>
                                           <select class="form-select form-select-sm" name="contrat" id="type_contrat">
                                               <option value=" CDD">
                                                   CDD
                                               </option>
                                               <option value=" CDI">
                                                   CDI
                                               </option>
                                           </select>
                                           <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: 20px;"></button>
                                       </div>
                                       <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger'>Identifiant Interne</label>
                                           <input type="text" class="form-control " style='background-color:#FFFF00 ;' name="identifiantinterne" id="" style=" width: 60%;">
                                       </div>
                                       <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger'>Matricule Interne</label>
                                           <input type="text" class="form-control " style='background-color:#238fce;' name="matriculeinterne" id="" style=" width: 60%;">
                                       </div>
                                       <div style="width: 100%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger' style=" width: 40%;">Matricule Social (CNPS)</label>
                                           <input type="text" class="form-control " name="matriculesocial" id="" style=" width: 40%;">
                                           <label for="" class='text-danger' style="width: 20%; padding-left: 10px;">N* Enreg</label>
                                           <input type="number" class="form-control " style="width: 15%;" name="numenregistrement">
                                       </div>
                                       <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger'>NIU (Impots)</label>
                                           <input type="text" class="form-control " name="NIU" id="" style=" width: 60%;">
                                       </div>
                                       <div>
                                           <p>
                                               <b>Entrée</b>
                                           </p>
                                           <div style="width: 60%;   display: flex; justify-content: space-around;">
                                               <label for="">Entrée</label>
                                               <input type="date" class="form-control " name="dateentree" id="date_entree" value="<?= date('Y-m-d') ?>">
                                           </div>
                                           <div style="width: 60%;  display: flex; justify-content: space-around;">
                                               <label for="">Date de Contrat</label>
                                               <input type="date" class="form-control " name="datecontrat" id="IDDate_Contrat" value="<?= date('Y-m-d') ?>">
                                           </div>
                                       </div>
                                       <div>
                                           <p>
                                               <b>Depart</b>
                                           </p>
                                           <div style="width: 100%;   display: flex; justify-content: space-evenly; align-items: center;">
                                               <label for="" style="width: 100%; ">Date de Depart</label>
                                               <input type="date" class="form-control " name="datedepart" id="IDDate_Sortie" style="width: 500px;">
                                               <div>
                                                   <input type="checkbox" name="" id="" value="archive">
                                                   <label for="">Archivé</label>
                                               </div>
                                           </div>
                                           <div style="width: 71%;   display: flex; justify-content: space-around;">
                                               <label for="">Motif De Depart</label>
                                               <input type="text" class="form-control " style='background-color:#238fce;' name="motifdepart" id="motif_depart">

                                           </div>
                                       </div>
                                   </div>
                               </div>


                           </div>


                   </div>

                   <div class="col" style='margin-top:200px'>

                    <section class="econte2" style='width:100%'>
                        <div class="class1 mx-2">
                            <div class="class2 spec1">
                                <div class="gauche">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
                                        <label class="form-check-label h4" for="check1">Prestataire interne ?</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
                                        <label class="form-check-label h4 text-danger" for="check1">Prestataire externe ?</label>
                                    </div>


                                </div>
                                <div class="class4">
                                    <div>
                                        <label for="" class=' gras mt-4'>Carte a puce</label>
                                        <div>
                                            <button><img src="<?= SITE_URL ?>/assets/img/floppy-disk.png" alt="" style="width: max-content; height: 35px;"></button>
                                            <button><img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 40px;"></button>


                                        </div>
                                    </div>
                                    <div>
                                        <label class=' gras mt-3' for="">Biometrie</label>
                                        <div>
                                            <button><img src="<?= SITE_URL ?>/assets/img/floppy-disk.png" alt="" style="width: max-content; height: 35px;"></button>
                                            <button><img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 40px;"></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- css pour les bouton -->
                                <style>
                                    .class4 img {
                                        width: 33px !important;
                                    }

                                    .gras {
                                        font-weight: 600;
                                    }

                                    .spec2,
                                    .spec1 {
                                        justify-content: center !important;
                                    }
                                </style>

                            </div>

                            <div class=" spec2">
                                <div class="preview-img">
                                    <img src="<?= SITE_URL ?>/assets/img/images.png" class='placeholder-img' alt="">
                                </div>
                                <div class='zone'>
                                    <div class="roww">
                                        <input type="file" class="file-input" accept="image/*" hidden>
                                        <button style='margin-left: 24px;'>
                                            <img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 35px;">
                                        </button>
                                        <button class="choose-img">
                                            <img class="choose-img" src="<?= SITE_URL ?>/assets/img/camera.png" alt="" style="width: max-content; height: 35px;">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- css pour les bouton et images -->
                            <style>
                                .spec2 {
                                    height: 100%;
                                    width: 100%;
                                    display: flex;
                                    flex-direction: column;
                                    justify-content: space;
                                    align-items: flex-end;
                                }

                                .placeholder-img {
                                    width: 300px !important;
                                    height: 400px !important;
                                }

                                .preview-img img {
                                    max-width: 490px;
                                    min-height: 335px;
                                    width: 100%;
                                    height: 100%;
                                    object-fit: contain;
                                }

                                .preview-img {
                                    display: flex;
                                    overflow: hidden;
                                    align-items: center;
                                    justify-content: center;
                                    margin-left: 20px;
                                    border: 2px solid #aaa;
                                    border-radius: 10px;
                                }

                                .zone {
                                    justify-content: flex-start !important;
                                    gap: 10px;
                                }

                                section button {
                                    border: 1px solid gray;
                                    border-radius: 5px;
                                    transition: background-color 0.3s ease, box-shadow 0.3s ease;

                                }

                                section button:hover {
                                    background-color: #D3D3D3;
                                    ;
                                    /* Gris foncé */
                                    box-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
                                }
                            </style>
                        </div>

                        <div class="class5">
                            <div class="class6">
                                <ul class="pagination">
                                    <li class="page-item d-flex justify-content-center"><a id='activer' class="page-link page-link0 px-4  m-0 text-dark  " href="#"> <span>Horaires</span></a></li>
                                    <li class="page-item"><a class="page-link page-link0 px-4 text-dark m-0 " href="#"><span> Services</span></a></li>
                                    <li class="page-item "><a class="page-link page-link0 px-4 text-dark   " href="#"><span>Messagerie</span></a></li>
                                    <li class="page-item"><a class="page-link page-link0 px-4 text-dark  " href="#"><span>Biometrie</span></a></li>
                                    <li class="page-item espace"><a class="page-link px-2 text-dark " href="#"><span>❮❮</span></a></li>
                                    <li class="page-item"><a class="page-link px-2 text-dark" href="#"><span>❯❯</span></a></li>

                                </ul>

                            </div>
                            <div class="class7">
                                <div class="class8">
                                    <div class="qwe1"><br>
                                        <div class="ligne">

                                        </div>
                                    </div>
                                    <label class='option-horaire'>Options horaires </label>
                                    <div class="qwe2">

                                        <div class="activer">
                                            <input type="checkbox" class="form-check-input" name="active" id="" value="1">

                                            <lable>Activer</lable>

                                        </div>
                                        <div class="opt">
                                            <div class="option_debut">
                                                <label for="">Début Option</label>
                                                <input type="time" name="heuredebut" class='form-control' id="" value="<?= date('H:i') ?>">
                                            </div>
                                            <div class="Option_fin">
                                                <label for="">Fin Option</label>
                                                <input type="time" name="heurefin" class='form-control' id="" value="<?= date('H:i') ?>">
                                            </div>
                                        </div>
                                        <div class="btn_bas">


                                            <button>Ajouter<img src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;"></button>
                                            <button>Retirer<img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
                                        </div>

                                    </div>
                                </div>
                                <div class="class9">
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="lundi1" id="" value="1">
                                        Lundi
                                    </div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="mardi1" id="" value="1">
                                        Mardi
                                    </div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="mercredi1" id="" value="1">
                                        Mercredi
                                    </div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="jeudi1" id="" value="1">
                                        Jeudi
                                    </div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="vendredi1" id="" value="1">
                                        Vendredi
                                    </div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="samedi1" id="" value="1">
                                        Samedi
                                    </div>
                                    <div>
                                        <input type="checkbox" class="form-check-input" name="dimanche1" id="" value="1">
                                        Dimanche
                                    </div>

                                </div>
                            </div>

                            <style>
                                .option-horaire {
                                    font-size: 25px;
                                    font-weight: 500;
                                }
                            </style>


                            <div>

                            </div>
                        </div>

                        <style>
                            .pagination {
                                width: 100%;

                            }

                            .pagination span {
                                font-size: 21px;
                                font-weight: 500;
                            }

                            .pagination li {
                                border: 0px solid gray;
                            }

                            .espace {
                                margin-left: 30px;
                            }

                            #activer {
                                background: white !important;
                                border: 0px;
                            }

                            .page-link0 {
                                background: #DEE2E6 !important;
                            }

                            /* .page-item{
                            display:flex;
                            text-content:center;
                        } */
                        </style>

                    </section>
                   </div>





                    <!-- css pour la div 2 -->
                    <style>
                        .div_2 label {
                            font-size: 18px
                        }

                        .slectdate {
                            height: 31px !important;
                        }

                        .num {
                            margin-top: 1rem !important;
                        }

                        .situation p,
                        label {
                            font-size: 18px
                        }

                        .div_2 input[type="radio"] {
                            width: 15% !important;
                            height: 19px !important;
                        }


                        .bordure {
                            padding-left: 10px;
                        }

                        .cont_employer2 {
                            height: 205%;
                            padding-left: 7px;
                        }

                        .se1 p {
                            font-size: 17px;
                            font-weight: 600;
                        }

                        .spec1 {
                            justify-content: space-around;
                        }
                    </style>







                </div>
            </div>


            <div class="option47 py-2">
                <div style="width: 50%; padding-left: 30px;">
                    <button type="submit" name="ajouter_pers">Ajouter<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>


                <div style="width: 50%; display: flex; gap: 20px;">
                    <button class="btn1">❮❮</button>

                    <button class="btn2">❯❯</button>
                </div>

                <div style="width: 100%; display: flex; justify-content: space-around;">
                    <button>Recherche<img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 20px;"></button>
                    <button>Imprimer<img src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;"></button>
                    <button>Vider<img src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;"></button>

                </div>

                <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                    <button class='close_window' id='fermer'>Fermer<img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>

            </div>

        </div>
        <style>
            .option47 {
                display: flex;
                position: fixed;
                top:550px;
                left:5%;
                background-color:#fff;

                justify-content: space-around;
                align-items: center;
                 
                width: 90%;
               
                 z-index: 1;
            }

            .option47 button {
                width: 110px;
                height: 36px;
                border: 1px solid gray;
                border-radius: 5px;
            }
        </style>
    </div>
    <!-----divers----->


    <!----deuxieme formulaire dans employee----->
    <div class="divers_cont" style="display: none;">
        <main>
            <div class="cont_employer">
                <div class="contenue_employers">
                    <div class="cont_titre ">
                        <div style="display: flex;">
                            <img src="<?= SITE_URL ?>/assets/image/la%20terre.webp" alt="" class="ico_emplye">
                            <h2 class="fiche_sala">Fiche Salarié</h2>
                        </div>

                        <div>
                            <button class="close_window4" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close"></i></button>
                        </div>
                    </div>


                    <div class="cont_employer2">
                        <div class="list_gauche">
                            <div class="se1">
                                <p>Mission</p>
                                <p>Evenements</p>
                                <p>La paie</p>
                                <p>Congés</p>
                                <style>
                                    .se1 {
                                        border-left: 2px solid #fff;
                                    }
                                </style>
                            </div>
                            <div class="se1">
                                <p>Frais de Deplacement</p>
                                <p>Acomptes</p>
                                <p class="acti">Divers</p>
                                <p class="employers_btn">Employés</p>
                            </div>
                        </div>


                        <div class="econte row" style=" ">

                           <div class="col p-1">
                               <div class="econte1 gauche-divers" style="border-right: 2px solid gray;      display:none">
                                   <h1 style="background-color: black;color: white; padding: 12px;">Divers</h1>
                                   <div style="padding-top: 10px;">
                                       <ul class="pagination">
                                           <li class="page-item d-flex justify-content-center"><a id='activer' class="page-link page-link0 px-4  m-0 text-dark  " href="#"> <span>Categorie</span></a></li>
                                           <li class="page-item"><a class="page-link page-link0 px-4 text-dark m-0 " href="#"><span> Banque</span></a></li>


                                       </ul>
                                   </div>
                                   <div class="Autre"> <!--le carre autre commence ici -->
                                       <span style="font-size: 30px;margin-left:10px ;">Autres</span>
                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Convention Collective</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <select class="form-select form-select-sm" name="conventioncollective" id="" style='background-color:#238fce ;'>
                                                       <option></option>
                                                       <option>FONCTIONNAIRE</option>
                                                   </select>
                                                   <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt=""></button>
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex;   gap: 7px;">
                                               <label for="">echellon</label>
                                               <select class="form-select form-select-sm" style='background-color:#238fce ;' name="echellon" id="">
                                                   <option value="">E</option>
                                               </select>
                                               <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: 20px;"></button>
                                           </div>
                                       </div><!--ligne 1 fini ici-->


                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content:space-between; align-items: center; width: 100%; ">
                                               <p>Categorie</p>
                                               <div style="display: flex; justify-content: left; width: 50%; gap: 7px;">
                                                   <select class="form-select form-select-sm" style='background-color:#238fce ;' name="categorie" id="" style="width: 150px;">
                                                       <option value="">VI</option>
                                                   </select>
                                                   <button style="height: 25px; height: 25px; padding-top:2px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: 20px;"></button>
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex;   gap: 7px;">
                                               <label for="">Indice</label>
                                               <select class="form-select form-select-sm" style='background-color:#238fce ;' name="" id="" style="width: 100%;">
                                                   <option value="">E</option>
                                               </select>
                                               <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: 20px;"></button>
                                           </div>
                                       </div>


                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Salaire De base Par semaine</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <input class="form-control " type="number" name="salairebase">
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex;  ">
                                               <input type="checkbox" class="form-check-input" name="loge" id="" value="oui">
                                               <label for=""><b>logé</b></label>
                                           </div>
                                       </div>


                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Heure par Semaine</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <select class="form-select form-select-sm" name="heuresemaine" id="" style="width: 140px;" style='background-color:#238fce ;'>
                                                       <option value="0">0</option>
                                                       <option value="5">5</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex; ">
                                               <input type="checkbox" class="form-check-input" name="nouri" id="" value="oui">
                                               <label for=""><b>Nourie</b></label>
                                           </div>
                                       </div>


                                       <div style="display: flex; justify-content: center; align-items: center;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Taux Horaires</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <select class="form-select form-select-sm" name="tauxhoriare" id="" style="width: 140px;">
                                                       <option value="0">0</option>
                                                       <option value="5">5</option>
                                                   </select>
                                               </div>
                                           </div>
                                           <div style="width: 50% ; display: flex;   ">
                                               <input type="checkbox" class="form-check-input" name="assure" id="" value="oui">
                                               <label for=""><b>Assuré</b></label>
                                           </div>
                                       </div>



                                       <div style="display: flex; justify-content: center; align-items: center; width: 67%;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Cumul Heure</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <input type="text" style='background-color:#0b9444 ;' class="form-control " name="cumulheure" id="">
                                               </div>
                                           </div>
                                       </div>


                                       <div style="display: flex; justify-content: center; align-items: center; width: 67%;">
                                           <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                               <p>Grade de Salarié</p>
                                               <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                   <input type="text" style='background-color:#FFFF00 ;' class="form-control " name="gradesalarie" id="" style="width: 70%; ">
                                               </div>
                                           </div>
                                       </div>
                                   </div>

                                   <div style="width: 100%;  height: 200px; "><!--Diplomes-->
                                       <p>
                                           <b>Diplomes</b>
                                       </p>
                                       <div style="display: flex; justify-content: right; align-items: end;  width: 100%; height: 80%;">
                                           <div style="display: flex; padding-left:0px;padding-right:0px; flex-direction: column; align-items: end; justify-content: space-between; height: 100%;">
                                               <button style="height: 35px; height: 35px; padding-top:2px; border:2px solid gray; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: 10px;"></button>
                                               <button style="height: 35px; height: 35px; padding-top:2px; border:2px solid gray; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width: 20px;"></button>
                                           </div>
                                           <div style="width: 100%; height: 100%; padding-left:0px;">
                                               <div style="width: 100%; height: 100%; padding-left:0px; padding-right:0px; border: 1px solid gray;">

                                                   <div style="display: flex; width: 100%; height: 0px;">

                                                   </div>
                                                   <style>
                                                       .econte1 div {}
                                                   </style>

                                                   <table class="table table-bordered">
                                                       <thead>
                                                           <tr class='table-dark text-center'>
                                                               <th class='px-5'>Nom</th>
                                                               <th class="text-center">Année</th>
                                                               <th class="text-center">Mention</th>

                                                           </tr>
                                                       </thead>
                                                       <tbody>
                                                           <tr class='table-primary'>
                                                               <td>
                                                                   <p>
                                                                   <p>
                                                               </td>
                                                               <td></td>
                                                               <td></td>





                                                           </tr>
                                                       </tbody>
                                                   </table>

                                               </div>
                                           </div>
                                       </div>

                                   </div>
                                   <style>
                                       .bleauta {
                                           background: #2169EC !important;
                                       }
                                   </style>

                                   <div> <!--contrat-->
                                       <p>
                                           <b>Contrat</b>
                                       </p>
                                       <div style="display: flex; align-items: center; justify-content: space-around;">
                                           <label for="">Genre de Salarié</label>
                                           <select class="form-select form-select-sm" name="genresalarie2" id="">
                                               <option value="PERMANENT">PERMANENT</option>
                                               <option value="STAGIAIRE">STAGIAIRE</option>
                                           </select>
                                           <button style="height: 25px; height: 25px; padding-top:3px; padding-right:45px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: 20px;"></button>
                                           <label for="">Type De Contrat</label>
                                           <select class="form-select form-select-sm" name="contrat" id="">
                                               <option value=" CDD">
                                                   CDD
                                               </option>
                                               <option value=" CDI">
                                                   CDI
                                               </option>
                                           </select>
                                           <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: 20px;"></button>
                                       </div>
                                       <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger'>Identifiant Interne</label>
                                           <input type="text" class="form-control " style='background-color:#FFFF00 ;' name="identifiantinterne" id="" style=" width: 60%;">
                                       </div>
                                       <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger'>Matricule Interne</label>
                                           <input type="text" class="form-control " style='background-color:#238fce;' name="matriculeinterne" id="" style=" width: 60%;">
                                       </div>
                                       <div style="width: 100%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger' style=" width: 40%;">Matricule Social (CNPS)</label>
                                           <input type="text" class="form-control " name="matriculesocial" id="" style=" width: 40%;">
                                           <label for="" class='text-danger' style="width: 20%; padding-left: 10px;">N* Enreg</label>
                                           <input type="number" class="form-control " style="width: 15%;" name="numenregistrement">
                                       </div>
                                       <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger'>NIU (Impots)</label>
                                           <input type="text" class="form-control " name="NIU" id="" style=" width: 60%;">
                                       </div>
                                       <div>
                                           <p>
                                               <b>Entrée</b>
                                           </p>
                                           <div style="width: 60%;   display: flex; justify-content: space-around;">
                                               <label for="">Entrée</label>
                                               <input type="date" class="form-control " name="dateentree" id="" value="<?= date('Y-m-d') ?>">
                                           </div>
                                           <div style="width: 60%;  display: flex; justify-content: space-around;">
                                               <label for="">Date de Contrat</label>
                                               <input type="date" class="form-control " name="datecontrat" id="" value="<?= date('Y-m-d') ?>">
                                           </div>
                                       </div>
                                       <div>
                                           <p>
                                               <b>Depart</b>
                                           </p>
                                           <div style="width: 100%;   display: flex; justify-content: space-evenly; align-items: center;">
                                               <label for="" style="width: 100%; ">Date de Depart</label>
                                               <input type="date" class="form-control " name="datedepart" id="" style="width: 500px;">
                                               <div>
                                                   <input type="checkbox" name="" id="" value="archive">
                                                   <label for="">Archivé</label>
                                               </div>
                                           </div>
                                           <div style="width: 71%;   display: flex; justify-content: space-around;">
                                               <label for="">Motif De Depart</label>
                                               <input type="text" class="form-control " style='background-color:#238fce;' name="motifdepart" id="">

                                           </div>
                                       </div>
                                   </div>
                               </div>


                           </div>
                            <!-- fin gauche de diver  -->

                           <div class="col">


                           </div>


                            <!--  css pour la premiere partie gauche de divers -->
                            <style>
                                .gauche-divers label,
                                p {
                                    font-size: 20px;
                                    margin-top: 10px;
                                }

                                label b {
                                    padding-top: -40px;
                                }

                                .gauche-divers button {
                                    height: 34px;

                                }
                            </style>


                        </div>
                    </div>


                    <div class="option47">
                        <div style="width: 50%; padding-left: 30px;">
                            <button type="submit" name="ajouter_pers">Ajouter<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                        </div>


                        <div style="width: 50%; display: flex; gap: 20px;">
                            <button class="btn1">❮❮</button>

                            <button class="btn2">❯❯</button>
                        </div>

                        <div style="width: 100%; display: flex; justify-content: space-around;">
                            <button>Recherche<img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 20px;"></button>
                            <button>Imprimer<img src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;"></button>
                            <button>Vider<img src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;"></button>

                        </div>

                        <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                            <button>Fermer<img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</form>

<template id="pers_table_template">
    <tr style="pointer-events: all !important;">
        
        <td id='option'>
            <div class="d-flex">

                <!-- <button class="bouton bg-success "  id="set">
                    <i class="fas fa-edit"></i>

                </button> -->
                <div class="tooltip47">
                    <button class="bouton bg-success btn-modif" onclick='modifierLigne(this)'><i class="fas fa-edit"></i>
                
                      <span class="tooltiptext47">Modifier</span>
                    </button>
                </div>

                <div class="tooltip47">
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
        }
                </style>
            </div>

        </td> 
        <td id='data-NEng' data-NEng ></td>
        <td id='civilite' data-civilite></td>
        <td  data-nom id='nom'></td>
        <td  data-prenom id='prenom'></td>
        <td id='fonction' data-Fonction></td>
        <td id='phone' data-phone></td>
        <td id='pseudo' data-PSeudo></td>
        <td id='matricule' data-Matricule></td>
        <td id='matriculeInterne' data-MatriculeInterne></td>
        <td id='cni' data-cni></td>
        <td id='email' data-Email></td>
        <td id='dnais' data-dnais></td>
        <td id='npere' data-npere></td>
        <td id='nmere' data-nmere></td>
        <td id='vnais' data-vnais></td>
        <td id='nurg' data-nurg></td>
        <td id='nuurg' data-nuurg></td>
        <td id='agenceBanque' data-AgenceBanque></td>
        <td id='codeBanque' data-CodeBanque></td>
        <td id='codeguichet' data-CodeGuichetBanque></td>
        <td id='numcomptbanque' data-NumeroCompteBanque></td>
        <td id='cleRib' data-CleRibBanque></td>
        <td id='CodeSwiftBanque' data-CodeSwiftBanque></td>
        <td id='CodeUtilisateur' data-CodeUtilisateur></td>
        <td id='categorie' data-categorie></td>
        <td id='Grade' data-Grade></td>
        <td id='Convention' data-Convention></td>
        <td id='departement1' data-departement1></td>
        <td id='Direction' data-Direction></td>
        <td id='SousDirection' data-SousDirection></td>
        <td id='Service' data-Service></td>
        <td id='motif_depart' data-motif_depart></td>
        <td id='date_sortie' data-date_sortie></td>
        <td id='date_entree' data-date_entree></td>
        <td id='genre_salarie' data-genre_salarie></td>
        <td id='type_contrat' data-type_contrat></td>
        <td id='IDDate_Contrat' data-IDDate_Contrat></td>
        <td id='IDDate_Sortie' data-IDDate_Sortie></td>
        <td id='LieuDelivranceCNI' data-LieuDelivranceCNI></td>
        <td id='DateExpirationCNI' data-DateExpirationCNI></td>
        <td id='IDDateExpirationCNI' data-IDDateExpirationCNI></td>

    </tr>
</template>






<script>
    const employer = document.querySelector(".Nouveau");
    const cont_emp = document.querySelector(".cont_employer");
    employer.addEventListener("click", () => {
        cont_emp.style.display = "flex";
    });
</script>
<!-- <script>
    const close_window = document.querySelector(".close_window");

    const cont_employer = document.querySelector(".cont_employer");

    close_window.addEventListener("click", (event) => {
         event.preventDefault();
        cont_employer.style.display = "none";

    });

</script> -->

<!-- click sur le boutton recherche  -->
<script>
    const zone_recherche = document.getElementById("zone_recherche");
    const boutRecherche = document.getElementById("recherche");

    boutRecherche.addEventListener("click", (e) => {
        e.preventDefault();
        zone_recherche.style.display = "block";
        document.documentElement.scrollTop = 0;
    });
</script>

<script>
    const boutonsFermer5 = document.querySelectorAll("#close_window");
    const conteneur0 = document.querySelector(".cont_employer");

    if (conteneur0) {
        boutonsFermer5.forEach((bouton) => {
            bouton.addEventListener("click", (e) => {
                e.preventDefault();
                conteneur0.style.display = "none";
            });
        });
    }
</script>
<script>
    const boutonsFermer = document.querySelectorAll("#fermer");
    const conteneur00 = document.querySelector(".cont_employer");

    if (conteneur00) {
        boutonsFermer.forEach((bouton) => {
            bouton.addEventListener("click", (e) => {
                e.preventDefault();
                conteneur0.style.display = "none";
            });
        });
    }
</script>

<script>
    const fermer1 = document.querySelector(".fermer");
    const cont_employer = document.querySelector(".cont_employer");
    const Diver_cont = document.querySelector(".divers_cont");
    fermer1.addEventListener("click", () => {
        cont_employer.style.display = "none";
        Diver_cont.style.display = "none";
    });
</script>
<script>
    const diverBtn = document.querySelector(".divers");
    const cont_emplo = document.querySelector(".employe47");
    const cont_diver = document.querySelector(".diver47");
    diverBtn.addEventListener("click", () => {
        cont_diver.style.display = "flex";
        cont_emplo.style.display = "none";
    })
</script>
<script>
    const emploBtn5 = document.querySelector(".acti");
    const cont_emplo2 = document.querySelector(".employe47");
    const cont_diver2 = document.querySelector(".diver47");
    emploBtn5.addEventListener("click", () => {
        cont_diver2.style.display = "none";
        cont_emplo2.style.display = "block";
    })
</script>

<script>
    const emploBtn = document.querySelector(".employers_btn");
    const cont_divers = document.querySelector(".divers_cont");
    emploBtn.addEventListener("click", () => {
        cont_divers.style.display = "none";
    })
</script>
<!-- <script>
    const close_window2 = document.querySelector(".close_window2");
    const cont_employe2 = document.querySelector(".cont_employer");
    const Diver_contr2 = document.querySelector(".divers_cont");
    close_window2.addEventListener("click", () => {
        cont_employe2.style.display = "none";
        Diver_contr2.style.display = "none";
    });
</script> -->

<script>
    const boutonFermerPage = document.getElementById("fermer_page");

    if (boutonFermerPage) {
        boutonFermerPage.addEventListener("click", () => {
            window.close(); // Cette ligne ferme la fenêtre actuelle
        });
    }
</script>

<!-- script pour limage -->

<script>
    const fileInput0 = document.querySelector(".file-input")
    const chooseImgBtn0 = document.querySelector(".choose-img")
    const previewImg0 = document.querySelector(".preview-img img")

    const loadImage0 = () => {
        let file = fileInput0.files[0]; // getting user selected file
        console.log(file)
        if (!file) return; // return if user hasn't selected file
        previewImg0.src = URL.createObjectURL(file) // passing file url as preview img src
    }

    chooseImgBtn0.addEventListener("click", () => fileInput0.click())
    fileInput0.addEventListener("change", loadImage0)
</script>


<!-- <script>
    //pour
    const fileInput = document.querySelector(".input-file")
    const chooseImgBtn = document.querySelector(".choix-img")
    const previewImg = document.querySelector(".preview-image img")

    const loadImage = () => {
        let file = fileInput.files[0]; // getting user selected file
        console.log(file)
        if (!file) return; // return if user hasn't selected file
        previewImg.src = URL.createObjectURL(file) // passing file url as preview img src
    }

    chooseImgBtn.addEventListener("click", () => fileInput.click())
    fileInput.addEventListener("change", loadImage)
</script> -->




<!-- fermer -->
<script>
    const boutonFermer0 = document.getElementById("fermer");
    const cont_employer0 = document.querySelector(".cont_employer");

    boutonFermer0.addEventListener("click", (e) => {
        e.preventDefault();
        cont_employer0.style.display = "none";
    });
</script>

   <script>
        const bouton = document.getElementById("fermons");


        bouton.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home/resource_humaine";
        });
    </script>


</div>


<!-- javascript pour la gestion du tableau -->

<script>

   document.addEventListener("DOMContentLoaded", function() {
    const table = document.getElementById("myTable");
    const form = document.getElementById("formu_show");
    let selectedRow;
    //     // Gérer le survol de la ligne
    // table.addEventListener("mouseover", function(event) {
    //     const targetRow = event.target.closest("tr");
    //     if (targetRow) {
    //         targetRow.classList.add("highlight");
    //     }
    // });

    // Gérer le survol en dehors de la ligne
    // table.addEventListener("mouseout", function(event) {
    //     const targetRow = event.target.closest("tr");
    //     if (targetRow) {
    //         targetRow.classList.remove("highlight");
    //     }
    // });

            // Fonction pour remplir le formulaire avec les données de la ligne
                    // const nom = targetRow.cells[2].textContent;
            table.addEventListener("dblclick", function(event) {
            const targetRow = event.target.closest("tr");
            const form = document.getElementById("formu_show");

            if (targetRow) {
            // Désélectionner la ligne actuelle
            if (selectedRow) {
            selectedRow.classList.remove("selected");
            }

            // Sélectionner la nouvelle ligne
            targetRow.classList.add("selected");
            selectedRow = targetRow;

            // Récupérer les données de la ligne et les afficher dans le formulaire
            const civilite = targetRow.cells[1].textContent;
                const NEng =  targetRow.cells[3].textContent;
             //const NEng = targetRow.cells[0].textContent;
            const nom = targetRow.querySelector('[data-nom]').textContent;
            const prenom = targetRow.cells[3].textContent;
            const fonction = targetRow.cells[4].textContent;
            const phone = targetRow.cells[5].textContent;
            const pseudo = targetRow.cells[6].textContent;
            const matricule = targetRow.cells[7].textContent;
            const cni= targetRow.cells[9].textContent;
            const email = targetRow.cells[10].textContent;
            const dnais = targetRow.cells[11].textContent;
            const npere= targetRow.cells[12].textContent;
            const nmere = targetRow.cells[13].textContent;
            const vnais= targetRow.cells[14].textContent;
            const nurg= targetRow.cells[15].textContent;
            const nuurg = targetRow.cells[16].textContent;
            const agenceBanque = targetRow.cells[17].textContent;
            const codeBanque = targetRow.cells[18].textContent;
            const codeguichet = targetRow.cells[19].textContent;
            const numcomptbanque = targetRow.cells[20].textContent;
            const cleRib = targetRow.cells[21].textContent;
            const CodeSwiftBanque = targetRow.cells[22].textContent;
            const CodeUtilisateur = targetRow.cells[23].textContent;
            const categorie = targetRow.cells[24].textContent;
            const Grade = targetRow.cells[25].textContent;
            const Convention = targetRow.cells[26].textContent;
            const departement1 = targetRow.cells[27].textContent;
            const genre_salarie = targetRow.cells[28].textContent;
            const Direction = targetRow.cells[29].textContent;
            const SousDirection = targetRow.cells[30].textContent;
            const Service = targetRow.cells[31].textContent;
            const motif_depart = targetRow.cells[32].textContent;
            const date_sortie = targetRow.cells[33].textContent;
            const date_entree = targetRow.cells[34].textContent;
            const type_contrat = targetRow.cells[35].textContent;
            const IDDate_Contrat = targetRow.cells[36].textContent;
            const IDDate_Sortie = targetRow.cells[37].textContent;
            const LieuDelivranceCNI = targetRow.cells[38].textContent;
            const DateExpirationCNI = targetRow.cells[39].textContent;
            const IDDateExpirationCNI = targetRow.cells[40].textContent;


            // // Ajoutez d'autres lignes pour récupérer d'autres données

            // Afficher les données dans le formulaire
            // document.getElementById("nom").value = nom;
            // document.getElementById("prenom").value = prenom;
            // document.getElementById("civilite").value = civilite;
            // document.getElementById("fonction").value = fonction;
            // document.getElementById("phone").value = phone;
            // document.getElementById("pseudo").value = pseudo;
            // document.getElementById("matricule").value = matricule;
            // document.getElementById("matriculeInterne").value = matriculeInterne;
            // document.getElementById("cni").value = cni;
            // document.getElementById("email").value = email;
            // document.getElementById("dnais").value = dnais;
            // document.getElementById("npere").value = npere;
            // document.getElementById("nmere").value = nmere;
            // document.getElementById("vnais").value = vnais;
            // document.getElementById("nurg").value = nurg;
            // document.getElementById("nuurg").value = nuurg;
            // document.getElementById("agenceBanque").value = agenceBanque;
            // document.getElementById("codeBanque").value = codeBanque;
            // document.getElementById("codeguichet").value = codeguichet;
            // document.getElementById("numcomptbanque").value = numcomptbanque;
            // document.getElementById("cleRib").value = cleRib;
            // document.getElementById("CodeSwiftBanque").value = CodeSwiftBanque;
            // document.getElementById("CodeUtilisateur").value = CodeUtilisateur;
            // document.getElementById("categorie").value = categorie;
            // document.getElementById("Grade").value = Grade;
            // document.getElementById("Convention").value = Convention;
            // document.getElementById("departement1").value = departement1;
            // document.getElementById("Direction").value = Direction;
            // document.getElementById("SousDirection").value = SousDirection;
            // document.getElementById("Service").value = Service;
            // document.getElementById("motif_depart").value = motif_depart;
            // document.getElementById("date_sortie").value = date_sortie;
            // document.getElementById("date_entree").value = date_entree;
            // document.getElementById("genre_salarie").value = genre_salarie;
            // document.getElementById("type_contrat").value = type_contrat;
            // document.getElementById("IDDate_Contrat").value = prenom;
            // document.getElementById("IDDate_Sortie").value = IDDate_Sortie;
            // document.getElementById("LieuDelivranceCNI").value = LieuDelivranceCNI;
            // document.getElementById("DateExpirationCNI").value = DateExpirationCNI;
            // document.getElementById("IDDateExpirationCNI").value = IDDateExpirationCNI;

            console.log(nom,prenom,categorie,Service)

            }
            });



    });




    //  function supprimerLigne(button) {
    //     var row = button.closest('tr');
    //      const rowId = event.target.getAttribute('data-id');
    //     row.remove();
    // }
 </script>


    
 <script>
    $(document).ready(function() {
        $('#myTable').on('click', '.btn-open', function(event) {

            const targetRow = event.target.closest("tr");

            var NEng = targetRow.querySelector('[data-NEng]').textContent;
            var civilite = targetRow.cells[1].textContent;

            // const nom = targetRow.cells[2].textContent;
            var nom = targetRow.querySelector('[data-nom]').textContent;
            var prenom = targetRow.cells[3].textContent;
            var fonction = targetRow.cells[4].textContent;
            var phone = targetRow.querySelector('[data-phone]').textContent;
            var pseudo = targetRow.cells[6].textContent;
            var matricule = targetRow.cells[7].textContent;
            var cni= targetRow.cells[9].textContent;
            var email = targetRow.cells[10].textContent;
            var dnais = targetRow.cells[11].textContent;
            var npere= targetRow.cells[12].textContent;
            var nmere = targetRow.cells[13].textContent;
            var vnais= targetRow.cells[14].textContent;
            var nurg= targetRow.cells[15].textContent;
            var nuurg = targetRow.cells[16].textContent;
            var agenceBanque = targetRow.cells[17].textContent;
            var codeBanque = targetRow.cells[18].textContent;
            var codeguichet = targetRow.cells[19].textContent;
            var numcomptbanque = targetRow.cells[20].textContent;
            var cleRib = targetRow.cells[21].textContent;
            var CodeSwiftBanque = targetRow.cells[22].textContent;
            var CodeUtilisateur = targetRow.cells[23].textContent;
            var categorie = targetRow.cells[24].textContent;
            var Grade = targetRow.cells[25].textContent;
            var Convention = targetRow.cells[26].textContent;
            var departement1 = targetRow.cells[27].textContent;
            var genre_salarie = targetRow.cells[28].textContent;
            var Direction = targetRow.cells[29].textContent;
            var SousDirection = targetRow.cells[30].textContent;
            var Service = targetRow.cells[31].textContent;
            var motif_depart = targetRow.cells[32].textContent;
            var date_sortie = targetRow.cells[33].textContent;
            var date_entree = targetRow.cells[34].textContent;
            var type_contrat = targetRow.cells[35].textContent;
            var IDDate_Contrat = targetRow.cells[36].textContent;
            var IDDate_Sortie = targetRow.cells[37].textContent;
            var LieuDelivranceCNI = targetRow.cells[38].textContent;
            var DateExpirationCNI = targetRow.cells[39].textContent;
            var IDDateExpirationCNI = targetRow.cells[40].textContent;

            var formData = {
              NEng:NEng,
                nom: nom,
                prenom: prenom,
                fonction: fonction,
                phone: phone,
                matricule: matricule,
                cni: cni,
                email: email,
                dnais: dnais,
                npere: npere,
                nmere: nmere,
                vnais: vnais,
                nurg: nurg,
                nuurg: nuurg,
                agenceBanque: agenceBanque,
                codeBanque: codeBanque,
                codeguichet: codeguichet,
                numcomptbanque: numcomptbanque,
                cleRib: cleRib,
                CodeSwiftBanque: CodeSwiftBanque,
                CodeUtilisateur: CodeUtilisateur,
                categorie: categorie,
                Grade: Grade,
                SousDirection: SousDirection,
                Convention: Convention,
                departement1: departement1,
                genre_salarie: genre_salarie,
                Direction: Direction,
                Service: Service,
                date_sortie: date_sortie,
                date_entree: date_entree,
                type_contrat: type_contrat,
                IDDate_Contrat: IDDate_Contrat,
                IDDate_Sortie: IDDate_Sortie,
                LieuDelivranceCNI: LieuDelivranceCNI,
                DateExpirationCNI: DateExpirationCNI,
                IDDateExpirationCNI: IDDateExpirationCNI,
                civilite: civilite


            };
            console.log(civilite)

            sessionStorage.setItem('formData', JSON.stringify(formData));
            $.ajax({
                    type: "POST",
                    url: "http://localhost/Iplans/openEmployer", 
                    data: { formData: JSON.stringify(formData) },
                    success: function(response) {
                        
                        console.log(response);
                        console.log('reussi donc ok')
                    },
                    error: function(error) {
                       
                        console.error(error);
                        console.error('des erreurs');
                    }
                });


           window.location.href = 'http://localhost/Iplans/openEmployer';



        });
    });
</script> 

 <script>
    $(document).ready(function() {
        $('#myTable').on('click', '.btn-open', function(event) {

            const targetRow = event.target.closest("tr");

            //const neng = row.querySelector("[data-NEng]").textContent;
            var NEng = targetRow.querySelector('[data-NEng]').textContent;
            var civilite = targetRow.cells[1].textContent;
            // const nom = targetRow.cells[2].textContent;
            var nom = targetRow.querySelector('[data-nom]').textContent;
            var prenom = targetRow.cells[3].textContent;
            var fonction = targetRow.cells[4].textContent;
            var phone = targetRow.querySelector('[data-phone]').textContent;
            var pseudo = targetRow.cells[6].textContent;
            var matricule = targetRow.cells[7].textContent;
            var cni= targetRow.cells[9].textContent;
            var email = targetRow.cells[10].textContent;
            var dnais = targetRow.cells[11].textContent;
            var npere= targetRow.cells[12].textContent;
            var nmere = targetRow.cells[13].textContent;
            var vnais= targetRow.cells[14].textContent;
            var nurg= targetRow.cells[15].textContent;
            var nuurg = targetRow.cells[16].textContent;
            var agenceBanque = targetRow.cells[17].textContent;
            var codeBanque = targetRow.cells[18].textContent;
            var codeguichet = targetRow.cells[19].textContent;
            var numcomptbanque = targetRow.cells[20].textContent;
            var cleRib = targetRow.cells[21].textContent;
            var CodeSwiftBanque = targetRow.cells[22].textContent;
            var CodeUtilisateur = targetRow.cells[23].textContent;
            var categorie = targetRow.cells[24].textContent;
            var Grade = targetRow.cells[25].textContent;
            var Convention = targetRow.cells[26].textContent;
            var departement1 = targetRow.cells[27].textContent;
            var genre_salarie = targetRow.cells[28].textContent;
            var Direction = targetRow.cells[29].textContent;
            var SousDirection = targetRow.cells[30].textContent;
            var Service = targetRow.cells[31].textContent;
            var motif_depart = targetRow.cells[32].textContent;
            var date_sortie = targetRow.cells[33].textContent;
            var date_entree = targetRow.cells[34].textContent;
            var type_contrat = targetRow.cells[35].textContent;
            var IDDate_Contrat = targetRow.cells[36].textContent;
            var IDDate_Sortie = targetRow.cells[37].textContent;
            var LieuDelivranceCNI = targetRow.cells[38].textContent;
            var DateExpirationCNI = targetRow.cells[39].textContent;
            var IDDateExpirationCNI = targetRow.cells[40].textContent;

            var formData = {
               NEng:NEng,
                nom: nom,
                prenom: prenom,
                fonction: fonction,
                phone: phone,
                matricule: matricule,
                cni: cni,
                email: email,
                dnais: dnais,
                npere: npere,
                nmere: nmere,
                vnais: vnais,
                nurg: nurg,
                nuurg: nuurg,
                agenceBanque: agenceBanque,
                codeBanque: codeBanque,
                codeguichet: codeguichet,
                numcomptbanque: numcomptbanque,
                cleRib: cleRib,
                CodeSwiftBanque: CodeSwiftBanque,
                CodeUtilisateur: CodeUtilisateur,
                categorie: categorie,
                Grade: Grade,
                SousDirection: SousDirection,
                Convention: Convention,
                departement1: departement1,
                genre_salarie: genre_salarie,
                Direction: Direction,
                Service: Service,
                date_sortie: date_sortie,
                date_entree: date_entree,
                type_contrat: type_contrat,
                IDDate_Contrat: IDDate_Contrat,
                IDDate_Sortie: IDDate_Sortie,
                LieuDelivranceCNI: LieuDelivranceCNI,
                DateExpirationCNI: DateExpirationCNI,
                IDDateExpirationCNI: IDDateExpirationCNI,
                civilite: civilite


            };
            console.log(civilite)

            sessionStorage.setItem('formData', JSON.stringify(formData));
            $.ajax({
                    type: "POST",
                    url: "http://localhost/Iplans/openEmployer", 
                    data: { formData: JSON.stringify(formData) },
                    success: function(response) {
                        
                        console.log(response);
                        console.log('reussi donc ok')
                    },
                    error: function(error) {
                       
                        console.error(error);
                        console.error('des erreurs');
                    }
                });

            
           window.location.href = 'http://localhost/Iplans/openEmployer';


        
        });
    });
</script> 
 <script>
    $(document).ready(function() {
        $('#myTable').on('click', '.btn-modif', function(event) {

            const targetRow = event.target.closest("tr");

            var NEng = targetRow.cells[1].textContent;
            var civilite = targetRow.cells[2].textContent;
          
            // const nom = targetRow.cells[2].textContent;
            var nom = targetRow.cells[3].textContent;
            var prenom = targetRow.cells[4].textContent;
            var fonction = targetRow.cells[5].textContent;
            var phone = targetRow.cells[6].textContent;
            var pseudo = targetRow.cells[7].textContent;
            var matricule = targetRow.cells[8].textContent;
            var cni= targetRow.cells[9].textContent;
            var email = targetRow.cells[10].textContent;
            var dnais = targetRow.cells[11].textContent;
            var npere= targetRow.cells[12].textContent;
            var nmere = targetRow.cells[13].textContent;
            var vnais= targetRow.cells[14].textContent;
            var nurg= targetRow.cells[15].textContent;
            var nuurg = targetRow.cells[16].textContent;
            var agenceBanque = targetRow.cells[17].textContent;
            var codeBanque = targetRow.cells[18].textContent;
            var codeguichet = targetRow.cells[19].textContent;
            var numcomptbanque = targetRow.cells[20].textContent;
            var cleRib = targetRow.cells[21].textContent;
            var CodeSwiftBanque = targetRow.cells[22].textContent;
            var CodeUtilisateur = targetRow.cells[23].textContent;
            var categorie = targetRow.cells[24].textContent;
            var Grade = targetRow.cells[25].textContent;
            var Convention = targetRow.cells[26].textContent;
            var departement1 = targetRow.cells[27].textContent;
            var genre_salarie = targetRow.cells[28].textContent;
            var Direction = targetRow.cells[29].textContent;
            var SousDirection = targetRow.cells[30].textContent;
            var Service = targetRow.cells[31].textContent;
            var motif_depart = targetRow.cells[32].textContent;
            var date_sortie = targetRow.cells[33].textContent;
            var date_entree = targetRow.cells[34].textContent;
            var type_contrat = targetRow.cells[35].textContent;
            var IDDate_Contrat = targetRow.cells[36].textContent;
            var IDDate_Sortie = targetRow.cells[37].textContent;
            var LieuDelivranceCNI = targetRow.cells[38].textContent;
            var DateExpirationCNI = targetRow.cells[39].textContent;
            var IDDateExpirationCNI = targetRow.cells[40].textContent;

            var formData = {
               NEng:NEng,
                civilite:civilite,
                nom: nom,
                prenom: prenom,
                fonction: fonction,
                phone: phone,
                matricule: matricule,
                cni: cni,
                email: email,
                dnais: dnais,
                npere: npere,
                nmere: nmere,
                vnais: vnais,
                nurg: nurg,
                nuurg: nuurg,
                agenceBanque: agenceBanque,
                codeBanque: codeBanque,
                codeguichet: codeguichet,
                numcomptbanque: numcomptbanque,
                cleRib: cleRib,
                CodeSwiftBanque: CodeSwiftBanque,
                CodeUtilisateur: CodeUtilisateur,
                categorie: categorie,
                Grade: Grade,
                SousDirection: SousDirection,
                Convention: Convention,
                departement1: departement1,
                genre_salarie: genre_salarie,
                Direction: Direction,
                Service: Service,
                date_sortie: date_sortie,
                date_entree: date_entree,
                type_contrat: type_contrat,
                IDDate_Contrat: IDDate_Contrat,
                IDDate_Sortie: IDDate_Sortie,
                LieuDelivranceCNI: LieuDelivranceCNI,
                DateExpirationCNI: DateExpirationCNI,
                IDDateExpirationCNI: IDDateExpirationCNI,
                civilite: civilite


            };
            console.log(civilite)

            sessionStorage.setItem('formData', JSON.stringify(formData));
            $.ajax({
                    type: "POST",
                    url: "http://localhost/Iplans/modifEmploye", 
                    data: { formData: JSON.stringify(formData) },
                    success: function(response) {
                        
                        console.log(response);
                        console.log('reussi donc ok')
                    },
                    error: function(error) {
                       
                        console.error(error);
                        console.error('des erreurs');
                    }
                });

            
           window.location.href = 'http://localhost/Iplans/modifEmploye';


        
        });
    });
</script> 


<script>
      
        function supprimerLigne(button) {

            const row = button.closest('tr');

            const neng = row.querySelector("[data-NEng]").textContent;
            console.log('id:',neng)


            const url = `http://localhost/pers/${neng}`;
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










<?php

$content = ob_get_clean();
include './vues/layout.php';
?>