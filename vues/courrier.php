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
<main class="main corrier">
  <div class="entrant">
    <h2>Courrier Entrant</h2>
    <section>
      <button>Nbre total de Courrier : <strong>2</strong></button>
      <button>Aujourd'hui : <strong>0</strong></button>
      <button>Ancien Courrier : <strong>0</strong></button>
      <button>Traités/Archivées : <strong>0</strong></button>
    </section>
    <section>
      <h4>Niveau d'importance</h4>
      <span><strong>Exceptionel</strong><strong>0</strong></span>
      <span><strong>Très haute</strong><strong>2</strong></span>
      <span><strong>haute</strong><strong>1</strong></span>
      <span><strong>moyenne</strong><strong>0</strong></span>
      <span><strong>Basse</strong><strong>0</strong></span>
    </section>
    <button class="btn" data-newcourrier>Nouveau courrier</button>
  </div>
  <div class="sortant">
    <h2>Courrier Sortant</h2>
    <section>
      <button>Nbre total de Courrier : <strong>2</strong></button>
      <button>Aujourd'hui : <strong>0</strong></button>
      <button>Ancien Courrier : <strong>0</strong></button>
      <button>Traités/Archivées : <strong>0</strong></button>
    </section>
    <section>
      <h4>Niveau d'importance</h4>
      <span><strong>Exceptionel</strong><strong>0</strong></span>
      <span><strong>Très haute</strong><strong>2</strong></span>
      <span><strong>haute</strong><strong>1</strong></span>
      <span><strong>moyenne</strong><strong>0</strong></span>
      <span><strong>Basse</strong><strong>0</strong></span>
    </section>
    <button class="btn">Ouvrir un courrier</button>
  </div>
</main>

<div class="modal" data-modal>
  <div class="container">
    <button data-close>&times;</button>
    <h3 class="title">Nouveau Courrier</h3>
    <form data-form enctype="multipart/form-data" method="post" action="<?= SITE_URL ?>/forms/formdata.php">
      <fieldset>
        <legend>Type de courrier</legend>
        <label for="entrant"><input type="radio" name="type" id="entrant" value="entrant" required />Courrier Entrant</label>
        <label for="sortant"><input type="radio" name="type" id="sortant" value="sortant" required />Courrier Sortant</label>
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
          <input type="date" name="date" id="date" required />
        </div>
        <div class="group">
          <label for="heure">Heure de depot</label>
          <input type="time" name="heure" id="heure" required />
        </div>
        <section>
          <fieldset>
            <legend>Pièces jointes</legend>
            <span class="icons">
              <a title="pièces jointes" data-firstPiece>
                <input type="file" name="files" data-Rupload multiple id="files" class="hidden">
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
              <label for="exceptionnel"><input required data-select type="radio" name="niveau" id="exceptionnel"> Exceptionnel</label>
              <label for="tres_haut"><input required data-select type="radio" name="niveau" id="tres_haut"> Très haut</label>
              <label for="haute"><input required data-select checked type="radio" name="niveau" id="haute"> Haute</label>
              <label for="moyenne"><input required data-select type="radio" name="niveau" id="moyenne"> Moyenne</label>
              <label for="basse"><input required data-select type="radio" name="niveau" id="basse"> Basse</label>
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
        <button type="submit" title="Envoyer"><img src="<?= SITE_URL ?>/assets/img/icons/solid/paper-plane.svg" height="32px"></button>
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

<?php
$content = ob_get_clean();
include 'layout.php';
?>