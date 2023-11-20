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
    <title>Mission</title>
</head>
<body>
  <div class="container-fluid conteneur conteneur0 text-white" style='width:75%;'>

    <div class="row">
        <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                <div style="display: flex;">
                    <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                    <h6 class="fiche_sala">Fiche Mission</h6>
                    
                </div>

                <div>
                    <button class="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                </div>
        </div>
    </div>
    <div class="row">
            <div class="col-sm-7 p-2" style='background-color: #3498db ;'>

                <div class="d-flex justify-content-between  mb-3">
                    <div class="zone1" style='width:15%'>
                       <img src="<?= SITE_URL ?>/assets/image/merveille.png" alt="" style='width: 100%'>
                    </div>
                    <div class="zone2  text-center"style='width:70%'>
                         <h2 class='text-mission mt-3' style='font-weight:bold;'>NOUVELLE MISSION</h2>
                    </div>
                    <div class="zone3">
                        <img src="<?= SITE_URL ?>/assets/img/avatar.png" alt="" style='width: 100px;height: 100px;' class='border border-secondary border-1' >
                        <!-- <button type="button" class="bout" display='none'><i class="fas fa-search"></i></button> -->
                        <select class="form-select-sm" style='width:100%'>
                                                 <option></option>
                                                <option>jordan</option>
                                                <option>ulrich</option>
                                                <option>gildas</option>
                                                <option>etoo</option>
                                                
                                             </select>
                    </div>
                </div>
                
                        <div style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                                <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; ">
                                  
                                    <label for="destination" class="form-label">
                                       Destination
                                    </label>
                           
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%'>
                                                 <option></option>
                                                <option>DOUALA</option>
                                                <option>YAOUNDE</option>
                                                <option>KRIBI</option>
                                                <option>LIMBE</option>
                                                <option>FDFS</option>
                                             </select>
                                        </div>
                                </div>
                                <div style="width: 39% ; display: flex;   ">
                                   <label for="via" class="form-label mx-3">Via</label>   
                                    <select class="form-select-sm">
                                        <option></option>
                                        <option>EDEA</option>
                                        <option>BONABERIE</option>
                                        <option>FDSFDS</option>
                                    
                                    </select> 
                                </div>
                        </div> 
                        <!-- fin premiere ligne -->
                        <div style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                           <div  style="display: flex; justify-content:space-between; align-items: center;      width: 100%; ">
                             
                                <label for="deplacement" class="form-label">Mode de  déplacement </label>
                             
                                <span style='display: flex; justify-content: flex-end;'>
                                <select class="form-select-sm" style='width:85%'>
                                        <option></option>
                                        <option>FDSFDS</option>
                                        <option>CAMION</option>
                                        <option>VEHICULE PERSONNEL</option>
                                    
                                    </select>
                                <button type="button" class="bout1"><i class="fas fa-search"></i></button> 
                                </span>
                                
                            </div>

                            <div style="width: 48% ; display: flex;  "> 
                                <label for="immatriculation" class="form-label mx-1 " id='text-reduire'>Immatriculation</label>   
                                    <select class="form-select-sm" style='width:75%'>
                                        <option></option>
                                        <option>LT 893BG</option>
                                        <option>LT 126 IA</option>
                                        <option>LT 278 EN</option>
                                    
                                    </select> 
                            </div>        
                        </div>
                        <!-- 2eme ligne -->
                     <div class='mt-3'>   
                        
                        <div>
                            <label for="cadre" class="form-label" style='width:35%;'>Cadre/Objectif de la Mission  </label>
                            <select class="form-select-sm" style='width:40%;'>
                                    <option></option>
                                    <option>FDSFDS</option>
                                    <option>INTEGRATION IPLANS</option>
                                    <option>LIVRAISON MARCHANDISE</option>
                                                            
                                </select>
                            
                        </div>
                     </div>
                        <div class='mt-3' style=" display: flex;  ">
                            <div style=" display: flex; width:36% ">
                                <label for="cadre" class="form-label">Site/Tiers  </label>
                             </div>  
                             <div> 
                                <select class="form-select-sm" style="display: flex; width:205% ">
                                        <option></option>
                                        <option>CANALSAT</option>
                                        <option>DEPOT DOUALA</option>
                                        <option>DEPOT YAOUNDE</option>
                                        <option>FDSFDSFDSFDS</option>
                                                                
                                </select>
                        
                            </div>
                      </div>  

                          <!-- fin 3eme ligne -->
                        <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; justify-content: space-between; align-items: center; width: 60%; ">
                                <label for="deplacement" class="form-label">Date de départ </label>
                                    <input type="date" class="form-control-sm" >
                                    
                            </div>    
                             <div style="display: flex; justify-content: right;width: 40%; gap: 7px;">   
                                <label for="immatriculation" class="form-label">Nombre de jour(s)</label>   
                                    
                                          <input type="number" class="form-control-sm" style='width:23%' >
                                    
                              
                             </div>   
                        </div>

                               <!-- fin 3eme ligne -->
                        <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; justify-content: space-between; align-items: center; width: 60%; ">
                                <label for="deplacement" class="form-label">Date de rétour</label>
                                    <input type="date" class="form-control-sm" >
                                    
                            </div>    
                             <div style="display: flex; justify-content: right;width: 38%; gap: 7px;">   
                                <label for="immatriculation" class="form-label">No BL/LTA</label>   
                                    <select class="form-select-sm">
                                        <option></option>
                                        <option>LT 893BG</option>
                                        <option>LT 126 IA</option>
                                        <option>LT 278 EN</option>
                                    
                                    </select> 
                             </div>   
                        </div>
                  
            
                        <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="cadre" class="form-label" style="display: flex; justify-content: space-between; align-items: center; width: 35%; ">Nature du chargement </label>
                            <select class="form-select-sm" style='width:65%'>
                            </select>
                            
                        </div>
                        <div class='mt-3' style="display: flex; justify-content: space-between; align-items: center;">
                            <label for="cadre" class="form-label" style="display: flex; justify-content: space-between; align-items: center; width: 35%; ">Prise en charge</label>
                            <select class="form-select-sm" style='width:65%'>
                                <option selected>SURÉE PAR LA SOCIÉTÉ DEMO SUIVANT LE BARÈME EN VIGUEUR.</option>                                                  
                                </select>
                            
                        </div>
                        <div class='mt-3' style="display: flex; justify-content: center; align-items: center;" class='mt-3'>
                                <div style="display: flex; justify-content: space-between; align-items: center; width: 52%; ">
                                        <label for="">Durée travail par jour</label>
                                        <input type="time" name="heuredebut" class='form-control' id="" value="<?= date('H:i:s') ?>" style='width:33%'>
                                </div>

                                <div style="display: flex; justify-content: right;width: 48%; "> 
                                        <div class="form-check mt-1" style='width:58%;'>
                                                <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
                                                <label class="form-check-label " id='text-reduire' for="check1" >Bloquer le pointage?</label>
                                       </div>
                                    <label for="immatriculation" class="form-label  mt-2 " 
                                    id='text-reduire' style='width:25%;'>No Dossier</label>   
                                    <input type="text" class="form-control"  style='width:15%'>
                                </div>
                                        
                        </div>
                        <div class="custom-form mt-4 ">
                              <!-- ceci ne concerne que text divider -->
                            <div class="text-divider-container">
                                <div class="text-divider">
                                    <span>Pièce jointe</span>
                               </div>
                            </div>
                           <!-- le tableau a lintereieur -->
                           <div class="option-boutton d-flex justify-content-end ">
                                

                            <div class="tooltip47" onclick="showTooltip()">
                               <button >
                                     <img  src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width: max-content; height: 20px;">
                                    <span class="tooltiptext1">Charger une pièce  jointe</span>
                               </button>

                            </div>
                              

                                 <div class="tooltip47" onclick="showTooltip()">
                                    <button >
                                          <img  src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width: max-content; height: 20px;">
                                          <span class="tooltiptext47">Verrouiller</span>
                                    </button>

                                </div>
                               <div class="tooltip47" onclick="showTooltip()">
                                      <button >
                                           <img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                                           <span class="tooltiptext1">Supprimer  pièce  jointe</span>
                                     </button>

                                </div>

                           </div>
                           <div class="table-container">

                               <table class="table table-bordered">
                                    <thead>
                                    <tr class="table-secondary">
                                        <th width=2% class="text-center">T</th>
                                        <th text-center class="text-center">pièce jointe </th>
                                        <th width=20% class="text-center">Taille</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr class="table-primary custom-row">
                                        
                                        <td ><p></p></td>
                                        <td ><p></p></td>
                                        <td ><p></p></td>
                                    </tr>
                                    </tbody>
                                </table>
                           </div>
                  
                  </div>  <!--  fin de la partie gauche -->
                



        </div>  <!--  div fermante de la col -->
                

            



           <!-- debut de la partie gauche -->
            <div class="col-sm-5 text-dark" style='background-color: #3498db ;'>

                 <div class="option-boutton d-flex justify-content-end " >   <!-- boutton gauche -->
                
                       <!-- <button>
                          <img  src="<?= SITE_URL ?>/assets/img/padlock.png" alt="" style="width: max-content; height: 20px;">
                          <span class="tooltiptext">Mon Tooltip personnalisé</span>
                       </button> -->
                       <div class="tooltip47 my-2" onclick="showTooltip()">
                         <button >
                            <img  src="<?= SITE_URL ?>/assets/img/padlock.png" alt="" style="width: max-content; height: 20px;">
                            <span class="tooltiptext47">Verrouiller</span>
                         </button>

                        </div>
                        
                       
                 </div>
                 <div class="custom-form" style='width:100%;height:93%;'>
                              <!-- ceci ne concerne que text divider -->
                            <div class="text-divider-container2">
                                <div class="text-divider2">
                                    <span>Rapport de mission</span>
                               </div>

                            </div>

                              <div class="commentaire mt-1">
                                  <textarea class="form-control zone-commentaire mt-3" placeholder="Merci d'ecrire votre rapport de mission ci..." rows="28" id="comment" name="text"></textarea>
                               </div>
                 </div>   
                       

            </div><!--  fin de la partie ou div droite -->
    </div>
    
      <div class="row d-flex justify-content-between bg-primary bout-bas p-2 mb-2" >
           <div style='width:10%;' >

               <button>Valider<img  src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
           </div> 

             <!--  c2eme -->
           
           <div style='width:57%;'>
               <button>Supprimer
                <img  src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
              </button>
              <button>Imprimer
                <img  src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;">
              </button>
              <button >Frais
                <img  src="<?= SITE_URL ?>/assets/img/argent.png" alt="" style="width: max-content; height: 20px;">
              </button>
           </div>
            <!--  css du haut  -->
           <div style='width:15%;' >
              <button id="fermer" class='ferme'>
                  Fermer
                 <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
             </button>


             
           </div>
           <!--  css du haut  -->
      </div>
   
  </div>
 
<!--  css du haut  -->
    <style>
        .bout{
            position: absolute;
            z-index: 10;
            left:0;
            top:60px;
            margin: 5px;
        }
        .zone3{
            position: relative;
        }

            /* Style pour le formulaire */
        .custom-form {
            border: 1px solid #ccc;
            border-radius: 10px;
            height: 175px;
            position: relative;
        }

        /* Styles CSS personnalisés pour le séparateur de texte */
         .text-divider-container {
            position: absolute;
            top: 0%;
            left: 10%;
            transform: translate(-50%, -50%);
            background-color: #77B5FE;
            padding: 0 10px;
            font-size: 14px;
        }

       
        .text-divider {

            padding: 5px 0;
            text-align: center;
        }
        /* les 3 bouttons qui sont au bout pour manipuler */
        .option-boutton button{
            border:1px solid gray;
            padding: 4px;
        }
        <!-- le tableau -->
          .table-container {
            width: 700px;
            max-height: 300px; /* Hauteur maximale du conteneur avec défilement */
            overflow-y: auto; /* Ajoute une barre de défilement vertical si nécessaire */
        }

        /* le css de la div 2 */

         .text-divider-container2 {
            position: absolute;
            top: 0%;
            left: 20%;
            transform: translate(-50%, -50%);
            background-color: #3498DB;
            padding: 0 10px;
            font-size: 14px;
            z-index: 20;
        }

        .commantaire{
              border: 1px solid #d6dbdf;

        }
        .zone-commantaire{
              border: 1px solid #d6dbdf;
              padding:2px;
              background-color: # #ebedef ;

        }
        /* footer de la page zonde des botton */
        .bout-bas button{
            width:120px;
            height:45px;
            border-radius:5px;
        }
        /* header de la page         */
        .ico_emplye{
            height: 20px;
            margin-right: 5px;
        }

        /* css du tooltip sur les bouttons acteur vs chefban */
          
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
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
            font-size:14px;
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
            font-size:14px;
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
        #text-reduire{
            font-size: 13px;
        }
        .row{
            background-color:#1f34f1;
        }
        .text-mission{
            font-size:37px;
            color:  #f8f9f9  ;
  /* text-shadow: 4px 0px 0px rgba(206,202,202,0.79); */
        }
        textarea {
            background-color: #d6dbdf ; 
            padding: 10px;
            border-radius:5px;
        }
        .commentaire{
            background-color:  #ebedef ;
            border-radius:7px;
        }
    </style> 
    
    


   <!-- les script de la page -->

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
    const ferme = document.querySelector(".close_window");
    const conteneur= document.querySelector(".conteneur");

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

</body>
</html>



<?php

$content = ob_get_clean();
include 'layout.php';
?>