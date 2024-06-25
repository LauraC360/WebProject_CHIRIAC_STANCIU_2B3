<?php
require_once 'constants.php'; // Assuming this file contains necessary constants
require_once 'database.php'; // Adjust the path to where your Database class is located

// Ensure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode the JSON body from the request
    $data = json_decode(file_get_contents('php://input'), true);

    // Create a new instance of the Database class
    $database = new Database();
    $conn = $database->conn; // Get the PDO connection

    try {
        // Prepare the SQL statement using the Database class's prepare method
        $sql = "INSERT INTO logs (action_data, created_at) VALUES (:action_data, NOW())";
        $stmt = $database->prepare($sql); // Use the prepare method from your Database class

        // Bind the parameters
        $stmt->bindParam(':action_data', json_encode($data), PDO::PARAM_STR);

        // Execute the statement
        $stmt->execute();

        // Respond with a success message
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'message' => 'Data logged successfully']);
    } catch(Exception $e) {
        // Handle any errors
        http_response_code(500); // Internal Server Error
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    // Handle non-POST requests here
    http_response_code(405); // Method Not Allowed
    echo 'Method Not Allowed';
}
?>