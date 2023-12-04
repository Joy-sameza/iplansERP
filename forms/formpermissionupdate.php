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
    $debut = $_POST['date_debut'];
    $fin = $_POST['date_fin'];
    $type = $_POST['motif'];
    $deduire = $_POST['deduire'];
    $annee = $_POST['annee'];
    $recuperable = $_POST['recuperable'];
    $blockpointage = $_POST['bloquer'] == 'on' ? 'OUI' : 'NON';

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
        "debut" => $debut,
        "fin" => $fin,
        "type" => $type,
        "AccordeePar" => "NONO YANNICK",
        "deduireSurConges" => $deduire,
        "anneeComptable" => $annee,
        "reccuperable" => "OUI",
        "block_pointage" => $blockpointage,
        "matricule" => $matricule,
        "Demande" => '123',
        "IDBlockPointage" => '123',
        "IndexGroupement" => "123",
        "IDDateTime"=> uniqid(date("Y-m-d H:i:s"), true),
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
        CURLOPT_URL => PERMISSION_API_URL . $_REQUEST['id'],
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
