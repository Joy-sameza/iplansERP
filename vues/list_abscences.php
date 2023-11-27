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
    <div class="container-fluid conteneur0 border border-2 border-primary" style='width:75%;'>
        
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
             <select class="form-select-sm mt-5 " style='width:95%;margin-left:10px'>
                                        <option SELECTED>TOUS</option>
                                        <option>UN SALAIRE</option>
                                     
                                    </select>
           
       </div>
    </div>
    </div>
    <!-- fin de la div qui suit  -->


     <div class="row " style='height:400px;'>
                   <div class="table-responsive debut_tableau w-100">

                               <table class="table table-bordered  ">
                                    <thead >
                                    <tr class="table-secondary text-center table-dark ">
                                        <th style='font-size:13px; ' class='px-5'>Site</th>
                                        <th style='font-size:13px;' class='px-5'>Departement</th>
                                        <th style='font-size:13px;' class='px-5'>Civilite</th>
                                        <th style='font-size:13px; ' class='px-5'>Nom</th>
                                        <th style='font-size:13px;' class='px-5'>Prenom</th>
                                        <th style='font-size:13px;' class='px-5' >Motif</th>
                                        <th style='font-size:13px;' class='px-5'>Debut</th>
                                        <th style='font-size:13px;' class='px-5'>Fin</th>
                                        <th style='font-size:13px;' class='px-5' >justification</th>
                                        <th style='font-size:13px;' class='px-5'>Block_pointage</th>
                                        <th style='font-size:13px;' class='px-5'>Recupereble</th>
                                        <th style='font-size:13px;' class='px-5' >DeduireSurConges</th>
                                        <th style='font-size:13px;' class='px-5'>AnneeComptable</th>
                                        <th style='font-size:13px;' class='px-5' >Matricule</th>
                                        <th style='font-size:13px;' class='px-5'>CreePar</th>
                                        <th style='font-size:13px;' class='px-5' >AccordeePar</th>
                                        <th style='font-size:13px;' class='px-5'>Archive</th>
                                    
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <tr class="table-primary custom-row text-center text-white" style='background-color:#0D6EFD;'>
                                        
                                        <td  class='text-white' style='background-color:#0D6EFD;' >DEMO</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >APPLICATION</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >Mademoiselle</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >Kamsu Simo </td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >Liliane Diane</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >Repos</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >09/10/2023</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >09/10/2023</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >MEMO</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >oui</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >oui</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' ></td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >2021</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >Demo96e973e691</td>
                                        <td class='text-white' style='background-color:#0D6EFD;' ></td>
                                        <td class='text-white' style='background-color:#0D6EFD;' ></td>
                                        <td class='text-white' style='background-color:#0D6EFD;' >2</td>
                                        
                                    </tr>
                                    </tbody>
                                </table>
                           </div>


            </div>

    <!-- debut de la div tableau -->

 
    <style>
                 .debut_tableau {
   
     border-bottom: none;
     overflow-x: auto;


       &::-webkit-scrollbar {
        height: 15px; /* Ajuster la hauteur de la barre de défilement horizontale */
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
        
    <!-- fin div tableau  -->


  <!-- la div du footer  -->
       <div class="row d-flex justify-content-between bg-primary bout-bas p-2 " >
           <div style='width:87%;' class=' d-flex justify-content-between' >
                <button class='taille_boutton' id='new'>
                     Nouveau
                     <img  src="<?= SITE_URL ?>/assets/img/add-file.png" alt="" style="width: max-content; height: 20px;">
                </button>
                
                <button class='taille_boutton'>
                  Modifier
                       <img  src="<?= SITE_URL ?>/assets/img/set.png" alt="" style="width: max-content; height: 20px;">
                </button>

               <button>
                Supprimer
                      <img  src="<?= SITE_URL ?>/assets/img/bin.png" alt="" style="width: max-content; height: 20px;">
              </button>
              <button > 
                Imprimer Liste
                     <img  src="<?= SITE_URL ?>/assets/img/printer.png" alt="" style="width: max-content; height: 20px;">
              </button>
              <button > 
                Voir Pointages
                     <img  src="<?= SITE_URL ?>/assets/img/saving.png" alt="" style="width: max-content; height: 20px;">
              </button>
              <button class='taille_boutton'> 
                Conges
                     <img  src="<?= SITE_URL ?>/assets/img/question.png" alt="" style="width: max-content; height: 20px;">
              </button>
              <button > 
                Planning
                     <img  src="<?= SITE_URL ?>/assets/img/pc.png" alt="" style="width: max-content; height: 20px;">
              </button>
           </div>
            <!--  css du haut  -->
           <div style='width:12%;justify-content:flex-end;' class=' d-flex ' >
              <button id="fermer">
                 Fermer
                    <img  src="<?= SITE_URL ?>/assets/img/close.png" alt="" style="width: max-content; height: 20px;">
              </button>
   
           </div>
           <!--  css du haut  -->
      </div>


  <!-- fin div footer  -->






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
            border:1px solid gray;
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

 .bout-bas button{
            width:125px;
            height:45px;
            border-radius:5px;
            font-size:13px;
        }
   .bout-bas .taille_boutton{
            width:100px;
            height:45px;
            border-radius:5px;
            font-size:13px;
   }  
   
   
element.style {
}
.debut_tableau
&:hover {
}
.debut_tableau {
    border-bottom: none;
    overflow-x: auto;
}
.w-100 {
    width: 100%!important;
}
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}
.row>*{
    padding-left:0!important;
    padding-right:0!important;
}

     </style>




   <!-- jsvascript -->
    <script>
    const ferme = document.querySelector(".close_window");
    const conteneur= document.querySelector(".conteneur0");

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


 <!-- evenement sur les bouttons  -->

    <script>
        document.getElementById("new").addEventListener("click", function() {
            
            var nouvellePageURL = "http://localhost/Iplans/gestion_abscences"; 
            window.open(nouvellePageURL, "_blank");
        });
    </script>
</html>


































<?php

$content = ob_get_clean();
include 'layout.php';
?>