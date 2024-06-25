<?php

require_once 'database.php';
require_once 'CountyDB.php';

// create object to connect to database
$dbo = new Database();
$countyDB = new CountyDB();

// Retrieve county, month, and year from query parameters
$county = isset($_GET['county']) ? $_GET['county'] : null;
$month = isset($_GET['month']) ? $_GET['month'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;

// Validate the inputs here (not shown for brevity)

$rv = $countyDB->getAllDataForCountyByCertainMonthAndYear($dbo, $county, $month, $year);

// Assuming $rv is an array of data similar to the provided JSON structure
// Start generating HTML table content
$htmlContent = '<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="fetchData_CountyViewData.css">
</head>
<body>';

$htmlContent .= '<table class="tabular--wrapper"><thead><tr>
<th>JUDET</th>
<th>Total someri</th>
<th>NUMAR TOTAL SOMERI FEMEI</th>
<th>NUMAR TOTAL SOMERI BARBATI</th>
<th>NUMAR TOTAL SOMERI DIN MEDIUL URBAN</th>
<th>NUMAR SOMERI FEMEI DIN MEDIUL URBAN</th>
<th>NUMAR SOMERI BARBATI DIN MEDIUL URBAN</th>
<th>NUMAR TOTAL SOMERI DIN MEDIUL RURAL</th>
<th>NUMAR SOMERI FEMEI DIN MEDIUL RURAL</th>
<th>NUMAR SOMERI BARBATI DIN MEDIUL RURAL</th>
<th>Numar someri indemnizati</th>
<th>Numar someri neindemnizati</th>
<th>Rata somajului</th>
<th>Rata somajului Feminina</th>
<th>Rata somajului Masculina</th>
<th>fara studii</th>
<th>invatamant primar</th>
<th>invatamant gimnazial</th>
<th>invatamant liceal</th>
<th>invatamant posticeal</th>
<th>invatamant profesional arte si meserii</th>
<th>invatamant universitar</th>
<th>Sub 25 ani</th>
<th>25 29 ani</th>
<th>30 39 ani</th>
<th>40 49 ani</th>
<th>50 55 ani</th>
<th>peste 55 ani</th>
</tr></thead><tbody>';

foreach ($rv as $row) {
    $htmlContent .= '<tr>';
    foreach ($row as $key => $value) {
        $htmlContent .= '<td>' . htmlspecialchars($value) . '</td>';
    }
    $htmlContent .= '</tr>';
}

$htmlContent .= '</tbody></table>';

// Echo the generated HTML content
echo $htmlContent;
?>