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
    <title>Liste Message</title>
   </head>
   <body>
      <div class="container-fluid conteneur border  border-2 border-primary" style='width:80%;'>

              <!-- le header  -->

           <div class="row bg-primary border-1 ">
                <div class="cont_titre d-flex justify-content-between  p-1" style='align-items: center;'>
                        <div style="display: flex;">
                            <img src="<?= SITE_URL ?>/assets/img/iplans-icon.png" alt="" class="ico_emplye">
                            <h6 class="fiche_sala" style='color:white;'>Fiche Message</h6>
                            
                        </div>

                        <div>
                            <button class="close_window" style="width: 30px; height: 30px; background-color: red; border: none;"> <i class="fas fa-close svg-close" style='color:white;'></i></button>
                        </div>
                </div>
            </div>
            <!-- fin header  -->

            <div class="container-fluid  d-flex mb-2">
                <div class="cont1 d-flex d-flex justify-content-end" style='width:10%;margin:0; '>
                   <div class='pt-1 mx-1'>
                     <b>Cc</b>
                   </div>
                     <button class='bouton-seul'>
                       <img  src="<?= SITE_URL ?>/assets/img/staff.png" alt="" style="width: 25px; height: 25px;">
                     </button>
                </div>
                <!-- fin du 1er cont  -->
                <div class="cont2  " style='width:88%;margin:0;'>
                 <input type="text" class="form-control border-0" style="width:100%; height: 110px;" readonly>
            
                </div>
                <!-- fin du 2 eme cont  -->
                <div class="cont3" style='width:1%;margin:0;'>

                                       <div class="tooltip47" >
                                            <button class='bouton-seul'>
                                                <img  src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width:20px; height: 20px;">
                                             <span class="tooltiptext47">Supprimer la selection</span>
                                            </button>
                                        </div> 

                     <!-- <button class='bouton-seul'>
                       <img  src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width: 20px; height: 20px;">
                     </button> -->

                                        <div class="tooltip47" >
                                            <button class='bouton-seul'>
                                                <img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width:20px; height: 20px;">
                                             <span class="tooltiptext47">Supprimer tout</span>
                                            </button>
                                        </div> 

                    
            
                </div>
            </div>

            <div class="container-fluid d-flex mb-2">
                <div class="cont1 d-flex d-flex justify-content-end" style='width:10%;margin:0; '>
                   <div class='pt-1 mx-1'>
                     <b>A</b>
                   </div>
                     <button class='bouton-seul'>
                       <img  src="<?= SITE_URL ?>/assets/img/staff.png" alt="" style="width: 25px; height: 25px;">
                     </button>
                </div>
                <!-- fin du 1er cont  -->
                <div class="cont2  " style='width:88%;margin:0;'>
                 <input type="text" class="form-control border-0" style="width:100%; height: 110px;" readonly>
            
                </div>
                <!-- fin du 2 eme cont  -->
                <div class="cont3" style='width:1%;margin:0;'>
                                       
                                        <div class="tooltip47" >
                                            <button class='bouton-seul'>
                                                <img  src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width:20px; height: 20px;">
                                             <span class="tooltiptext47">Supprimer la selection</span>
                                            </button>
                                        </div>
                                        <div class="tooltip47" >
                                            <button class='bouton-seul'>
                                                <img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width:20px; height: 20px;">
                                             <span class="tooltiptext47">Supprimer tout</span>
                                            </button>
                                        </div> 

            
                </div>
            </div>
            <div class="container-fluid d-flex mb-2">
                <div class="cont1 d-flex d-flex justify-content-end" style='width:10%;margin:0; '>
                   <div class='pt-1 mx-1'>
                     <b>Object</b>
                   </div>
                     
                </div>
                <!-- fin du 1er cont  -->
                <div class="" style='width:88%;margin:0;'>
                   <select class="form-select-sm" style='width:100%'>
                      <option value="">HI</option>  
                      <option value="">FERRIER</option>  
                      <option value="">DEMANDE ACCORDE</option>  
                      <option value="">DEMANDE DOCUMENT </option>  
                      <option value="">BONJOUR</option>  
                      <option value="">RE BONJOUR</option>  
                  </select>
            
                </div>
                <!-- fin du 2 eme cont  -->
                <div class="cont3" style='width:1%;margin:0;'>

                </div>
            </div>




             <div class="container-fluid d-flex mb-2">
                <div class="cont1 d-flex d-flex justify-content-end" style='width:10%;margin:0; '>
                   <div class='pt-1 mx-1'>
                     <b>P.Jtes</b>
                   </div>
                     <button class='bouton-seul'>
                       <img  src="<?= SITE_URL ?>/assets/img/staff.png" alt="" style="width: 25px; height: 25px;">
                     </button>
                </div>
                <!-- fin du 1er cont  -->
                <div class="cont2  " style='width:81%;margin:0;'>
                 <input type="text" class="form-control border-0" style="width:100%; height: 110px;" readonly>
            
                </div>
                <!-- fin du 2 eme cont  -->
                <div class="cont3" style='width:1%;margin:0;'>
                     

                                       <div class="tooltip47" >
                                            <button class='bout_long'>
                                                <img  src="<?= SITE_URL ?>/assets/img/plus.png" alt="" style="width:20px; height: 20px;">Ajouter
                                             <span class="tooltiptext47">Ajouter une piece jointe</span>
                                            </button>
                                        </div> 
                        
                                       <div class="tooltip47" >
                                            <button class='bout_long'>
                                                <img  src="<?= SITE_URL ?>/assets/img/minus.png" alt="" style="width:20px; height: 20px;">Ajouter
                                             <span class="tooltiptext47">Retirer la derniere piece jointe</span>
                                            </button>
                                        </div> 
                        

                
                   

            
                </div>
            </div>
             <div class="container-fluid d-flex mb-2">
                <div class="cont1 d-flex d-flex justify-content-end" style='width:10%;margin:0; '>
              
                </div>
                <!-- fin du 1er cont  -->
                <div class="" style='width:91%;margin:0;'>
                  <div class='pt-1 mx-1  d-flex'>
                     <b class='mt-1 mx-2'>Date d'envoi </b>
                     <input type="date" class="form-control yellow" id="dateInput" value="<?php echo date('Y-m-d'); ?>"  style='width:20%;margin:0;'>
                   </div>
            
                </div>
                <!-- fin du 2 eme cont  -->
                <div class=" d-flex justify-content-end" style='width:0%;margin:0;'>
                       
            
                </div>
            </div>




                <div class="container-fluid d-flex mb-2" style='margin:0;'>
                <div class=" cont1 d-flex d-flex justify-content-end" style='width:10%;margin:0; '>


                   <div class='pt-1 mx-1'>
                     <b>Msg</b>
                   </div>
                
                </div>
                <!-- fin du 1er cont  -->
                <div class=" container-fluid cont2  " style='width:90%;margin:0;position:relative'>
                

               <textarea class="form-control border-0  shadow-none" style="width:100%; height: 290px;" >

               
DR NONO YANNICK
SOCIETE DEMO
PEDIATRE
Departement : PEDIATRIE
DEMOy
            </textarea>

                                       <div class="tooltip47 bout_absolue" style='width:0%;margin:0;position:absolute'>
                                            <button class='' style='margin-right:0px;'>
                                                <img  src="<?= SITE_URL ?>/assets/img/down-arrow.png" alt="" style="width:26px; height: 28px;">
                                             <span class="tooltiptext47">Ajouter votre signature</span>
                                            </button>
                                        </div> 
                 
                        <!-- <button class='bout_absolue' style='margin-right:0px;'>
                       <img  src="<?= SITE_URL ?>/assets/img/down-arrow.png" alt="" style="width: 23px; height: 25px;">
                       </button> -->
            
                </div>
              
            </div>


           <!-- debut la div les boutton du bas  -->
            <div class="row d-flex justify-content-between bg-primary bout-bas p-2 " >
                <div style='width:26%;' class='d-flex justify-content-between' >

                    <button>Envoyer
                        <img  src="<?= SITE_URL ?>/assets/img/message.png" alt="" style="width: max-content; height: 20px;">
                    </button>
               
                    
                    <button >Vider
                        <img  src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
                    </button>
                </div>
                 <!--  css du haut  -->
                 <div style='width:13%;' >
                            <button id="fermer" class='ferme'>
                                Fermer
                                <img src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
                            </button>

                 </div>
                <!--  css du haut  -->
           </div>
           <!-- fin de la div des boutton du bas  -->


      </div>
      <!-- fin du grand container  -->

      <!-- css de la page  -->
      <style>
 .no-focus-outline:focus {
  outline: none; /* Supprime la bordure de focus */
}
            .bout-bas button{
            width:120px;
            height:45px;
            border-radius:5px;
        }
        .ico_emplye{
            height: 18px;
            margin-right: 5px;
        }
        .bouton-seul{
            width:2.4em;
            height: 2.2em;

        }
        .bout_long{
            width:110px;
            height: 42px;
             transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .cont2{
           border:1px solid gray;
        }
        .yellow{
            background-color:yellow;
        }
        .bout_absolue{
              position: absolute;
            z-index: 10;
            right:39px;
            top:-12%;
            margin: 5px;
        }
        button{
            border:1px solid gray;
        }
        .conteneur0{
            border-bottom: none!important;
        }
      

        /* le tooltip  */

             
        .tooltip47 {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }

        .tooltip47 .tooltiptext47 {
            visibility: hidden;
            width: 170px;
            background-color: #f0f004;
            color: #080808;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 10;
            top: 110%;
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
      </style>

  <!-- le js de la page  -->
<!-- ... Autres parties du code HTML ... -->

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ferme = document.querySelector(".close_window");
        const conteneur = document.querySelector(".conteneur");

        ferme.addEventListener("click", (e) => {
            e.preventDefault();
            conteneur.style.display = "none";
        });

        const boutonFermer = document.getElementById("fermer");
        boutonFermer.addEventListener("click", (e) => {
            e.preventDefault();
            conteneur.style.display = "none";
        });
    });
</script>

<!-- ... Autres parties du code HTML ... -->


   </body>
   </html>





























<?php

$content = ob_get_clean();
include 'layout.php';
?>


