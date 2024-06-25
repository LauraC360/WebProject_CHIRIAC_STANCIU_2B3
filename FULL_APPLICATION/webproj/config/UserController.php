<?php
require_once 'database.php';

class UserController {

    //private $countyDB;

    private $dbo;

    public function __construct() {
        $this->dbo = new Database();
    }

    public function processAdminRequest(string $requestMethod) {
        if ($requestMethod == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $repeat_password = $_POST['repeat-password'];
        
            // Check if passwords match
            if ($password !== $repeat_password) {
                //$_SESSION['error'] = "Passwords do not match";
                echo json_encode(['error' => 'Passwords do not match']);
            }
        
            // Check if the email already exists
            $sql = "SELECT id FROM users WHERE email = :email";
            $stmt = $this->dbo->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
        
            if ($stmt->rowCount() > 0) {
                $_SESSION['error'] = "Email already registered";
                echo json_encode(['error' => 'Email already registered']);
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
                // Insert the new user into the database
                $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
                $stmt = $this->dbo->prepare($sql);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':password', $hashed_password);
        
                if ($stmt->execute()) {
                    // Fetch the user ID
                    $user_id = $this->dbo->conn->lastInsertId();
        
                    // Set session variables to log the user in
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['email'] = $email;
        
                    // Redirect to home page after successful registration and login
                    // header("Location: home.php");
                    // exit();
                    echo json_encode(['message' => 'User registered successfully.']);
                } else {
                    $_SESSION['error'] = "Error: Could not execute the query.";
                    echo json_encode(['error' => 'Error: Could not execute the query.']);
                    exit();
                }
            }
        } 
        else if($requestMethod == "GET") {
            $sql = "SELECT * FROM users";
            $stmt = $this->dbo->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($results);
        }
        else if($requestMethod == "PUT") {
            parse_str(file_get_contents("php://input"), $put_vars);
            $id = $put_vars['id'] ?? null;
            $email = $put_vars['email'] ?? null;
            $password = $put_vars['password'] ?? null;
        
            // Validation for email
            if ($email !== null && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['error' => 'Invalid email format']);
                exit();
            }
        
            // Hash the password if it's provided
            $hashed_password = $password ? password_hash($password, PASSWORD_BCRYPT) : null;
        
            // Prepare SQL statement to update data
            // Note: You might want to conditionally build this SQL based on what's provided
            $sql = "UPDATE users SET email = :email, password = :hashed_password WHERE id = :id";
            $stmt = $this->dbo->prepare($sql);
        
            // Bind parameters and execute
            if ($stmt) {
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':hashed_password', $hashed_password); // Corrected parameter binding
        
                if ($stmt->execute()) {
                    echo json_encode(['message' => 'User updated successfully.']);
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
            $sql = "DELETE FROM users WHERE id = :id";
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