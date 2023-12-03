<?php

// ini_set("session.use_only_cookies", 1);
// ini_set("session.use_strict_mode", 1);

// session_set_cookie_params([
//     "lifetime" => 1800,  // cookie will expire in 30 minutes
//     "secure" => "https", // cookie will only be sent over https
//     "https_only" => 1,    
// ]);

function see_dashboard()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/accueil.php';
}
function courrier()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/courrier.php';
}
function loginlogin()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/login.php';
}
function spider()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/home.php';
}
function rhrhrh()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/RH.php';
}
function tableau()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/tableau.php';
}
function tester()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/tester.php';
}
function show404()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/404.php';
}
function mission()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/mission.php';
}
function list_mission()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/list_mission.php';
}
function details_mission()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/details_mission.php';
}
function list_abscences()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/list_abscences.php';
}

function gestion_abscences()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/gestion_abscences.php';
}
function selection_salarie()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/selection_salarie.php';
}
function fiche_message()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/fiche_message.php';
}
function permi_con()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/permi_con.php';
}
?>



