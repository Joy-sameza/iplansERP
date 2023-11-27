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
    <title>Details Missions</title>
</head>
<body>
    <div class="container-fluid border border-primary conteneur0 border-3" style='width:58%;'>

        <div class="row head bg-primary">
                <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                        <div style="display: flex;">
                            <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                            <h6 class="fiche_sala" style='color:white;'>Details frais de mission</h6>
                            
                        </div>

                        <div>
                            <button class="close_window" id="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                        </div>
                </div>
        </div>
        <div class="container-fluid">
            <h1 class='text-center text-secondary my-3'><b>Frais de Mission</b></h1>
        </div>
        <span>Numero Note:</span>
        <div class="row  justify-content-start mb-3">
                <div class="col-sm-8 py-3  madiv8  ">
                    <div class='d-flex'>
                        <div style='width:50%' class='text-center'>
                            <h5><b>Par Jour</b></h5>
                            
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Transport</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%'>
                                                 <option selected>0</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>10000</option>
                                                
                                             </select>FCFA
                                        </div>
                                 </div>      
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Logement</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%'>
                                                 <option selected>0</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>10000</option>
                                             </select>FCFA
                                        </div>
                                 </div>      
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Nutrition</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%'>
                                                <option selected>0</option>
                                                <option>10000</option>
                                                <option>5000</option>
                                                <option>6000</option>
                                                
                                             </select>FCFA
                                        </div>
                                 </div>      
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Perdime</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%'>
                                               <option selected>0</option>
                                                <option>10000</option>
                                                <option>2000</option>
                                               
                                             </select>FCFA
                                        </div>
                                 </div>      
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Autres</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%'>
                                                
                                                 <option selected>0</option>
                                                <option>40000</option>
                                                <option>10000</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>100000</option>
                                             </select>FCFA
                                        </div>
                                 </div>      
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Totaux</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%'>
                                                  <option selected>0</option>
                                                <option>40000</option>
                                                <option>10000</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>70000</option>
                                                <option>21000</option>
                                                <option>55000</option>
                                                <option>260000</option>
                                                <option>7000</option>
                                             </select>FCFA
                                        </div>
                                 </div>      
                                     

                        </div>
                        <!--  -->
                        <div style='width:50%'>
                            <h5><b>Total</b></h5>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <select class="form-select-sm" style='width:38%'>
                                                  <option selected>0</option>
                                                <option>40000</option>
                                                <option>10000</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>70000</option>
                                                <option>21000</option>
                                                <option>55000</option>
                                                <option>260000</option>
                                                <option>7000</option>
                                             </select>FCFA
                                                <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
                                                  <span class="form-check-label" for="check1">Carburant ?</span>
                                        </div>
                                 </div>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <select class="form-select-sm" style='width:38%'>
                                                  <option selected>0</option>
                                                <option>40000</option>
                                                <option>10000</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>70000</option>
                                                <option>21000</option>
                                                <option>55000</option>
                                                <option>260000</option>
                                                <option>7000</option>
                                             </select>FCFA
                                              
                                        </div>
                                 </div>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <select class="form-select-sm" style='width:38%'>
                                                  <option selected>0</option>
                                                <option>40000</option>
                                                <option>10000</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>70000</option>
                                                <option>21000</option>
                                                <option>55000</option>
                                                <option>260000</option>
                                                <option>7000</option>
                                             </select>FCFA
                                              
                                        </div>
                                 </div>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <select class="form-select-sm" style='width:38%'>
                                                  <option selected>0</option>
                                                <option>40000</option>
                                                <option>10000</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>70000</option>
                                                <option>21000</option>
                                                <option>55000</option>
                                                <option>260000</option>
                                                <option>7000</option>
                                             </select>FCFA
                                                
                                        </div>
                                 </div>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <select class="form-select-sm" style='width:38%'>
                                                  <option selected>0</option>
                                                <option>40000</option>
                                                <option>10000</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>70000</option>
                                                <option>21000</option>
                                                <option>55000</option>
                                                <option>260000</option>
                                                <option>7000</option>
                                             </select>FCFA 
                                              
                                        </div>
                                 </div>





                        </div>    
                    </div>
                </div><!-- fin colone 1 -->
  

               <div class="col-sm-4 mt-3  madiv4">
                 <span class='note'><b>Note</b></span>
                          <textarea class="form-control  w-100 h-100 border-0" id="exampleTextarea" rows="3" readonly>
Mission à KRIBI Via BONABERI Pour 1 Jour(s) Avec 00:00:00 de travail par jour 
                         </textarea>
                 

               </div><!-- fin colone 2 -->
            
        </div>
        <!-- fin de la row -->
        <div class="row d-flex justify-content-center  text-center mb-1">
            
            <div style='width:55%; align-items: center;'  class="d-flex justify-content-between mb-3">
              <span  style='width:50%'><b>TOTAL FRAIS DE MISSION</b></span>
              <input type="text" class="form-control-sm vert " name="nom" style='width:50%; align-items: center;'>FCFA
            </div>
            <div style='width:45%; align-items: center;' class="d-flex justify-content-center mb-3">
              <span  style='width:50%; align-items: center;'><b>TOTAL FRAIS PREVUS</b></span>
              00
            </div>
        </div>

        <!-- bas de la page -->
         <div class="row d-flex justify-content-between bg-primary bout-bas p-2" >
           <div style='width:82%;' >

               <button>Valider<img  src="<?= SITE_URL ?>/assets/img/accept.png" alt="" style="width: max-content; height: 20px;"></button>
         
          
               <button>Supprimer
                <img  src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
              </button>
              <button>Imprimer
                <img  src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;">
              </button>
              <button >Alerter
                <img  src="<?= SITE_URL ?>/assets/img/danger.png" alt="" style="width: max-content; height: 20px;">
              </button>
           </div>
            <!--  css du haut  -->
           <div style='width:18%;' >
              <button id="fermer" class='ferme'>
                  Fermer
                 <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
             </button>


             
           </div>
           <!--  css du haut  -->
      </div>


    </div>
    <!-- fin de la grande div -->
     
    <style>
          .ico_emplye{
            height: 20px;
            margin-right: 5px;
        }
        label{
            font-size:17px;
        }
        /* #check1{
                margin-left: 18px;

        } */
        .madiv8{
            
            border-right: 2px solid gray;
            border-bottom: 2px solid gray;
            margin-left: 5px;
           
        
        }
        .madiv4{
            border: 2px solid gray; 
                width: 32%;
             margin-right: 0;
                margin-left: 5px;
                position: relative;
            }
          .note{
            position: absolute;
            top: -8%; /* Position à 50% du haut du conteneur */
    left: 5%;
          }  
          .vert{
            background-color:#0b9444;
            color:white;
          }

            .bout-bas button{
            width:116px;
            height:45px;
            border-radius:5px;
        }
                        
        
    </style>
    




      <!-- <script>
    const boutonsFermer = document.querySelectorAll("#close_window");
     const conteneur0 = document.querySelector(".conteneur0");

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
            const conteneur0 = document.querySelector(".conteneur0");

            if (conteneur0) {
                boutonsFermer.forEach((bouton) => {
                    bouton.addEventListener("click", (e) => {
                        e.preventDefault();
                        conteneur0.style.display = "none";
                        console.log('yo')
                    });
                });
            }
        </script> -->
        <script>
   window.addEventListener('load', (event) => {
       const boutonsFermer = document.querySelectorAll("#close_window, #fermer");
       const conteneur0 = document.querySelector(".conteneur0");

       if (conteneur0) {
           boutonsFermer.forEach((bouton) => {
               bouton.addEventListener("click", (e) => {
                   e.preventDefault();
                   conteneur0.style.display = "none";
                   console.log('yo');
               });
           });
       }
   });
</script>

</body>
</html>






































<?php

$content = ob_get_clean();
include 'layout.php';
?>
