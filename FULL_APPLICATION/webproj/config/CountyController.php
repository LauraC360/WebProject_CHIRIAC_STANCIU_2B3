<?php

require_once 'database.php';
require_once 'CountyDB.php';

require_once 'dompdf/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class CountyController 
{
    private $countyDB;
    private $dbo;

    public function __construct() {
        $this->dbo = new Database();
        $this->countyDB = new CountyDB();
    }

    // public function processDownloadMapRequest($requestMethod, $format) {
    //     // Check if the request method is GET
    //     if ($requestMethod !== 'GET') {
    //         header('HTTP/1.1 405 Method Not Allowed');
    //         exit;
    //     }

    //     // Determine the file path based on the requested format
    //     //$filePath = '';
    //     $fileName = 'romania'; // Example filename, adjust as needed
    //     switch ($format) {
    //         case 'svg':
    //             $filePath = '/.../public/';
    //             $contentType = 'image/svg+xml';
    //             $fileName .= '.svg';
    //             break;
    //         case 'png':
    //             $filePath = 'path/to/your/png/file.png';
    //             $contentType = 'image/png';
    //             $fileName .= '.png';
    //             break;
    //         default:
    //             header('HTTP/1.1 400 Bad Request');
    //             echo "Unsupported file format requested.";
    //             exit;
    //     }

    //     // Check if the file exists
    //     if (!file_exists($filePath)) {
    //         header('HTTP/1.1 404 Not Found');
    //         exit;
    //     }

    //     // Send headers to indicate the content type and a suggested filename
    //     header('Content-Type: ' . $contentType);
    //     header('Content-Disposition: attachment; filename="' . $fileName . '"');

    //     // Read and output the file
    //     readfile($filePath);
    //     exit;
    // }


    public function processAdminRequest($method, $month, $year) {
        header('Content-Type: application/json');
        switch ($method) {
            case 'GET':
                $this->getAllCountiesMonthlyStats($month, $year);
                break;
            case 'POST':
                $this->countyDB->insertMonthlyData($this->dbo, $month, $year, $_POST);
                break;
            case 'PUT':
                parse_str(file_get_contents("php://input"), $putVars);
            
                // Assuming $putVars contains the fields to update and 'JUDET' to specify the row
                if (isset($putVars['JUDET'])) {
                    $judet = $putVars['JUDET'];
                    // Remove 'JUDET' from $putVars to have only the fields to update
                    unset($putVars['JUDET']);
                    
                    // Call updateMonthlyData with 'JUDET' as the identifier
                    $response = $this->countyDB->updateMonthlyData($this->dbo, $month, $year, $putVars, $judet);
                    echo json_encode($response);
                } else {
                    http_response_code(400); // Bad Request
                    echo json_encode(['error' => 'Missing JUDET for update']);
                }
                break;
            case 'DELETE':
                parse_str(file_get_contents("php://input"), $deleteVars);
                
                // Assuming $deleteVars contains 'JUDET' to specify the row for deletion
                if (isset($deleteVars['JUDET'])) {
                    $judet = $deleteVars['JUDET'];
                
                    // Call deleteMonthlyData with 'JUDET' as the identifier
                    $response = $this->countyDB->deleteMonthlyDataByJudet($this->dbo, $month, $year, $judet);
                    echo json_encode($response);
                } else {
                    http_response_code(400); // Bad Request
                    echo json_encode(['error' => 'Missing JUDET for deletion']);
                }
            break;
            default:
                // Method Not Allowed
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
                break;
        }
    }

    public function processDownloadMapRequest($requestMethod, $format) {
        // Check if the request method is GET
        if ($requestMethod !== 'GET') {
            header('HTTP/1.1 405 Method Not Allowed');
            exit;
        }
    
        // Initialize filePath to an empty string
        $filePath = '';
        $fileName = 'romania'; // Example filename, adjust as needed
        switch ($format) {
            case 'svg':
                // Corrected file path for the SVG file
                //$filePath = '/../webproj/public/romania.svg';
                $filePath = './public/romania.svg';
                $contentType = 'image/svg+xml';
                $fileName .= '.svg';
                break;
            case 'png':
                // Assuming you will correct this path as needed for PNG files
                $filePath = './public/romania.png';
                $contentType = 'image/png';
                $fileName .= '.png';
                break;
            default:
                header('HTTP/1.1 400 Bad Request');
                echo "Unsupported file format requested.";
                exit;
        }
    
        // Check if the file exists
        if (!file_exists($filePath)) {
            header('HTTP/1.1 404 Not Found');
            exit;
        }
    
        // Send headers to indicate the content type and a suggested filename
        header('Content-Type: ' . $contentType);
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
    
        // Read and output the file
        readfile($filePath);
        exit;
    }

    public function processGetAllCountiesFilesRequest(string $method, ?string $format, ?string $month, ?string $year): void {
        header('Content-Type: application/json');
        switch ($method) {
            case 'GET':
                $this->getAllCountiesFiles($format, $month, $year);
                break;
            default:
                // Method Not Allowed
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
                break;
        }
    }

    public function processGetAllCountiesMonthlyStatsRequest(string $method, ?string $month, ?string $year): void {
        header('Content-Type: application/json');
        switch ($method) {
            case 'GET':
                $this->getAllCountiesMonthlyStats($month, $year);
                break;
            default:
                // Method Not Allowed
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
                break;
        }
    }

    public function processGetCountyDataRequest(string $method, ?string $county): void {
        header('Content-Type: application/json');
        switch ($method) {
            case 'GET':
                $this->getCountyData($county);
                break;
            default:
                // Method Not Allowed
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
                break;
        }
    }

    public function processGetCountyMonthlyStatsRequest(string $method, ?string $county, ?string $month, ?string $year): void {
        header('Content-Type: application/json');
        switch ($method) {
            case 'GET':
                $this->getCountyMonthlyStats($county, $month, $year);
                break;
            default:
                // Method Not Allowed
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
                break;
        }
    }

    public function processGetCountyFilesRequest(string $method, ?string $format, ?string $month, ?string $year, ?string $county): void {
        switch ($method) {
            case 'GET':
                $this->getCountyFiles($format, $month, $year, $county);
                break;
            default:
                // Method Not Allowed
                http_response_code(405);
                echo json_encode(['error' => 'Method not allowed']);
                break;
        }
    }

    private function getCountyData(?string $county): void {
        if (!$county) {
            http_response_code(400);
            echo json_encode(['error' => 'County not specified']);
            return;
        }

        $rv = $this->countyDB->getAllDocDataForCounty($this->dbo, $county);

        if ($rv === null) {
            http_response_code(404);
            echo json_encode(['error' => 'Data not found for the specified county']);
            return;
        }

        echo json_encode($rv);
    }

    private function getCountyMonthlyStats(?string $county, ?string $month, ?string $year): void {
        // Check if parameters are provided
        if (!$county || !$month || !$year) {
            http_response_code(400);
            echo 'Parameters missing';
            return;
        }
    
        header('Content-Type: text/html; charset=utf-8'); // Set the content type to HTML

        // Retrieve data from the database
        $rv = $this->countyDB->getAllDataForCountyByCertainMonthAndYear($this->dbo, $county, $month, $year);
    
        if (!$rv) {
            http_response_code(404);
            echo 'Data not found';
            return;
        }
    
        // Start HTML content
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
    
        // Output the HTML content
        echo $htmlContent;
    }

    private function getCountyFiles(?string $format, ?string $month, ?string $year, ?string $county): void {
        // Ensure output buffering is off to prevent memory issues with large datasets
        while (ob_get_level()) ob_end_clean();
    
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
            $data = $this->countyDB->getAllDataForCountyByCertainMonthAndYear($this->dbo, $county, $month, $year); // Assuming this method returns an array of data
    
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
            // Generate PDF content
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
    
            // Add table headers and body
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
    
            $data = $this->countyDB->getAllDataForCountyByCertainMonthAndYear($this->dbo, $county, $month, $year);
    
            foreach ($data as $row) {
                $htmlContent .= '<tr>';
                foreach ($row as $key => $value) {
                    $htmlContent .= '<td>' . htmlspecialchars($value) . '</td>';
                }
                $htmlContent .= '</tr>';
            }
    
            $htmlContent .= '</tbody></table></body></html>';
    
            // Initialize Dompdf
            $dompdf = new Dompdf();
            $dompdf->loadHtml($htmlContent);
            $dompdf->setPaper('A1', 'landscape');
            $dompdf->render();
            $dompdf->stream($county . '_' . $month . '_' . $year . '.pdf', array("Attachment" => 1));
            exit;
        } else {
            // Handle unsupported formats
            echo "Unsupported format";
        }
    }
 
    private function getAllCountiesMonthlyStats(?string $month, ?string $year): void {
        
        header('Content-Type: text/html; charset=utf-8'); // Set the content type to HTML

        // Retrieve data
        $rv = $this->countyDB->getMonthlyDataForAllCounties($this->dbo, $month, $year);
    
        // Start generating HTML content
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
    
        $htmlContent .= '</tbody></table></body></html>';
    
        // Echo the generated HTML content
        echo $htmlContent;
    }


    private function getAllCountiesFiles(?string $format, ?string $month, ?string $year): void {

        // Ensure output buffering is off to prevent memory issues with large datasets
        while (ob_get_level()) ob_end_clean();
    
        // Based on the format, generate the file content
        if ($format === 'csv') {
            // Set headers for CSV download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="data_' . $month . '_' . $year . '.csv"');
    
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
            // $data = $countyDB->getAllDataForCountyByCertainMonthAndYear($dbo, $county, $month, $year); // Assuming this method returns an array of data
            $data = $this->countyDB->getMonthlyDataForAllCounties($this->dbo, $month, $year);
    
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
    
            // $rv = $countyDB->getAllDataForCountyByCertainMonthAndYear($dbo, $county, $month, $year);
            $rv = $this->countyDB->getMonthlyDataForAllCounties($this->dbo, $month, $year);
    
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
            $dompdf->stream($month . '_' . $year . '.pdf', array("Attachment" => 1));
    
            // // Convert the HTML to PDF
            // $pdf->writeHTML($htmlContent, true, false, true, false, '');
    
            // $pdf->Output('' . $county . '_' . $month . '_' . $year . '.pdf', 'I');
            exit;
    
        } else {
            // Handle unsupported formats
            echo "Unsupported format";
        }
    }

}
?>