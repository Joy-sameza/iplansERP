
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

//if (!isset($_POST['iplans_submit'])) {
//    http_response_code(401);
//    exit;
//}

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

/**
 * Sends data via Courrier API and returns the response.
 *
 * @param string $data The data to be sent to the API.
 * @param string $fileDestination The destination file path.
 * @return array The response from the API.
 */
function sendDataCourrier(string $data, string $fileDestination): array
{
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => COURRIER_API_URL,
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

// traitement des informations des employers
if (isset($_POST['ajouter_pers'])) {

// Get the form data
    $civilite = $_POST['civilite'];
    $genre = $_POST['genre'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $cni = $_POST['cni'];
    $fait = $_POST['fait'];
    $expire = $_POST['expire'];
    $adresse = $_POST['adresse'];
    $tel = $_POST['tel'];
    $telpro = $_POST['telpro'];
    $siteagence = $_POST['siteagence'];
    $direction = $_POST['direction'];
    $sousdirection = $_POST['sousdirection'];
    $service = $_POST['service'];
    $departement = $_POST['departement'];
    $posteoccupe = $_POST['posteoccupe'];
    $datenaissssance = $_POST['datenaissssance'];
    $lieunaissance = $_POST['lieunaissance'];
    $nompere = $_POST['nompere'];
    $nommere = $_POST['nommere'];
    $nomurgence = $_POST['nomurgence'];
    $numerourgence = $_POST['numerourgence'];
    $email = $_POST['email'];
    $emailpro = $_POST['emailpro'];


    $lundi1 = $_POST['lundi1'];
    $mardi1 = $_POST['mardi1'];
    $mercredi1 = $_POST['mercredi1'];
    $jeudi1 = $_POST['jeudi1'];
    $vendredi1 = $_POST['vendredi1'];
    $samedi1 = $_POST['samedi1'];
    $dimanche1 = $_POST['dimanche1'];

    $loge = $_POST['loge'];
    $assure = $_POST['assure'];
    $nouri = $_POST['nouri'];


    $nombreenfant = $_POST['nombreenfant'];
    $heuredebut = $_POST['heuredebut'];
    $heurefin = $_POST['heurefin'];
    $conventioncollective = $_POST['conventioncollective'];
    $echellon = $_POST['echellon'];
    $categorie = $_POST['categorie'];
    $salairebase = $_POST['salairebase'];
    $heuresemaine = $_POST['heuresemaine'];
    $tauxhoriare = $_POST['tauxhoriare'];
    $gradesalarie = $_POST['gradesalarie'];
    $genresalarie2 = $_POST['genresalarie2'];
    $contrat = $_POST['contrat'];
    $identifiantinterne = $_POST['identifiantinterne'];
    $matriculeinterne = $_POST['matriculeinterne'];
    $matriculesocial = $_POST['matriculesocial'];
    $numenregistrement = $_POST['numenregistrement'];
    $NIU = $_POST['NIU'];
    $dateentree = $_POST['dateentree'];
    $datecontrat = $_POST['datecontrat'];
    $datedepart = $_POST['datedepart'];
    $motifdepart = $_POST['motifdepart'];

    $data = json_encode([
        "Site" => "mcs",
        "civilite" => $civilite,
        "nom" => $nom,
        "prenom" => $prenom,
        "Matricule" => $matriculeinterne,
        "MatriculeInterne" => $matriculeinterne,
        "cni" => $cni,
        "LieuDelivranceCNI" => $fait,
        "DateExpirationCNI" => $expire,
        "departement" => $posteoccupe,
        "departement1" => $departement,
        "Direction" => $direction,
        "SousDirection" => $sousdirection,
        "Service" => $service,
        "Email" => $email,
        "EmailProfessionnel" => $emailpro,
        "phone" => $tel,
        "TelephoneProfessionne" => $telpro,
        "Adresse" => "douala",
        "Fonction" => $departement,
        "Sexe" => $genre,
        "dnais" => $datenaissssance,
        "npere" => $nompere,
        "nmere" => $nommere,
        "vnais" => $lieunaissance,
        "nurg" => $nomurgence,
        "nuurg" => $numerourgence,
        "LUNDI" => $lundi1,
        "MARDI" => $mardi1,
        "MERCREDI" => $mercredi1,
        "JEUDI" => $jeudi1,
        "VENDREDI" => $vendredi1,
        "SAMEDI" => $samedi1,
        "DIMANCHE" => $dimanche1,
        "Convention" => $conventioncollective,
        "categorie" => $categorie,
        "Echelon" => $echellon,
        "SalaireBaseMensuel" => $salairebase,
        "genre_salarie" => $gradesalarie,
        "date_entree" => $dateentree,
        "date_contrat" => $datecontrat,
        "loge" =>  $loge,
        "nourri" => $nouri,
        "type_contrat" =>  $contrat,
        "motif_depart" => $motifdepart,
        "NombreEnfant" =>  $nombreenfant,

        "CodeAgence" => "252525"

    ]);
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => PERS_API_URL,
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

    if ($response) {
        header("location: ../employes");
    }
}

//post de mission
