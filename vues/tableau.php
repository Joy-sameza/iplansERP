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

<main>
    <div class="haut_avec_label" >  <!--le haut avec les label-->
        <div>
            <label for="">Site(Agence)</label>
            <select name="" id="">
                <option value="">Demo</option>
            </select>
            <label for="">Departement</label>
            <select name="" id="">
                <option value="">TOUS</option>
            </select>
            <label for="">Genre</label>
            <select name="" id="">
                <option value="">Permanent</option>
            </select>
            <input type="checkbox" name="" id=" ">
            <label for="">Archivés</label>
        </div>

        <div>
            <button>
                <img src="<?= SITE_URL ?>/assets/image/SAV.webp" alt="">
            </button>
        </div>
    </div> <!---fin le haut avec les label -->

    <div class="aphabet"> <!--debut lettre de l'aphabet-->
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
    </div>   <!--fin lettre de l'alphabet-->

    <div class="debut_tableau"> <!--debut tableau-->

                <table  border="1">
                    <thead >
                    <th>Civilite</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Fonction</th>
                    <th>Telephone</th>
                    <th>Pseudo</th>
                    <th>Matricule</th>
                    <th>Identifiant</th>
                    <th>CNI</th>
                    <th>Email</th>
                    <th>DateNaissance</th>
                    <th>Nom_du_Pere</th>
                    <th>Nom_de_la_mere</th>
                    <th>Ville_de_Naissance</th>
                    <th>Nom_D'urgence</th>
                    <th>Numero_D'urgence</th>
                    <th>AgenceBanque</th>
                    <th>CodeBanque</th>
                    <th>CodeGuichetBanque</th>
                    <th>NumeroCompletBanque</th>
                    <th>CleRibBanque</th>
                    <th>VcodeSwittBanque</th>
                    <th>CodeUtilisateur</th>
                    <th>Categorie</th>
                    <th>Grade </th>
                    <th>Convention</th>
                    <th>Departement</th>
                    <th>GenreSalarie</th>
                    <th>Direction</th>
                    <th>SousDirection</th>
                    <th>Service</th>
                    <th>MotifDepart </th>
                    <th>DateSortie</th>
                    <th>DateEntree</th>
                    <th>GenreSalarie</th>
                    <th>TypeContrat</th>
                    <th>IDDate_Contrat</th>
                    <th>IDDate_Sortie</th>

                    <th>LieuDelivranceCNI</th>
                    <th>DateExpirationCNI</th>
                    <th>IDDateExpirationCNI</th>
                    <th>IDDate_Contrat</th>
                    <th>IDDate_Sortie</th>
                    </thead>
                    <?php

                    foreach ($d as $pack) {
                    ?>
                    <tbody>
                    <td><?=$pack['civilite']?></td>
                    <td><?=$pack['nom']?></td>
                    <td><?=$pack['prenom']?></td>
                    <td><?=$pack['Fonction']?></td>
                    <td><?=$pack['phone']?></td>
                    <td><?=$pack['PSeudo']?></td>
                    <td><?=$pack['Matricule']?></td>
                    <td><?=$pack['MatriculeInterne']?></td>
                    <td><?=$pack['cni']?></td>
                    <td><?=$pack['Email']?></td>
                    <td><?=$pack['dnais']?></td>
                    <td><?=$pack['npere']?></td>
                    <td><?=$pack['nmere']?></td>
                    <td><?=$pack['vnais']?></td>
                    <td><?=$pack['nurg']?></td>
                    <td><?=$pack['nuurg']?></td>
                    <td><?=$pack['AgenceBanque']?></td>
                    <td><?=$pack['CodeBanque']?></td>
                    <td><?=$pack['CodeGuichetBanque']?></td>
                    <td><?=$pack['NumeroCompteBanque']?></td>
                    <td><?=$pack['CleRibBanque']?></td>
                    <td><?=$pack['CodeSwiftBanque']?></td>
                    <td><?=$pack['CodeUtilisateur']?></td>
                    <td><?=$pack['categorie']?></td>
                    <td><?=$pack['Grade']?> </td>
                    <td><?=$pack['Convention']?></td>
                    <td><?=$pack['departement1']?></td>
                    <td><?=$pack['Direction']?></td>
                    <td><?=$pack['SousDirection']?></td>
                    <td><?=$pack['Service']?></td>
                    <td><?=$pack['motif_depart']?></td>
                    <td><?=$pack['date_sortie']?></td>
                    <td><?=$pack['date_entree']?></td>
                    <td><?=$pack['genre_salarie']?></td>
                    <td><?=$pack['type_contrat']?></td>
                    <td><?=$pack['IDDate_Contrat']?></td>
                    <td><?=$pack['IDDate_Sortie']?></td>
                    <td><?=$pack['LieuDelivranceCNI']?></td>
                    <td><?=$pack['DateExpirationCNI']?></td>
                    <td><?=$pack['IDDateExpirationCNI']?></td>


                    </tbody>
                    <?php } ?>
                </table>


    </div><!--fin de zone du tableau-->

    <div class="zonne_dinformation"> <!--zone d'information -->
        <div class="zone1">
            <div class="zone">
                <label for="">Direction</label>
                <select name="" id="">
                    <option value="">TOUTES</option>
                </select>
                <label for="">Sous Dir~</label>
                <select name="" id="">
                    <option value="">TOUTES</option>
                </select>
                <label for="">Services</label>
                <select name="" id="">
                    <option value="">TOUS</option>
                </select>
            </div>
            <div class="zone">
                <label for="">Grade</label>
                <select name="" id="">
                    <option value="">TOUS</option>
                </select>
                <label for="">Convention</label>
                <select name="" id="">
                    <option value="">TOUTES</option>
                </select>
                <label for="">Categ~</label>
                <select name="" id="">
                    <option value="">TOUTES</option>
                </select>
                <label for="">Fontion</label>
                <select name="" id="">
                    <option value="">TOUTES</option>
                </select>
            </div>
        </div>



        <div class="zone_de_categorie"><!--zone de categorie-->
            <div> <!--sexe-->
                <p style="font-size: 10px;">
                    Sexe
                </p>
                <div>
                    <input type="radio" name="genre" id="" >
                    <label for="">M</label>
                </div>
                <div>
                    <input type="radio" name="genre" id="" >
                    <label for="">F</label>
                </div>
                <div>
                    <input type="radio" name="genre" id="">
                    <label for="">Tous</label>
                </div>
            </div>
            <div> <!--Prestataire-->
                <p style="font-size: 10px;">
                    Prestataire
                </p>
                <div>
                    <input type="radio" name="prestataire" id="">
                    <label for="">Non</label>
                </div>
                <div>
                    <input type="radio" name="prestataire" id="">
                    <label for="">Oui</label>
                </div>
                <div>
                    <input type="radio" name="prestataire" id="">
                    <label for="">Tous</label>
                </div>
            </div>
            <div> <!--Conforme-->
                <p style="font-size: 10px;">
                    Conforme
                </p>
                <div>
                    <input type="radio" name="conforme" id="">
                    <label for="">Non</label>
                </div>
                <div>
                    <input type="radio" name="conforme" id="">
                    <label for="">Oui</label>
                </div>
                <div>
                    <input type="radio" name="conforme" id="">
                    <label for="">Tous</label>
                </div>
            </div>
            <div> <!--Periode de naissance-->
                <p style="font-size: 10px;">
                    Periode Naissance
                </p>
                <div>
                    <label for="">Debut</label>
                    <input type="radio" name="" id="">

                </div>
                <div>
                    <input type="date" name="" id="">
                    <label for="">Fin</label>
                </div>
                <div>
                    <input type="date" name="" id="">
                    <label for="">Actif</label>
                </div>
            </div>
        </div>
    </div><!--fin d'information-->

    <div class="cont_button_bas"><!--buton contenaire du bas -->
        <div style="display: flex; justify-content: center; align-items: center; gap: 10px; width: max-content;">
            <button class="btn_bass Nouveau" style="padding-top: 0 !important;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">Nouveau</button>
            <button class="btn_bass"style="padding-top: 0 !important;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">Ouvrir</button>
            <button class="btn_bass"style="padding-top: 0 !important;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">Suprimer</button>
            <button class="btn_bass"style="padding-top: 0 !important;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">Imprimer</button>
            <button class="btn_bass"style="padding-top: 0 !important;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">Pointages</button>
            <button class="btn_bass email" style=" padding-top: 0 !important;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">Envoyer un Email </button>
        </div>
        <div style="display: flex; gap: 10px;">
            <button class="btn_bass" style="padding-top: 0 !important;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">Recherche</button>
            <button class="btn_bass"style="padding-top: 0 !important;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="">Fermer</button>
        </div>
    </div>
</main>
<!--- debut du formulaire generale---->

<form data-form enctype="multipart/form-data" method="post" action="<?= SITE_URL ?>/forms/formdata.php">



<div class="cont_employer" style="display: none;">
    <!----employer formulaire------->
    <div class="contenue_employers">
        <div class="cont_titre" >
            <div style="display: flex;">
                <img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" class="ico_emplye">
                <h2 class="fiche_sala">Fiche Salarié</h2>
            </div>

            <div>
                <button class="close_window" style="width: 30px; height: 30px; background-color: red; border: none;">  </button>
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


            <div class="econte">
                <div class="econte1">
                    <h1 style="background-color: black;color: white;">Employé</h1>
                    <section class="div_1">
                        <h3 style="font-size: 15px;">Identité</h3>
                        <div class="idntite1">
                            <div>
                                <label for="">Civilité</label>
                                <select name="civilite" id="" style="width: 130%;">
                                    <option value="Monsieur">Monsieur</option>
                                    <option value="Madame">Madame</option>
                                </select>
                                <div style="display: flex; flex-direction: column;">
                                    <h3 style="margin-top: -10px;">sexe</h3>
                                    <div style="display: flex ; gap: 7px; margin-top: -7px;" >
                                        <label for="">Masculin</label>
                                        <input type="radio" value="1" name="genre">

                                        <label for="">Feminin</label>
                                        <input type="radio" value="1" name="genre">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="idntite2">
                            <label for="">Nom</label>
                            <input type="text" name="nom" required>
                        </div>
                        <div class="idntite3">
                            <label for="">Prenom</label>
                            <input type="text" name="prenom">
                        </div>
                        <div class="idntite4">
                            <label for="" style="width: 80%">N* Carte national</label>
                            <input type="text" name="cni">
                            <label for="" style="width: 25%">Fait a</label>
                            <input type="text" name="fait">
                            <label for="" style="width: 50%">Expire le</label>
                            <input type="date" name="expire" value="<?= date('Y/m/d') ?>">
                        </div>
                        <div class="idntite5">
                            <label for="">Adresse</label>
                            <input type="text" name="adresse">
                        </div>
                        <div class="idntite6">
                            <label for="">Telephone</label>
                            <input type="tel" name="tel">
                        </div>
                        <div class="idntite7">
                            <label for="">Telephone Pro~</label>
                            <input type="tel" name="telpro">
                        </div>
                        <div class="idntite8">
                            <label for="">Site (Agence)</label>
                            <select name="siteagence" id="">
                                <option value="DEMO">DEMO</option>
                            </select>
                        </div>
                        <div class="idntite9">
                            <label for="">Direction </label>
                            <select name="direction" id="">
                                <option value="">BICEC</option>
                                <option value="">UBA</option>
                            </select>
                        </div>
                        <div class="idntite10">
                            <label for="">Sous-Direction </label>
                            <select name="sousdirection" id="">
                                <option value="">BICEC</option>
                            </select>
                        </div>
                        <div class="idntite11">
                            <label for="">Service </label>
                            <select name="service" id="">
                                <option value="SSMEDICAL">SSMEDICAL</option>
                            </select>
                        </div>
                        <div class="idntite12">
                            <label for="">Departement  </label>
                            <select name="departement" id="">
                                <option value="CHAUFFEUR">CHAUFFEUR</option>
                            </select>
                        </div>
                        <div class="idntite13">
                            <label for="">Poste Occupé  </label>
                            <select name="posteoccupe" id="">
                                <option value="PROJECT MANAGER">PROJECT MANAGER</option>
                            </select>
                        </div>
                    </section>







                    <div class="div_2">
                        <h3>Info Personnelles</h3>
                        <div>
                            <div class="te1">
                                <label for="">Date de Naissance</label>
                                <input type="date" name="datenaissssance" id="" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div>
                                <label for="">Lieu de Naissance</label>
                                <select name="lieunaissance" id="" style="width: 80%; margin-right: 30%;">
                                    <option value="">Dschang</option>
                                </select>
                            </div>
                            <div>
                                <label for="">Nom du Pere</label>
                                <input type="text" name="nompere" id="">
                            </div>
                            <div>
                                <label for="">Nom de la mere</label>
                                <input type="text" name="nommere" id="">
                            </div>
                            <div>
                                <label for="">nom durgence</label>
                                <input type="text" name="nomurgence" id="">
                            </div>
                            <div>
                                <label for="">Numero D'urgence</label>
                                <input type="tel" name="numerourgence" id="">
                            </div>
                            <div>
                                <label for="">Adresse email</label>
                                <input type="email" name="email" id="">
                            </div>
                            <div>
                                <label for="">Adresse email pro~</label>
                                <input type="email" name="emailpro" id="">
                            </div>
                            <div class="situation">
                                <h4>situation matrimonial</h4>
                                <div>
                                    <div style="display: flex; align-items: center;
                                        justify-content: center; margin-top: 20px;">
                                        <label for="">Nombre d'enfants</label>
                                        <input type="number" value="1" class="enfant" name="nombreenfant">
                                    </div>
                                    <div >
                                        <div>

                                        </div>
                                        <div style="display: flex; flex-direction: column;">
                                            <p>Celebataire</p>
                                            <p>Marié</p>
                                            <p>Divorcé</p>
                                            <p>Veuf \ Veuve</p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>





                <section class="econte2">
                    <div class="class1">
                        <div class="class2 spec1">
                            <div class="class3">
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <label for="">Prestataire interne ?</label>
                                </div>
                                <div>
                                    <input type="checkbox" name="" id="">
                                    <label for="">Prestataire externe ?</label>
                                </div>
                            </div>
                            <div class="class4">
                                <div>
                                    <label for="">Carte a puce</label>
                                    <div>
                                        <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                        <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt=""  style="width: 20px; height: 20px;"></button>
                                    </div>
                                </div>
                                <div>
                                    <label for="">Biometrie</label>
                                    <div>
                                        <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt=""  style="width: 20px; height: 20px;"></button>
                                        <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt=""  style="width: 20px; height: 20px;"></button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div style="background-image: url(./fond.png);" class=" spec2">
                            <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                            <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>

                        </div>
                    </div>

                    <div class="class5">
                        <div class="class6">
                            <button class="clicked">Horaires</button>
                            <button>Services</button>
                            <button>Messagerie</button>
                            <button>Biometrie</button>
                        </div>
                        <div class="class7">
                            <div class="class8">
                                <div class="qwe1"><br>
                                    <div  class="ligne">
                                        asd
                                    </div>
                                </div>
                                <div class="qwe2">
                                    <div class="activer">
                                        <input type="checkbox" name="active" id="" value="1">
                                        <p>
                                            Activer
                                        </p>
                                    </div>
                                    <div class="opt">
                                        <div class="option_debut">
                                            <label for="">Début Option</label>
                                            <input type="time" name="heuredebut" id="" value="<?= date('H:i') ?>">
                                        </div>
                                        <div class="Option_fin">
                                            <label for="">Fin Option</label>
                                            <input type="time" name="heurefin" id="" value="<?= date('H:i') ?>">
                                        </div>
                                    </div>
                                    <div class="btn_bas">
                                        <button>Ajouter<img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                        <button>Retirer<img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                    </div>

                                </div>
                            </div>
                            <div class="class9">
                                <div>
                                    <input type="checkbox" name="lundi1" id="" value="1">
                                    <p>Lundi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="mardi1" id="" value="1">
                                    <p>Mardi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="mercredi1" id="" value="1">
                                    <p>Mercredi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="jeudi1" id="" value="1">
                                    <p>Jeudi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="vendredi1" id="" value="1">
                                    <p>Vendredi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="samedi1" id="" value="1">
                                    <p>Samedi</p>
                                </div>
                                <div>
                                    <input type="checkbox" name="dimanche1" id="" value="1">
                                    <p>Dimanche</p>
                                </div>

                            </div>
                        </div>


                        <div>

                        </div>
                    </div>




                </section>

            </div>
        </div>


        <div class="option">
            <div style="width: 50%; padding-left: 30px;">
                <input type="submit" value="Ajouter" name="ajouter">
            </div>


            <div style="width: 50%; display: flex; gap: 20px;">
                <button class="btn1"><</button>
                <button class="btn2">></button>
            </div>

            <div style="width: 100%; display: flex; justify-content: space-around;">
                <button>Recherche</button>
                <button>Imprimer</button>
                <button>Vider</button>
            </div>

            <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                <button class="Fermer">Fermer</button>
            </div>

        </div>

    </div>
</div>
<!-----divers----->


    <!----deuxieme formulaire dans employee----->
<div class="divers_cont" style="display: none;">
    <main>
        <div class="cont_employer" >
            <div class="contenue_employers">
                <div class="cont_titre" >
                    <div style="display: flex;">
                        <img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" class="ico_emplye">
                        <h2 class="fiche_sala">Fiche Salarié</h2>
                    </div>

                    <div>
                        <button class="close_window2" style="width: 30px; height: 30px; background-color: red; border: none;">  </button>
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
                            <p class="acti">Divers</p>
                            <p class="employers_btn" >Employés</p>
                        </div>
                    </div>


                    <div class="econte" style="zoom: 89%;">
                        <div class="econte1">
                            <h1 style="background-color: black;">Divers</h1>
                            <div style="padding-top: 10px;">
                                <button>Categorie</button>
                                <button>Banque</button>
                            </div>
                            <div class="Autre"> <!--le carre autre commence ici -->
                                <p>
                                    <b>Autres</b>
                                </p>
                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Convention Collective</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <select name="conventioncollective" id="" style="width: 150px;">
                                                <option>FONCTIONNAIRE</option>
                                            </select>
                                            <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <label for="">echellon</label>
                                        <select name="echellon" id="" style="width: 100%;">
                                            <option value="">E</option>
                                        </select>
                                        <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/image/la terre.webp" alt="" style="width: 20px;"></button>
                                    </div>
                                </div><!--ligne 1 fini ici-->


                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content:space-between; align-items: center; width: 100%; ">
                                        <p>Categorie</p>
                                        <div style="display: flex; justify-content: left; width: 50%; gap: 7px;">
                                            <select name="categorie" id="" style="width: 150px;">
                                                <option value="">VI</option>
                                            </select>
                                            <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <label for="">Indice</label>
                                        <select name="" id="" style="width: 100%;">
                                            <option value="">E</option>
                                        </select>
                                        <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Salaire De base Par semaine</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <input type="number" name="salairebase">
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <input type="checkbox" name="loge" id="" value="oui">
                                        <label for=""><b>logé</b></label>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Heure par Semaine</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <select name="heuresemaine" id="" style="width: 140px;">
                                                <option value="0">0</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <input type="checkbox" name="nouri" id="" value="oui">
                                        <label for=""><b>Nourie</b></label>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Taux Horaires</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <select name="tauxhoriare" id="" style="width: 140px;">
                                                <option value="0">0</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div style="width: 50% ; display: flex;   gap: 7px;">
                                        <input type="checkbox" name="assure" id="" value="oui">
                                        <label for=""><b>Assuré</b></label>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center; width: 67%;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Cumul Heure</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <input type="text" name="cumulheure" id="">
                                        </div>
                                    </div>
                                </div>


                                <div style="display: flex; justify-content: center; align-items: center; width: 67%;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                        <p>Grade de Salarié</p>
                                        <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                            <input type="text" name="gradesalarie" id=""  style="width: 70%; ">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div style="width: 100%;  height: 200px; "><!--Diplomes-->
                                <p>
                                    <b>Diplomes</b>
                                </p>
                                <div style="display: flex; justify-content: right; align-items: end;  width: 100%;
                                    height: 80%;">
                                    <div style="display: flex; flex-direction: column; align-items: end; justify-content: space-between; height: 100%;">
                                        <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                        <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                    </div>
                                    <div style="width: 100%; height: 100%; padding-top: 10px;">
                                        <div style="width: 100%; height: 100%; border: 1px solid black;">
                                            <div style="display: flex; width: 100%; background-color: black; color: white; " >
                                                <p style="width: 50%;  padding-left: 5px; text-align: center;">Nom</p>
                                                <p style="width: 25%; padding-left: 5px; text-align: center;">Année</p>
                                                <p style="width: 25%; padding-left: 5px; text-align: center;">Mention</p>
                                            </div>
                                            <div style="display: flex; width: 100%; background-color: #2169ec; height: 30px;" >
                                                <p style="width: 50%;  padding-left: 5px;"></p>
                                                <p style="width: 25%; padding-left: 5px;"></p>
                                                <p style="width: 25%; padding-left: 5px;"></p>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div> <!--contrat-->
                                <p>
                                    <b>Contrat</b>
                                </p>
                                <div style="display: flex; align-items: center; justify-content: space-around;">
                                    <label for="">Genre de Salarié</label>
                                    <select name="genresalarie2" id="">
                                        <option value="PERMANENT">PERMANENT</option>
                                        <option value="STAGIAIRE">STAGIAIRE</option>
                                    </select>
                                    <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                    <label for="">Type De Contrat</label>
                                    <select name="contrat" id="">
                                        <option value=" CDD">
                                            CDD
                                        </option>
                                        <option value=" CDI">
                                            CDI
                                        </option>
                                    </select>
                                    <button style="height: 20px; height: 20px;"><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px;"></button>
                                </div>
                                <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                    <label for="">Identifiant Interne</label>
                                    <input type="text" name="identifiantinterne" id="" style=" width: 60%;">
                                </div>
                                <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                    <label for="">Matricule Interne</label>
                                    <input type="text" name="matriculeinterne" id="" style=" width: 60%;">
                                </div>
                                <div style="width: 100%;  display: flex; justify-content: space-between; align-items: center;">
                                    <label for="" style=" width: 30%;">Matricule Social (CNPS)</label>
                                    <input type="text" name="matriculesocial" id="" style=" width: 40%;">
                                    <label for="" style="width: 20%; padding-left: 10px;">N* Enreg</label>
                                    <input type="number" style="width: 15%;" name="numenregistrement">
                                </div>
                                <div style="width: 70%;  display: flex; justify-content: space-between; align-items: center;">
                                    <label for="">NIU (Impots)</label>
                                    <input type="text" name="NIU" id="" style=" width: 60%;">
                                </div>
                                <div>
                                    <p>
                                        <b>Entrée</b>
                                    </p>
                                    <div style="width: 40%;   display: flex; justify-content: space-around;">
                                        <label for="">Entrée</label>
                                        <input type="date" name="dateentree" id="" value="<?= date('Y-m-d') ?>">
                                    </div>
                                    <div style="width: 40%;  display: flex; justify-content: space-around;">
                                        <label for="">Date de Contrat</label>
                                        <input type="date" name="datecontrat" id="" value="<?= date('Y-m-d') ?>">
                                    </div>
                                </div>
                                <div>
                                    <p>
                                        <b>Depart</b>
                                    </p>
                                    <div style="width: 50%;   display: flex; justify-content: space-evenly; align-items: center;">
                                        <label for="" style="width: 100%; ">Date de Depart</label>
                                        <input type="date" name="datedepart" id="" style="width: 500px;">
                                        <div>
                                            <input type="checkbox" name="" id="" value="archive">
                                            <label for="">Archivé</label>
                                        </div>
                                    </div>
                                    <div style="width: 40%;   display: flex; justify-content: space-around;">
                                        <label for="">Motif De Depart</label>
                                        <input type="text" name="motifdepart" id="">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <section class="econte2">
                            <div class="class1">
                                <div class="class2 spec1">
                                    <div class="class3">
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <label for="">Prestataire externe ?</label>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="" id="">
                                            <label for="">Prestataire externe ?</label>
                                        </div>
                                    </div>
                                    <div class="class4">
                                        <div>
                                            <label for="">Carte a puce</label>
                                            <div>
                                                <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                                <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt=""  style="width: 20px; height: 20px;"></button>
                                            </div>
                                        </div>
                                        <div>
                                            <label for="">Biometrie</label>
                                            <div>
                                                <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt=""  style="width: 20px; height: 20px;"></button>
                                                <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt=""  style="width: 20px; height: 20px;"></button>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div style="background-image: url(./fond.png);" class=" spec2">
                                    <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                    <button><img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>

                                </div>
                            </div>

                            <div class="class5">
                                <div class="class6">
                                    <button class="clicked">Horaires</button>
                                    <button>Services</button>
                                    <button>Messagerie</button>
                                    <button>Biometrie</button>
                                </div>
                                <div class="class7">
                                    <div class="class8">
                                        <div class="qwe1"><br>
                                            <div  class="ligne">
                                                asd
                                            </div>
                                        </div>
                                        <div class="qwe2">
                                            <div class="activer">
                                                <input type="checkbox" name="" id="">
                                                <p>
                                                    Activer
                                                </p>
                                            </div>
                                            <div class="opt">
                                                <div class="option_debut">
                                                    <label for="">Début Option</label>
                                                    <input type="time" name="" id="" value="<?= date('H:i') ?>">
                                                </div>
                                                <div class="Option_fin">
                                                    <label for="">Fin Option</label>
                                                    <input type="time" name="" id="" value="<?= date('H:i') ?>">
                                                </div>
                                            </div>
                                            <div class="btn_bas">
                                                <button>Ajouter<img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                                <button>Retirer<img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" style="width: 20px; height: 20px;"></button>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="class9">
                                        <div>
                                            <input type="checkbox" name="lundi" id="" value="1">
                                            <p>Lundi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="mardi" id="" value="1">
                                            <p>Mardi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="mercredi" id="" value="1">
                                            <p>Mercredi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="jeudi" id="" value="1">
                                            <p>Jeudi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="vendredi" id="" value="1">
                                            <p>Vendredi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="samedi" id="" value="1">
                                            <p>Samedi</p>
                                        </div>
                                        <div>
                                            <input type="checkbox" name="dimanche" id="" value="1">
                                            <p>Dimanche</p>
                                        </div>

                                    </div>
                                </div>


                                <div>

                                </div>
                            </div>




                        </section>

                    </div>
                </div>


                <div class="option">
                    <div style="width: 50%; padding-left: 30px;">
                        <input type="submit" value="Ajouter" name="ajouter">
                    </div>


                    <div style="width: 50%; display: flex; gap: 20px;">
                        <button class="btn1"><</button>
                        <button class="btn2">></button>
                    </div>

                    <div style="width: 100%; display: flex; justify-content: space-around;">
                        <button>Recherche</button>
                        <button>Imprimer</button>
                        <button>Vider</button>
                    </div>

                    <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                        <button class="Fermer">Fermer</button>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>
</form>



<script>
    const employer = document.querySelector(".Nouveau");
    const cont_emp = document.querySelector(".cont_employer");
    employer.addEventListener("click", () => {
        cont_emp.style.display = "flex";
    });
</script>
<script>
    const close_window = document.querySelector(".close_window");
    const cont_employe = document.querySelector(".cont_employer");
    close_window.addEventListener("click", () => {
        cont_employe.style.display = "none";
    });
</script>
<script>
    const ferme = document.querySelector(".Fermer");
    const cont_employer = document.querySelector(".cont_employer");
    const Diver_cont = document.querySelector(".divers_cont");
    ferme.addEventListener("click", () => {
        cont_employer.style.display = "none";
        Diver_cont.style.display = "none";
    });
</script>
<script>
    const diverBtn = document.querySelector(".divers");
    const cont_diver = document.querySelector(".divers_cont");
    diverBtn.addEventListener("click", () => {
        cont_diver.style.display = "flex";
    })
</script>
<script>
    const emploBtn = document.querySelector(".employers_btn");
    const cont_divers = document.querySelector(".divers_cont");
    emploBtn.addEventListener("click", () => {
        cont_divers.style.display = "none";
    })
</script>
<script>
    const close_window2 = document.querySelector(".close_window2");
    const cont_employe2 = document.querySelector(".cont_employer");
    const Diver_contr2 = document.querySelector(".divers_cont");
    close_window2.addEventListener("click", () => {
        cont_employe2.style.display = "none";
        Diver_contr2.style.display = "none";
    });
</script>
<script>
    const fermer = document.querySelector(".Fermerr");
    const cont_employerr = document.querySelector(".cont_employer");
    const Diver_contr = document.querySelector(".divers_cont");
    fermer.addEventListener("click", () => {
        cont_employer.style.display = "none";
        Diver_cont.style.display = "none";
    });
</script>



<?php

$content = ob_get_clean();
include 'layout.php';
?>
