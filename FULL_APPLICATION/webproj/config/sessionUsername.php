<?php
session_start();
if (!isset($_SESSION['username'])) {
    // User is not logged in. Redirect or display a message.
    echo "<script>alert('You must be logged in to access this page.'); window.location.href = 'login.php';</script>";
    exit; // Stop further execution of the script
}
$username = $_SESSION['username']; 
?>