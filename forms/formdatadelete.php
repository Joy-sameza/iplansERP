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

sendDeleteRequest();

/**
 * Sends a DELETE request to the Courrier API.
 *
 * @throws Exception Throws an exception if there is an error in the cURL request.
 */
function sendDeleteRequest()
{
    $url = COURRIER_API_URL . $_REQUEST['id'];
    
    $curlHandle = curl_init();
    
    $curlOptions = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "DELETE",
    ];
    
    curl_setopt_array($curlHandle, $curlOptions);
    
    $response = curl_exec($curlHandle);
    $error = curl_error($curlHandle);
    
    curl_close($curlHandle);
    
    if ($error) {
        http_response_code(500);
        echo json_encode(["errors" => $error]);
        die();
    }
    
    echo $response;
}
