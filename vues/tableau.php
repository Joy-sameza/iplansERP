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




   <main >
    <div class="haut_avec_label mt-3"> <!--le haut avec les label-->
        <div class="d-flex">
            <div class="d-flex p-2">
            <span class="m-2">Site(Agence) </span>
            <select   name="" id=""  class="form-select p-2">
                   <option value="">Demo</option>
                </select>
             </div>
             <div class="d-flex p-2">   
            <span class="m-2">Departement</span>
                <select name="" id=""  class="form-select p-2">
                   <option value="">TOUS</option>
                </select>
             </div>   
             <div class="d-flex p-2">
            <span class="m-2">Genre</span>
                <select name="" id=""  class="form-select p-2">
                   <option value="">Permanent</option>
                </select>
            </div>   
            
            <input type="checkbox" class="form-check-input mt-3" name="" id=" " > 
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
            </thead>
            <tbody id="pers_table">
                <?php
                foreach ($d as $pack) {
                ?>
                    <tr>
                        <td><?= $pack['civilite'] ?></td>
                        <td><?= $pack['nom'] ?></td>
                        <td><?= $pack['prenom'] ?></td>
                        <td><?= $pack['Fonction'] ?></td>
                        <td><?= $pack['phone'] ?></td>
                        <td><?= $pack['PSeudo'] ?></td>
                        <td><?= $pack['Matricule'] ?></td>
                        <td><?= $pack['MatriculeInterne'] ?></td>
                        <td><?= $pack['cni'] ?></td>
                        <td><?= $pack['Email'] ?></td>
                        <td><?= $pack['dnais'] ?></td>
                        <td><?= $pack['npere'] ?></td>
                        <td><?= $pack['nmere'] ?></td>
                        <td><?= $pack['vnais'] ?></td>
                        <td><?= $pack['nurg'] ?></td>
                        <td><?= $pack['nuurg'] ?></td>
                        <td><?= $pack['AgenceBanque'] ?></td>
                        <td><?= $pack['CodeBanque'] ?></td>
                        <td><?= $pack['CodeGuichetBanque'] ?></td>
                        <td><?= $pack['NumeroCompteBanque'] ?></td>
                        <td><?= $pack['CleRibBanque'] ?></td>
                        <td><?= $pack['CodeSwiftBanque'] ?></td>
                        <td><?= $pack['CodeUtilisateur'] ?></td>
                        <td><?= $pack['categorie'] ?></td>
                        <td><?= $pack['Grade'] ?> </td>
                        <td><?= $pack['Convention'] ?></td>
                        <td><?= $pack['departement1'] ?></td>
                        <td><?= $pack['Direction'] ?></td>
                        <td><?= $pack['SousDirection'] ?></td>
                        <td><?= $pack['Service'] ?></td>
                        <td><?= $pack['motif_depart'] ?></td>
                        <td><?= $pack['date_sortie'] ?></td>
                        <td><?= $pack['date_entree'] ?></td>
                        <td><?= $pack['genre_salarie'] ?></td>
                        <td><?= $pack['type_contrat'] ?></td>
                        <td><?= $pack['IDDate_Contrat'] ?></td>
                        <td><?= $pack['IDDate_Sortie'] ?></td>
                        <td><?= $pack['LieuDelivranceCNI'] ?></td>
                        <td><?= $pack['DateExpirationCNI'] ?></td>
                        <td><?= $pack['IDDateExpirationCNI'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>


    </div><!--fin de zone du tableau-->

    

    <form id="categie_form">
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
                        <input type="checkbox"  class="form-check-input" name="actif" id="">
                    </div>
                    <div>
                        <input type="date" id="date_debut"  value="<?= date('Y-m-d') ?>">
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
     <div style="" class="container-fluid d-flex justify-content-between mb-4">
        <div class="col-sm-9 ">
            
            <button class="bouton Nouveau " ><i class="fas fa-external-link-alt svg"></i>Nouveau</button>
            <button class="bouton " ><i class="fas fa-folder-open svg"></i>Ouvrir</button>
            <button class="bouton" ><i class="fas fa-trash svg"></i>Suprimer</button>
            <button class="bouton"  id="print_table"><i class="fas fa-print svg"></i>Imprimer</button>
            <button class="bouton" > <i class="fas fa-clock svg"></i>Pointages</button>
            <button class="bouton email" > <i class="fas fa-envelope svg" ></i>Envoyer un Email </button>
        </div>
        <div class="col-sm-3 d-flex justify-content-end ">
            <button class="bouton"  id="recherche"> <i class="fas fa-search svg"></i></i>Recherche47</button>
            <button class="bouton fermer" id="fermer_page" > <i class="fas fa-close svg"></i>Fermer</button>
        </div>

     </div>
     <div style='visibility: hidden;'><p>juste de lespace</p></div>
     <style>
        .container-fluid{
            margin-bottom: 4rem;
        }
        .bouton{
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
        .bouton:hover{
             background-color:#0b9444;
        }
        .fermer{
            background-color: #BB2D3B !important;
        }
        .svg{
          width:19px!important;
          margin-right: 3px !important;
        }
        
        .zone select {
            width: 100%;
            height: 45px;

        }

        .header{
            display:none;
        }
         .aphabet p {
           background-color: #248CCC !important;
           width: 100%;
           text-align: center;

        }
          .aphabet .a-z {
     background-color: white !important;
      }
     
    
      body{
        padding: 0 20px 0 20px !important;
      } 

      /* scrollbar du tableau */

      ::-webkit-scrollbar {
  width: 8px;
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
        height: 10px; /* Ajuster la hauteur de la barre de défilement horizontale */
    }

    &::-webkit-scrollbar-thumb {
        background-color: #3498db; /* Couleur du curseur de défilement */
    }

    &::-webkit-scrollbar-track {
        background-color: #ecf0f1; /* Couleur de la piste de défilement */
    }
   
       &:hover {
        &::-webkit-scrollbar-thumb {
            background-color: #0b9444; /* Changement de couleur au survol */
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

<form data-form enctype="multipart/form-data" method="post" action="<?= SITE_URL ?>/forms/formdata.php">



    <div class="cont_employer" style="display: none;">
        <!----employer formulaire------->
        <div class="contenue_employers">
            <div class="cont_titre ">
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h2 class="fiche_sala">Fiche Salarié47</h2>
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
                    .list_gauche:hover{
                            cursor: pointer;

                    }
                </style>


                <div class="econte">
                    <div class="econte1">
                        <h1 style="background-color: black;color: white; padding: 12px;" >Employé</h1>
                        <section class="div_1">
                            <h3 style="font-size: 25px;">Identité</h3>
                            <div class="idntite1">
                                <div>
                                    <label for="">Civilité</label>
                                    <select name="civilite"  class="form-select form-select" id="" style="width: 100%;">
                                        <option value="Monsieur">Monsieur</option>
                                        <option value="Madame">Madame</option>
                                    </select>
                                    <div style="display: flex; flex-direction: column;">
                                        <h3 style="margin-top: -10px; margin-left:-40px;">sexe</h3>
                                        <div style="display: flex ; gap: 7px; margin-top: -7px;">
                                            <label for="">Masculin</label>
                                            
                                            <input type="radio"  value="1" name="genre">

                                            <label for="">Feminin</label>
                                            <input type="radio" value="1" name="genre">
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="idntite2">
                                <label for="" class="mt-3">Nom</label>
                                <input type="text" class="form-control mt-3" name="nom" required>
                            </div>
                            <div class="idntite3">
                                <label for=""class="mt-3">Prenom</label>
                                <input type="text" class="form-control mt-3" name="prenom">
                            </div>
                            <div class="idntite4">
                                <label class="mt-3" for="" style="width: 80%">N* Carte national</label>
                                <input type="text" class="form-control mt-3" name="cni">
                                <label class="mt-3" for="" style="width: 40%">Fait a</label>
                                <input type="text" class="form-control mt-3" name="fait" required>
                                <label class="mt-3" for="" style="width: 70%">Expire le</label>
                                <input type="date" name="expire" class="form-control mt-3" value="<?= date('Y-m-d') ?>">
                            </div>
                            <div class="idntite5">
                                <label class="mt-3"for="">Adresse</label>
                                <input type="text" class="form-control mt-3"  name="adresse">
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
                                <select class="form-select form-select-sm" name="siteagence" id="">
                                    <option value="DEMO">DEMO</option>
                                </select>
                            </div>
                            <div class="idntite9">
                                <label class="mt-3" for="">Direction </label>
                                <select class="form-select form-select-sm" name="direction" id="">
                                    <option value="">BICEC</option>
                                    <option value="">UBA</option>
                                </select>
                            </div>
                            <div class="idntite10">
                                <label class="mt-3"for="">Sous-Direction </label>
                                <select class="form-select form-select-sm" name="sousdirection" id="">
                                    <option value="">BICEC</option>
                                </select>
                            </div>
                            <div class="idntite11">
                                <label class="mt-3"for="">Service </label>
                                <select class="form-select form-select-sm" name="service" id="">
                                    <option value="SSMEDICAL">SSMEDICAL</option>
                                </select>
                            </div>
                            <div class="idntite12">
                                <label class="mt-3" for="">Departement </label>
                                <select class="form-select form-vert form-select-sm" name="departement" id="">
                                    <option value="CHAUFFEUR">CHAUFFEUR</option>
                                </select>
                            </div>
                            <div class="idntite13">
                                <label class="mt-3" for="">Poste Occupé </label>
                                <select class="form-select form-bleu form-select-sm" name="posteoccupe" id="">
                                    <option value="PROJECT MANAGER">PROJECT MANAGER</option>
                                </select>
                            </div>
                            <style>
                                .form-vert {
                                   background-color: #3498db; 
                                }
                                .form-bleu {
                                   background-color:   #0b9444
                                }
                                 .form-vert>select option {
                                   background-color: #3498db; 
                                }
                                .form-bleu>select option{
                                   background-color:   #0b9444
                                }
                            </style>
                        </section>

                   <!-- css interne de employer -->

                <style>
                    .svg-close{
                        width:25px!important;
                        color:white;
                    }
                    .ico_emplye{
                         margin-right: 3px !important;
                    }
                    .se1 p{
                        color:black;
                    }
                    /* identite css */
                    .div_1{
                        padding-left: 10px;
                    }
                    .div_1 label{
                        font-size: 18px
                    }
                    /* taille du containeur*/
                    .contenue_employers{
                         height: 600px;
                         overflow: auto;
                    }
                   
                </style>



                        <div class="div_2 bordure">
                            <h4 class='p-2 mt-3 '>Info Personnelles</h4>
                            <div>
                                <div class="te1">
                                    <label class="mt-3"for="">Date de Naissance</label>
                                    <input type="date"class="form-control mt-3"  name="datenaissssance" id="" value="<?= date('Y-m-d') ?>">
                                </div>
                                <div>
                                    <label class="mt-3"for="">Lieu de Naissance</label>
                                    <select name="lieunaissance" class="form-select form-select slectdate mt-3" id="" style="width: 80%; margin-right: 30%;">
                                        <option value="">Dschang</option>
                                        <option value="">Douala</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="mt-3"for="">Nom du Pere</label>
                                    <input type="text" class="form-control mt-3" name="nompere" id="">
                                </div>
                                <div>
                                    <label class="mt-3"for="">Nom de la mere</label>
                                    <input type="text" class="form-control num mt-3" name="nommere" id="">
                                </div>
                                <div>
                                    <label class="mt-3"for="">nom durgence</label>
                                    <input type="text" class="form-control mt-3" name="nomurgence" id="">
                                </div>
                                <div>
                                    <label class="mt-3"for="">Numero D'urgence</label>
                                    <input type="tel" class="form-control num mt-3" name="numerourgence" id="">
                                </div>
                                <div>
                                    <label class="mt-3"for="">Adresse email</label>
                                    <input type="email" class="form-control mt-3" name="email" id="">
                                </div>
                                <div>
                                    <label class="mt-3"for="">Adresse email pro~</label>
                                    <input type="email"  class="form-control mt-3" name="emailpro" id="">
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
                                                <p>Celebataire <input type="radio"  id="radio1" name="optradio" value="option1" checked></p>
                                                <p>Marié <input type="radio"  id="radio1" name="optradio" value="option1" ></p>
                                                <p>Divorcé <input type="radio"  id="radio1" name="optradio" value="option1"></p>
                                                <p> <input type="radio"  id="radio1" name="optradio" value="option1">Veuf \ Veuve</p>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- css pour la div 2 -->
                    <style>
                       .div_2 label{
                        font-size: 18px
                    }
                    .slectdate{
                            height: 31px !important;
                    }

                    .num{
                        margin-top: 1rem!important;
                    }
                    .situation p,label{
                      font-size: 18px
                    }
                    .div_2 input[type="radio"]{
                            width: 15% !important;
                            height: 19px !important;
                    }
                    /* .econte1 div {
                        margin: 0;
                        padding: 0;
                    } */
                     .bordure{
                        padding-left: 10px;
                    }

                    .cont_employer2{
                        height: 205%;
                         padding-left: 7px;
                    }
                    .se1 p{
                    font-size: 17px;
                    font-weight: 600;
                    }
                    .spec1{
                            justify-content: space-around;
                    }
                    </style>
                    





<section class="econte2">
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
                                            <button><img  src="<?= SITE_URL ?>/assets/img/floppy-disk.png" alt="" style="width: max-content; height: 35px;"></button>
                                            <button><img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 40px;"></button>

                                          
                                        </div>
                                    </div>
                                    <div>
                                        <label class=' gras mt-3' for="">Biometrie</label>
                                        <div>
                                            <button><img  src="<?= SITE_URL ?>/assets/img/floppy-disk.png" alt="" style="width: max-content; height: 35px;"></button>
                                            <button><img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 40px;"></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- css pour les bouton -->
                                <style>
                                    .class4 img{
                                            width: 33px!important;
                                    }
                                    .gras{
                                        font-weight: 600; 
                                    }
                                   .spec2, .spec1{
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
                                                <img  src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 35px;">
                                            </button>
                                            <button class="choose-img">
                                                <img class="choose-img" src="<?= SITE_URL ?>/assets/img/camera.png" alt="" style="width: max-content; height: 35px;">
                                            </button>
                                        </div>
                                </div> 
                            </div>
                             <!-- css pour les bouton et images -->
                             <style>
                                .spec2{
                                     height: 100%;
                                     width: 100%;
                                     display: flex;
                                     flex-direction: column;
                                     justify-content: space;
                                     align-items: flex-end;
                                }
                                .placeholder-img{
                                     width: 300px!important;
                                     height: 400px!important;
                                }

                                .preview-img img{
                                    max-width: 490px;
                                    min-height: 335px;
                                    width: 100%;
                                    height: 100%;
                                    object-fit: contain;
                               }
                              .preview-img{
                                    display: flex;
                                    overflow: hidden;
                                    align-items: center;
                                     justify-content: center;
                                   margin-left: 20px; 
                                     border: 2px solid #aaa;
                                     border-radius: 10px;
                            }
                            .zone{
                                    justify-content: flex-start!important;
                                    gap:10px;
                            }
                            section button{
                                border: 1px solid gray;
                                border-radius: 5px;
                                transition: background-color 0.3s ease, box-shadow 0.3s ease;

                            }
                                section button:hover {
                                background-color: #D3D3D3;; /* Gris foncé */
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
                                         
                                            
                                            <button>Ajouter<img  src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;"></button>
                                            <button>Retirer<img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
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
                                .option-horaire{
                                    font-size: 25px;
                                    font-weight: 500;
                                }
                            </style>


                            <div>

                            </div>
                        </div>

                     <style>
                        .pagination{
                            width: 100%;
                            
                        }
                        .pagination span{
                            font-size: 21px;
                             font-weight: 500;
                        }
                        .pagination li{
                            border:0px solid gray;
                        }
                        .espace{
                            margin-left:30px ;
                        }
                        #activer{
                           background:white!important;
                           border: 0px;
                        }
                        .page-link0{
                            background: #DEE2E6!important;
                        }
                        /* .page-item{
                            display:flex;
                            text-content:center;
                        } */
                     </style>

 </section>

                </div>
            </div>

            <!-- css pour la div de droite -->
            <style>
               
            </style>


            <div class="option47">
                <div style="width: 50%; padding-left: 30px;">
                     <button>Ajouter<img  src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>


                <div style="width: 50%; display: flex; gap: 20px;">
                    <button class="btn1">❮❮</button>
                   
                    <button class="btn2">❯❯</button>
                </div>

                <div style="width: 100%; display: flex; justify-content: space-around;">
                <button>Recherche<img  src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 20px;"></button>
                <button>Imprimer<img  src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;"></button>
                <button>Vider<img  src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;"></button>
                
                </div>

                <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                   <button class='close_window' id='fermer'>Fermer<img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>

            </div>

        </div>
        <style>
            .option47{
                    display: flex;
                    justify-content: space-around;
                    align-items: center;
                    width: 100%;
                    height: 7%;
            }
            .option47 button{
                    width: 110px;
                     height: 36px;
                     border:1px solid gray;
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
                            <img src="<?= SITE_URL ?>/assets/image/la terre.webp" alt="" class="ico_emplye">
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
                                    .se1{
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


                        <div class="econte"  style="zoom: 95%; ">
                            <div class="econte1 gauche-divers" style="border-right: 2px solid gray;">
                                <h1 style="background-color: black;color: white; padding: 12px;" >Divers</h1>
                                <div style="padding-top: 10px;">
                                    <ul class="pagination">
                                        <li class="page-item d-flex justify-content-center"><a id='activer' class="page-link page-link0 px-4  m-0 text-dark  " href="#"> <span>Categorie</span></a></li>
                                        <li class="page-item"><a class="page-link page-link0 px-4 text-dark m-0 " href="#"><span> Banque</span></a></li>

                                      
                                 </ul>
                                </div>
                                <div class="Autre"> <!--le carre autre commence ici -->
                                   <span style="font-size: 30px;margin-left:10px ;" >Autres</span>
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                            <p>Convention Collective</p>
                                            <div style="display: flex; justify-content: left;width: 50%; gap: 7px;">
                                                <select class="form-select form-select-sm"  name="conventioncollective" id="" style='background-color:#238fce ;'>
                                                    <option></option>
                                                    <option>FONCTIONNAIRE</option>
                                                </select>
                                                <button style="height: 25px; height: 25px; padding-top:3px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/plus.png" alt=""></button>
                                            </div>
                                        </div>
                                        <div style="width: 50% ; display: flex;   gap: 7px;">
                                            <label for="">echellon</label>
                                            <select class="form-select form-select-sm" style='background-color:#238fce ;'  name="echellon" id="" >
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
                                                <input class="form-control "  type="number" name="salairebase">
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
                                                <select class="form-select form-select-sm"  name="heuresemaine" id="" style="width: 140px;" style='background-color:#238fce ;'>
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
                                                <select class="form-select form-select-sm"  name="tauxhoriare" id="" style="width: 140px;">
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
                                                        .econte1 div{
                                                           
                                                             
                                                        }
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
                                                                <td><p><p></td>
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
                                      .bleauta{
                                          background: #2169EC!important;
                                      }
                                </style>

                                <div> <!--contrat-->
                                    <p>
                                        <b>Contrat</b>
                                    </p>
                                    <div style="display: flex; align-items: center; justify-content: space-around;">
                                        <label for="">Genre de Salarié</label>
                                        <select class="form-select form-select-sm"  name="genresalarie2" id="">
                                            <option value="PERMANENT">PERMANENT</option>
                                            <option value="STAGIAIRE">STAGIAIRE</option>
                                        </select>
                                       <button style="height: 25px; height: 25px; padding-top:3px; padding-right:45px; border:none; background-color:#fff"><img src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: 20px;"></button>
                                        <label for="">Type De Contrat</label>
                                        <select class="form-select form-select-sm"  name="contrat" id="">
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
                            <!--  css pour la premiere partie gauche de divers -->
                            <style>
                                .gauche-divers label,p{
                                    font-size: 20px;
                                    margin-top:10px;
                                }
                                label b{
                                    padding-top:-40px;
                                }
                                .gauche-divers button{
                                        height: 34px;
                                        
                                }

                            </style>

                           <section class="econte2">
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
                                            <button><img  src="<?= SITE_URL ?>/assets/img/floppy-disk.png" alt="" style="width: max-content; height: 35px;"></button>
                                            <button><img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 40px;"></button>

                                          
                                        </div>
                                    </div>
                                    <div>
                                        <label class=' gras mt-3' for="">Biometrie</label>
                                        <div>
                                            <button><img  src="<?= SITE_URL ?>/assets/img/floppy-disk.png" alt="" style="width: max-content; height: 35px;"></button>
                                            <button><img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 40px;"></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- css pour les bouton -->
                                <style>
                                    .class4 img{
                                            width: 33px!important;
                                    }
                                    .gras{
                                        font-weight: 600; 
                                    }
                                   .spec2, .spec1{
                                            justify-content: center !important;
                                    } 
                                    .econte2{
                                        width: 100%;
                                         zoom: 79%;
                                    }
                                    
                                </style>

                            </div>

                            <div class=" spec2">
                                <div class="preview-image">
                                    
                                    
                                    <img src="<?= SITE_URL ?>/assets/img/images.png" class='placeholder-img' alt="">
                                </div>
                                 <div class='zone'>
                                        <div class="roww">
                                            <input type="file" class="input-file" accept="image/*" hidden>
                                            <button style='margin-left: 24px;'>
                                                <img  src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 35px;">
                                            </button>
                                            <button class="choix-img">
                                                <img class="choix-img" src="<?= SITE_URL ?>/assets/img/camera.png" alt="" style="width: max-content; height: 35px;">
                                            </button>
                                        </div>
                                </div>

                            </div>
                             <!-- css pour les bouton et images -->
                             <style>
                                .spec2{
                                     height: 100%;
                                     width: 100%;
                                     display: flex;
                                     flex-direction: column;
                                     justify-content: space;
                                     align-items: flex-end;
                                }
                                .placeholder-img{
                                     width: 300px!important;
                                     height: 400px!important;
                                }

                                .preview-img img{
                                    max-width: 490px;
                                    min-height: 335px;
                                    width: 100%;
                                    height: 100%;
                                    object-fit: contain;
                               }
                               .preview-image img{
                                   max-width: 490px;
                                    min-height: 335px;
                                    width: 100%;
                                    height: 100%;
                                    object-fit: contain;
                               }
                              .preview-img{
                                    display: flex;
                                    overflow: hidden;
                                    align-items: center;
                                     justify-content: center;
                                   margin-left: 20px; 
                                     border: 2px solid #aaa;
                                     border-radius: 10px;
                            }
                            .preview-image{
                                    display: flex;
                                    overflow: hidden;
                                    align-items: center;
                                     justify-content: center;
                                   margin-left: 20px; 
                                     border: 2px solid #aaa;
                                     border-radius: 10px;
                            }
                            .zone{
                                    justify-content: flex-start!important;
                                    gap:10px;
                            }
                            section button{
                                border: 1px solid gray;
                                border-radius: 5px;
                                transition: background-color 0.3s ease, box-shadow 0.3s ease;

                            }
                                section button:hover {
                                background-color: #D3D3D3;; /* Gris foncé */
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
                            <div class="class7" style="padding-left: 30px;">
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
                                         
                                            
                                            <button>Ajouter<img  src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;"></button>
                                            <button>Retirer<img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
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
                              
                            </style>


                            <div>

                            </div>
                        </div>

                    




  </section>

                        </div>
                    </div>


                    <div class="option47">
                          <div style="width: 50%; padding-left: 30px;">
                     <button>Ajouter<img  src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>


                <div style="width: 50%; display: flex; gap: 20px;">
                    <button class="btn1">❮❮</button>
                   
                    <button class="btn2">❯❯</button>
                </div>

                <div style="width: 100%; display: flex; justify-content: space-around;">
                <button>Recherche<img  src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 20px;"></button>
                <button>Imprimer<img  src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;"></button>
                <button>Vider<img  src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;"></button>
                
                </div>

                <div style="width: 100%; display: flex; justify-content: right; padding-right: 30px;">
                   <button>Fermer<img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;"></button>
                </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</form>

<template id="pers_table_template">
    <tr>
        <td data-civilite></td>
        <td data-nom></td>
        <td data-prenom></td>
        <td data-Fonction></td>
        <td data-phone></td>
        <td data-PSeudo></td>
        <td data-Matricule></td>
        <td data-MatriculeInterne></td>
        <td data-cni></td>
        <td data-Email></td>
        <td data-dnais></td>
        <td data-npere></td>
        <td data-nmere></td>
        <td data-vnais></td>
        <td data-nurg></td>
        <td data-nuurg></td>
        <td data-AgenceBanque></td>
        <td data-CodeBanque></td>
        <td data-CodeGuichetBanque></td>
        <td data-NumeroCompteBanque></td>
        <td data-CleRibBanque></td>
        <td data-CodeSwiftBanque></td>
        <td data-CodeUtilisateur></td>
        <td data-categorie></td>
        <td data-Grade></td>
        <td data-Convention></td>
        <td data-departement1></td>
        <td data-Direction></td>
        <td data-SousDirection></td>
        <td data-Service></td>
        <td data-motif_depart></td>
        <td data-date_sortie></td>
        <td data-date_entree></td>
        <td data-genre_salarie></td>
        <td data-type_contrat></td>
        <td data-IDDate_Contrat></td>
        <td data-IDDate_Sortie></td>
        <td data-LieuDelivranceCNI></td>
        <td data-DateExpirationCNI></td>
        <td data-IDDateExpirationCNI></td>
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
    const boutonsFermer = document.querySelectorAll("#close_window");
   const conteneur0 = document.querySelector(".cont_employer");

        if (conteneur0) {
            boutonsFermer.forEach((bouton) => {
                bouton.addEventListener("click", (e) => {
                    e.preventDefault();
                    conteneur0.style.display = "none";
                });
            });
        }
  </script>
  <script>
    const boutonsFermer = document.querySelectorAll("#fermer");
   const conteneur0 = document.querySelector(".cont_employer");

        if (conteneur0) {
            boutonsFermer.forEach((bouton) => {
                bouton.addEventListener("click", (e) => {
                    e.preventDefault();
                    conteneur0.style.display = "none";
                });
            });
        }
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
         const boutonFermerPage = document.getElementById("fermer_page");

        if (boutonFermerPage) {
            boutonFermerPage.addEventListener("click", () => {
                window.close(); // Cette ligne ferme la fenêtre actuelle
            });
        }

    </script>

  <!-- script pour limage -->

  <script>
    const fileInput = document.querySelector(".file-input")
    const chooseImgBtn = document.querySelector(".choose-img")
    const previewImg = document.querySelector(".preview-img img")

    const loadImage = () => {
    let file = fileInput.files[0]; // getting user selected file
    console.log(file)
    if (!file) return;// return if user hasn't selected file
    previewImg.src = URL.createObjectURL(file)// passing file url as preview img src
   }

   chooseImgBtn.addEventListener("click", () => fileInput.click())
   fileInput.addEventListener("change", loadImage)
 </script>


  <script>
    //pour
    const fileInput = document.querySelector(".input-file")
    const chooseImgBtn = document.querySelector(".choix-img")
    const previewImg = document.querySelector(".preview-image img")

    const loadImage = () => {
    let file = fileInput.files[0]; // getting user selected file
    console.log(file)
    if (!file) return;// return if user hasn't selected file
    previewImg.src = URL.createObjectURL(file)// passing file url as preview img src
   }

   chooseImgBtn.addEventListener("click", () => fileInput.click())
   fileInput.addEventListener("change", loadImage)

                                 
 </script>




<!-- fermer -->
<script>
    const boutonFermer = document.getElementById("fermer");
    const cont_employer = document.querySelector(".cont_employer");

    boutonFermer.addEventListener("click", (e) => {
        e.preventDefault();
        cont_employer.style.display = "none";
    });
</script>


</div>


<?php

$content = ob_get_clean();
include 'layout.php';
?>
