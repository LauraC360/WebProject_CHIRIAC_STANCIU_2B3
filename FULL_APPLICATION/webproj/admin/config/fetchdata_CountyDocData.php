<?php

require_once 'database.php';
require_once 'CountyDB.php';

// Display errors for debugging, remove or set to 0 in production
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

$dbo = new Database();
$countyDB = new CountyDB();

$county = isset($_GET['county']) ? $_GET['county'] : null;

if (!$county) {
    echo json_encode(['error' => 'County not specified']);
    exit;
}

$rv = $countyDB->getAllDocDataForCounty($dbo, $county);
echo json_encode($rv);

?>