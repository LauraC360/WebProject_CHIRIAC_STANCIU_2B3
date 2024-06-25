<?php

require_once 'database.php';
require_once 'CountyDB.php';

//for pdf transformation
require_once ('tcpdf/tcpdf.php');


// Create object to connect to database
$dbo = new Database();
$countyDB = new CountyDB();

// Capture parameters from the query string
$county = $_GET['county'] ?? null; // Default to null if not specified
$format = $_GET['format'] ?? null; // Default to CSV if not specified
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
    // Initialize TCPDF
    $pdf = new TCPDF();

    // Set headers for PDF download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="data_' . $county . '_' . $month . '_' . $year . '.pdf"');

    // Generate PDF content
    // from url to get html content
    $url = "http://localhost/webproj/config/fetchdata_CountyViewData.php?county=" . urlencode($county) . "&month=" . urlencode($month) . "&year=" . urlencode($year);

    // Use file_get_contents or cURL to fetch the content
    $htmlContent = file_get_contents($url);

    // Check if fetching was successful
    if ($htmlContent === false) {
        // Handle error, e.g., by logging or setting an error message in the PDF
        $pdf->writeHTML('<p>Error fetching data. Please try again later.</p>', true, false, true, false, '');
    } else {
        // Include the HTML content in the PDF
        $pdf->writeHTML($htmlContent, true, false, true, false, '');
    }

    $pdf->Output('data_' . $county . '_' . $month . '_' . $year . '.pdf', 'D');

    echo "PDF content would go here";
    // More PDF generation here
} else {
    // Handle unsupported formats
    echo "Unsupported format";
}
?>