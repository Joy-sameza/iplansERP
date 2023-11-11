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

<?php
require_once "./include/config.php";
ini_set("date.timezone", "Africa/Douala");
$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => COURRIER_API_URL,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
]);

$response = curl_exec($curl);
$err = curl_error($curl);
$data = [];

curl_close($curl);

if ($err) {
  $_SESSION['error'] = true;
  return;
}
$d = (array)json_decode($response, true);


$a = $b = $c = $de = $e = $u = $ent_auj = 0;
$f = $g = $h = $z = $k = $v = $sor_auj = 0;
$enc1 = $enc2 = $enc3 = $enc4 = $enc5 = $enc6 = $enc_auj = 0;

$j = 0;
$i = 0;
$enc = 0;

foreach ($d as $pack) {

  if ($pack['InOutCourier'] == "Entrant") {
    $i++;

    if ($pack['NiveauImportance'] == "Haute") {
      $a++;
    }
    if ($pack['NiveauImportance'] == "Très haute") {
      $b++;
    }
    if ($pack['NiveauImportance'] == "Moyenne") {
      $c++;
    }
    if ($pack['NiveauImportance'] == "Basse") {

      $de++;
    }
    if ($pack['NiveauImportance'] == "Exceptionel") {

      $e++;
    }
    if ($pack['DateDepot'] == date("Y/m/d")) {
      $ent_auj++;
    }
    if ($pack['Statut'] == "Archivé") {
      $u++;
    }
    if ($pack['Statut'] == "Traité") {
      $u++;
    }
  }
  if ($pack['InOutCourier'] == "Sortant") {
    $j++;
    if ($pack['NiveauImportance'] == "Haute") {
      $f++;
    }
    if ($pack['NiveauImportance'] == "Très haute") {
      $g++;
    }
    if ($pack['NiveauImportance'] == "Moyenne") {
      $h++;
    }
    if ($pack['NiveauImportance'] == "Basse") {
      $z++;
    }
    if ($pack['NiveauImportance'] == "Exceptionel") {
      $k++;
    }
    if ($pack['DateDepot'] == date("Y/m/d")) {
      $sor_auj++;
    }
    if ($pack['Statut'] == "Traité") {
      $v++;
    }
    if ($pack['Statut'] == "Archivé") {
      $v++;
    }
  }
  if ($pack['InOutCourier'] == "En cours") {
    $enc++;
    if ($pack['NiveauImportance'] == "Haute") {
      $enc1++;
    }
    if ($pack['NiveauImportance'] == "Très haute") {
      $enc2++;
    }
    if ($pack['NiveauImportance'] == "Moyenne") {
      $enc3++;
    }
    if ($pack['NiveauImportance'] == "Basse") {
      $enc4++;
    }
    if ($pack['NiveauImportance'] == "Exceptionel") {
      $enc5++;
    }
    if ($pack['DateDepot'] == date("Y/m/d")) {
      $enc_auj++;
    }
    if ($pack['Statut'] == "Traité") {
      $enc6++;
    }
    if ($pack['Statut'] == "Archivé") {
      $enc6++;
    }
  }
}
?>


<main class="main corrier">
  <div class="entrant">
    <h2>Courrier Entrant/Sortant</h2>
    <section>
      <button>Nbre total de Courrier : <strong><?= ($i+$j)-($u+$v) ?? '0' ?></strong></button>
      <button>Aujourd'hui Entrant : <strong><?= $ent_auj ?? '0' ?></strong></button>
        <button>Aujourd'hui Sortant : <strong><?= $sor_auj ?? '0' ?></strong></button>
      <button>Ancien Courrier : <strong><?= ($i - $ent_auj)+($j - $sor_auj) ?? '0' ?></strong></button>
      <button>Traités/Archivées : <strong><?= $u+$v ?? '0' ?></strong></button>
    </section>
    <section>
      <h4>Niveau d'importance</h4>
      <span><strong>Exceptionel</strong><strong><?= $e+$k ?? '0' ?></strong></span>
      <span><strong>Très haute</strong><strong><?= $b+ $g ?? '0' ?></strong></span>
      <span><strong>haute</strong><strong><?= $a+ $f ?? '0' ?></strong></span>
      <span><strong>moyenne</strong><strong><?= $c+$h  ?? '0' ?></strong></span>
      <span><strong>Basse</strong><strong><?= $de+ $z ?? '0' ?></strong></span>
    </section>
    <button class="btn" data-newcourrier>Nouveau courrier</button>
  </div>
  <div class="sortant">
    <h2>Registre Courier</h2>
    <section>
      <button>Nbre total de Courrier : <strong><?= ($i+$j)-($u+$v) ?? '0' ?></strong></button>
        <button>Aujourd'hui Entrant : <strong><?= $ent_auj ?? '0' ?></strong></button>
        <button>Aujourd'hui Sortant : <strong><?= $sor_auj ?? '0' ?></strong></button>
      <button>Ancien Courrier : <strong><?= ($i - $ent_auj)+($j - $sor_auj) ?? '0' ?></strong></button>
      <button>Traités/Archivées : <strong><?= $u+$v ?? '0' ?></strong></button>
    </section>
    <section>
      <h4>Niveau d'importance</h4>
      <span><strong>Exceptionel</strong><strong><?= $e + $k ?? '0' ?></strong></span>
      <span><strong>Très haute</strong><strong><?= $b+ $g ?? '0' ?></strong></span>
      <span><strong>haute</strong><strong><?= $a+ $f ?? '0' ?></strong></span>
      <span><strong>moyenne</strong><strong><?= $c + $h ?? '0' ?></strong></span>
      <span><strong>Basse</strong><strong><?= $de + $z ?? '0' ?></strong></span>
    </section>
    <button class="btn" data-ouvrirCourrier>Ouvrir un courrier</button>
  </div>
  <div class="encours">
    <h2>Courrier en cours</h2>
    <section>
      <button>Nbre total de Courrier : <strong><?= $enc ?? '0' ?></strong></button>
      <button>Aujourd'hui : <strong><?= $enc_auj ?></strong></button>
      <button>Ancien Courrier : <strong><?= $enc - $enc_auj ?? '0' ?></strong></button>
      <button>Traités/Archivées : <strong><?= $enc6 ?? '0' ?></strong></button>
    </section>
    <section>
      <h4>Niveau d'importance</h4>
      <span><strong>Exceptionel</strong><strong><?= $enc5 ?? '0' ?></strong></span>
      <span><strong>Très haute</strong><strong><?= $enc2 ?? '0' ?></strong></span>
      <span><strong>haute</strong><strong><?= $enc1 ?? '0' ?></strong></span>
      <span><strong>moyenne</strong><strong><?= $enc3 ?? '0' ?></strong></span>
      <span><strong>Basse</strong><strong><?= $enc4 ?? '0' ?></strong></span>
    </section><br><br><br>
    <button class="btn" data-nouvelleRedaction>Nouvelle Redaction</button>
  </div>
</main>

<div class="modal" data-modal1>
  <div class="container">
    <button data-close>&times;</button>
    <h3 class="title">Nouveau Courrier</h3>
    <form data-form enctype="multipart/form-data" method="post" action="<?= SITE_URL ?>/forms/formdata.php">
      <fieldset>
        <legend>Type de courrier</legend>
        <label for="entrant"><input type="radio" name="type" id="entrant" value="Entrant" required />Courrier Entrant</label>
        <label for="sortant"><input type="radio" name="type" id="sortant" value="Sortant" required />Courrier Sortant</label>
      </fieldset>
      <fieldset>
        <legend>Info Courrier</legend>
        <div class="group">
          <label for="ref">Reference</label>
          <input type="text" name="ref" id="ref" required />
        </div>
        <div class="group">
          <label for="objet">Objet</label>
          <input type="text" name="objet" id="objet" required />
        </div>
        <div class="group">
          <label for="source">Source</label>
          <input type="text" name="source" id="source" required />
        </div>
        <div class="group">
          <label for="desti">Destinataires</label>
          <input type="text" name="desti" id="desti" required />
        </div>
        <div class="group">
          <label for="date">Date de depot</label>
          <input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>" required />
        </div>
        <div class="group">
          <label for="heure">Heure de depot</label>
          <input type="time" name="heure" id="heure" value="<?= date('H:i') ?>" required />
        </div>
        <section>
          <fieldset>
            <legend>Pièces jointes</legend>
            <span class="icons">
              <a title="pièces jointes" data-firstPiece>
                <input type="file" name="userfiles" data-Rupload id="files" class="hidden">
                <img data-upload src="<?= SITE_URL ?>/assets/img/icons/solid/paperclip.svg" height="16">
              </a>
              <a title="ajouter une pièces jointes" data-addPiece><img src="<?= SITE_URL ?>/assets/img/icons/solid/plus.svg" height="16"></a>
              <a title="retirer une pièces jointes" data-removePiece><img src="<?= SITE_URL ?>/assets/img/icons/solid/minus.svg" height="16"></a>
              <a title="retirer toutes les pièces jointes" data-removeAll><img src="<?= SITE_URL ?>/assets/img/icons/solid/xmark.svg" height="16"></a>
            </span>
            <table>
              <thead>
                <th>T</th>
                <th>Pièces jointes</th>
                <th>Taille</th>
              </thead>
              <tbody data-tbody></tbody>
            </table>
          </fieldset>
          <fieldset>
            <legend>Niveau d'importance</legend>
            <div class="options">
              <label for="exceptionnel"><input required data-select type="radio" name="niveau" id="exceptionnel" value="Exceptionnel"> Exceptionnel</label>
              <label for="tres_haut"><input required data-select type="radio" name="niveau" id="tres_haut" value="Très haute"> Très haut</label>
              <label for="haute"><input required data-select checked type="radio" name="niveau" id="haute" value="Haute"> Haute</label>
              <label for="moyenne"><input required data-select type="radio" name="niveau" id="moyenne" value="Moyenne"> Moyenne</label>
              <label for="basse"><input required data-select type="radio" name="niveau" id="basse" value="Basse"> Basse</label>
            </div>
            <div class="range">
              <input type="range" step="5" min="0" max="20" list="options" data-range>
              <datalist id="options">
                <option value="0"></option>
                <option value="5"></option>
                <option value="10"></option>
                <option value="15"></option>
                <option value="20"></option>
                <option value="25"></option>
              </datalist>
            </div>
          </fieldset>
        </section>
      </fieldset>
      <div class="btn">
        <button type="reset" title="Annuler" data-reset><img src="<?= SITE_URL ?>/assets/img/icons/solid/xmark.svg" height="32px"></button>
        <button type="submit" title="Envoyer" name="iplans_submit"><img src="<?= SITE_URL ?>/assets/img/icons/solid/paper-plane.svg" height="32px"></button>
      </div>
    </form>
  </div>
</div>
<div class="modal" data-modal2>
  <div class="container" id="modal2-container">
    <button data-close2>&times;</button>
    <h3 class="title">Liste des courier arrivé/départ</h3>
    <div class="heading">
      <form id="formOuvrirCourrier">
        <fieldset>
          <legend>Recherche</legend>
          <div class="form-group">
            <label>Date de debut <input type="date" name="date_debut" id="date_debut" value="<?= date('Y-m-d') ?>"></label>
            <input type="checkbox" name="filtre" id="filtre"><label> Filtre</label>
            <label>Date de fin <input type="date" name="date_fin" id="date_fin" value="<?= date('Y-m-d') ?>"></label>
          </div>
        </fieldset>
        <fieldset>
          <label>
            site (Agence)
            <select name="site" id="site">
              <option value="tous" selected>TOUS</option>
              <?php
              // Get site from database through API
              curl_setopt_array($curl, [
                CURLOPT_URL => "http://localhost/courrier/site",
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
          </label>
        </fieldset>
        <fieldset>
          <legend>Niveau d'importance</legend>
          <label for=""><input type="radio" name="niveau_filtre" value="exceptionnel_filtre" id=""> Exceptionel</label>
          <label for=""><input type="radio" name="niveau_filtre" value="tres_haute_filtre" id=""> Très haute</label>
          <label for=""><input type="radio" name="niveau_filtre" value="haute_filtre" id=""> Haute</label>
          <label for=""><input type="radio" name="niveau_filtre" value="moyenne_filtre" id=""> Moyenne</label>
          <label for=""><input type="radio" name="niveau_filtre" value="basse_filtre" id=""> Basse</label>
          <label for=""><input type="radio" name="niveau_filtre" value="tous_importance_filtre" id="" checked> Tous</label>
        </fieldset>
        <fieldset>
          <legend>Etat des couriers</legend>
          <label for=""><input type="radio" name="etat_filtre" value="archive_filtre" id=""> Archivés</label>
          <label for=""><input type="radio" name="etat_filtre" value="non_archive_filtre" id=""> Non Archivés</label>
          <label for=""><input type="radio" name="etat_filtre" value="tous_archive_filtre" id="" checked> Tous</label>
        </fieldset>
        <fieldset>
          <legend>Type de courier</legend>
          <label for=""><input type="radio" name="type_filtre" value="entrant_filtre" id=""> Courier Entrant</label>
          <label for=""><input type="radio" name="type_filtre" value="sortant_filtre" id=""> Courier Sortant</label>
          <label for=""><input type="radio" name="type_filtre" value="encours_filtre" id=""> Courier en cours</label>
          <label for=""><input type="radio" name="type_filtre" value="tous_type_filtre" id="" checked> Tous</label>
        </fieldset>
      </form>
    </div>
    <div class="table">
      <table id="printable" style="position: relative;">
        <thead style="position: sticky; top: 0;">
          <th>References</th>
          <th>Objet</th>
          <th>Date depot</th>
          <th>Heure depot</th>
          <th>Source</th>
          <th>Destinataire</th>
          <th>Importance</th>
          <th>Type de courrier</th>
          <th>Statut</th>
        </thead>
        <tbody class="list">

        </tbody>
      </table>
    </div>
    <div class="footing">
      <div class="btns">
        <button id="modify">Modifier </button>
        <button id="delete">Supprimer</button>
        <button id="archive">Archiver</button>
        <button id="print">Imprimer Liste</button>
      </div>
      <span>Liste des couriers arrivés/départ</span>
    </div>
  </div>
</div>
<div class="modal" data-modal3>
  <div class="container">
    <button data-close3>&times;</button>
    <h3 class="title">Nouveau Courrier en cours</h3>
    <form data-form enctype="multipart/form-data" method="post" action="<?= SITE_URL ?>/forms/formdata.php">
      <fieldset>
        <legend>Utilisez un des templates</legend>
        <div class="template">
          <span data-text="Gestion fiscale">
            <img src="<?= SITE_URL ?>/assets/downloads/template.jpg">
          </span>
          <a href="<?= SITE_URL ?>/assets/downloads/template.docx" download>
            <button type="button">Télécharger</button>
          </a>
        </div>
        <div class="template">
          <span data-text="Gestion finance">
            <img src="<?= SITE_URL ?>/assets/downloads/template2.jpg">
          </span>
          <a href="<?= SITE_URL ?>/assets/downloads/template2.docx" download>
            <button type="button">Télécharger</button>
          </a>
        </div>
        <div class="template">
          <span data-text="Gestion finance">
            <img src="<?= SITE_URL ?>/assets/downloads/template2.jpg">
          </span>
          <a href="<?= SITE_URL ?>/assets/downloads/template2.docx" download>
            <button type="button">Télécharger</button>
          </a>
        </div>
        <div class="template">
          <span data-text="Gestion finance">
            <img src="<?= SITE_URL ?>/assets/downloads/template2.jpg">
          </span>
          <a href="<?= SITE_URL ?>/assets/downloads/template2.docx" download>
            <button type="button">Télécharger</button>
          </a>
        </div>
        <input type="radio" name="type" id="en_cours" value="En cours" checked style="display: none;" required>
      </fieldset>
      <fieldset>
        <legend>Info Courrier</legend>
        <div class="group">
          <label for="ref">Reference</label>
          <input type="text" name="ref" id="ref" required />
        </div>
        <div class="group">
          <label for="objet">Objet</label>
          <input type="text" name="objet" id="objet" required />
        </div>
        <div class="group">
          <label for="source">Source</label>
          <input type="text" name="source" id="source" required />
        </div>
        <div class="group">
          <label for="desti">Destinataires</label>
          <input type="text" name="desti" id="desti" required />
        </div>
        <div class="group">
          <label for="date">Date de depot</label>
          <input type="date" name="date" id="date" value="<?= date('Y-m-d') ?>" required />
        </div>
        <div class="group">
          <label for="heure">Heure de depot</label>
          <input type="time" name="heure" id="heure" value="<?= date('H:i') ?>" required />
        </div>
        <section>
          <fieldset>
            <legend>Pièces jointes</legend>
            <span class="icons">
              <a title="pièces jointes" data-firstPiece>
                <input type="file" name="userfiles" data-Rupload id="files" class="hidden">
                <img data-upload src="<?= SITE_URL ?>/assets/img/icons/solid/paperclip.svg" height="16">
              </a>
              <a title="ajouter une pièces jointes" data-addPiece><img src="<?= SITE_URL ?>/assets/img/icons/solid/plus.svg" height="16"></a>
              <a title="retirer une pièces jointes" data-removePiece><img src="<?= SITE_URL ?>/assets/img/icons/solid/minus.svg" height="16"></a>
              <a title="retirer toutes les pièces jointes" data-removeAll><img src="<?= SITE_URL ?>/assets/img/icons/solid/xmark.svg" height="16"></a>
            </span>
            <table>
              <thead>
                <th>T</th>
                <th>Pièces jointes</th>
                <th>Taille</th>
              </thead>
              <tbody data-tbody></tbody>
            </table>
          </fieldset>
          <fieldset>
            <legend>Niveau d'importance</legend>
            <div class="options">
              <label for="exceptionnel"><input required data-select type="radio" name="niveau" id="exceptionnel" value="Exceptionnel"> Exceptionnel</label>
              <label for="tres_haut"><input required data-select type="radio" name="niveau" id="tres_haut" value="Très haute"> Très haut</label>
              <label for="haute"><input required data-select checked type="radio" name="niveau" id="haute" value="Haute"> Haute</label>
              <label for="moyenne"><input required data-select type="radio" name="niveau" id="moyenne" value="Moyenne"> Moyenne</label>
              <label for="basse"><input required data-select type="radio" name="niveau" id="basse" value="Basse"> Basse</label>
            </div>
            <div class="range">
              <input type="range" step="5" min="0" max="20" list="options" data-range>
              <datalist id="options">
                <option value="0"></option>
                <option value="5"></option>
                <option value="10"></option>
                <option value="15"></option>
                <option value="20"></option>
                <option value="25"></option>
              </datalist>
            </div>
          </fieldset>
        </section>
      </fieldset>
      <div class="btn">
        <button type="reset" title="Annuler" data-reset><img src="<?= SITE_URL ?>/assets/img/icons/solid/xmark.svg" height="32px"></button>
        <button type="submit" title="Envoyer" name="iplans_submit"><img src="<?= SITE_URL ?>/assets/img/icons/solid/paper-plane.svg" height="32px"></button>
      </div>
    </form>
  </div>
</div>
<template data-template-row-info>
  <tr>
    <td data-type></td>
    <td data-doc-name></td>
    <td data-size></td>
  </tr>
</template>
<template data-list-template-info>
  <tr>
    <td data-ref></td>
    <td data-objet></td>
    <td data-date></td>
    <td data-heure></td>
    <td data-source></td>
    <td data-destinataire></td>
    <td data-niveau></td>
    <td data-type></td>
    <td data-statut></td>
    <td data-neng style="display: none;"></td>
  </tr>
</template>

<?php
$content = ob_get_clean();
include 'layout.php';
?>