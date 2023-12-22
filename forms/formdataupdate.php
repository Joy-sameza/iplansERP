<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './../include/config.php';
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // The request method is not POST, so we do nothing
    exit('POST request method required');
}


if (!isset($_POST['iplans_submit'])) {
    http_response_code(401);
    exit;
}

// Get the form data
$type = $_POST['nom'] ?? null;
$ref = $_POST['ref'] ?? null;
$desti = $_POST['desti'] ?? null;
$objet = $_POST['objet'] ?? null;
$source = $_POST['source'] ?? null;
$date = $_POST['date'] ?? null;
$heure = $_POST['heure'] ?? null;
$niveau = $_POST['niveau'] ?? null;
$statut = $_POST['statut'] ?? null;

$bytes = 1024 * 1024; //Convert Megabytes to bytes
$done = false;
$fileDestination = $fileName = "";


if (array_key_exists("userfiles", $_FILES) and !empty($_FILES["userfiles"]['name'])) {
    $files = $_FILES["userfiles"];

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
], JSON_NUMERIC_CHECK);

if ($done) {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => COURRIER_API_URL . $_REQUEST['id'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    if ($err) {
        unlink($fileDestination);
        echo json_encode(["errors" => $err]);
        exit;
    }

    $result = (array)json_decode($response, true);
    unlink($result['DestiPieceJointe']);

    $output = sendDataUsingCurl($data, $fileDestination);
    $dtd = (array)json_decode($output, true);


    if (array_key_exists("message", $dtd) && array_key_exists("rows", $dtd)) {
        echo $output;
    } else {
        unlink($fileDestination);
        echo json_encode(["errors" => "An error occurred"]);
    }
} else {
    $output = sendDataUsingCurl($data, $fileDestination);
    $dtd = (array)json_decode($output, true);

    if (array_key_exists("message", $dtd) && array_key_exists("rows", $dtd)) {
        echo $output;
    } else {
        echo json_encode(["errors" => "An error occurred"]);
    }
}

function sendDataUsingCurl(string $data, string $fileDestination): string
{
    $curlHandle = curl_init();

    $curlOptions = [
        CURLOPT_URL => COURRIER_API_URL . $_REQUEST['id'],
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
    $err = curl_error($curlHandle);

    curl_close($curlHandle);

    if ($err) {
        unlink($fileDestination);
        return ("errors " . $err);
    } else {
        return $response;
    }
}
