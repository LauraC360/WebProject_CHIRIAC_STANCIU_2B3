<?php
session_start();
require 'config/database.php'; // Ensure this path is correct

$db = new Database();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the stored hashed password
    $sql = "SELECT id, password FROM users WHERE email = :email";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $stored_hash = $row['password'];

        // Verify the password
        if (password_verify($password, $stored_hash)) {
            // Password is correct, start a session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $email;

            // Redirect to home page after successful login
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password";
        }
    } else {
        $_SESSION['error'] = "Invalid email or password";
    }

    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Login.css">
    <link rel="stylesheet" href="global.css">
    <title>UNX Romania</title>
</head>

<body>
    <div class="page-container">
        <div class="login-container">
            <div class="login-content-container">
                <h2 class="login-title">Login</h2>
                <?php

                if (isset($_SESSION['error'])) {
                    echo '<div class="error-message">' . $_SESSION['error'] . '</div>';
                    unset($_SESSION['error']);
                }
                ?>
                <form action="login.php" method="post" class="input-container">
                    <input class="login-input" type="email" name="email" placeholder="E-mail" required>
                    <input type="password" class="login-input" name="password" placeholder="Password" required>
                    <input type="submit" value="Log in" class="login-button">
                </form>
                <p class="forgotten-password">Forgotten password</p>
            </div>
        </div>
    </div>
    <script src="./src/scripts/Login.js"></script>
</body>

</html>