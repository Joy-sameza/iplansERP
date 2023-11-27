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
                        <div style='width:50%' class='text-center colone1'>
                            <h5><b>Par Jour</b></h5>
                            
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Transport</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%' id='transport'>
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
                                             <select class="form-select-sm" style='width:100%' id='logement'>
                                                 <option selected>0</option>
                                                <option>25000</option>
                                                <option>60000</option>
                                                <option>250000</option>
                                                <option>10000</option>
                                                <option>5000</option>
                                             </select>FCFA
                                        </div>
                                 </div>      
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Nutrition</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%' id='nutrition'>
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
                                             <select class="form-select-sm" style='width:100%' id='perdime'>
                                               <option selected>0</option>
                                                <option>10000</option>
                                                <option>2000</option>
                                               
                                             </select>FCFA
                                        </div>
                                 </div>      
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Autres</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                             <select class="form-select-sm" style='width:100%' id='autres'>
                                                
                                                 <option selected>0</option>
                                                <option>40000</option>
                                                <option>10000</option>
                                                <option>20000</option>
                                                <option>50000</option>
                                                <option>5000</option>
                                                <option>100000</option>
                                             </select>FCFA
                                        </div>
                                 </div>      
                                 <div class='d-flex justify-content-around mt-3'>
                                     <label style='width:10%; '>Totaux</label>
                                        <div style="display: flex; justify-content: left;width: 51%; ">
                                               <!--<select class="form-select-sm" style='width:100%' id='tataux'>
                                                 <option selected>0</option>
                                                <option>85000</option>
                                                <option>25000</option>
                                                <option>50000</option>
                                                <option>71000</option>
                                                <option>100000</option>
                                                <option>75000</option>
                                                <option>10000</option>
                                                <option>70000</option>
                                                <option>65000</option>
                                                <option>80000</option>
                                                <option>60000</option>
                                                <option>20000</option>
                                                <option>42000</option>
                                             </select>FCFA -->
                                              <input type="text" class="form-control-sm mt-1" style='width:100%' id="tataux" readonly>
                                        </div>
                                 </div>      
                                     

                        </div>
                        <!--  -->
                        <div style='width:50%' class='colonne2'>
                        
                            <h5><b>Total</b></h5>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <select class="form-select-sm" style='width:38%' id='1'>
                                                  <option selected>0</option>
                                                
                                                <option>50000</option>
                                                <option>250000</option>
                                                <option>20000</option>
                                                <option>40000</option>
                                                <option>100000</option>
                                                
                                             </select>FCFA
                                                <input type="checkbox" class="form-check-input" id="check1" name="option1" value="something" checked>
                                                  <span class="form-check-label" for="check1">Carburant ?</span>
                                        </div>
                                 </div>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <!-- <select class="form-select-sm" style='width:38%' id='2'>
                                                  <option selected>0</option>
                                          
                                                <option>25000</option>
                                                <option>75000</option>
                                                <option>240000</option>
                                                <option>70000</option>
                                                <option>60000</option>
                                                <option>120000</option>
                                                <option>35000</option>
                                                <option>150000</option>
                                                <option>7000</option>
                                             </select>FCFA -->
                                            <input type="text" class="form-control-sm" style='width:38%' id="2" readonly>
                                              
                                        </div>
                                 </div>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <!-- <select class="form-select-sm" style='width:38%' id='3'>
                                                  <option selected>0</option>
                                     
                                                <option>10000</option>
                                                <option>18000</option>
                                                <option>35000</option>
                                           
                                             </select>FCFA -->
                                             <input type="text" class="form-control-sm" style='width:38%' id="3" readonly>
                                              
                                        </div>
                                 </div>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <!-- <select class="form-select-sm" style='width:38%' id='4'>
                                                  <option selected>0</option>
                                                <option>30000</option>
                                                <option>14000</option>
                              
                                             </select>FCFA -->
                                             <input type="text" class="form-control-sm" style='width:38%' id="4" readonly>
                                                
                                        </div>
                                 </div>

                               <div class='justify-content-between mt-3'>
                                     
                                        <div style="display: flex; justify-content: left; ">
                                             <!-- <select class="form-select-sm" style='width:38%' id='5'>
                                                  <option selected>0</option>
                                                <option>60000</option>
                                                <option>5000</option>
                                                <option>20000</option>
                                                <option>80000</option>
                                                <option>100000</option>
                                                <option>140000</option>
                                                
                                             </select>FCFA  -->
                                             <input type="text" class="form-control-sm" style='width:38%' id="5" value='0' readonly>
                                              
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
              <span  style='width:60%'><b>TOTAL FRAIS DE MISSION</b></span>
              <input type="text" class="form-control-sm vert " id='totalFrais' style='width:50%; align-items: center;' readonly>FCFA
            </div>
            <div style='width:45%; align-items: center;' class="d-flex justify-content-left mb-3">
              <span  style='width:50%; align-items: center;' ><b>TOTAL FRAIS PREVUS</b></span>
              
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





<script>
    // Fonction pour mettre à jour les valeurs de la colonne2 en fonction de la colonne1
    function updateColumn2() {
        // Récupérer les valeurs sélectionnées dans la colonne1
        var transportValue = parseInt(document.getElementById('transport').value);
        var logementValue = parseInt(document.getElementById('logement').value);
        var nutritionValue = parseInt(document.getElementById('nutrition').value);
        var perdimeValue = parseInt(document.getElementById('perdime').value);
        var autresValue = parseInt(document.getElementById('autres').value);

        // Appliquer les calculs spécifiques
        document.getElementById('1').value = transportValue * 2;
        document.getElementById('2').value = (logementValue) * getJoursEcart();
        document.getElementById('3').value = nutritionValue * getJoursEcart();
        document.getElementById('4').value = perdimeValue * getJoursEcart();
        document.getElementById('5').value = ((autresValue) * getJoursEcart());
        
        // Mettre à jour les totaux
        updateTotals();
    }

    // Fonction pour mettre à jour les totaux
    function updateTotals() {
        // Récupérer les valeurs des colonnes
        var colonne1Total = calculateColonne1Total();
        var colonne2Total = calculateColonne2Total();

        // Mettre à jour le champ tataux avec la somme de la colonne1
        document.getElementById('tataux').value = colonne1Total;

        // Mettre à jour les champs de total
        document.getElementById('totalFrais').value = colonne2Total;
        
    }

    // Fonction pour calculer la somme des valeurs de la colonne1
    function calculateColonne1Total() {
        var transportValue = parseInt(document.getElementById('transport').value);
        var logementValue = parseInt(document.getElementById('logement').value);
        var nutritionValue = parseInt(document.getElementById('nutrition').value);
        var perdimeValue = parseInt(document.getElementById('perdime').value);
        var autresValue = parseInt(document.getElementById('autres').value);

        return transportValue + logementValue + nutritionValue + perdimeValue + autresValue;
    }

    // Fonction pour calculer la somme des valeurs de la colonne2
    function calculateColonne2Total() {
        var value1 = parseInt(document.getElementById('1').value);
        var value2 = parseInt(document.getElementById('2').value);
        var value3 = parseInt(document.getElementById('3').value);
        var value4 = parseInt(document.getElementById('4').value);
        var value5 = parseInt(document.getElementById('5').value);

        return value1 + value2 + value3 + value4 + value5;
    }

    // Fonction pour récupérer la valeur de joursEcart depuis le localStorage
    function getJoursEcart() {
        var joursEcart = localStorage.getItem('joursEcart');
        return joursEcart ? parseInt(joursEcart) : 1; // Si la clé n'existe pas, utiliser la valeur par défaut 1
    }

    // Ajouter des écouteurs d'événements pour détecter les changements dans la colonne1
    document.getElementById('transport').addEventListener('change', updateColumn2);
    document.getElementById('logement').addEventListener('change', updateColumn2);
    document.getElementById('nutrition').addEventListener('change', updateColumn2);
    document.getElementById('perdime').addEventListener('change', updateColumn2);
    document.getElementById('autres').addEventListener('change', updateColumn2);

    // Appeler la fonction updateTotals pour initialiser les totaux lors du chargement de la page
    updateTotals();
</script>

<script>
    // Au chargement de la page, récupérer la valeur depuis le localStorage
    window.onload = function () {
        var valeurLocalStorage = localStorage.getItem('joursEcart');

        // Mettre à jour le texte du placeholder avec la valeur du localStorage
        if (valeurLocalStorage) {
            document.getElementById('nombreJours').textContent = valeurLocalStorage;
        }
    };

  
</script>




</body>
</html>






































<?php

$content = ob_get_clean();
include 'layout.php';
?>
