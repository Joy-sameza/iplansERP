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
$nom = $_POST['nom'] ?? null;
$prenom = $_POST['prenom'] ?? null;
$fonction= $_POST['fonction'] ?? null;
$phone = $_POST['phone'] ?? null;
$matricule = $_POST['matricule'] ?? null;
$cni = $_POST['cni'] ?? null;
$civilite = $_POST['civilite'] ?? null;
$email = $_POST['email'] ?? null;
$dnais = $_POST['dnais'] ?? null;
$npere= $_POST['npere'] ?? null;
$nmere = $_POST['nmere'] ?? null;
$vnais = $_POST['vnais'] ?? null;
$nurg = $_POST['nurg'] ?? null;
$nuurg = $_POST['nuurg'] ?? null;
$matriculeInterne = $_POST['matriculeInterne'] ?? null;
$categorie= $_POST['categorie'] ?? null;
$Grade = $_POST['Grade'] ?? null;
$SousDirection = $_POST['SousDirection'] ?? null;
$Convention= $_POST['Convention'] ?? null;
$departement1= $_POST['departement1'] ?? null;
$Direction = $_POST['Direction'] ?? null;
$Service = $_POST['Service'] ?? null;
$date_entree= $_POST['date_entree'] ?? null;

$type_contrat = $_POST['type_contrat'] ?? null;
$IDDate_Contrat = $_POST['IDDate_Contrat'] ?? null;
$IDDate_Sortie = $_POST['IDDate_Sortie'] ?? null;
$LieuDelivranceCNI= $_POST['LieuDelivranceCNI'] ?? null;
$IDDateExpirationCNI = $_POST['IDDateExpirationCNI'] ?? null;
$motif_depart= $_POST['motif_depart'] ?? null;
$id = $_POST['NEng'] ?? null;


$bytes = 1024 * 1024; //Convert Megabytes to bytes
$done = false;
$fileDestination = $fileName = "";

$data = json_encode([
    'NEng'=>$id,
                'nom'=> $nom,
                'prenom'=>$prenom,
                'fonction'=>$fonction,
                'phone'=> $phone,
                'matricule'=> $matricule,
                'cni'=>$cni,
                'civilite'=>$civilite,
                'email'=>$email,
                'dnais'=>$dnais,
                'npere'=>$npere,
                'nmere'=>$nmere,
                'vnais'=> $vnais,
                'nurg'=> $nurg,
                'nuurg'=> $nuurg,
                'matriculeInterne'=>$matriculeInterne,


                'categorie'=>$categorie,
                'Grade'=>$Grade,
                'SousDirection'=> $SousDirection,
                'Convention'=>$Convention,
                'departement1'=>$departement1,

                'Direction'=>$Direction,
                'Service'=>$Service,

                'date_entree'=>$date_entree,
                'type_contrat'=> $type_contrat,
                'IDDate_Contrat'=>$IDDate_Contrat,
                'IDDate_Sortie'=> $IDDate_Sortie,
                'LieuDelivranceCNI'=> $LieuDelivranceCNI,

                'IDDateExpirationCNI'=> $IDDateExpirationCNI,
               'motif_depart'=>$motif_depart,

], JSON_NUMERIC_CHECK);

  $curlHandle = curl_init();

    $curlOptions = [
        CURLOPT_URL => PERS_API_URL . $_REQUEST['NEng'],
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


        return $response;

