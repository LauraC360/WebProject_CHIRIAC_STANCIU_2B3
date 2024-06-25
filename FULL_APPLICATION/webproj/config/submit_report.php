<?php
session_start();
require 'database.php'; // Ensure this path is correct

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $report = $_POST['report'];

    // Debugging output
    error_log("Form data received: email=$email, firstname=$firstname, lastname=$lastname, report=$report");

    // Insert the report into the database
    $sql = "INSERT INTO community_reports (email, first_name, last_name, report_content) VALUES (:email, :firstname, :lastname, :report)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':report', $report);

    if ($stmt->execute()) {
        echo "Your report has been submitted successfully.";
    } else {
        echo "There was an error submitting your report. Please try again.";
    }
}
?>