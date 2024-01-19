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
<?php
require_once "./include/config.php";
ini_set("date.timezone", "Africa/Douala");
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => PERS_API_URL,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$data = [];

curl_close($curl);

if ($err) {
    $_SESSION['error'] = true;
    return;
}
$d = (array)json_decode($response, true);
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

        .cont_employer{
            background-color:white!important;
        }
    </style>


</main>

<!--- debut du formulaire generale---->

<form id='formu_show'>



    <div class="cont_employer" style="">
        <!----employer formulaire------->
        <div class="contenue_employers">
            <div class="cont_titre ">
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h2 class="fiche_sala">Ouvrir Fiche Salarié </h2>
                </div>

                <div>
                    <button class="close_window" id="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close"></i></button>
                </div>
            </div>


            <div class="cont_employer2">
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
                                        <option value="Madame">Mademoiselle</option>
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
                    <?php
                    // Démarrez la session si ce n'est pas déjà fait
                 
                 
                    // Vérifiez si les données sont envoyées via POST
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["formData"])) {
                        // Récupérez les données JSON et décodez-les en tableau associatif
                        $formData = json_decode($_POST["formData"], true);
                        
                        // Stockez les données dans la session (côté serveur)
                        $_SESSION["formData"] = $formData;
            
                        // Utilisez $formData comme nécessaire
                    }
                    ?>


                            <div class="idntite2">
                                <label for="" class="mt-3">Nom</label>
                                <input type="text" class="form-control mt-3" name="nom" id='nom' value="">
                               
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
                                <input type="text" class="form-control mt-3" name="adresse" id=''>
                            </div>
                            <div class="idntite6">
                                <label class="mt-3" for="">Telephone</label>
                                <input type="tel" class="form-control mt-3" name="tel" id='phone'>
                            </div>
                            <div class="idntite7">
                                <label class="mt-3" for="">Telephone Pro~</label>
                                <input type="tel" class="form-control mt-3" name="telpro">
                            </div>
                            <div class="idntite8">
                                <label class="mt-3" for="">Site (Agence)</label>
                            <input type="text" class="form-control mt-3" name="nompere" id="agenceBanque">
                            </div>
                            <div class="idntite9">
                                <label class="mt-3" for="">Direction </label>
                                <input type="text" class="form-control mt-3" name="Direction" id="Direction">
                            </div>
                            <div class="idntite10">
                                <label class="mt-3" for="">Sous-Direction </label>
                               <input type="text" class="form-control mt-3" name="nompere" id="SousDirection">
                            </div>
                            <div class="idntite11">
                                <label class="mt-3" for="">Service </label>
                               <input type="text" class="form-control mt-3" name="nom" id='Service' required>
                            </div>
                            <div class="idntite12">
                                <label class="mt-3" for="">Departement </label>
                                <input type="text" class="form-control mt-3" name="nom" id='departement1' required>
                            </div>
                            <div class="idntite13">
                                <label class="mt-3" for="">Poste Occupé </label>
                               <input type="text" class="form-control mt-3" name="nom" id='fonction' required>
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
                                width:85%!important
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
                                    <label class="mt-3" for="">Lieu de Naissance</label>
                                 
                                    <input type="text" class="form-control mt-3" style="width: 80%; margin-right: 30%;" name="nom" id='vnais'>
                                </div>
                                <div>
                                    <label class="mt-3" for="">Nom du Pere</label>
                                    <input type="text" class="form-control mt-3" name="nompere" id="npere">
                                </div>
                                <div>
                                    <label class="mt-3" for="">Nom de la mere</label>
                                    <input type="text" class="form-control num mt-3" name="nommere" value="<?php echo $formData['prenom'] ?? ''; ?>"id="nmere">
                                </div>
                                <div>
                                    <label class="mt-3" for="">nom durgence</label>
                                    <input type="text" class="form-control mt-3" name="nomurgence" id="nurg" >
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
                                           <input type="text" class="form-control " style='background-color:#238fce;' name="matriculeInterne" id="matriculeInterne" style=" width: 60%;">
                                       </div>
                                       <div style="width: 100%;  display: flex; justify-content: space-between; align-items: center;">
                                           <label for="" class='text-danger' style=" width: 40%;">Matricule Social (CNPS)</label>
                                           <input type="text" class="form-control " name="matricule" id="matricule" style=" width: 40%;">
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

            <!-- css pour la div de droite -->
            <style>

            </style>


            <div class="option47">
                <!-- <div style="width: 50%; padding-left: 30px;">
                    <button type="submit" name="ajouter_pers">Ajouter<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                </div> -->


             


                <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                    <button class='close_window' id='fermer'>Fermer<img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>

            </div>

        </div>
        <style>
            .option47 {
                display: flex;
                justify-content: space-around;
                align-items: center;
                width: 100%;
                height: 7%;
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
                        <div style="width: 100%; display: flex; justify-content:center; padding-right: 30px;">

                            <div style="width: 50%; padding-left: 30px;">
                                <button type="submit" name="ajouter_pers">Ajouter<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                            </div>



                            <div style="width: 50%; display: flex; justify-content: right; padding-right: 30px;">
                                <button>Fermer<img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
                            </div>

                        
                        </div>
                       

                    </div>
                </div>
            </div>
        </main>
    </div>
</form>









<!-- click sur le boutton recherche  -->




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







<!-- fermer -->
<script>
    const ferme = document.querySelector(".close_window");
    const conteneur = document.querySelector(".conteneur0");

    ferme.addEventListener("click", (e) => {
        e.preventDefault()
        window.location.href = "<?= SITE_URL ?>/employes";

    });
</script>
<script>
    const boutonFermer = document.getElementById("fermer");
    const conteneur0 = document.querySelector(".conteneur0");

    boutonFermer.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "<?= SITE_URL ?>/employes";
    });
</script>



<script>
    // Récupérer les données depuis sessionStorage
    var formData = JSON.parse(sessionStorage.getItem('formData'));
    console.log(formData)

    // Remplir le formulaire avec les données
             document.getElementById("nom").value = formData.nom;
            // document.getElementById("prenom").value = formData.prenom || '';

             document.getElementById("prenom").value = formData.prenom || '';
             //document.getElementById("civilite").value = formData.civilite || '';
             document.getElementById("fonction").value = formData.fonction || '';
             document.getElementById("phone").value = formData.phone || '';
       
             document.getElementById("matricule").value = formData.matricule || '';
             document.getElementById("matriculeInterne").value = formData.matriculeInterne || '';
             document.getElementById("cni").value = formData.cni || '';
             document.getElementById("email").value = formData.email || '';
             document.getElementById("dnais").value = formData.dnais || '';
             document.getElementById("npere").value = formData.npere || '';
             document.getElementById("nmere").value = formData.nmere || '';
             document.getElementById("vnais").value = formData.vnais || '';
             document.getElementById("nurg").value = formData.nurg || '';
             document.getElementById("nuurg").value = formData.nuurg || '';
             document.getElementById("agenceBanque").value = formData.agenceBanque || '';
            // document.getElementById("codeBanque").value = formData.codeBanque || '';
            // document.getElementById("codeguichet").value = formData.codeguichet || '';
            // document.getElementById("numcomptbanque").value = formData.numcomptbanque || '';
            // document.getElementById("cleRib").value = formData.cleRib || '';
            // document.getElementById("CodeSwiftBanque").value = formData.CodeSwiftBanque || '';
            // document.getElementById("CodeUtilisateur").value = formData.CodeUtilisateur || '';
             document.getElementById("categorie").value = formData.categorie || '';
             document.getElementById("Grade").value = formData.Grade || '';
            // document.getElementById("Convention").value = formData.Convention || '';
             document.getElementById("departement1").value = formData.departement1 || '';
             document.getElementById("Direction").value = formData.Direction || '';
             document.getElementById("SousDirection").value = formData.SousDirection || '';
             document.getElementById("Service").value = formData.Service || '';
             document.getElementById("motif_depart").value = formData.motif_depart || '';
            // document.getElementById("date_sortie").value = formData.date_sortie || '';
            // document.getElementById("date_entree").value = formData.date_entree || '';
            // document.getElementById("genre_salarie").value = formData.genre_salarie || '';
            // document.getElementById("type_contrat").value = formData.type_contrat || '';
            // document.getElementById("IDDate_Contrat").value = formData.prenom || '';
            // document.getElementById("IDDate_Sortie").value = formData.IDDate_Sortie || '';
             document.getElementById("LieuDelivranceCNI").value = formData.LieuDelivranceCNI || '';
            // document.getElementById("DateExpirationCNI").value = formData.DateExpirationCNI || '';
            // document.getElementById("IDDateExpirationCNI").value = formData.IDDateExpirationCNI || '';


    // les champs selects


                var civiliteValue = formData.civilite;

                // Accédez à l'élément select
                var selectCivilite = document.getElementById("civilite");

                for (var i = 0; i < selectCivilite.options.length; i++) {
                    // Vérifiez si la valeur de l'option correspond à celle dans formData
                    if (selectCivilite.options[i].value === civiliteValue) {
                        // Définissez la propriété selected de cette option sur true
                        selectCivilite.options[i].selected = true;
                        // Sortez de la boucle car vous avez trouvé la correspondance
                        break;
                    }
                }



</script>

   


</div>





<?php

$content = ob_get_clean();
include './vues/layout.php';
?>