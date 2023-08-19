<?php

function see_dashboard()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/home.php';
}
function pannel()
{
    $dirs=__DIR__;
    $dirs=str_replace("controllers", "", $dirs);
    require $dirs.'vues/pannel.php';
}

?>