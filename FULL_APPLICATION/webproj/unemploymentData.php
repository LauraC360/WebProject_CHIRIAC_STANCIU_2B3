<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/UnemploymentData.css">
    <link rel="stylesheet" href="./src/style/Home/HomeHeader.css">
    <link rel="stylesheet" href="global.css">

    <title>UNX Romania</title>
</head>

<body>
    <?php if (isset($_SESSION['warning'])) : ?>
        <script>
            alert('<?php echo htmlspecialchars($_SESSION['warning']); ?>');
        </script>
        <?php unset($_SESSION['warning']); ?>
    <?php endif; ?>

    <div class="page-unemploy-container">

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
            <div class="grid-unemploy">
                <a href="gender_reports.php" class="grid-element" id="gender-reports">Gender Reports</a>
                <a href="all_data.php" class="grid-element" id="all-collected-data">All Collected Data</a>
                <!-- <a href="https://forms.gle/boj1p6ZdnimhVg3V6" class="grid-element" id="community-reports">Community Reports</a> -->
                <a href="community_reports.php" class="grid-element" id="community-reports">Community Reports</a>
                <a href="time_tracker.php" class="grid-element" id="time-tracker">Time Tracker</a>
                <a href="map.php" class="grid-element" id="map">A map of Unemployment</a>
                <a href="age_reports.php" class="grid-element" id="age-reports">Age reports</a>
            </div>

            <div class="footer">
                <div class="rights">
                    <p class="right-text">© 2024 UNX Romania, All Rights Reserved.</p>
                    <div class="icon-container">
                        <img class="icon" src="public/twitter.png" alt="Twitter" />
                        <img class="icon" src="public/instagram.png" alt="Instagram" />
                        <img class="icon" src="public/facebook.png" alt="Facebook" />
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

    <script src="./src/scripts/UnemploymentData.js"></script>
    <script src="./src/scripts/Home.js"></script>
</body>

</html>