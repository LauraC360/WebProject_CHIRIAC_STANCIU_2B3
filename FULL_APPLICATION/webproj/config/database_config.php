<?php
$host = 'database-own-server.cvwyk6sq0sk6.eu-north-1.rds.amazonaws.com';
$db   = 'webproj_db';
$user = 'admin';
$pass = 'numaipot22';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

    //$fakeCounties = ['GALATI', 'IASI', 'ALBA', 'ARAD', 'ARGES', 'BACAU', 'BIHOR', 'BISTRITA', 'BOTOSANI', 'BRAILA', 'BRASOV', 'BUZAU', 'CALARASI', 'CARAS-SEVERIN', 'CLUJ', 'CONSTANTA',
    //             'COVASNA', 'DAMBOVITA', 'DOLJ', 'GIURGIU', 'GORJ', 'HARGHITA', 'HUNEDOARA', 'IALOMITA', 'ILFOV', 'MARAMURES', 'MEHEDINTI', 'BUCURESTI', 'MURES', 'NEAMT',
    //             'OLT', 'PRAHOVA', 'SALAJ', 'SATU-MARE', 'SIBIU', 'SUCEAVA', 'TELEORMAN', 'TIMIS', 'TULCEA', 'VALCEA', 'VASLUI', 'VRANCEA'];
    
    $counties = ['PRAHOVA'];
    
    //$counties = ['SALAJ', 'SATU-MARE', 'SIBIU', 'SUCEAVA', 'TELEORMAN', 'TIMIS', 'TULCEA', 'VALCEA', 'VASLUI', 'VRANCEA'];
    $monthlyTables = ['march_24', 'february_24', 'january_24', 'december_23', 'november_23', 'october_23', 'september_23', 'august_23', 'july_23', 'june_23', 'may_23', 'april_23', 'march_23'];

    // Define the tables and initialize a flag to indicate if the county table has been created
    $countyTableCreated = false;

    foreach ($counties as $county) {
        // Normalize the county name to create a table name
        $countyTableName = strtolower($county) . '_data';
        
        // Create the county table with the specified structure
        $createTableSQL = "CREATE TABLE IF NOT EXISTS `$countyTableName` (
                                id INT AUTO_INCREMENT PRIMARY KEY,
                                JUDET VARCHAR(255),
                                Date DATE,
                                Year INT,
                                Month VARCHAR(50),
                                Formats VARCHAR(50) DEFAULT 'csv, pdf',
                                Status VARCHAR(50) DEFAULT 'Approved',
                                ViewFile VARCHAR(255) DEFAULT 'View',
                                DownloadFile VARCHAR(255) DEFAULT 'Download'
                            );";
        $pdo->exec($createTableSQL);
    
        foreach ($monthlyTables as $monthlyTable) {
            // Extract month and year from the table name
            list($month, $yearSuffix) = explode('_', $monthlyTable);
            $year = '20' . $yearSuffix;
            $monthName = ucfirst($month); // Capitalize the first letter of the month
    
            // Check if there's data for the county in the monthly table
            $checkDataSQL = "SELECT COUNT(*) FROM `$monthlyTable` WHERE JUDET = :county";
            $stmt = $pdo->prepare($checkDataSQL);
            $stmt->execute([':county' => $county]);

            if ($stmt->fetchColumn() > 0) {
                // Insert a record into the county table for this month
                $insertSQL = "INSERT INTO `$countyTableName` (JUDET, Date, Year, Month, Formats, Status, ViewFile, DownloadFile) 
                              VALUES (:county, CURDATE(), :year, :month, 'csv, pdf', 'Approved', 'View', 'Download')";
                $stmt = $pdo->prepare($insertSQL);
                $stmt->execute([
                    ':county' => $county,
                    ':year' => $year,
                    ':month' => $monthName
                ]);
            }
        }
    }
    echo "Data for all counties has been updated successfully.\n";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>