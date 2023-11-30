<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './../include/config.php';

header('Content-Type: application/json');
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // The request method is not POST, so we do nothing
    http_response_code(405);
    exit('POST request method required');
}

if (array_key_exists('iplans_submit', $_REQUEST)) {

    $appliquer_check = $_POST['appliquer_check'];
    $anneeComptable = $_POST['anneeComptable'];
    $justification = $_POST['justification'];
    $bloquer_check = $_POST['bloquer_check'];
    $date_debut = $_POST['date_debut'];
    $appliquer = $_POST['appliquer'];
    $date_fin = $_POST['date_fin'];
    $deduire = $_POST['deduire'];
    $person = $_POST['person'];
    $motif = (int)$_POST['motif'];

} else {
    http_response_code(401);
    exit(json_encode($_POST));
    exit;
}
