<?php
require_once 'database.php';

class CountyDB 
{
    public function getAllDocDataForCounty($dbo, $county) 
    {
        // if (!preg_match('/^\w+$/', $county)) {
        //     throw new InvalidArgumentException("Invalid county name");
        // }

        // // Dynamically construct the table name
        // $county = strtolower($county);
        // $tableName = $county . "_data";

        // Construct the SQL query using the sanitized table name
        $county = strtolower($county);
        $tableName = "`" . $county . "_data`"; // Enclose table name in backticks

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

    public function getMonthlyDataForAllCounties($dbo, $month, $year) {
        // Step 1: Validate Inputs
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
        $query = "SELECT * FROM `$tableName`";

        // Prepare and execute the query
        $stmt = $dbo->prepare($query);
        $stmt->execute();

        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }

    public function insertMonthlyData($dbo, $month, $year, $fieldValues) {
        // Step 1: Validate Inputs
        if (!preg_match('/^\d{4}$/', $year)) {
            throw new InvalidArgumentException("Invalid year format");
        }
        
        $validMonths = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        if (!in_array(strtolower($month), $validMonths)) {
            throw new InvalidArgumentException("Invalid month name");
        }
    
        // Optionally validate $fieldValues as needed, including checking for 'county'
    
        // Step 2: Format Table Name
        $shortYear = substr($year, -2); // Get last two digits of the year
        $tableName = strtolower($month) . "_" . $shortYear; // Construct table name
    
        // Step 3: Create Insert Query
        // Assuming $fieldValues is an associative array with column names as keys
        $columns = implode(", ", array_keys($fieldValues));
        $valuesPlaceholders = ":" . implode(", :", array_keys($fieldValues)); // Placeholder for prepared statement
    
        $query = "INSERT INTO `$tableName` ($columns) VALUES ($valuesPlaceholders)";
    
        // Prepare and execute the insert query
        $stmt = $dbo->prepare($query);
        
        // Bind the data values
        foreach ($fieldValues as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
        }
    
        $stmt->execute();
    
        // Return success or any other relevant information
        return ['success' => true, 'message' => 'Data inserted successfully'];
    }


    public function updateMonthlyData($dbo, $month, $year, $fieldValues, $judet) {
        // Validate year format
        if (!preg_match('/^\d{4}$/', $year)) {
            throw new InvalidArgumentException("Invalid year format");
        }
        
        // Validate month name
        $validMonths = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        if (!in_array(strtolower($month), $validMonths)) {
            throw new InvalidArgumentException("Invalid month name");
        }

        // Construct table name
        $shortYear = substr($year, -2);
        $tableName = strtolower($month) . "_" . $shortYear;
        
        // Construct update query
        $updateParts = [];
        foreach ($fieldValues as $key => $value) {
            $updateParts[] = "$key = :$key";
        }
        $updateString = implode(", ", $updateParts);
        $query = "UPDATE `$tableName` SET $updateString WHERE JUDET = :judet";

        // Prepare and execute query
        $stmt = $dbo->prepare($query);
        foreach ($fieldValues as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
        }
        $stmt->bindValue(':judet', $judet);
        $stmt->execute();

        return ['success' => true, 'message' => 'Data updated successfully'];
    }

    public function deleteMonthlyDataByJudet($dbo, $month, $year, $judet) {
        // Validate year format
        if (!preg_match('/^\d{4}$/', $year)) {
            throw new InvalidArgumentException("Invalid year format");
        }
        
        // Validate month name
        $validMonths = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];
        if (!in_array(strtolower($month), $validMonths)) {
            throw new InvalidArgumentException("Invalid month name");
        }
    
        // Construct table name
        $shortYear = substr($year, -2);
        $tableName = strtolower($month) . "_" . $shortYear;
        
        // Construct delete query
        $query = "DELETE FROM `$tableName` WHERE JUDET = :judet";
    
        // Prepare and execute query
        $stmt = $dbo->prepare($query);
        $stmt->bindValue(':judet', $judet);
        $stmt->execute();
    
        return ['success' => true, 'message' => 'Data deleted successfully'];
    }
}

?>