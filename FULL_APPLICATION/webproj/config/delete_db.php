<?php

// Database connection variables
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
    // Establish database connection
    $pdo = new PDO($dsn, $user, $pass, $options);

    // Fetch table names ending with '_data'
    $query = "SHOW TABLES LIKE '%_data'";
    $stmt = $pdo->query($query);
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Delete each table
    foreach ($tables as $table) {
        $dropTableSQL = "DROP TABLE `$table`";
        $pdo->exec($dropTableSQL);
        echo "Deleted table: $table\n";
    }
} catch (PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}

?>