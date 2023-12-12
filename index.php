<?php

/**
 * Code sniffer
 *
 * @category Pass
 * @package  Pass
 * @author   Pass <username@example.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.gnu.org/copyleft/gpl.html
 *
 */


require_once __DIR__ . '/include/config.php';
require_once __DIR__ . '/controllers/home_controller.php';
// gestion des routes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace("/Iplans", "", $uri);
$uri = str_replace(".php", "", $uri);
$uri = str_replace("//", "/", $uri);
if ('/accueil' == $uri || empty($uri) || $uri == "/") {
    see_dashboard();
}
if ('/courrier' == $uri) {
    courrier();
}
if ('/login' == $uri) {
    loginlogin();
}
if ('/home' == $uri) {
    spider();
}
if ('/resource_humaine' == $uri) {
    rhrhrh();
}
if ('/tester' == $uri) {
    tester();
}
if ('/mission' == $uri) {
    mission();
}
if ('/details_mission' == $uri) {
    details_mission();
}
if ('/list_mission' == $uri) {
    list_mission();
}
if ('/list_abscences' == $uri) {
    list_abscences();
}
if ('/gestion_abscences' == $uri) {
    gestion_abscences();
}
if ('/selection_salarie' == $uri) {
    selection_salarie();
}
if ('/fiche_message' == $uri) {
    fiche_message();
}
if ('/permi_con' == $uri) {
    permi_con();
}
if ('/openEmployer' == $uri) {
    openEmployer();
}
if ('/list-visit-rdv' == $uri) {
    list_visit_rdv();
}
if ('/visit-rdv' == $uri) {
    fiche_visite_rdv();
}
if ('/employes' == $uri) {
    tableau();
} elseif (!empty($uri) and !in_array($uri, ['/', '/accueil', '/details_mission', '/list_abscences', '/mission', '/list_mission', '/courrier', '/login', '/home', '/resource_humaine', '/employes', '/gestion_abscences', '/selection_salarie', '/fiche_message', '/tester','/permi_con','/openEmployer','/list-visit-rdv','/visit-rdv'])) {
    show404();
}