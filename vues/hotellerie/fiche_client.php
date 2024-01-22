<?php
ob_start();
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




?>


    <div class="container-fluid conteneur0  border border-2 border-primary" style='width:100%;border-bottom:none;'>

        <div class="row bg-primary border-1 ">
            <div class="cont_titre d-flex justify-content-between  " style='align-items: center;'>
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h6 class="fiche_sala" style='color:white;'>Liste des clients</h6>

                </div>

                <div>
                    <button class="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                </div>
            </div>
        </div>
        <!-- fin du header  -->
        <div class="container-fluid bout d-flex justify-content-start">
          

             <button type="button" class="bouton active" id='selection1' > Selection1
                    </button>
                   
                     <button type="button" class="bouton" id='selection2'
                      >
                        Selection2
                    </button>
                    <style>
                         .bouton.active {
                        background-color: gray;
                        color:white;
                       
                        }
                    </style>
           

        </div>
        <div>
            <form id="filterForm">
                <div class="row d-flex ">
                    <div class='englobe' style='width:19%;padding:0px;margin:0px;position:relative;'>
                        <div style='width:100%;height: 91px;' class='p-1 pt-2 border border-2 mt-3 border-secondary option_cont'>
                            <div class="text-divider-container1">
                                <div class="text-divider">
                                    <span>Periode Enregistrement</span>
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
                    <div class='englobe mx-1' style='width:18%;padding:0px;margin:0px;position:relative;'>
                        <div style='width:100%; height: 91px;' class='p-2 border border-1 option_cont border-2 mt-3 border-secondary'>
                            <div class="text-divider-container2">
                                <div class="text-divider">
                                    <span>Selection</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                                <label for="site" class="form-label">Site </label>
                                <select class="form-select-sm " style='width:50%' id="site">
                                    <option SELECTED>DEMO</option>
                                    <option value="">DEPOT DOUCHE</option>
                                    <option value="">DEPOT YASSA</option>
                                    <option value="">DEPOT NGAOUNDERE</option>
                                </select>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-1'>
                                <label for="departement" class="form-label">Zone/Quartier </label>
                                <select class="form-select-sm " style='width:50%' id="departement">
                                    <option SELECTED value="TOUS">TOUTES</option>
                                    <option value="ADMINISTRATIF">BAMENDA</option>
                                    <option value="ADMINISTRATIION">NGAOUNDERE</option>
                                    <option value="APPLICATION">BONAMOUSSADI</option>
                                    <option value="COMMERCIAL">MAKEPE</option>
                                    <option value="ENTREPOT">AKWA</option>
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class='englobe mx-1' style='width:18%;padding:0px;margin:0px;position:relative;'>
                        <div style='width:100%; height: 91px;' class='p-2 border border-1 option_cont border-2 mt-3 border-secondary'>
                            <div class="text-divider-container2">
                                <div class="text-divider">
                                    <span>Selection</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                                <label for="site" class="form-label">Type </label>
                                <select class="form-select-sm " style='width:50%' id="site">
                                    <option SELECTED>TOUS</option>
                                    <option value="">NORMAL</option>
                                    <option value="">HANDICAPE</option>
                                    <option value="">PASSAGE</option>
                                    <option value="">VIP</option>
                                </select>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-1'>
                                <label for="departement" class="form-label">Categorie </label>
                                <select class="form-select-sm " style='width:50%' id="departement">
                                    <option SELECTED value="TOUS">TOUTES</option>
                                    <option value="">AGE MOYEN </option>
                                    <option value="">JEUNE</option>
                                    <option value="">VIELLIARD</option>
                                   
                                   
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class='englobe' style='width:9%;padding:0px;margin:0px;position:relative;margin-right:5px'>
                        <div style='width:100%;height: 91px;' class='p-2 border border-1 option_cont border-2 mt-3 border-secondary'>
                            <div class="text-divider-container3">
                                <div class="text-divider">
                                    <span>Sexe</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between;flex-direction: column;">
                                <div class="form-check" >
                                    <input type="checkbox" class="form-check-input" id="Masculin"value="toutes">
                                    <label class="form-check-label" for="Masculin">Masculin</label>
                                </div>
                                <div class="form-check" >
                                    <input type="checkbox" class="form-check-input" id="Feminin" name="Feminin" value="Feminin">
                                    <label class="form-check-label" for="check2">Feminin</label>
                                </div>
                                <div class="form-check" >
                                    <input type="checkbox" class="form-check-input" id="Tous" name="Tous" value="Tous">
                                    <label class="form-check-label" for="check2">Tous</label>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                    <div class='englobe' style='width:9%;padding:0px;margin:0px;position:relative;'>
                        <div style='width:100%;height: 91px;' class='p-2 border border-1 option_cont border-2 mt-3 border-secondary'>
                            <div class="text-divider-container4">
                                <div class="text-divider">
                                    <span>Prospect</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between;flex-direction: column;">
                                <div class="form-check" >
                                    <input type="checkbox" class="form-check-input" id="Masculin"value="toutes">
                                    <label class="form-check-label" for="Masculin">Non</label>
                                </div>
                                <div class="form-check" >
                                    <input type="checkbox" class="form-check-input" id="Feminin" name="Feminin" value="Feminin">
                                    <label class="form-check-label" for="check2">Oui</label>
                                </div>
                                <div class="form-check" >
                                    <input type="checkbox" class="form-check-input" id="Tous" name="Tous" value="Tous">
                                    <label class="form-check-label" for="check2">Tous</label>
                                </div>
                            </div>
                           
                        </div>
                    </div>
                   
                </div>
            </form>
        </div>
        <!-- fin de la div qui suit  -->


        <div class="row " >
            <div class="table-responsive debut_tableau w-100 " style='height:300px;'>
                <table class="table table-bordered " id="" style="position: relative; text-align: center;">
                    <thead style="position: sticky; top: 0; z-index:999">
                        <tr class="table-secondary text-center table-dark">
                            <th style='font-size:13px;' class='px-5'>Option</th>
                            <th style='font-size:13px;' class='px-5'>Civilite</th>
                            <th style='font-size:13px;' class='px-5'>Nom</th>
                            <th style='font-size:13px;' class='px-5'>Prenom</th>
                            <th style='font-size:13px;' class='px-5'>TypeClient</th>
                            <th style='font-size:13px;' class='px-5'>Province</th>
                            <th style='font-size:13px;' class='px-5'>Societe</th>
                            <th style='font-size:13px;' class='px-5'>Site</th>
                            <th style='font-size:13px;' class='px-5'>Telephone</th>
                            <th style='font-size:13px;' class='px-5'>Departement</th>
                            <th style='font-size:13px;' class='px-5'>Arrondissement</th>
                            <th style='font-size:13px;' class='px-5'>District</th>
                            <th style='font-size:13px;' class='px-5'>CodePostale</th>
                            <th style='font-size:13px;' class='px-5'>Ville</th>
                            <th style='font-size:13px;' class='px-5'>Pays</th>
                            <th style='font-size:13px;' class='px-5'>Adresse</th>
                            <th style='font-size:13px;' class='px-5'>Email</th>
                            <th style='font-size:13px;' class='px-5'>DateContact</th>
                            <th style='font-size:13px;' class='px-5'>Nationalite</th>
                            <th style='font-size:13px;' class='px-5'>NumeroContribuable</th>
                            <th style='font-size:13px;' class='px-5'>Profession</th>
                        </tr>
                    </thead>
                    <tbody id="client_table">
                       
                    </tbody>
                </table>
            </div>


        <!-- debut de la div tableau -->

        <style>
              .bout button {
            padding: 10px 15px;
            border-radius: none;
            border:0;
            background:white;
        } 
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
        
               <div class="row d-flex mx-0 ">
                    <div class='englobe' style='width:19%;padding:0px;margin:0px;position:relative;'>
                       
                        <div style='width:100%;height: 50px;' class='p-1 pt-2 border border-2 mt-3 border-secondary option_cont'>
                            <div class="text-divider-container7">
                                <div class="text-divider">
                                    <span>Selection</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                              
                                 <label for="" class="form-label">Rechercher </label>
                                   <input type="text" id="myInput" class='form-control-sm ' name="search" style='width:58%;background:pink'>
                                   <button style='height: 33px;'>GO
                                        <!-- <img src="<?= SITE_URL ?>/assets/img/arrow-right.png" alt="" style="width: 20px; height: 20px;"> -->
                                    </button>
                            </div>
                        </div>
                    </div>
                    <div class='englobe mx-2' style='width:19%;padding:0px;margin:0px;position:relative;'>
                       
                        <div style='width:100%;height: 50px;' class='p-1 pt-2 border border-2 mt-3 border-secondary option_cont'>
                            <div class="text-divider-container7">
                                <div class="text-divider">
                                    <span>Selection</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                              
                                 <label for="" class="form-label">Representant </label>
                                     <select class="form-select-sm " style='width:62%;background:yellow' id="departement">
                                    <option SELECTED value="TOUS">TOUS</option>
                                    <option value="">DR NONO YANNICK </option>
                                    <option value="">EVINA CHRISTINE</option>
                              
                                   
                                   
                                </select>
                                   
                            </div>
                        </div>
                    </div>
                    <div class='englobe' style='width:19%;padding:0px;margin:0px;position:relative;'>
                       
                        <div style='width:100%;height: 50px;' class='p-1 pt-2 border border-2 mt-3 border-secondary option_cont'>
                            <div class="text-divider-container7">
                                <div class="text-divider">
                                    <span>Selection</span>
                                </div>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                              
                                 <label for="" class="form-label">Bureau </label>
                                  <select class="form-select-sm " style='width:62%;background:yellow' id="departement">
                                    <option SELECTED value="TOUS">TOUTES</option>
                                    <option value="">ECOLE CEBEC </option>
                                    <option value="">ECOLE PUBLIQUE</option>
                                    <option value="">SANTA BARBARA</option>
                                   
                                   
                                </select>
                                  
                            </div>
                        </div>
                    </div>
                    <div class=' d-flex justify-content-center' style='width:20%;padding:0px;margin:0px;position:relative;align-items:center'>
                       
                        <b><span>0.0</span></b>
                    </div>
                    <div class=' d-flex justify-content-center' style='width:20%;padding:0px;margin:0px;position:relative;align-items:center'>
                       
                         <input type="checkbox" class="form-check-input" id=""value=""><b>Inclure Les Archives</b>
                    </div>
                  
                   
      
               </div>
        <!-- la div du footer  -->
        <div class="row d-flex justify-content-between bg-primary bout-bas p-2 m-0">
            <div style='width:35%;' class=' d-flex justify-content-between'>
                <button class='taille_boutton' id='new'>
                    Nouveau
                    <img src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;">
                </button>


                <button id="delete">
                    Supprimer
                    <img src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
                </button>
                
                <button class='taille_boutton' id="modify">
                    Options
                    <img src="<?= SITE_URL ?>/assets/img/set.png" alt="" style="width: max-content; height: 20px;">
                </button>
                <button id="printData">
                    Imprimer 
                    <img src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;">
                </button>
           
             
              
            </div>
            <!--  css du haut  -->
            <div style='width:35%;' class=' d-flex justify-content-between'>
                 

                            <button id="rdv" onclick='redirectToRDV()'>
                                RDV
                                <img src="<?= SITE_URL ?>/assets/img/timetable.png" alt="" style="width: max-content; height: 20px;">
                            </button>
                        
                        
                            <button id="fermer">
                                Fermer
                                <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                            </button>
                        
                     
            </div>


            </div>
            <!--  css du haut  -->
        </div>

        <!-- fin div footer  -->

       

    </div>
    <!-- fin de la grande div  -->

    <template id="client_table_template">
        <tr class="table-primary custom-row text-center text-white" style="pointer-events: all !important;">
            <td class='text-white' style='background-color:#0D6EFD;'id='option' >
        
        
                    
        
            <div class="d-flex">

                <!-- <button class="bouton bg-success "  id="set">
                    <i class="fas fa-edit"></i>

                </button> -->
                <div class="tooltip47">
                    <button class="bouton bg-success btn-modif"><i class="fas fa-edit"></i>
                
                      <span class="tooltiptext47">Modifier</span>
                    </button>
                </div>

                <div class="tooltip47">
                    <button class="bouton btn-open mx-1 "  id="open">
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

                      .englobe,
                            .option_cont {
                                background-color: #edf1f1;
                            }

                            .option_cont {
                                border-radius: 6px;
                                
                            }
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
            <td class='text-white' style='background-color:#0D6EFD;' data-Options></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Civilite></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Nom></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Prenom></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-TypeClient></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Province></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Societe></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Site></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Telephone></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Departement></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Arrondissement></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-District></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-CodePostale></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Ville></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Pays></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Adresse></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Email></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-DateContact></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Nationalite></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-NumeroContribuable></td>
            <td class='text-white' style='background-color:#0D6EFD;' data-Profession></td>
        </tr>

    </template>


<!-- debut du css  -->
<style>
    /* css du header pour le futur */
    .ico_emplye {
        height: 20px;
        margin-right: 5px;
    }

    .englobe,
    .option_cont {
        background-color: #EBEDEF;
    }

    .option_cont {
        border-radius: 6px;
    }

    /* Styles CSS personnalisés pour le séparateur de texte */
    .text-divider-container1 {
        position: absolute;
        top: 13%;
        left: 35%;
        transform: translate(-50%, -50%);
        background-color: #EBEDEF;
        padding: 0 7px;
        font-size: 14px;
    }
    .text-divider-container7 {
        position: absolute;
        top: 19%;
        left: 19%;
        transform: translate(-50%, -50%);
        background-color: #EBEDEF;
        padding: 0 7px;
        font-size: 14px;
    }

    .text-divider-container2 {
        position: absolute;
        top: 13%;
        left: 17%;
        transform: translate(-50%, -50%);
        background-color: #EBEDEF;
        padding: 0 7px;
        font-size: 14px;
    }

    .text-divider-container3 {
        position: absolute;
        top: 12%;
        left: 24%;
        transform: translate(-50%, -50%);
        background-color: #EBEDEF;
        padding: 0 7px;
        font-size: 14px;
    }
    .text-divider-container4 {
        position: absolute;
        top: 12%;
        left: 37%;
        transform: translate(-50%, -50%);
        background-color: #EBEDEF;
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
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
    }

    .row>* {
        padding-left: 0 !important;
        padding-right: 0 !important;
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




<script>
    const ferme = document.querySelector(".close_window");
    const conteneur = document.querySelector(".conteneur0");

    ferme.addEventListener("click", (e) => {
        e.preventDefault()
        window.location.href = "<?= SITE_URL ?>/home";

    });
</script>
<script>
    const boutonFermer = document.getElementById("fermer");
    const conteneur0 = document.querySelector(".conteneur0");

    boutonFermer.addEventListener("click", (e) => {
        e.preventDefault();
        window.location.href = "<?= SITE_URL ?>/home";
    });
</script>

    <script type="module">
        const Template = document.getElementById("client_table_template");
        const Tableau = document.getElementById("client_table");
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
                Civilite:"Civilite",
                Nom: "Nom",
                Prenom:"Prenom",
                TypeClient:"TypeClient",
                Province:"Province",
                Societe:"Societe",
                Site:"Site",
                Telephone:"Telephone",
                Departement:"Departement",
                Arrondissement:"Arrondissement",
                District:"District",
                CodePostale:"CodePostale",
                Ville:"Ville",
                Pays:"Pays",
                Adresse:"Adresse",
                Email:"Email",
                DateContact:"DateContact",
                Nationalite:"Nationalite",
                NumeroContribuable:"NumeroContribuable",
                Profession:"Profession"
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



        const response = await fetch(api_url_client);
       const absences = await response.json();



        Tableau.innerHTML = '';
        for (const absence of absences) {
            updatePERMISSIONTable(Tableau, absence, Template);
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

        document.getElementById("new").addEventListener("click",
            () => window.location.href = "<?= SITE_URL ?>/gestion_abscences");

        const allRows = fillTableau.querySelectorAll("tr");
        // let actionData = "";
        // const modifyBtn = document.getElementById("modify");
        // const deleteBtn = document.getElementById("delete");

        Array.from(allRows).forEach((row) => {
            console.log(row);
            const modifyBtn = row.querySelector('[data-modify]');
            const deleteBtn = row.querySelector('[data-delete]');

            modifyBtn.addEventListener("click", (e) => {

                const targetRow = e.target.parentNode.parentNode.parentNode.parentNode;
                const extractedData = extractDataFromRow(targetRow);
                localStorage.setItem("extractedData", JSON.stringify(extractedData));
                window.open("<?= SITE_URL ?>/gestion_abscences", "_self");
            });

            deleteBtn.addEventListener("click", async (e) => {
                const targetRow = e.target.parentNode.parentNode.parentNode.parentNode;
                const extractedData = extractDataFromRow(targetRow);
                await deleteAbscence(parseInt(extractedData.neng));
                setTimeout(() => {}, 1500);
                window.location.href = "<?= SITE_URL ?>/list_abscences";
            });
        });

        /**
         * Extract data from a row
         * @param {HTMLTableRowElement} row Row from which data is to be extracted
         * @returns {Object} The extracted data
         */
        function extractDataFromRow(row) {
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
                NEng: "neng",
            };
            let obj = {};
            for (const [, value] of Object.entries(pers)) {
                obj[value] = row.querySelector(`[data-${value}]`).textContent;
            }
            return obj;
        }

        /**
         * @param {number} id The id of the abscence to delete
         * @returns {Promise<void>}
         */
        async function deleteAbscence(id) {
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
            const response = await fetch("<?= SITE_URL ?>/forms/formdeleteabsence.php", {
                method: "POST",
                body: formData,
            });
            if (!response.ok) return showAlert("L'absence n'a pas pu être supprimé", "error");
            return showAlert("L'absence a été supprimé avec succès", "success");
        }
    </script>
<!-- evenement sur les bouttons  -->




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
            document.getElementById("myTable"),
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



<script>
      
        function supprimerLigne(button) {

            const row = button.closest('tr');

            const neng = row.querySelector("[data-neng]").textContent;
            console.log('id:',neng)


            const url = `http://localhost/permission/${neng}`;
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


</script>


<script>
              document.addEventListener('DOMContentLoaded', function() {
                var bouton1 = document.getElementById('selection1');
                var bouton2 = document.getElementById('selection2');

                    bouton1.addEventListener('click', function() {
                        bouton1.classList.add('active');
                        bouton2.classList.remove('active');
                    });

                    bouton2.addEventListener('click', function() {
                        bouton2.classList.add('active');
                        bouton1.classList.remove('active');
                    });
                });

</script>



<script>
    function redirectToRDV() {
       
            window.location.href = '<?= SITE_URL ?>/home/list-visit-rdv';
        }
</script>


<?php

$content = ob_get_clean();
include './vues/layout.php';
?>