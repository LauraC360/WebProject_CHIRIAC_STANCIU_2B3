<?php
require_once 'database.php';

class CountyDB 
{
    public function getAllDocDataForCounty($dbo, $county) 
    {
        if (!preg_match('/^\w+$/', $county)) {
            throw new InvalidArgumentException("Invalid county name");
        }

        // Dynamically construct the table name
        $county = strtolower($county);
        $tableName = $county . "_data";

        // Construct the SQL query using the sanitized table name
        $cmd = "SELECT
        cd.id as id,
        cd.Month as month,
        cd.Year as year,
        cd.Date as date,
        cd.Formats as formats,
        cd.Status as status,
        cd.ViewFile as viewFile,
        cd.DownloadFile as downloadFile
        FROM {$tableName} cd";

        // Prepare and execute the query
        $stmt = $dbo->conn->prepare($cmd);
        $stmt->execute();
        $rv = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rv;
    }

    public function getAllDataForCountyByCertainMonthAndYear($dbo, $county, $month, $year) {

        // Step 1: Validate Inputs
        if (!preg_match('/^\w+$/', $county)) {
            throw new InvalidArgumentException("Invalid county name");
        }
        if (!preg_match('/^\d{4}$/', $year)) {
            throw new InvalidArgumentException("Invalid year format");
        }
        
        $validMonths = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        if (!in_array(strtolower($month), $validMonths)) {
            throw new InvalidArgumentException("Invalid month name");
        }

        // Step 2: Format Table Name
        $shortYear = substr($year, -2); // Get last two digits of the year
        $tableName = strtolower($month) . "_" . $shortYear; // Construct table name

         // Step 3: Create Query
        $query = "SELECT * FROM `$tableName` WHERE JUDET = :county";
    
        // Prepare and execute the query
        $stmt = $dbo->prepare($query);
        $stmt->bindParam(':county', $county, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

}

?>