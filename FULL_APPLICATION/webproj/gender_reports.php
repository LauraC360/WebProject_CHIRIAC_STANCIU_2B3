<?php
session_start();
include 'partials/header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Gender_reports.css">
    <link rel="stylesheet" href="./src/style/Home/HomeHeader.css">
    <link rel="stylesheet" href="global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Gender Reports - UNX Romania</title>
</head>

<body>
    <div class="page-gender-container">

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
            <div class="container">
                <div class="box card"> 
                    <div class="color">
                        <div class="circle">
                           <h1><i class="fas fa-female"></i></h1>
                        </div>
                    </div>
                    <div class="content">
                        <img src="public/female_worker.png" alt="Female worker" data-source="https://e7.pngegg.com/pngimages/122/436/png-clipart-woman-in-front-of-laptop-computer-illustration-cartoon-icon-ppt-cartoon-characters-infographic-cartoon-character.png">
                        <h4 class="effect-1"> WOMEN </h4>
                        <p>  Unemployment rate for females was 5.10% in December of 2023, according to the EUROSTAT. FTE rate remained stable for women (approx 43%).</p>
                    </div>
                </div>

                <div class="box2 card"> 
                    <div class="color2">
                        <div class="circle shadow">
                            <h1><i class="fas fa-male"></i></h1>
                        </div>
                    </div>
                    <div class="content">
                        <img src="public/male_worker.png" alt="Female worker" data-source="https://e7.pngegg.com/pngimages/469/111/png-clipart-man-working-in-front-of-computer-cartoon-computer-businessperson-work-file-furniture-company.png">
                        <h4 class="effect-2"> MEN </h4>
                        <p>  Unemployment rate for males was 5.90% in December of 2023, according to the EUROSTAT. FTE rate increased for men (from 56 % to 60 %).</p>
                    </div>
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

    <script src="./src/scripts/Home.js"></script>
</body>

</html>