<?php
session_start();
include 'partials/header.php';
require 'config/database.php'; // Include the Database class

// Create a new Database instance
$db = new Database();

$stmt = $db->prepare("SELECT city_name, data_point FROM city_chart ORDER BY id ASC");
$stmt->execute();

$county = 'galati';

// Initialize an array to hold data points for each city
$cityData = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $cityName = $row['city_name'];
    $dataPoint = $row['data_point'];

    if (!array_key_exists($cityName, $cityData)) {
        $cityData[$cityName] = [];
    }

    // Append the data point to the appropriate city's array
    $cityData[$cityName][] = $dataPoint;
}


// Extract specific city data into separate arrays if needed
$IasiData = $cityData['IASI'] ?? [];
$ClujData = $cityData['CLUJ'] ?? [];
$BucurestiData = $cityData['BUCURESTI'] ?? [];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./src/style/Galati_data.css">
    <link rel="stylesheet" href="./src/style/Home/HomeHeader.css">
    <link rel="stylesheet" href="global.css">

    <title>All Data - UNX Romania</title>
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
                                  <h2> All Data 2023-2024 </h2>
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

                              <div class="chart-container">
                              
                                <div class="chart">
                                <div id="chart"></div>
                                </div>
                    
                              </div>

                                  <!-- <div class="data--card light-blue">
                                      <div class="card--header">
                                          <div class="amount">
                                              <span class="title">
                                                  Unemployed people
                                              </span>
                                              <span class="amount--value"> 10.1% </span>
                                          </div>
                                      </div>
                                      <span class="card-detail"> 2023 Jan - Apr </span>
                                  </div> -->
              
                                  <!-- <div class="data--card light-blue">
                                      <div class="card--header">
                                          <div class="amount">
                                              <span class="title">
                                                  Unemployed people
                                              </span>
                                              <span class="amount--value"> 5.7% </span>
                                          </div>
                                      </div>
                                      <span class="card-detail"> 2023 Apr - Aug </span>
                                  </div> -->
              
                                  <!-- <div class="data--card light-blue">
                                      <div class="card--header">
                                          <div class="amount">
                                              <span class="title">
                                                  Unemployed people
                                              </span>
                                              <span class="amount--value"> 6.9% </span>
                                          </div>
                                      </div>
                                      <span class="card-detail"> 2023 Aug - Dec </span>
                                  </div> -->
              
                                  <!-- <div class="data--card light-blue">
                                      <div class="card--header">
                                          <div class="amount">
                                              <span class="title">
                                                  Unemployed people
                                              </span>
                                              <span class="amount--value"> 8.3% </span>
                                          </div>
                                      </div>
                                      <span class="card-detail"> 2024 Jan - Apr </span>
                                  </div> -->

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
                                        <!-- <th>Status</th> -->
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

    


    <script src="./src/scripts/Home.js"></script>
    
    <!-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('config/fetchdata_galatiData.php')
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('.table-container table tbody');
            data.forEach(item => {
                const row = `<tr>
                    <td>${item.date}</td> 
                    <td>${item.year}</td>
                    <td>${item.month}</td>
                    <td>${item.formats}</td>
                    <td>${item.status}</td>
                    <td><a href="#" class="view--button view-link">${item.viewFile}</a></td>
                    <td><a href="#" class="download--button download-link">${item.downloadFile}</a></td>
                </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error:', error));
    });
    </script> -->
    
    <script>

    document.addEventListener('DOMContentLoaded', async function() {
    try {
        // Directly using the URL without appending additional parameters
        //const county = 'galati';

        const response = await fetch('http://localhost/webproj/api/county/resources/');
        const data = await response.json();
        const tableBody = document.querySelector('.table-container table tbody');
        data.forEach(item => {
            const row = `<tr>
                <td>${item.date}</td> 
                <td>${item.year}</td>
                <td>${item.month}</td>
                <td>${item.formats}</td>
                <td><button class="view--button view-link" data-month="${item.month}" data-year="${item.year}">${item.viewFile}</button></td>
                <td><button class="download--button download-link" data-month="${item.month}" data-year="${item.year}">${item.downloadFile}</button></td>
            </tr>`;
            tableBody.innerHTML += row;
        });
        attachViewButtonListeners();
        attachDownloadButtonListeners();
        filterTable();
    } catch (error) {
        console.error('Error:', error);
    }   
    });

    function constructURL(baseURL, params) {
        const url = new URL(baseURL, window.location.origin);
        Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
        return url;
    }

    async function attachViewButtonListeners() {
        document.querySelectorAll('.view--button').forEach(button => {
            button.addEventListener('click', async function(event) {
                event.preventDefault(); // Prevent the default action

                const month = this.getAttribute('data-month');
                const year = this.getAttribute('data-year');
                const params = { month: month, year: year };
                const queryURL = 'http://localhost/webproj/api/county/all/monthly-stats/' + month + '/' + year;
                
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
        //const county = 'galati';

        // Construct download URL with query parameters
        //http://localhost/webproj/api/county/all/files/pdf/March/2024
        const url = `http://localhost/webproj/api/county/all/files/${encodeURIComponent(format)}/${encodeURIComponent(month)}/${encodeURIComponent(year)}`;
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
            downloadLink.download = `data_${month}_${year}.${format}`; // Example filename
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

    // function downloadFile(format, month, year) {
    //     console.log(`Downloading in format: ${format}, month: ${month}, year: ${year}`);
        
    //     // Get the county name
    //     const county = 'galati';

    //     // Construct download link
    //     const url = `http://localhost/webproj/config/fetchdata_CountyDownloadData.php?format=${encodeURIComponent(format)}&month=${encodeURIComponent(month)}&year=${encodeURIComponent(year)}&county=${encodeURIComponent(county)}`;

    //      // Create a temporary link element
    //     const downloadLink = document.createElement('a');
    //     downloadLink.href = url;

    //     // Append the link to the document
    //     document.body.appendChild(downloadLink);

    //     // Programmatically click the link to start the download
    //     downloadLink.click();

    //     // Remove the link from the document
    //     document.body.removeChild(downloadLink);

    //     closePopup(); // Close the popup after initiating the download
    // }

    function closePopup() {
        var popup = document.getElementById('dynamicDownloadPopup');
        if (popup) {
            popup.remove(); // This removes the popup element entirely
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('searchInput').addEventListener('keyup', filterTable);
    });

    // function filterTable() {
    //     const input = document.getElementById('searchInput');
    //     const filter = input.value.toUpperCase();
    //     const tableBody = document.querySelector('.table-container table tbody'); // Adjust this selector to match your HTML structure
    //     const rows = tableBody.getElementsByTagName('tr');

    //     for (let i = 0; i < rows.length; i++) {
    //         let visible = false;
    //         // Assuming the text to search is in td elements
    //         const cells = rows[i].getElementsByTagName('td');
    //         for (let j = 0; j < cells.length; j++) {
    //             if (cells[j].textContent.toUpperCase().indexOf(filter) > -1) {
    //                 visible = true;
    //                 break;
    //             }
    //         }
    //         rows[i].style.display = visible ? "" : "none";
    //     }
    // }

    // Search Bar Functionality

    // function searchData() {
    //     var input = document.getElementById('searchInput').value;
    //     var xhttp = new XMLHttpRequest();
    //     xhttp.onreadystatechange = function() {
    //         if (this.readyState == 4 && this.status == 200) {
    //             // Assuming you have a div to display the results
    //             document.getElementById('searchResults').innerHTML = this.responseText;
    //         }
    //     };
    //     xhttp.open("GET", "searchResources.php?q=" + input, true);
    //     xhttp.send();
    // }

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
        
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Convert PHP arrays to JavaScript arrays
        var IasiData = <?php echo json_encode($IasiData); ?>;
        var ClujData = <?php echo json_encode($ClujData); ?>;
        var BucurestiData = <?php echo json_encode($BucurestiData); ?>;

        var options = {
          series: [{
          name: 'Iasi',
          data: IasiData
        }, {
          name: 'Cluj',
          data: ClujData
        }, {
          name: 'Bucuresti',
          data: BucurestiData
        }],
          chart: {
          type: 'bar',
          height: 250,
          width: '99%',
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb', 'Mar'],
        },
        yaxis: {
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "% " + val + " unemployed"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>    

</body>
</html>