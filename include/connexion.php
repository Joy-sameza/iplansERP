<?php
include "include/config.php";
$servername=HOST_NAME;
$username=USER_NAME;
$password=USER_PASSWORD;
$myDB=DB_NAME;

try{
    $conn=new PDO("mysql:host=$servername;dbname=$myDB",$username, $password);
    $conn->SetAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e){
    echo "Impossible de se connecter a la base de données :" .$e->getMessage();
    exit();

}
?>