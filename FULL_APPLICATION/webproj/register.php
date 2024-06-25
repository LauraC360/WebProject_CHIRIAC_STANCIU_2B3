<?php
session_start();
require 'config/database.php'; // Ensure this path is correct

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat-password'];

    // Check if passwords match
    if ($password !== $repeat_password) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: register.php");
        exit();
    }

    // Check if the email already exists
    $sql = "SELECT id FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $_SESSION['error'] = "Email already registered";
        header("Location: register.php");
        exit();
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert the new user into the database
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            // Fetch the user ID
            $user_id = $db->conn->lastInsertId();

            // Set session variables to log the user in
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;

            // Redirect to home page after successful registration and login
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['error'] = "Error: Could not execute the query.";
            header("Location: register.php");
            exit();
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Register.css">
    <link rel="stylesheet" href="global.css">
    <title>UNX Romania</title>
</head>

<body>
    <div class="page-container">
        <div class="register-container">
            <div class="register-content-container">
                <h2 class="register-title">Register</h2>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                ?>
                <form action="register.php" method="post" class="input-container">
                    <input class="register-input" type="email" name="email" placeholder="E-mail" required>
                    <input type="password" class="register-input" name="password" placeholder="Password" required>
                    <input type="password" class="register-input" name="repeat-password" placeholder="Repeat password" required>
                    <input type="submit" value="Register" class="register-button">
                </form>
            </div>
        </div>
    </div>
    <script src="./src/scripts/Register.js"></script>
</body>

</html>