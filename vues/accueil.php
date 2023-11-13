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
	<form method="psot" action="">
	<div id="etablissemt">
		<p>
			<label for="etablissemt"><?= $lang['etablissement'] ?></label>
				<select name="Etablissement" id="etablissement">
						<option><?= $lang['choix1'] ?></option>
					<option value="nyalla">Lycee bilingue de Nyalla</option>
					<option value="japoma">Lycee de Japoma</option>
				</select>
		</p>
	</div>

<div id="specialite">
	<p>
		<label for="specialite"><?= $lang['specialite'] ?></label>
			<select name="specialite" id="specialite">
				<option><?= $lang['choix2'] ?></option>
				<option value="ict">GHT</option>
				
			</select>
	</p>
</div>

<div id="cycle">
	<p>
		<label for="cycle"><?= $lang['cycle'] ?></label>
			<select name="cycle" id="cycle">
				<option><?= $lang['choix3'] ?></option>
				<option value="licence">Premier Cycle</option>
				<option value="master">Second Cycle</option>
			</select>
	</p>
</div>
<p>
<a href="<?= SITE_URL ?>/login"><input type="button" value="<?= $lang['suivant'] ?>"></a>


</p>
</form>
</main>
<?php
$content = ob_get_clean();
include 'layout.php';
?>