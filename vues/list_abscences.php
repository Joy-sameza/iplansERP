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
    <div class="container-fluid" style='width:70%;'>
        
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
    <div class="row d-flex ">

        <div class='englobe' style='width:25%;padding:0px;margin:0px;position:relative;'>
                    <div style='width:100%;height: 91px;' class='p-1 pt-2 border border-2 mt-3 border-secondary option_cont'>
                            <div class="text-divider-container1">
                                    <div class="text-divider">
                                        <span>Periode</span>
                                    </div>

                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center; ">
                                    <label for="date_debut" style='30%' class="form-label">Date début </label>
                                        <input type="date" class="form-control-sm" id="date_debut" >
                                        
                                    </div> 
                                    <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-1'>
                                        <label for="date_debut" style='30%' class="form-label">Date fin </label>
                                        <input type="date" class="form-control-sm" id="date_fin" >
                            </div> 
                
                    </div>
            
            </div>
        
        <div class='englobe mx-1' style='width:27%;padding:0px;margin:0px;position:relative;'>

              <div style='width:100%; height: 91px;' class='p-2 border border-1 option_cont border-2 mt-3 border-secondary' >
                    <div class="text-divider-container2">
                            <div class="text-divider">
                                <span>Selection</span>
                            </div>

                    </div>
                   <div style="display: flex; justify-content: space-between; align-items: center; ">
                     <label for="date_debut" class="form-label" >Site </label>
                                  <select class="form-select-sm " style='width:50%'>
                                        <option SELECTED>TOUS</option>
                                        <option>DEPOT DOUCHE</option>
                                        <option>DEPOT NGAOUNDERE</option>
                                        <option>DEPOT YASSA</option>
                                    
                                    </select>  
                    </div> 
                    <div style="display: flex; justify-content: space-between; align-items: center;" class='mt-1'>
                        <label for="date_debut" class="form-label" style='50%'>Departement </label>
                                    <select class="form-select-sm " style='width:50%'>
                                        <option SELECTED>TOUS</option>
                                        <option>PEDIATRIE</option>
                                        <option>APLICATION</option>
                                        <option>ADMINISTRATEUR</option>
                                        <option>CHAUFEUR</option>
                                        <option>TECHNIQUE</option>
                                        <option>COMMERCIAL</option>
                                        <option>ENTREPOT</option>
                                        <option>ADMINISTRATION</option>
                                       
                                    
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
                        <input type="checkbox" class="form-check-input" id="check1" name="">
                        <label class="form-check-label" for="check1">Toutes</label>
                    </div>
                    <div class="form-check" style='width:40%'>
                        <input type="checkbox" class="form-check-input" id="check2" name="">
                        <label class="form-check-label" for="check2">En Attentes</label>
                    </div>
                </div> 
                <div style="display: flex; justify-content: space-between; align-items: center; " class='mt-2'>
                    <div class="form-check" style='width:60%'>
                        <input type="checkbox" class="form-check-input" id="check1" name="">
                        <label class="form-check-label" for="check1">Archivees(Accordees)</label>
                    </div>
                    <div class="form-check" style='width:40%'>
                        <input type="checkbox" class="form-check-input" id="check2" name="">
                        <label class="form-check-label" for="check2">Accordees</label>
                    </div>
                </div> 
  
        </div>
       </div>

       <div  class='englobe1' style='width:16%;padding:0px;margin:0px;position:relative;'>
        <button class='boutton'>
           <img  src="<?= SITE_URL ?>/assets/img/padlock.png" alt="" style="width: max-content; height: 20px;">
           
       </button>
           
       </div>
    </div>
    </div>
    <!-- fin de la div qui suit  -->









    </div>
    <!-- fin de la grande div  -->
    


</body>
<!-- debut du css  -->
     <style>
        /* css du header pour le futur */
          .ico_emplye{
            height: 20px;
            margin-right: 5px;
        }
      .englobe, .option_cont{
            background-color:  #bfc9ca   ;
        }
        .option_cont{
            border-radius:6px;
        }
          /* Styles CSS personnalisés pour le séparateur de texte */
         .text-divider-container1 {
            position: absolute;
            top: 10%;
            left: 17%;
            transform: translate(-50%, -50%);
            background-color:  #BFC9CA ;
            padding: 0 7px;
            font-size: 14px;
        }
         .text-divider-container2 {
            position: absolute;
            top: 10%;
            left: 17%;
            transform: translate(-50%, -50%);
            background-color:  #BFC9CA ;
            padding: 0 7px;
            font-size: 14px;
        }
         .text-divider-container3 {
            position: absolute;
            top: 12%;
            left: 10%;
            transform: translate(-50%, -50%);
            background-color: #BFC9CA ;
            padding: 0 7px;
            font-size: 14px;
        }

       
        .text-divider {

            padding:  0;
            text-align: center;
            font-weight:600;
        }
        .boutton{
            position: absolute;
        }

     </style>
</html>


































<?php

$content = ob_get_clean();
include 'layout.php';
?>