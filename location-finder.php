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
    <title>Location Finder - Solar & Wind Energy Availability</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                        <li><a href="weather-map.php"><i class="fas fa-map-marked-alt"></i> Weather Map</a></li>
                        <li><a href="location-finder.php" class="active"><i class="fas fa-search-location"></i> Location Finder</a></li>
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
                <h1><i class="fas fa-search-location"></i> Find Ideal Locations</h1>
                <p>Enter your preferred weather conditions, and we'll recommend the best locations in India.</p>
            </div>
        </section>

        <section class="section">
            <div class="recommendation-container">
                <form id="recommendation-form" class="form-container">
                    <div class="form-group">
                        <label for="preferred-temperature"><i class="fas fa-temperature-high"></i> Preferred Temperature (°C)</label>
                        <input type="number" id="preferred-temperature" name="preferred-temperature" min="0" max="50" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="preferred-wind-speed"><i class="fas fa-wind"></i> Preferred Wind Speed (m/s)</label>
                        <input type="number" id="preferred-wind-speed" name="preferred-wind-speed" min="0" max="20" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Find Locations</button>
                    </div>
                </form>
                <div id="recommendation-results" class="results-container">
                    <h3>Recommended Locations</h3>
                    <div id="locations-list"></div>
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

    <script src="js/recommendation.js"></script>
    <script src="js/responsive.js"></script>
</body>
</html> 