


<?php

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
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => siteiplans_API_URL."8",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ],
]);
$response_societe= (array)json_decode(curl_exec($curl));
?>
<?php
if (isset($_POST['submit_societe'])) {
    $image=$_FILES['image']['name'];
    $file_tmp_name=$_FILES['image']['tmp_name'];
    move_uploaded_file($file_tmp_name,"uploads/$image");
        // Get the form data
        $site = $_POST['site'];
        $email = $_POST['email'];
        $siteweb=$_POST['siteweb'];
        $pobox = $_POST['pobox'];
        $employees = $_POST['employees'];
        $nombreposte=$_POST['nombreposte'];
       $telephone = $_POST['telephone'];
         $adress = $_POST['adress'];



        $data = json_encode([
            "Site" => $site,
            "EMail" => $email,
            "Telephone" => $telephone,
            "Employees" => $employees,
            "NombrePoste"=>$nombreposte,
            "POBOX"=>$pobox,
            "Address"=>$adress,
            "NomPhoto"=>$image


        ]);
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => siteiplans_API_URL."8" ,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PATCH",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json"
            ],
        ]);

        $response = (array)json_decode(curl_exec($curl));
    echo "<script>
             swal({
             icon: 'success',
             text: 'mise a jour  avec succès...',
             timer: 2000,
             onOpen: function(){
             swal.showLoading()
             }
             }).then(function(){
                 window.open('" . SITE_URL . "/home/param','_self');
             });
            </script>";



}
?>
<style>
    .header{
        display: none;
     }
     .ico_emplye {
            height: 20px;
            margin-right: 5px;
        }
       .bout-bas button {
            width: 120px;
            height: 45px;
            border-radius: 5px;
        }   
       .bout button {
            padding: 10px 15px;
            border-radius: 5px;
        }  
        .bous button{
             padding: 10px 15px;
            border-radius: 5px;
        } 
</style>
    <div class="container-fluid conteneur" style='width:100%'>

        <form id="main_form" enctype="multipart/form-data" method="post" class="was-validated">
            <div class="row bg-primary border-1 ">
                <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                    <div style="display: flex;">
                        <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                        <h6 class="fiche_sala" style='color:white;'>Configuration générale iPlans ERP</h6>
                    </div>
                    <div>
                        <button id="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                    </div>
                </div>
            </div>
            
            <div class="haut d-flex m-2 justify-content-around">
                 <div>
                 <select  class="form-select" id="sel" name="">
                    <option>DEMO</option>
                    <option>DEPOT DOUCHE</option>
                    <option>DEPOT YASSA</option>
                    <option>DEPOT NGAOUNDERE</option>
                   
                </select>
                 </div>
                 <div>
                    <h2 class='text-secondary font-weight-bold'>DEMO</h2>
                 </div>
            </div>
            <div class=" bout" style='  text-align: center;'>

                    <button type="button" id='societe' onclick='redirectToSociete()'><img src="<?= SITE_URL ?>/assets/img/house.png" alt="" style="width: max-content; height: 20px;"> Société
                    </button>
                    <button type="button" id='OK' name="">
                        Pointages
                    </button>
                    <button type="button" id='' onclick='redirectToUser()'  name="">
                        Utilisateurs
                    </button>
                    <button type="button" id='OK' name="">
                        Planings
                    </button>
                    <button type="button" id='OK' name="">
                        Compatibilité
                    </button>
                    <button type="button" id='OK' name="">
                        La Paie
                    </button>
                    <button type="button" id='OK' name="">
                        Caisse
                    </button>
                    <button type="button" id='OK' name="">
                        Telephonie
                    </button>
                    <button type="button" id='OK' name="">
                        GESCOM
                    </button>
                    <button type="button" id='OK' name="">
                        Outils
                    </button>
                    <button type="button" id='OK' name="">
                            Connexion
                    </button>
                    <button type="button" id='OK' name="">
                        Contrôle d'accès
                    </button>

            </div>



             <div class=" d-flex bous my-1"  style='width:98%;  margin: 0 auto;'>

                        <button type="button" id='OK' name="" style='width:100%'>
                        Hebergement
                        </button>
                  
                         <button type="button" id='OK' name="" style='width:100%'>
                        Cameras
                        </button>
                 
                       <button type="button" id='OK' name="" style='width:100%'>
                        Ecole
                       </button>
                
             </div>

            <div class="row mt-5 " style=''>
                <!-- gauche  -->
                <div class="col-sm-5 mx-4">
                    <form action="" method="post" enctype="multipart/form-data">
                          <div class="idntite3 d-flex">
                                <label for="" class="mt-2" style="width: 33%">Nom Social</label>
                                <input type="text" class="form-control mt-2"style="width: 67%" name="site" id='site' value='<?php echo $response_societe['Site']?>'>
                         </div>
                          <div class="idntite3 d-flex">
                                <label for="" class="mt-2" style="width: 33%">Adresse</label>
                                <input type="text" class="form-control mt-2"style="width: 67%" name="adress" id='adress' value='<?php echo $response_societe['Address']?>'>
                         </div>
                          <div class="idntite3 d-flex">
                                <label for="" class="mt-2" style="width: 33%">Boite Postal </label>
                                <input type="text" class="form-control mt-2"style="width: 67%" name="pobox" id='pobox' value='<?php echo $response_societe['POBOX']?>'>
                         </div>
                          <div class="idntite3 d-flex">
                                <label for="" class="mt-2" style="width: 33%">Telephone</label>
                                <input type="text" class="form-control mt-2"style="width: 67%" name="telephone" id='telephone' value='<?php echo $response_societe['Telephone']?>'>
                         </div>
                          <div class="idntite3 d-flex">
                                <label for="" class="mt-2" style="width: 33%">Telecopie(Fax)</label>
                                <input type="text" class="form-control mt-2"style="width: 67%" name="prenom" id='prenom'>
                         </div>
                          <div class="idntite3 d-flex">
                                <label for="" class="mt-2" style="width: 33%">Site Web</label>
                                <input type="text" class="form-control mt-2"style="width: 67%" name="siteweb" id='prenom' value='<?php echo $response_societe['WebSite']?>'>
                         </div>
                          <div class="idntite3 d-flex">
                                <label for="" class="mt-2" style="width: 33%">Email</label>
                                <input type="text" class="form-control mt-2"style="width: 67%" name="email" id='prenom' value='<?php echo $response_societe['EMail']?>'>
                         </div>
                          <div class="idntite3 d-flex">
                                <label for="" class="mt-2" style="width: 33%">Site</label>
                                <input type="text" class="form-control mt-2"style="width: 67%" name="prenom" id='prenom'  value='<?php echo $response_societe['Site']?>' disabled>
                         </div>
                          <div class="idntite3 d-flex mt-2">
                               <div style="width: 33%">
                                   <label for="" class="mt-4" style="width: 100%;font-size:12px;">Code Agence(5 Caracteres)</label>
                                   <label for="" class="mt-4" style="width: 100%">Nombre D'employes</label>
                                   <label for="" class="mt-4" style="width: 100%">Nombre de Poste (*)</label>
                               </div>
                               <div style="width: 30%">
                                <input type="text" class="form-control mt-3"style="width: 70%" name="prenom" id='prenom'  value='<?php echo $response_societe["Site"]?>' >
                                <input type="tel" class="form-control mt-3"style="width: 70%" name="employees" id='prenom'  value='<?php echo $response_societe['Employees']?>' >
                                 <input type="tel"class="form-select form-select-sm mt-3" name="nombreposte"  style="width: 70%" value="<?php echo $response_societe['NombrePoste']?>">


                            
                               </div>
                               <div style="width: 37%;align-items: flex-end;display: flex;flex-direction: column;" class=''>
                                   <div class="preview-img">
                                    <img src="<?= SITE_URL ?>/uploads/<?php echo $response_societe["NomPhoto"]?>" class='placeholder-img' alt="" style='height:130px'>
                                </div>
                                <div class='zone'>
                                    <div class="roww">
                                        <input type="file" class="file-input" accept="*/*" name="image"  value="" hidden>
                                        <button class="choose-img mt-2" style='margin-left: 24px;border-radius:5px;height: 40px;width:150px'>
                                            <img class="choose-img" src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 25px;"><b>Logo Societe</b>
                                        </button>
                                       
                                    </div>
                                </div>
                            
                            
                              </div>
                         </div>
                         <div class='d-flex mt-3' >
                            <button type="submit" id='appliquer' style='width:340px;height:40px;margin: 0 auto;border-radius:5px' name="submit_societe">Appliquer <img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                         </div>
                         
                    </form>

                </div>
                <!-- millieu  -->
                <div class="col-sm-6 md-2">
                     <div class="custom-form mt-2 my-2 " style='width:100%;height:98%;'>
                        <!-- ceci ne concerne que text divider -->
                        <div class="text-divider-container2">
                            <div class="text-divider2">
                                <span>Rapport de mission</span>
                            </div>
                        </div>
                        <div class="mt-3 mx-1 ">
                             <div class=" " style='font-size:13px'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                                Auhentification et Code Gestionnaire obligatoire lors des suppressions
                             </div>
                             <div class=" " style='font-size:13px'>
                                <input type="checkbox" class="form-check-input " name="" id="" >
                                Exiger la selection des numeros de serie lors des ventes
                             </div>
                             <div class=" d-flex" style='font-size:13px ; width:100%'>
                                <div style='width:55%'>
                                    <input type="checkbox" class="form-check-input " name="" id="" checked>
                                Exiger la selection du numeros lors des commades
                                </div>
                                <div style='width:45%'>
                                    <input type="checkbox" class="form-check-input " name="" id="" checked>
                                 Grouper les N des lots lors des impressions
                                </div>
                             </div>
                             <div class=" d-flex" style='font-size:13px ; width:100%'>
                                <div style='width:55%'>
                                    <input type="checkbox" class="form-check-input " name="" id="" >
                               Autoriser les ventes en dessous du prix d'achet
                                </div>
                                <div style='width:45%'>
                                    <input type="checkbox" class="form-check-input " name="" id="" >
                               Validations du paiement fact fournisseurs
                                </div>
                             </div>
                             <div class=" " style='font-size:13px;color:red'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                                Calcul automatique du prix de revient a partir du prix d'achat a chaque arrivage
                             </div>
                             
                             <div class=" " style='font-size:13px;color:red'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                                Calcul automatique du prix de revient moyen unitaire pondere a partir du prix d'achat a chaque arrivage
                             </div>
                            <div class=" " style='font-size:13px'>
                                <input type="checkbox" class="form-check-input " name="" id="" >
                                Bloquer l'edition des bulletins de paie non conforme et des employés non conforme
                             </div>
                             
                            <div class=" " style='font-size:13px'>
                                <input type="checkbox" class="form-check-input " name="" id="" >
                               Rechercher un lecteur de carte a puce au demarrage d'Iplans sur ce poste
                             </div>
                              <div class=" d-flex" style='font-size:13px ; width:100%'>
                                <div style='width:55%'>
                                    <input type="checkbox" class="form-check-input " name="" id="" checked >
                               Autoriser des saisie sur les sites distants
                                </div>
                                <div style='width:45%;color:blue'>
                                    <input type="checkbox" class="form-check-input " name="" id="" >
                               Ne pas afficher l'ecran de menu rapide
                                </div>
                              </div>

                              <div class=" " style='font-size:13px'>
                                <input type="checkbox" class="form-check-input " name="" id="" >
                               Autoriser les imports des autres sites(Agences) dans un seul comptable
                             </div>

                              <div class=" " style='font-size:13px'>
                                <input type="checkbox" class="form-check-input " name="" id="" >
                               Desactiver la numerotation des continues de factures quelques soit le TPV
                             </div>


                            <div class=" d-flex" style='font-size:13px ; width:100%'>
                            <div style='width:40%'>
                                 <div>
                                    <input type="checkbox" class="form-check-input " name="" id="" checked >
                                    Generer automatiquement Code client
                                 </div>
                                 <div>
                                    <input type="checkbox" class="form-check-input " name="" id="" checked >
                                    File d'attente classique
                                 </div>
                                 <div>
                                    Ajouter Prefixe sur Facture
                                    <input type="text" class="form-control-sm " style='width:20%;background:yellow' name="" id="" value='V'>
                                 </div>
                              
                            </div>
                            <div style='width:60%;color:blue;align-items:center' class='d-flex custom-form2 mt-2'>

                               <div class="text-divider-container">
                                    <div class="text-divider">
                                        <span style='font-size:13px'>Criteres Code Clients</span>
                                    </div>
                                </div>
                                <div style='width:50%'>
                                    <input type="checkbox" class="form-check-input " name="" id="" checked >
                                    Alpha numerique
                                 </div>
                                <div style='width:40%'>
                                    Prefixe
                                    <input type="text" class="form-control-sm " name="" id="" style='width:40%;background:gray' value='PI'>
                                 </div>
                                <div>
                                    Longueur
                                    <input type="number" class="form-control-sm " name="" id="" style='width:30%;background:cyan' value='0'>
                                 </div>
                                   
                            </div>
                            </div>

                            <div class=" " style='font-size:13px;'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                               Activer la messsagerie instantanee(CHAT)
                             </div>
                            <div class=" " style='font-size:13px;'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                               Demander code gestionnaire a la suppression d'une ecriture comptable 
                             </div>
                            <div class=" " style='font-size:13px;'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                               Demander code gestionnaire a la fermeture d'une ecriture comptable non equilibre 
                             </div>
                            <div class=" " style='font-size:13px;'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                               Activer la visibilite des utilisateurs par site(AGENCES)
                             </div>





                       <div class=" d-flex" style='font-size:13px ; width:100%;position:relative;align-items:center'>
                            <div style='width:55%'>
                                 <div>
                                    <input type="checkbox" class="form-check-input " name="" id="" checked >
                                    Activer le destockage des produits en rupture de stock
                                 </div>
                               
                            </div>
                            <div style='width:45%;align-items:center' class='d-flex '>

                               <div class="text-divider-container3">
                                    <div class="text-divider">
                                        <span style='font-size:15px'><b>Valeur Device</b></span>
                                    </div>
                                </div>
                                
                                <div style='width:75%'>
                                     <span style='font-size:15px'>Devise</span>
                                      
                                <select class="form-control-sm " style='width:70%;background:yellow' id="devise" >
                                    
                                    <option value="">XAF</option>
                                    <option value="">EUR</option>
                                    <option value="">USD</option>
                                    <option value="">CAD</option>
                                    <option value="">LIVRE</option>
                                    <option value="">DIRAM</option>
                                    <option value="">NAIRA</option>
                                </select>
                           

                                  
                                 </div>
                                <div class=''>
                                    
                                    <input type="number" class="form-control-sm  " name="" id="" style='width:60%;background:cyan' value='0'>
                                 </div>
                                   
                            </div>
                            </div>

                            <div class=" " style='font-size:13px;'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                              Impression des factures TPV4 au format standard
                             </div>
                            <div class=" " style='font-size:13px;'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                              Impression des factures avec separateur decimal au milieme pret
                             </div>
                            <div class=" " style='font-size:13px;'>
                                <input type="checkbox" class="form-check-input " name="" id="" checked>
                              Impression des factures avec separateur decimal au centieme pret
                             </div>

                             <div style='width:100%' class='d-flex '>
                                <div style='width:65%;font-size:13px;'>
                                   <div class='mt-1'>
                                    Coeficients multiplicateur(Pour calcul prix de ventes des produits)
                                   </div>
                                   <div class='d-flex mt-3' style='justify-content: space-between;width:100%'>
                                     <div style='color:red' class='mt-3'>
                                          <input type="checkbox" class="form-check-input " name="" id=""  style='color:red'>
                                              Regime du simplifie
                                     </div>
                                     <div>
                                        Taux Precompte sur facture
                                     </div>
                                   </div>
                                   <div class='d-flex ' style='justify-content: space-between;float: right;    margin-top: 5px;' >
                                     <span>Taxe sejour</span>
                                   </div>
                                    <div class='d-flex ' style='justify-content: space-between;width:100%;    margin-top: 41px;'>
                                     <div>
                                          <input type="checkbox" class="form-check-input " name="" id="" checked>
                                             Activer les validation sur les dossiers
                                     </div>
                                     <div>
                                        Taxe sejour Max
                                     </div>
                                   </div>
                                  
                                   <div class='d-flex mt-3' style='justify-content: space-between;float: right;' >
                                     <span>Client Divers</span>
                                   </div>
                                </div>
                                <div style='width:25%;font-size:13px;margin-left:10px' class=''>
                                     <input type="text" class="form-control-sm   " style='width:100%;background:green;color:white' name="" id="" value='1.34'>
                                     <input type="text" class="form-control-sm  mt-1 " style='width:100%;background:green;color:white' name="" id="" value='0'>
                                     <input type="text" class="form-control-sm  mt-1 " style='width:100%;background:red;color:white' name="" id="" value='0'>
                                     <input type="text" class="form-control-sm  mt-1 " style='width:100%;background:yellow' name="" id="" value='3000'>
                                     <input type="text" class="form-control-sm mt-1" style='width:100%' name="" id="" value='DIVERS CLIENTS'>
                                   
                                </div>
                               <div class='d-flex' style='align-items: end;'>
                                 <div class='d-flex'>
                                       <button class="" style='border-radius:5px;height: 35px;width:35px'>
                                            <img class="choose-img" src="<?= SITE_URL ?>/assets/img/search.png" alt="" style="width: max-content; height: 20px;">
                                        </button>
                                           <button  style='border-radius:5px;height: 35px;width:35px'>
                                            <img class="choose-img" src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                                        </button>
                                </div>
                               </div>
                             </div>
                          







                             
              
                        </div>
                    </div>
                </div>
                <!-- droite -->
                <div class="col-sm-1"></div>
                
            </div>

            <div class='row mx-1' style='height:70vh;display:none'>
                <div class='col-sm-6' style='display: flex;flex-direction: column;justify-content:space-around;'>
                    <div >
                        <h2>Liste des utilisateurs</h2>
                    </div>
                    <div class='tooltip47'>
                         <button id='new' class='bg-success '>
                              Nouveau
                            <img src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;">
                          
                         </button>
                           <div class='tooltipBoutton'>
                              <button id="simple" class='ferme my-3'>
                                    Simple
                                    <img src="<?= SITE_URL ?>/assets/img/evaluation.png" alt="" style="width: max-content; height: 20px;">
                             </button>
                              <button id="admin" class='ferme'>
                                    Admin
                                    <img src="<?= SITE_URL ?>/assets/img/staff.png" alt="" style="width: max-content; height: 20px;">
                             </button>

                          </div>
                    </div>
                </div>
                <div class='col-sm-6' style=''>

                 <!-- formulaire  -->
                   <div style='width:100%; display:none' id='simple_form'>
                    <form action="" class='mt-5 p-4' style='border:2px solid gray;border-radius:9px; width: 65% ;'>
                        <div style='margin-bottom:30px;    text-align: center; '>
                            <h4>Form Utilisateurs</h4>
                        </div>
                        <div class='d-flex mt-4'>
                            <label style="width: 20%" class='mt-1' for="">Nom:</label>
                             <input type="text" class="form-control"style="width: 80%" name="nom" id='nom'>

                        </div>
                        <div class='d-flex mt-4'>
                            <label style="width: 20%" class='mt-1' for="">Prenom:</label>
                             <input type="text" class="form-control"style="width: 80%" name="nom" id='prenom'>

                        </div>
                        <div class='d-flex mt-4'>
                            <label style="width: 20%" class='mt-1' for="">Password:</label>
                             <input type="password" class="form-control"style="width: 80%" name="nom" id='nom'>

                        </div>
                        <div class='d-flex mt-4 mx-5'>
                            <label style="width: 60%" for="">Super Utilisateur ?</label>
                            <input type="checkbox" class="form-check-input mx-2 " name="" id="" >OUI
                            <input type="checkbox" class="form-check-input mx-2 " name="" id="" >NON
                            

                        </div>
                        <div class='d-flex justify-content-center mt-3' style='align-items:center'> 
                            <div class='mx-2'>
                               <input type="checkbox" class="form-check-input mx-2 " name="" id="" >
                            <label style="width: 60%" for="">Reinitialiser</label>
                            </div>
                            
                             <button type="submit" id='valid' style='width:130px;height:40px;border-radius:5px;' name="iplans_submit">Valider<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                            
                            

                        </div>
                    </form>

                   </div>

                   <!-- tableau pour les admins  -->
                   <div style='width:100%;' id='tableau'>



                   </div>
                   <!-- fin div pour admin  -->
                </div>
                

            </div>








        </form>

          <!-- debut de la div des boutton -->
         <div class="row d-flex justify-content-between bg-primary bout-bas p-2 mt-2 ">
                <div style='width:20%;'>
                    <button type="submit" id='OK' style='width:60px' name="iplans_submit">OK<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                    <button type="submit" id='appliquer' style='width:156px' name="iplans_submit">Appliquer Tous<img src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
                  
                </div>
            
                <div style='width:10.5%;'>
                    <button id="fermer" >
                        Fermer
                        <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                    </button>
                </div>
              
         </div>

    </div>  
    <style>
      label{
        font-weight:500;
      }

        .ferme{
            width: 120px;
            height: 45px;
            border-radius: 5px;
            border: 1px solid gray;
             transition: background-color 0.3s, color 0.3s;
             font-weight:500;
             font-size: 16px;
           
            
            }
            #valid{
                  border: 1px solid gray!important;

            }
             .ferme:hover {
            background-color: #0D6EFD;
            color: #fff;
            }
             #valid:hover {
            background-color: #0D6EFD;
            color: #fff;
            }
      


      .tooltip47:hover .tooltipBoutton {
            visibility: visible;
            opacity: 1;
        }

       .tooltip47 .tooltipBoutton{
            visibility: hidden;
            width: 180px;
           
           
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 10;
            top: 73%;
            left: 11%;
            
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 14px;
        }
        
          #new {
            width: 130px;
            height: 48px;
            border-radius: 5px;
            /* background-color: #0D6EFD; */
            color:white;
            font-size: 18px;
            font-weight:500;
        }
        .text-divider-container2 {
            position: absolute;
            top: 0%;
            left: 17%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 0 10px;
            font-size: 16px;
            z-index: 20;
        }
        .text-divider-container3 {
            position: absolute;
            top: -23%;
            left: 80%;
            transform: translate(-50%, -50%);
           
            padding: 0 10px;
            font-size: 15px;
            z-index: 20;
        }
        .text-divider-container {
            position: absolute;
            top: 3%;
            left: 20%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 0 5px;
            font-size: 16px;
            z-index: 20;
        }
           .custom-form {
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 175px;
            position: relative;
        }
           .custom-form2 {
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 50px;
            position: relative;
        }
    </style>  
    <!--  //fin grande div    -->
    <script>
        const bouton = document.getElementById("fermer");
        const bouton2 = document.getElementById("close_window");
       

        bouton.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home";
        });
        bouton2.addEventListener("click", (e) => {
            e.preventDefault();
           window.location.href = "<?= SITE_URL ?>/home";
        });
    </script>

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
    chooseImgBtn0.addEventListener("click", (e) => e.preventDefault())
    fileInput0.addEventListener("change", loadImage0)
</script>
<script>
    const boutton_simple = document.querySelector('#simple')
    const simple_form = document.querySelector('#simple_form')

        boutton_simple.addEventListener("click", (e) => {
        e.preventDefault();
        simple_form.style.display = "block";
       
    });

    
</script>
 <script>
        function redirectToSociete() {
       
            window.location.href = '<?= SITE_URL ?>/home/param';
        }
</script>
 <script>
        function redirectToUser() {
       
            window.location.href = '<?= SITE_URL ?>/home/param/utilisateurs';
        }
</script>
<script>
    //const valeurDeSite = sessionStorage.getItem('site');
    // Variable JavaScript à envoyer



    //alert(valeurDeSite);
</script>


<?php
$content = ob_get_clean();
include './vues/layout.php';
?>