<?php
session_start();
include 'partials/header.php';

require 'config/database.php'; // Include the Database class

// Create a new Database instance
$db = new Database();

// Use the $db instance to access the database
$stmt = $db->prepare("SELECT category, value FROM timetracker_data ORDER BY id ASC");
$stmt->execute();

$euData = [];
$romaniaData = [];
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if ($row['category'] == 'EU') {
        $euData[] = $row['value'];
    } elseif ($row['category'] == 'Romania') {
        $romaniaData[] = $row['value'];
    }
}

// Now $euData and $romaniaData contain the respective values for each category
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Time_tracker.css">
    <link rel="stylesheet" href="./src/style/Home/HomeHeader.css">
    <link rel="stylesheet" href="global.css">
    
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">

    <title>Time Tracker - UNX Romania</title>
</head>

<body>
    <div class="page-map-container">

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
            <!-- <h2> Unemployment in Romania 1999 - 2023 </h2> -->
            <h2> Unemployment in ROMANIA <br>
            compared to EU average rate</h2>
            <div class="main-container">
                <div class="data">
                    <div class="head">
                            <h3>Time Report</h3>
                        <div class="chart">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button-more">
                <!-- <button class="login-button" onclick="navigateToAllData()">More Timestamped Data</button> -->
                <button class="filled-button" onclick="navigateToAllData()"> More Timestamped Data </button>
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

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <!-- <script src="./src/scripts/Time_tracker.js"></script> -->
    
    <script>
        var euData = <?php echo json_encode($euData); ?>;
        var romaniaData = <?php echo json_encode($romaniaData); ?>;

        var options = {
            series: [{
            name: 'EU Unemployment Rate',
            data: euData
        }, {
            name: 'Romania Unemployment Rate',
            data: romaniaData
        }],
            chart: {
            height: 350,
            type: 'area'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            type: 'category',
            categories: [
            "April 2023", "May 2023", "June 2023", "July 2023", "August 2023", "September 2023", "October 2023",
            "November 2023", "December 2023", 
            "January 2024", "February 2024", "March 2024", "April 2024"
            ]
        },
        tooltip: {
            x: {
            format: 'MMMM yyyy' // Changed format to display full month name and year
            },
        },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>

    <script>
        function navigateToAllData() {
            window.location.href = 'all_data.php';
        }
    </script>

    <script src="./src/scripts/Home.js"></script>
</body>

</html>