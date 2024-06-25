<?php

require_once 'database.php';
require_once 'CountyDB.php';
// for pdf transformation
//require_once ('tcpdf/tcpdf.php');
require_once 'dompdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

// Create object to connect to database
$dbo = new Database();
$countyDB = new CountyDB();

// Capture parameters from the query string
$county = $_GET['county'] ?? null; // Default to null if not specified
$format = $_GET['format'] ?? 'csv'; // Default to CSV if not specified
$month = $_GET['month'] ?? null;
$year = $_GET['year'] ?? null;

// Ensure output buffering is off to prevent memory issues with large datasets
while (ob_get_level()) ob_end_clean();

// Based on the format, generate the file content
if ($format === 'csv') {
    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="data_' . $county . '_' . $month . '_' . $year . '.csv"');

    // Open the output stream
    $output = fopen('php://output', 'w');

    // Optionally write the header of the CSV file
    fputcsv($output, [
        'JUDET', 
        'Total_someri', 
        'NUMAR_TOTAL_SOMERI FEMEI', 
        'NUMAR_TOTAL_SOMERI BARBATI', 
        'NUMAR_TOTAL_SOMERI_DIN_MEDIUL_URBAN', 
        'NUMAR_SOMERI_FEMEI_DIN_MEDIUL_URBAN', 
        'NUMAR_SOMERI_BARBATI_DIN_MEDIUL_URBAN', 
        'NUMAR_TOTAL_SOMERI_DIN_MEDIUL_RURAL', 
        'NUMAR_SOMERI_FEMEI_DIN_MEDIUL_RURAL', 
        'NUMAR_SOMERI_BARBATI_DIN_MEDIUL_RURAL', 
        'Numar_someri_indemnizati', 
        'Numar_someri_neindemnizati', 
        'Rata_somajului', 
        'Rata_somajului_Feminina', 
        'Rata_somajului_Masculina', 
        'fara_studii', 
        'invatamant_primar', 
        'invatamant_gimnazial', 
        'invatamant_liceal', 
        'invatamant_posticeal', 
        'invatamant_profesional arte si meserii', 
        'invatamant_universitar', 
        'Sub_25_ani', 
        '25_29_ani', 
        '30_39_ani', 
        '40_49_ani', 
        '50_55_ani', 
        'peste_55_ani'
    ]);

    // Query your database
    $data = $countyDB->getAllDataForCountyByCertainMonthAndYear($dbo, $county, $month, $year); // Assuming this method returns an array of data

    // Check if data is not empty
    if (!empty($data)) {
        // Loop through query results and write each row to the CSV
        foreach ($data as $row) {
            fputcsv($output, $row); // Adjust $row as needed to match the CSV structure
        }
    } else {
        // Optionally write a message if no data is found
        fputcsv($output, ['No data available for the selected parameters.']);
    }

    // Close the output stream
    fclose($output);
    exit;
} elseif ($format === 'pdf') {
    
    // Set the html content

    $htmlContent = '<!DOCTYPE html>
    <html>
    <head>
        <style>
            .tabular--wrapper {
                background: #F5F4F4;
                margin-top: 1rem;
                border-radius: 10px;
                padding: 1rem;
                font-family: Arial, Helvetica, sans-serif;
                width: 40%;
                height: auto;
            }
            .table-container {
                width: 40%;
            }   
            table {
                width: 70%;
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

    $rv = $countyDB->getAllDataForCountyByCertainMonthAndYear($dbo, $county, $month, $year);

    foreach ($rv as $row) {
        $htmlContent .= '<tr>';
        foreach ($row as $key => $value) {
            $htmlContent .= '<td>' . htmlspecialchars($value) . '</td>';
        }
        $htmlContent .= '</tr>';
    }

    $htmlContent .= '</tbody></table>';

    //echo $htmlContent;
    // It works here

    // Initialize Dompdf
    $dompdf = new Dompdf();
    
    // Load HTML content
    $dompdf->loadHtml($htmlContent);

    // (Optional) Setup the paper size and orientation ('portrait' or 'landscape')
    $dompdf->setPaper('A1', 'landscape');
    
    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream($county . '_' . $month . '_' . $year . '.pdf', array("Attachment" => 1));

    // // Convert the HTML to PDF
    // $pdf->writeHTML($htmlContent, true, false, true, false, '');

    // $pdf->Output('' . $county . '_' . $month . '_' . $year . '.pdf', 'I');
    exit;

} else {
    // Handle unsupported formats
    echo "Unsupported format";
}
?>