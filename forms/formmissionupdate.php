<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './../include/config.php';
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // The request method is not POST, so we do nothing
    http_response_code(405);
    exit('POST request method required');
}

if (array_key_exists('iplans_submit', $_POST)) {

    // Get the form data
    $personne_id = (int)$_POST['personne'];
    $destination = $_POST['destination'];
    $via = $_POST['via'];
    $deplacement = $_POST['deplacement'];
    $immatriculation = $_POST['immatriculation'];
    $cadre = $_POST['cadre'];
    $site = $_POST['site'];
    $dateDebut = $_POST['dateDebut'];
    $joursEcart = $_POST['joursEcart'];
    $dateFin = $_POST['dateFin'];
    $nature = $_POST['nature'];
    $prise = $_POST['prise'];
    $heuredebut = $_POST['heuredebut'];
    $nobl_lta = $_POST['nobl_lta'];
    $comment = $_POST['comment'];
    $totalFees = (array)json_decode($_POST['totalFees'], true);
    $identifiant = $_POST['identifiant'];
    $persData = json_decode(file_get_contents(PERS_API_URL), true);
    $matricule = null;
    foreach ($persData as $person) {
        if ($person['NEng'] == $identifiant) {
            $matricule = $person['Indexe'];
            break;
        }
    }

    $data = json_encode([
        'matricule' => $matricule,
        'dest' => $destination,
        'via' => $via,
        'cadre' => $cadre,
        'deplacement' => $deplacement,
        'NumeroBL_LTA' => $nobl_lta,
        'site' => $site,
        'dateDebut' => $dateDebut,
        'Lieux' => $destination,
        'duree' => $joursEcart,
        'dateFin' => $dateFin,
        'nature' => $nature,
        'PriseEnCharge' => $prise,
        'charge' => $prise,
        'heuredebut' => $heuredebut,
        'Rapport' => $comment,
        'duree_travail' => $joursEcart,
        'Note_de_Frais' => "note ici",
        'Departement' => 'DEMO',
        "motor" => "123",
        "IndexEvenement" => "123",
        "IndexDossierLogistique" => "123",
        "NumeroDossier" => "123",
        "mat" => $immatriculation,
        "state" => "123",
        "BlockPointage" => "123",
        "historique" => "123",
        "Synchronization" => "123",
        "Archive" => 0,
        "ArchiveMotif" => "123",
        'NomPieceJointe' => "0",
        'DestiPieceJointe' => "0"
    ]);

    $output = sendDataUsingCurl($data);

    if (!(array_key_exists("message", $output) && array_key_exists("rows", $output))) http_response_code(500);
    echo json_encode($output);
} else {
    http_response_code(401);
    exit;
}

/**
 * Sends data using cURL.
 *
 * @param string $data The data to be sent.
 * @throws Exception If there is an error while sending the data.
 * @return array The response received after sending the data.
 */
function sendDataUsingCurl(string $data): array
{
    $curlHandle = curl_init();

    $curlOptions = [
        CURLOPT_URL => MISSION_API_URL . $_REQUEST['id'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "PATCH",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
    ];

    curl_setopt_array($curlHandle, $curlOptions);

    $response = curl_exec($curlHandle);
    $error = curl_error($curlHandle);

    curl_close($curlHandle);

    return $error ? ["errors " => $error] : (array)json_decode($response, true);
}
