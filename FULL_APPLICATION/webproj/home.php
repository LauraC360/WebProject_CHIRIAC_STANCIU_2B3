<?php
session_start();
include 'partials/header.php';
?>


<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Home/Home.css">
    <link rel="stylesheet" href="./src/style/Home/HomeHeader.css">
    <link rel="stylesheet" href="./src/style/Home/HomeSection1.css">
    <link rel="stylesheet" href="global.css">

    <title>UNX Romania</title>
</head>

<body>
    <div class="page-home-container">

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
            <h1 class="home-section-title">Explore Unemployment Rates in Romania</h1>
            <div class="home-button-container">
                <button onclick="navigateToUnemployment()" class="filled-button">Get Started</button>
                <button onclick="navigateToUnemployment()" class="empty-button">Learn More</button>
            </div>

            <div class="home-section-1">
                <h2 class="home-box-title">Key Features</h2>
                <div class="box-container">
                    <div class="box">
                        <div class="box-img-container">
                            <img src="./public/cube.png" alt="cube" />
                        </div>
                        <p class="box-text">UnX (Unemployment Explorer) offers users the ability to access a wide range of data types related to unemployment in Romania. This feature ensures that you have the flexibility to work with different datasets, including data segmented by counties, education levels, age groups, environments, and time periods, covering at least the last 12 months.
                        </p>
                    </div>
                    <div class="box">
                        <div class="box-img-container">
                            <img src="./public/cube.png" alt="cube" />
                        </div>
                        <p class="box-text">Users can view data in traditional chart formats such as bar charts, bar graphs, which provide clear and concise representations of the information. Additionally, for those who prefer a geographical perspective, cartographic visualizations are available, offering a map-based view of the unemployment data across different counties.
                        </p>
                    </div>
                    <div class="box">
                        <div class="box-img-container">
                            <img src="./public/cube.png" alt="cube" />
                        </div>
                        <p class="box-text">The visualization options are designed to help users better understand and interpret the data. By presenting information in a visually appealing and easily digestible manner, users can gain deeper insights and make more informed decisions. The intuitive interface allows for seamless switching between different visualization forms, enhancing the overall user experience.
                        </p>
                    </div>
                    <div class="box">
                        <div class="box-img-container">
                            <img src="./public/cube.png" alt="cube" />
                        </div>
                        <p class="box-text">Users can interact with the data directly, zooming in on specific areas, filtering information, and exploring different dimensions of the dataset. This interactivity makes the data exploration process more engaging and dynamic.
                        </p>
                    </div>
                </div>
            </div>

            <h1 class="home-section-title">Insights on Unemployment Data</h1>
            <div class="home-button-container">
                <button onclick="navigateToUnemployment()" class="filled-button">Learn More</button>
            </div>

            <div class="home-section-2">
                <div class="home-box-p">
                    <p class="faq">FAQ</p>
                    <h2 class="home-box-title">Common questions</h2>
                    <p>Here are some of the most common questions that we get.</p>
                </div>
                <div class="row-container">
                    <div class="row">
                        <h2>Which is the source of the statistics of unemployment?</h2>
                        <p class="box-text">The main source for data is this website: https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc. The data is updated monthly and is available for download in various formats. The data is collected by the National Institute of Statistics (INS) and the National Employment Agency (ANOFM).
                        </p>
                    </div>
                    <div class="row">
                        <h2>Which is the source of the statistics of unemployment?</h2>
                        <p class="box-text">The main source for data is this website: https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc. The data is updated monthly and is available for download in various formats. The data is collected by the National Institute of Statistics (INS) and the National Employment Agency (ANOFM).
                        </p>
                    </div>
                    <div class="row">
                        <h2>Which is the source of the statistics of unemployment?</h2>
                        <p class="box-text">The main source for data is this website: https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc. The data is updated monthly and is available for download in various formats. The data is collected by the National Institute of Statistics (INS) and the National Employment Agency (ANOFM).
                        </p>
                    </div>
                    <div class="row">
                        <h2>Which is the source of the statistics of unemployment?</h2>
                        <p class="box-text">The main source for data is this website: https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc. The data is updated monthly and is available for download in various formats. The data is collected by the National Institute of Statistics (INS) and the National Employment Agency (ANOFM).
                        </p>
                    </div>
                    <div class="row">
                        <h2>Which is the source of the statistics of unemployment?</h2>
                        <p class="box-text">The main source for data is this website: https://data.gov.ro/dataset?q=somaj&sort=metadata_modified+desc. The data is updated monthly and is available for download in various formats. The data is collected by the National Institute of Statistics (INS) and the National Employment Agency (ANOFM).
                        </p>
                    </div>
                </div>
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
    <script src="./src/scripts/Home.js"></script>
</body>

</html>