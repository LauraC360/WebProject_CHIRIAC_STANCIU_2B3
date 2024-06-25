<?php
session_start();
include 'partials/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Contact.css">
    <link rel="stylesheet" href="./src/style/Home/HomeHeader.css">
    <link rel="stylesheet" href="global.css">

    <title>UNX Romania</title>
</head>

<body>
    <div class="page-contact-container">

        <div class="home-header">
            <h2 class="header-title">UNX ROMANIA</h2>
            <nav class="nav-bar">
                <a class="nav-button" href="home.php">Home</a>
                <a class="nav-button" href="unemploymentData.php">Unemployment Data</a>
                <a class="nav-button" href="about.php">About</a>
                <a class="nav-button" href="contact.php">Contact</a>
            </nav>
            <div class="account-info-container">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <form action="config/logout.php" method="post">
                        <button class="login-button" type="submit">Logout</button>
                    </form>
                <?php else : ?>
                    <button class="login-button" onclick="navigateToLogin()">Login</button>
                    <button class="register-button" onclick="navigateToRegister()">Register</button>
                <?php endif; ?>
            </div>
        </div>

        <div class="content-container">
            <h2>CONTACT US</h2>
            <div class="details-container">
                <h3>Details</h3>
                <div class="contact-details">
                    <h4>Stanciu Sebastian</h4>
                    <div class="contact-container">
                        <p>E-mail:</p>
                        <a href="mailto:sebastian.stanciu.20@gmail.com" class="email">sebastian.stanciu.20@gmail.com</a>
                    </div>
                    <div class="contact-container">
                        <p>Phone:</p>
                        <a class="email">+40 741 618 012</a>
                    </div>
                    <h4>Chiriac Laura</h4>
                    <div class="contact-container">
                        <p>E-mail:</p>
                        <a href="mailto:laurachiriac.cl@gmail.com" class="email">laurachiriac.cl@gmail.com</a>
                    </div>
                    <div class="contact-container">
                        <p>Phone:</p>
                        <a class="email">+40 748 191 200</a>
                    </div>
                </div>
            </div>

            <div class="footer">
                <div class="rights">
                    <p class="right-text">© 2024 UNX Romania, All Rights Reserved.</p>
                    <div class="icon-container">
                        <img class="icon" src="public/twitter.png" alt="Twitter"/>
                        <img class="icon" src="public/instagram.png" alt="Instagram"/>
                        <img class="icon" src="public/facebook.png" alt="Facebook"/>
                    </div>
                </div>
                <div class="link-container">
                    <div class="column-container">
                        <p>Product</p>
                        <a href="">Features</a>
                        <a href="">Pricing</a>
                        <a href="">Tutorials</a>
                        <a href="">Releases</a>
                    </div>
                    <div class="column-container">
                        <p>Company</p>
                        <a href="">About</a>
                        <a href="">Careers</a>
                        <a href="">Contact</a>
                        <a href="">Blog</a>
                    </div>
                    <div class="column-container">
                        <p>Support</p>
                        <a href="">Terms of service</a>
                        <a href="">Privacy Policy</a>
                        <a href="">Legal</a>
                        <a href="">Help center</a>
                    </div>
                    <div class="column-container">
                        <p>Resources</p>
                        <a href="">Blog</a>
                        <a href="">Pricing</a>
                        <a href="">Service</a>
                        <a href="">Product</a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="./src/scripts/Home.js"></script>
</body>

</html>