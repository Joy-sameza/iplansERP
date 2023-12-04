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

// const loopObject = {
//     debut: 'date_debut',
//     fin: 'date_fin',
//     motif: 'motif',
//     deduiresurconges: 'deduire',
//     anneecomptable: 'annee',
//     reccuperable: 'recuperable',
// }

if (array_key_exists('iplans_submit', $_POST)) {
    echo json_encode($_POST);
    exit;
    // Get the form data
    $type = $_POST['type'] ?? null;
    $ref = $_POST['ref'] ?? null;
    $desti = $_POST['desti'] ?? null;
    $objet = $_POST['objet'] ?? null;
    $source = $_POST['source'] ?? null;
    $date = $_POST['date'] ?? null;
    $heure = $_POST['heure'] ?? null;
    $niveau = $_POST['niveau'] ?? null;
    $statut = $_POST['statut'] ?? null;

    $data = json_encode([
        "InOutCourier" => $type,
        "ReferenceCourier" => $ref,
        "ObjetCourier" => $objet,
        "SourceCourier" => $source,
        "NiveauImportance" => $niveau,
        "Destinataire" => $desti,
        "DateDepot" => $date,
        "HeureDepot" => $heure,
        "NomPieceJointe" => $fileName,
        "DestiPieceJointe" => $fileDestination,
        "Statut" => $statut
    ]);

    $output = sendDataUsingCurl($data);

    if (array_key_exists("message", $output) && array_key_exists("rows", $output)) {
        echo json_encode($output);
    } else {
        http_response_code(500);
        echo json_encode($output);
    }
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
