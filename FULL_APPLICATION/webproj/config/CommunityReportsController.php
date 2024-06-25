<?php
require_once 'database.php';

class CommunityReportsController {

    //private $countyDB;

    private $dbo;

    public function __construct() {
        $this->dbo = new Database();
    }

    public function processRequest(string $requestMethod) {
        if ($requestMethod == "POST") {
            // Assuming your form fields are 'username', 'email', 'report'
            // $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $report = filter_input(INPUT_POST, 'report', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Validation (basic example)
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die(json_encode(['error' => 'Invalid email format']));
            }
    
            // Prepare SQL statement to prevent SQL injection
            $sql = "INSERT INTO reports (email, report) VALUES (:email, :report)";
            $stmt = $this->dbo->prepare($sql);
    
            // Bind parameters and execute
            if ($stmt) {
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':report', $report);
                
                if ($stmt->execute()) {
                    echo json_encode(['message' => 'Report submitted successfully.']);
                } else {
                    echo json_encode(['error' => "Error: " . $stmt->errorInfo()[2]]);
                }
            } else {
                echo json_encode(['error' => "Error preparing statement."]);
            }
        } 
        else {
            // Not a POST request
            echo json_encode(['error' => "Invalid request method."]);
        }
    }

    public function processAdminRequest(string $requestMethod) {
        if ($requestMethod == "POST") {
            // Assuming your form fields are 'username', 'email', 'report'
            //$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $username = 'admin';
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $report = filter_input(INPUT_POST, 'report', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
            // Validation
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                die(json_encode(['error' => 'Invalid email format']));
            }
    
            // Prepare SQL statement to prevent SQL injection
            $sql = "INSERT INTO reports (email, report) VALUES (:email, :report)";
            $stmt = $this->dbo->prepare($sql);
    
            // Bind parameters and execute
            if ($stmt) {
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':report', $report);
                
                if ($stmt->execute()) {
                    echo json_encode(['message' => 'Report submitted successfully.']);
                } else {
                    echo json_encode(['error' => "Error: " . $stmt->errorInfo()[2]]);
                }
            } else {
                echo json_encode(['error' => "Error preparing statement."]);
            }
        } 
        else if($requestMethod == "GET") {
            $sql = "SELECT * FROM reports";
            $stmt = $this->dbo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($results);
        }
        else if($requestMethod == "PUT") {
            //echo json_encode(['error' => "PUT method supported."]);
            parse_str(file_get_contents("php://input"), $put_vars);
            $id = $put_vars['id'] ?? null;
            // $username = $put_vars['username'] ?? null;
            $email = $put_vars['email'] ?? null;
            $report = $put_vars['report'] ?? null;

            // // Validation
            // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //     die(json_encode(['error' => 'Invalid email format']));
            // }

            // Prepare SQL statement to update data
            $sql = "UPDATE reports SET email = :email, report = :report WHERE id = :id";
            $stmt = $this->dbo->prepare($sql);

            // Bind parameters and execute
            if ($stmt) {
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                // $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':report', $report, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    echo json_encode(['message' => 'Report updated successfully.']);
                } else {
                    echo json_encode(['error' => "Error: " . $stmt->errorInfo()[2]]);
                }
            } else {
                echo json_encode(['error' => "Error preparing statement."]);
            }
        }
        else if($requestMethod == "DELETE") {
            //echo json_encode(['error' => "DELETE method supported."]);
            // Parse input to get data
            parse_str(file_get_contents("php://input"), $delete_vars);
            $id = $delete_vars['id'] ?? null;

            // Validation
            if (empty($id) || !filter_var($id, FILTER_VALIDATE_INT)) {
                die(json_encode(['error' => 'Invalid or missing ID']));
            }

            // Prepare SQL statement to delete data
            $sql = "DELETE FROM reports WHERE id = :id";
            $stmt = $this->dbo->prepare($sql);

            // Check if the statement was prepared successfully
            if ($stmt) {
                // Bind parameters and execute
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                if ($stmt->execute()) {
                    // Check if any row was actually deleted
                    if ($stmt->rowCount() > 0) {
                        echo json_encode(['message' => 'Report deleted successfully.']);
                    } else {
                        echo json_encode(['error' => 'No report found with the given ID.']);
                    }
                } else {
                    echo json_encode(['error' => "Error: " . $stmt->errorInfo()[2]]);
                }
            } 
            else {
                echo json_encode(['error' => "Error preparing statement."]);
            }
        }
        else {
            // Not a valid request
            echo json_encode(['error' => "Invalid request method."]);
        }
    }
}
?>