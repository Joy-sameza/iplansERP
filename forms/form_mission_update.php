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

// Get the form data
if (array_key_exists('iplans_submit', $_POST)) {

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

    $bytes = 1024 * 1024; //Convert Megabytes to bytes
    $done = false;
    $fileDestination = $fileName = "";


    if (array_key_exists("file", $_FILES) and !empty($_FILES["file"]['filename'])) {
        $files = $_FILES["file"];

        if (empty($_FILES)) {
            exit('$_FILES is empty - is file_uploads set to "Off" in php.ini?');
        }

        if ($files["error"] !== UPLOAD_ERR_OK) {

            switch ($files["error"]) {
                case UPLOAD_ERR_PARTIAL:
                    exit('File only partially uploaded');
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    exit('File exceeds MAX_FILE_SIZE in the HTML form');
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    exit('File exceeds upload_max_filesize in php.ini');
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    exit('Temporary folder not found');
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    exit('Failed to write file');
                    break;
                default:
                    exit('Unknown upload error');
                    break;
            }
        }

        // Reject uploaded file larger than 50MB
        if ($files["size"] > MAX_UPLOAD_SIZE * $bytes) {
            exit('File too large (max ' . MAX_UPLOAD_SIZE . 'MB)');
        }

        $fileExt = explode(".", $files["name"]);
        $fileActualExt = strtolower(end($fileExt));
        $fileName = $files["name"];
        $newfile = uniqid("", true) . "." . $fileActualExt;
        $dest = str_replace("forms", "uploads\\", __DIR__);

        $fileDestination = $dest . $newfile;

        $done = move_uploaded_file($files["tmp_name"], $fileDestination);
    }

    $o = getPersonIndex($personne_id);
    $matricule = isset($o['index']) ? (string)$o['index'] : null;

    $noteDeFrais = str_pad('N', 15, mt_rand(0, 9));

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
        'Note_de_Frais' => $noteDeFrais,
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
        'NomPieceJointe' => $fileName,
        'DestiPieceJointe' => $fileDestination
    ]);

    $car = ($totalFees['option1'] === "on") ? (int)$totalFees['transport_total'] / 2 : (int)$totalFees['transport_total'];

    $fraisData = json_encode([
        'Indexe' => $matricule,
        'site' => $site,
        'NumNote' => $noteDeFrais,
        'ModeReglement' => "",
        'PseudoAccorde' => "",
        'TransportParJour' => $totalFees['transport'],
        'Transport' => $totalFees['transport_total'],
        'LogementParJour' => $totalFees['logement'],
        'Logement' => $totalFees['logement_total'],
        'NutritionParJour' => $totalFees['nutrition'],
        'Nutrition' => $totalFees['nutrition_total'],
        'PerdiemeParJour' => $totalFees['perdime'],
        'Perdieme' => $totalFees['perdime_total'],
        'AutresParJour' => $totalFees['autres'],
        'Autres' => $totalFees['autre_total'],
        'TotalPArJour' => $totalFees['tataux'],
        'TotalFrais' => $totalFees['totalFrais'],
        'DateCreation' => date('d/m/Y'),
        'Carburant' => $car,
    ]);

    $outputMission = sendDataMission($data, $fileDestination);
    $outputFrais = sendFraisData($fraisData);


    if (
        (array_key_exists("message", $outputMission) && array_key_exists("id", $outputMission)) &&
        (array_key_exists("message", $outputFrais) && array_key_exists("id", $outputFrais))
    ) {
        echo json_encode([$outputMission, $outputFrais]);
    } else {
        if ($done) unlink($fileDestination);
        http_response_code(500);
        echo json_encode([$outputMission, $outputFrais]);
    }
} else {
    http_response_code(401);
    exit;
}


/**
 * Sends data via courier.
 *
 * @param mixed $data The data to be sent.
 * @param string $fileDestination The destination file.
 * @throws Exception If there is an error in the request.
 * @return array The response from the API.
 */
function sendDataMission($data, $fileDestination)
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => MISSION_API_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        return ["errors" => $err];
        unlink($fileDestination);
    } else {
        return (array)json_decode($response, true);
    }
}

/**
 * Retrieves the index of a person from the API based on the given person ID.
 *
 * @param int $personId The ID of the person to retrieve the index for.
 * @throws Some_Exception_Class Description of the exception that may be thrown.
 * @return array Returns an array containing the index of the person. If there is an error, the array will contain an "errors" key with the error message.
 */
function getPersonIndex(int $personId): array
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => PERS_API_URL . $personId,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);
    $response = curl_exec($curl);
    $error = curl_error($curl);
    curl_close($curl);

    return $error ? ["errors" => $error] : ['index' => ((array) json_decode($response, true))["Indexe"]];
}


/**
 * Sends the given data to the Frais Mission API via a POST request.
 *
 * @param mixed $data The data to send to the API.
 * @throws Exception If there is an error sending the request.
 * @return array The response from the API as an associative array.
 */
function sendFraisData($data): array
{
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => FRAIS_MISSION_API_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json"
        ],
    ]);
    $response = curl_exec($curl);
    $error = curl_error($curl);

    curl_close($curl);

    if ($error) {
        return ["errors" => $error];
    } else {
        return json_decode($response, true);
    }
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
