<?php

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  // The request method is not POST, so we do nothing
  exit('POST request method required');
}

// Get the file data
$files = $_FILES['files'];
// Get the form data
$type = $_POST['type'];
$ref = $_POST['ref'];
$desti = $_POST['desti'];
$objet = $_POST['objet'];
$source = $_POST['source'];
$date = $_POST['date'];
$heure = $_POST['heure'];

$bytes = 1024 * 1024; //Convert Megabytes to bytes

