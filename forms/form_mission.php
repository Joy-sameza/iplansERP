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


// if (!array_key_exists('iplans_submit', $_POST)) {
//     http_response_code(401);
//     exit;
// }

// Get the form data
if (isset($_POST['iplans_submit'])) {
    $type = $_POST['type'];
    $ref = $_POST['ref'];
    $desti = $_POST['desti'];
    $objet = $_POST['objet'];
    $source = $_POST['source'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $niveau = $_POST['niveau'];

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

    $data = json_encode([
        "Site" => "mcs",
        "InOutCourier" => $type,
        "ReferenceCourier" => $ref,
        "ObjetCourier" => $objet,
        "SourceCourier" => $source,
        "NiveauImportance" => $niveau,
        "Destinataire" => $desti,
        "DateDepot" => $date,
        "HeureDepot" => $heure,
        "NomPieceJointe" => $fileName,
        "DestiPieceJointe" => $fileDestination
    ]);

    if ($done) {
        $output = sendDataCourrier($data, $fileDestination);

        if (array_key_exists("message", $output) && array_key_exists("id", $output)) {
            $_SESSION['save'] = true;
            header("Location: " . SITE_URL . "/courrier");
        } else {
            unlink($fileDestination);
            http_response_code(500);
            $_SESSION['error'] = true;
            header("Location: " . SITE_URL . "/courrier");
        }
    } else {
        $output = sendDataCourrier($data, $fileDestination);

        if (array_key_exists("message", $output) && array_key_exists("id", $output)) {
            $_SESSION['save'] = true;
            header("Location: " . SITE_URL . "/courrier");
        } else {
            http_response_code(500);
            $_SESSION['error'] = true;
            header("Location: " . SITE_URL . "/courrier");
        }
    }
}
