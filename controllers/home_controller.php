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
?>