<?php
session_start();
include 'partials/header.php';

require 'config/database.php'; // Include the Database class

// Create a new Database instance
$db = new Database();

// Assuming $county is already set to the desired value

// Retrieve the county from the URL parameter and sanitize it
$county = isset($_GET['county']) ? filter_var($_GET['county'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null; // Default to GALATI if not provided

// Prepare SQL query to fetch data from multiple tables
$sql = "
    SELECT 'March 2023' AS period, Rata_somajului FROM march_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'April 2023' AS period, Rata_somajului FROM april_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'May 2023' AS period, Rata_somajului FROM may_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'June 2023' AS period, Rata_somajului FROM june_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'July 2023' AS period, Rata_somajului FROM july_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'August 2023' AS period, Rata_somajului FROM august_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'September 2023' AS period, Rata_somajului FROM september_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'October 2023' AS period, Rata_somajului FROM october_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'November 2023' AS period, Rata_somajului FROM november_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'December 2023' AS period, Rata_somajului FROM december_23 WHERE JUDET = :county
    UNION ALL
    SELECT 'January 2024' AS period, Rata_somajului FROM january_24 WHERE JUDET = :county
    UNION ALL
    SELECT 'February 2024' AS period, Rata_somajului FROM february_24 WHERE JUDET = :county
    UNION ALL
    SELECT 'March 2024' AS period, Rata_somajului FROM march_24 WHERE JUDET = :county
";

$stmt = $db->prepare($sql);
$stmt->bindParam(':county', $county, PDO::PARAM_STR);
$stmt->execute();

// Initialize an array to hold data points
$cityData = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $period = $row['period'];
    $rataSomajului = $row['Rata_somajului'];

    // Append the data point to the array
    $cityData[] = ['period' => $period, 'Rata_somajului' => $rataSomajului];
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Galati_data.css">
    <link rel="stylesheet" href="./src/style/Home/HomeHeader.css">
    <link rel="stylesheet" href="global.css">

    <title>UNX Romania</title>
</head>

<body>
    <div class="page-galati-container">

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
            
            <div class="galati-data-container">
                     
                      <div class="dashboard-container3">
                        <div class="main--content">
                          <div class="header--wrapper">
                              <div class="header--title">
                                  <span> Dashboard </span>
                                  <h2><?php echo strtoupper($county); ?> County </h2>
                              </div>
                              <div class="search--info">
                                  <div class="search--box">
                                      <i class="solid search"></i>
                                      <input id="searchInput" type="text" placeholder="Search"" />
                                  </div>
                              </div>
                          </div>

                        <!-- <div class="download--popup" id="downloadPopup" style="display:none;">
                            <div class="popup-content">Select download format:</div>
                            <button onclick="downloadFile('pdf')">PDF</button>
                            <button onclick="downloadFile('excel')">Excel</button>
                            <button onclick="closePopup()">Cancel</button>
                        </div> -->
              
                          <div class="card-container">
                              <h3 class="main--title"> Unemployment data 2023-2024 1st third </h3>
                              <div class="card-wrapper">
                                  <div class="data--card light-blue">
                                      <div class="card--header">
                                          <div class="amount">
                                              <span class="title">
                                                  Unemployed people
                                              </span>
                                              <?php
                                                $desiredPeriod = 'April 2023'; // The period you want to retrieve data for
                                                $foundData = null; // Variable to store the data once found

                                                // Iterate through the cityData array
                                                foreach ($cityData as $data) {
                                                    if ($data['period'] === $desiredPeriod) {
                                                        $foundData = $data;
                                                        break;
                                                    }
                                                }

                                                if ($foundData == null) {
                                                    $foundData = ['Rata_somajului' => 'Unknown '];
                                                }
                                              ?>  
                                              <span class="amount--value"> <?php echo htmlspecialchars($foundData['Rata_somajului']); ?>% </span>
                                          </div>
                                      </div>
                                      <span class="card-detail"> 2023 Jan - Apr </span>
                                  </div>
              
                                  <div class="data--card light-blue">
                                      <div class="card--header">
                                          <div class="amount">
                                              <span class="title">
                                                  Unemployed people
                                              </span>
                                              <?php
                                                $desiredPeriod = 'August 2023'; // The period you want to retrieve data for
                                                $foundData = null; // Variable to store the data once found

                                                // Iterate through the cityData array
                                                foreach ($cityData as $data) {
                                                    if ($data['period'] === $desiredPeriod) {
                                                        $foundData = $data;
                                                        break;
                                                    }
                                                }

                                                if ($foundData == null) {
                                                    $foundData = ['Rata_somajului' => 'Unknown '];
                                                }
                                              ?>
                                              <span class="amount--value"> <?php echo htmlspecialchars($foundData['Rata_somajului']); ?>% </span>
                                          </div>
                                      </div>
                                      <span class="card-detail"> 2023 Apr - Aug </span>
                                  </div>
              
                                  <div class="data--card light-blue">
                                      <div class="card--header">
                                          <div class="amount">
                                              <span class="title">
                                                  Unemployed people
                                              </span>
                                              <?php
                                                $desiredPeriod = 'December 2023'; // The period you want to retrieve data for
                                                $foundData = null; // Variable to store the data once found

                                                // Iterate through the cityData array
                                                foreach ($cityData as $data) {
                                                    if ($data['period'] === $desiredPeriod) {
                                                        $foundData = $data;
                                                        break;
                                                    }
                                                }

                                                if ($foundData == null) {
                                                    $foundData = ['Rata_somajului' => 'Unknown '];
                                                }
                                              ?>
                                              <span class="amount--value"> <?php echo htmlspecialchars($foundData['Rata_somajului']); ?>% </span>
                                          </div>
                                      </div>
                                      <span class="card-detail"> 2023 Aug - Dec </span>
                                  </div>
              
                                  <div class="data--card light-blue">
                                      <div class="card--header">
                                          <div class="amount">
                                              <span class="title">
                                                  Unemployed people
                                              </span>
                                              <?php
                                                $desiredPeriod = 'March 2024'; // The period you want to retrieve data for
                                                $foundData = null; // Variable to store the data once found

                                                // Iterate through the cityData array
                                                foreach ($cityData as $data) {
                                                    if ($data['period'] === $desiredPeriod) {
                                                        $foundData = $data;
                                                        break;
                                                    }
                                                }

                                                if ($foundData == null) {
                                                    $foundData = ['Rata_somajului' => 'Unknown '];
                                                }
                                              ?>
                                              <span class="amount--value"> <?php echo htmlspecialchars($foundData['Rata_somajului']); ?>% </span>
                                          </div>
                                      </div>
                                      <span class="card-detail"> 2024 Jan - Apr </span>
                                  </div>
                          </div>
                      </div>
              

                      <div class="tabular--wrapper">
                        <h3 class="main--title">Resources</h3>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Formats</th>
                                        <th>Status</th>
                                        <th>View File</th>
                                        <th>Download File</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data rows will be inserted here dynamically -->
                                </tbody>
                            </table>
                        </div>
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
    </div>

    


    <!-- <script src="./src/scripts/Home.js"></script> -->
    
    <script>

    document.addEventListener('DOMContentLoaded', async function() {
        try {
            var county = "<?php echo $county; ?>";
            const response = await fetch('http://localhost/webproj/api/county/resources/' + county);
            const data = await response.json();
            const tableBody = document.querySelector('.table-container table tbody');

            data.forEach(item => {
                const row = document.createElement('tr');
                
                ['date', 'year', 'month', 'formats', 'status'].forEach(key => {
                    const cell = document.createElement('td');
                    cell.textContent = item[key];
                    row.appendChild(cell);
                });

                // Create and append the view button cell
                const viewButtonCell = document.createElement('td');
                const viewButton = document.createElement('button');
                viewButton.className = 'view--button view-link';
                viewButton.setAttribute('data-month', item.month);
                viewButton.setAttribute('data-year', item.year);
                viewButton.textContent = item.viewFile;
                viewButtonCell.appendChild(viewButton);
                row.appendChild(viewButtonCell);

                const downloadButtonCell = document.createElement('td');
                const downloadButton = document.createElement('button');
                downloadButton.className = 'download--button download-link';
                downloadButton.setAttribute('data-month', item.month);
                downloadButton.setAttribute('data-year', item.year);
                downloadButton.textContent = item.downloadFile;
                downloadButtonCell.appendChild(downloadButton);
                row.appendChild(downloadButtonCell);

                // Adăugarea rândului complet în tbody
                tableBody.appendChild(row);
            });

            attachViewButtonListeners();
            attachDownloadButtonListeners();
            filterTable();
        } catch (error) {
            console.error('Error:', error);
        }
    });

    // function constructURL(baseURL, params) {
    //     const url = new URL(baseURL, window.location.origin);
    //     Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
    //     return url;
    // }

    async function attachViewButtonListeners() {
        document.querySelectorAll('.view--button').forEach(button => {
            button.addEventListener('click', async function(event) {
                event.preventDefault(); // Prevent the default action

                const month = this.getAttribute('data-month');
                const year = this.getAttribute('data-year');
                //const county = 'galati';
                var county = "<?php echo $county; ?>";
                //const params = { county: 'galati', month: month, year: year };
                const queryURL = 'http://localhost/webproj/api/county/monthly-stats/' + county + '/' + month + '/' + year;
                
                try {
                    const response = await fetch(queryURL); // Use fetch with GET request

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    // Since you're fetching an HTML file, process the response as text
                    const responseHTML = await response.text();

                    // Now you have the HTML content in responseHTML
                    window.location.href = queryURL; // Redirect to the constructed URL

                } catch (error) {
                    console.error('Fetch error:', error);
                }
            });
        });
    }

    function attachDownloadButtonListeners() {
    document.querySelectorAll('.download--button').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default action
            const month = this.getAttribute('data-month');
            const year = this.getAttribute('data-year');
            showDownloadPopup(this, month, year); // 'this' refers to the clicked button
        });
    });
    }

    function showDownloadPopup(button, month, year) {
        // Remove any existing popup
        var existingPopup = document.getElementById('dynamicDownloadPopup');
        if (existingPopup) {
            existingPopup.remove();
        }

        // Create the popup container
        var popup = document.createElement('div');
        popup.id = 'dynamicDownloadPopup';
        popup.style.position = 'absolute';
        popup.style.background = '#f0f0f0';
        popup.style.border = '1px solid #ccc';
        popup.style.borderRadius = '5px';
        popup.style.padding = '10px';
        popup.style.boxShadow = '0 2px 5px rgba(0,0,0,0.2)';
        popup.style.zIndex = '1000';

        // Position the popup
        var rect = button.getBoundingClientRect();
        var bodyRect = document.body.getBoundingClientRect();
        popup.style.top = (rect.bottom - bodyRect.top) + 'px';
        popup.style.left = rect.left + 'px';

        // Create the option buttons
        var pdfButton = document.createElement('button');
        pdfButton.innerText = 'PDF';

        // Include month and year in the downloadFile call
        pdfButton.onclick = function() { downloadFile('pdf', month, year); };

        var excelButton = document.createElement('button');
        excelButton.innerText = 'CSV';
        // Include month and year in the downloadFile call
        excelButton.onclick = function() { downloadFile('csv', month, year); };

        // Create the cancel button
        var cancelButton = document.createElement('button');
        cancelButton.innerText = 'Cancel';
        cancelButton.onclick = closePopup;

        // Style for all buttons
        var buttonStyle = 'margin: 10px; padding: 5px 10px; background-color: #147487; color: white; border: none; border-radius: 5px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; cursor: pointer;';

        pdfButton.style.cssText = buttonStyle;
        excelButton.style.cssText = buttonStyle;
        cancelButton.style.cssText = buttonStyle;

        // Append buttons to the popup
        popup.appendChild(pdfButton);
        popup.appendChild(excelButton);
        popup.appendChild(cancelButton);

        // Append the popup to the body
        document.body.appendChild(popup);
    }

    async function downloadFile(format, month, year) {
        console.log(`Downloading in format: ${format}, month: ${month}, year: ${year}`);
        
        // Get the county name

        // Construct download URL with query parameters
        //const url = `http://localhost/webproj/api/county/files/${encodeURIComponent(county)}/${encodeURIComponent(month)}/${encodeURIComponent(year)}`;
        //const county = 'galati';
        var county = "<?php echo $county; ?>";
        const url = `http://localhost/webproj/api/county/files/${encodeURIComponent(format)}/${encodeURIComponent(month)}/${encodeURIComponent(year)}/${encodeURIComponent(county)}`;
        try {
            // Use fetch with GET method
            const response = await fetch(url);
            if (!response.ok) throw new Error('Network response was not ok.');

            // Assuming the server responds with the file to download
            // Create a Blob from the response
            const blob = await response.blob();

            // Create a URL for the blob
            const downloadUrl = window.URL.createObjectURL(blob);

            // Create a temporary link element
            const downloadLink = document.createElement('a');
            downloadLink.href = downloadUrl;
            downloadLink.download = `data_${county}_${month}_${year}.${format}`; // Example filename
            // Append the link to the document
            document.body.appendChild(downloadLink);

            // Programmatically click the link to start the download
            downloadLink.click();

            // Remove the link from the document
            document.body.removeChild(downloadLink);

            // Optionally, revoke the blob URL to free up memory
            window.URL.revokeObjectURL(downloadUrl);

            closePopup(); // Close the popup after initiating the download
        } catch (error) {
            console.error('Download failed:', error);
        }
    }

    function closePopup() {
        var popup = document.getElementById('dynamicDownloadPopup');
        if (popup) {
            popup.remove(); // This removes the popup element entirely
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchInput').addEventListener('keyup', filterTable);
    });

    function filterTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const tableBody = document.querySelector('.table-container table tbody');
        const rows = tableBody.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            let visible = false;
            const cells = rows[i].getElementsByTagName('td');
            for (let j = 0; j < cells.length; j++) {
                if (cells[j].textContent.toUpperCase().includes(filter)) {
                    visible = true;
                    break;
                }
            }
            rows[i].style.display = visible ? "" : "none";
        }
    }

    </script>

</body>
</html>