<?php
require_once 'database.php';
// create object to connect to database
$dbo = new Database();
// how to execute a query

$cmd = 'SELECT Month FROM galati_data';
$stmt = $dbo->conn->prepare($cmd);
$stmt->execute();
// view the result
$rv = $stmt->fetchAll(PDO::FETCH_ASSOC); // Corrected $statment to $stmt
print_r($rv);
?>