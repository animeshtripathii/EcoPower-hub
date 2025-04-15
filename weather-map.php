<?php
// Initialize the session
require_once "includes/config.php";

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Map - Solar & Wind Energy Availability</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Leaflet CSS and JS for interactive map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <img src="images/logo.png" alt="Clean Energy Logo">
                <h1>EcoPower-Hub</h1>
                <div class="mobile-menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li class="nav-dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-solar-panel"></i> Features <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="weather-map.php" class="active"><i class="fas fa-map-marked-alt"></i> Weather Map</a></li>
                        <li><a href="location-finder.php"><i class="fas fa-search-location"></i> Location Finder</a></li>
                        <li><a href="cost-estimator.php"><i class="fas fa-calculator"></i> Cost Estimator</a></li>
                    </ul>
                </li>
                <li class="nav-dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-user-circle"></i> Account <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="delete_account.php" class="delete-account-link"><i class="fas fa-user-times"></i> Delete Account</a></li>
                        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
            <div class="user-info">
                <i class="fas fa-user-circle"></i>
                <span>Welcome, <?php echo htmlspecialchars($_SESSION["username"]); ?></span>
            </div>
        </nav>
    </header>

    <main>
        <section class="page-header">
            <div class="page-header-content">
                <h1><i class="fas fa-map-marked-alt"></i> Interactive Weather Map</h1>
                <p>Click on any location in India to view current weather conditions and renewable energy potential.</p>
            </div>
        </section>

        <section class="section">
            <div class="map-container">
                <div id="india-map"></div>
                <div id="weather-info" class="weather-box">
                    <h3>Weather Information</h3>
                    <p>Click on the map to see weather details for that location.</p>
                    <div id="weather-details" style="display: none;">
                        <div class="weather-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span id="location-name">Location</span>
                        </div>
                        <div class="weather-item">
                            <i class="fas fa-temperature-high"></i>
                            <span id="temperature">Temperature: -- °C</span>
                        </div>
                        <div class="weather-item">
                            <i class="fas fa-tint"></i>
                            <span id="humidity">Humidity: -- %</span>
                        </div>
                        <div class="weather-item">
                            <i class="fas fa-wind"></i>
                            <span id="wind-speed">Wind Speed: -- m/s</span>
                        </div>
                        <div class="weather-item">
                            <i class="fas fa-sun"></i>
                            <span id="solar-potential">Solar Potential: --</span>
                        </div>
                        <div class="weather-item">
                            <i class="fas fa-fan"></i>
                            <span id="wind-potential">Wind Potential: --</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section about">
                <h3>About Us</h3>
                <p>We provide comprehensive information about solar and wind energy availability across India to help individuals and businesses make informed decisions about renewable energy investments.</p>
            </div>
            <div class="footer-section links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="weather-map.php">Weather Map</a></li>
                    <li><a href="location-finder.php">Location Finder</a></li>
                    <li><a href="cost-estimator.php">Cost Estimator</a></li>
                </ul>
            </div>
            <div class="footer-section contact">
                <h3>Contact Us</h3>
                <p><i class="fas fa-envelope"></i> info@solarwindenergy.com</p>
                <p><i class="fas fa-phone"></i> +91 123 456 7890</p>
                <div class="social-icons">
                    <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 Solar & Wind Energy Portal. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/map.js"></script>
    <script src="js/responsive.js"></script>
    <script>
        // Check for URL parameters to center map on specific location
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const lat = urlParams.get('lat');
            const lng = urlParams.get('lng');
            
            if (lat && lng) {
                // Center map on the specified coordinates
                map.setView([lat, lng], 10);
                
                // Create a marker at the location
                const marker = L.marker([lat, lng]).addTo(map);
                
                // Fetch and display weather for this location
                fetchWeatherDataByCoordinates(lat, lng);
            }
        });
    </script>
</body>
</html> 