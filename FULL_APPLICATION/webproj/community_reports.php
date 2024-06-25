<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    $_SESSION['warning'] = "You must be logged in to submit a report.";
    header("Location: unemploymentData.php");
    exit();
}

require 'config/database.php';

$db = new Database();

$submission_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $report = $_POST['report'];

    // Debugging output
    error_log("Form data received: email=$email, firstname=$firstname, lastname=$lastname, report=$report");

    // Insert the report into the database
    $sql = "INSERT INTO community_reports (email, first_name, last_name, report_content) VALUES (:email, :firstname, :lastname, :report)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':firstname', $firstname);
    $stmt->bindParam(':lastname', $lastname);
    $stmt->bindParam(':report', $report);

    if ($stmt->execute()) {
        $submission_message = "Your report has been submitted successfully.";
    } else {
        $submission_message = "There was an error submitting your report. Please try again.";
    }
}

$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Community_reports.css">
    <link rel="stylesheet" href="./src/style/Home/HomeHeader.css">
    <link rel="stylesheet" href="global.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css">

    <title>Community Reports - UNX Romania</title>
    <script>
        <?php if ($submission_message) : ?>
            alert('<?php echo $submission_message; ?>');
        <?php endif; ?>
    </script>
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
            <h2> Community Reports Form </h2>
            <div class="main-container">
                <div class="data">
                    <!-- <div class="head">
                            
                    </div> -->
                    <div class="form-container">
                    <!-- <form action="submit_report.php" method="post"> -->
                    <form id="reportForm">
                        <!-- <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required>
                        </div> -->
                        <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
                        </div>
                        <div class="form-group">
                            <label for="firstname">First Name:</label>
                            <input type="text" id="firstname" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Last Name:</label>
                            <input type="text" id="lastname" name="lastname">
                        </div>
                        <div class="form-group">
                            <label for="report">Report Content:</label>
                            <textarea id="report" name="report" rows="5" required></textarea>
                        </div>
                        <button class="submit--report" type="submit">Submit Report</button>
                    </form>
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
    <script>

    document.getElementById('reportForm').addEventListener('submit', async function(e) {
        e.preventDefault(); // Prevent the default form submission

        const formData = new FormData(this);
        
        const formBody = new URLSearchParams();
        for (const [key, value] of formData) {
            formBody.append(key, value);
        }

        try {
            const response = await fetch('http://localhost/webproj/api/community-reports/new', {
                method: 'POST',
                body: formBody,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            const result = await response.json();
            console.log(result);

            // Clear the form if the submission was successful
            this.reset();

            // Display a pop-up message to the user based on the response
            alert(result.message || 'Your report has been sent successfully. Thank you for your contribution!');

        } catch (error) {
            console.error('Error:', error);
            alert('There was an error submitting your report. Please try again.');
        }
    });


    </script>

</body>

</html>