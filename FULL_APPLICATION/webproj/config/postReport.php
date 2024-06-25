<?php
require_once 'database.php';

// create object to connect to database
$dbo = new Database();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming your form fields are 'username', 'email', 'report'
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $report = filter_input(INPUT_POST, 'report', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Validation (basic example)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Prepare SQL statement to prevent SQL injection
    $sql = "INSERT INTO reports (username, email, report) VALUES (:username, :email, :report)";
    $stmt = $dbo->prepare($sql);

    // Bind parameters and execute
    if ($stmt) {
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':report', $report);
        
        if ($stmt->execute()) {
            echo "Report submitted successfully.";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    } else {
        echo "Error preparing statement.";
    }
} else {
    // Not a POST request
    echo "Invalid request method.";
}

?>