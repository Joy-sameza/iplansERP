

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

//$_SESSION['lang']=10;
if(isset($_POST['p'])){

    $_SESSION["specialite"]=$_POST['specialite'];
//    var_dump($_SESSION["specialite"]);
//    exit();
    header('location: http://localhost/Iplans/login');
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
  .link1{
      pointer-events: none
  }
        .link2{
            pointer-events: none
        }
        .link3{
            pointer-events: none
        }

	</style>
		<div class="container-fluid conteneur0  border border-primary border-4 p-4" style='width:50%;margin-top:-70px'>
	<form method="post" action="" class="was-validated">

		
				<div id="etablissemt" class='container d-flex justify-content-between mb-3'>
					   
						
							<label for="etablissemt" class="text-uppercase">etablissement</label>
					
							<select name="Etablissement" id="etablissement" class="form-select" style='width:30%;height:11%'required>

								<!-- <option>choix1</option> -->
                                <?php
                                // Get site from database through API
                                $curl = curl_init();
                                curl_setopt_array($curl,[
                                    CURLOPT_URL => siteiplans_API_URL . "site",
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 30,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                                    CURLOPT_HTTPHEADER => [
                                        "Accept: application/javascript"
                                    ],
                                ]);

                                $response = curl_exec($curl);
                                curl_close($curl);

                                $datas = (array)json_decode($response);
                                foreach ($datas as $dt) {
                                    ?>
                                    <option value="<?= $dt ?>"><?= $dt ?></option>
                                    <?php
                                }
                                ?>
							</select>
					
					
				</div>

				<div id="specialite" class='container d-flex justify-content-between mb-3'>
					
						<label for="specialite" class="text-uppercase">specialite</label>
							<select name="specialite" id="specialite" class="form-select " style='width:30%;height:11%'required>
								<!-- <option>choix2</option> -->
								<option value="GHT" selected>GESTION HOTELIERE ET DU TOURISME (GHT)</option>
								<option value="GAAME">GESTION DES ACTIVITES ADMINISTRATIVES ET DES METIERS DE L'ECRIT (GAAME)</option>
							</select>
				
				</div>

				<div id="cycle" class='container d-flex justify-content-between mb-3'>
					 
						<label for="cycle" class="text-uppercase">cycle</label>
							<select name="cycle" id="cycle" class="form-select " style='width:30%;height:11%'required>
								<!-- <option>choix3</option> -->
								<option value="licence"  selected>Premier Cycle</option>
								<option value="master">Second Cycle</option>
							</select>
				
				</div>
				<p style='position:relative'>
					<a href="<?= SITE_URL ?>/login"  id="p" ><input type="submit" name="p" onclick="saveData()" class='btn' value="suivant" ><i class="fas fa-chevron-right ic2" style='position:absolute'></i><i class="fas fa-chevron-right ic1" style='position:absolute'></i></input></a>

                         

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
              
    <img src="<?= SITE_URL ?>/assets/img/logo_minesec2.png" alt="" style="width: 130px; height: 130px; margin-right:7px">
  </div>

 <script>
        function saveData() {
            window.location.href = "home/param?specialite=" + 10;
            // Récupérer la valeur du champ select
            var selectedText = document.getElementById("etablissement").options[document.getElementById("etablissement").selectedIndex].text;

            // Vérifier si des données existent déjà dans le localStorage
            var storedData = JSON.parse(localStorage.getItem("etablissement")) || [];

            // Ajouter la nouvelle valeur au tableau
            storedData.push(selectedText);

            // Enregistrer les données mises à jour dans le localStorage
            localStorage.setItem("etablissement", JSON.stringify(storedData));
            window.location.href = "home/param?specialite=" + selectedText;
            
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
include './vues/layout.php';
?>