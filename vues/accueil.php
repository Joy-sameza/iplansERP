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
<link rel="stylesheet" type="text/css" href="<?= SITE_URL ?>/assets/css/accueil.css">
<link href="<?= SITE_URL ?>/assets/css/style.css" rel="stylesheet">


<main>
	<style>
		.lange{
			font-size: 25px;
            margin-top: 47px;
			display: none;
		}
		.lang{
			    margin-top: 0px!important;
				padding-top: 43px;
		}
	    .lang	img{
				height: 24px;
				width: 24px;
			}


	</style>
		<div class="container-fluid conteneur0  border border-primary border-4 p-4" style='width:50%;margin-top:-70px'>
	<form method="psot" action="" class="was-validated">

		
				<div id="etablissemt" class='container d-flex justify-content-between mb-3'>
					   
						
							<label for="etablissemt" class="text-uppercase"><?= $lang['etablissement'] ?></label>
					
							<select name="Etablissement" id="etablissement" class="form-select" style='width:30%;height:11%'required>
							  
								<!-- <option><?= $lang['choix1'] ?></option> -->
								<option value="nyalla"  selected>Lycee bilingue de Nyalla</option>
								<option value="japoma">Lycee de Japoma</option>
							</select>
					
					
				</div>

				<div id="specialite" class='container d-flex justify-content-between mb-3'>
					
						<label for="specialite" class="text-uppercase"><?= $lang['specialite'] ?></label>
							<select name="specialite" id="specialite" class="form-select " style='width:30%;height:11%'required>
							    
								<!-- <option><?= $lang['choix2'] ?></option> -->
								<option value="ict" selected>GHT</option>
								
							</select>
				
				</div>

				<div id="cycle" class='container d-flex justify-content-between mb-3'>
					 
						<label for="cycle" class="text-uppercase"><?= $lang['cycle'] ?></label>
							<select name="cycle" id="cycle" class="form-select " style='width:30%;height:11%'required>
							   
								<!-- <option><?= $lang['choix3'] ?></option> -->
								<option value="licence"  selected>Premier Cycle</option>
								<option value="master">Second Cycle</option>
							</select>
				
				</div>
				<p style='position:relative'>
					<a href="<?= SITE_URL ?>/login"><input type="button" onclick="saveData()" class='btn' value="<?= $lang['suivant'] ?>"><i class="fas fa-chevron-right ic2" style='position:absolute'></i><i class="fas fa-chevron-right ic1" style='position:absolute'></i></input></a>

                         

				</p>

				<style>
					.btn{
						height:50px;
						width: 23%;
						background-color:#238fce;
						color:white;
						  font-size: 16px;
					}
					.ic1{
						    top: 49%;
  						    right: 42%;
							color:white;
					}
					.ic2{
						    top: 49%;
  						    right: 41%;
							color:white;
					}
					.btn:hover{
						background-color:#238fce;
						color:white;
					}
					.conteneur0{
						border-radius:10px;
					}
					body{
						background-color:#F0F8FF;
					}
					label{
						    font-size: 28px;
						   font-weight: 600;
					}
					
				</style>
		</div>		
	</form>
</main>
  <div class="container d-flex justify-content-end pb-5 align-items-right">
              
    <img src="<?= SITE_URL ?>/assets/img/logo_minesec2.png" alt=""style="width: 130px; height: 130px; margin-right:7px">
  </div>

 <script>
        function saveData() {
            // Récupérer la valeur du champ select
            var selectedText = document.getElementById("etablissement").options[document.getElementById("etablissement").selectedIndex].text;

            // Vérifier si des données existent déjà dans le localStorage
            var storedData = JSON.parse(localStorage.getItem("etablissement")) || [];

            // Ajouter la nouvelle valeur au tableau
            storedData.push(selectedText);

            // Enregistrer les données mises à jour dans le localStorage
            localStorage.setItem("etablissement", JSON.stringify(storedData));

            
        }
    </script>

<!-- 
	<script>
    // Fonction pour enregistrer la valeur sélectionnée dans le localStorage
    function enregistrerValeur() {
        var selectElement = document.getElementById("etablissement");
        var selectedValue = selectElement.options[selectElement.selectedIndex].value;

        // Récupérer les anciennes valeurs du localStorage
        var valeursExistants = JSON.parse(localStorage.getItem("etablissement")) || [];

        // Mettre à jour les valeurs (supprimer la valeur actuelle et ajouter la nouvelle)
        valeursExistants = valeursExistants.filter(function(val) {
            return val !== selectedValue;
        });
        valeursExistants.push(selectedValue);

        // Enregistrer dans le localStorage
        localStorage.setItem("etablissement", JSON.stringify(valeursExistants));
    }

    // Ajouter un écouteur d'événement pour détecter les changements dans le select
    document.getElementById("etablissement").addEventListener("change", enregistrerValeur); -->
</script>


<?php
$content = ob_get_clean();
include 'layout.php';
?>