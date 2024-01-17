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
    require $dirs.'vues/home/accueil.php';
}
function courrier()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/courier/courrier.php';
}
function loginlogin()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/home/login.php';
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
    require $dirs.'vues/employees/tableau.php';
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
    require $dirs.'vues/mission/mission.php';
}
function list_mission()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/mission/list_mission.php';
}
function details_mission()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/mission/details_mission.php';
}
function list_abscences()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/absence/list_abscences.php';
}

function gestion_abscences()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/absence/gestion_abscences.php';
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
function openEmployer()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/employees/openEmployer.php';
}
function list_visit_rdv()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/list_visit_rdv.php';
}
function fiche_visite_rdv()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/fiche_visite_rdv.php';
}
function modifEmploye()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/employees/modifEmploye.php';
}
function acceuil()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/acceuil.php';
}
function openMission()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/mission/openMission.php';
}
function com_pro()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/com_pro.php';
}
function openAbscence()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/absence/openAbscence.php';
}
function gestion_administrative()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/gestion_administrative.php';
}
function param()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/parametre/param.php';
}
function utilisateurs()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/parametre/utilisateurs.php';
}
function societe()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/parametre/societe.php';
}
?>



