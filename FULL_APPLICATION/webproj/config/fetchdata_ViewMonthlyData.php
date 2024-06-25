<?php
require_once 'database.php';
require_once 'CountyDB.php';

// create object to connect to database
$dbo = new Database();
$countyDB = new CountyDB();

// Retrieve county, month, and year from query parameters
$month = isset($_GET['month']) ? $_GET['month'] : null;
$year = isset($_GET['year']) ? $_GET['year'] : null;

$rv = $countyDB->getMonthlyDataForAllCounties($dbo, $month, $year);

//test - success
//echo json_encode($rv);


// Start generating HTML table content
$htmlContent = '<!DOCTYPE html>
<html>
<head>
    <style>
        .tabular--wrapper {
            background: #F5F4F4;
            margin-top: 1rem;
            border-radius: 10px;
            padding: 2rem;
            font-family: Arial, Helvetica, sans-serif;
        }
        .table-container {
            width: 100%;
        }   
        table {
            width: 95%;
            border-collapse: collapse;
        }
        thead {
            background: #147487;
            color: #F5F4F4;
        }
        th {
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: 600;
        }
        tbody {
            background: #f2f2f2;
        }
        td {
            padding: 15px;
            font-size: 16px;
            color: #333;
            text-align: center;
            align-items: center;
        }
        tr:nth-child(even) {
            background: #fff;
        }
        tfoot {
            background: #147487;
            font-style: italic;
            font-weight: 400;
        }
        tfoot td {
            padding: 15px;
            color: #F5F4F4;
        }
        .table-container button {
            color: #147487;
            font-size: 17px;  
            font-weight: 600;
            background: none;
            cursor: pointer;
            border: none;
        }
         .table-container button:hover {
            text-decoration: underline;
            cursor: pointer;
            border: none;
            color: #0A3A44;
        }
    </style>
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