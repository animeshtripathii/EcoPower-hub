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
    <title>Cost Estimator - Solar & Wind Energy Availability</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                        <li><a href="location-finder.php"><i class="fas fa-search-location"></i> Location Finder</a></li>
                        <li><a href="cost-estimator.php" class="active"><i class="fas fa-calculator"></i> Cost Estimator</a></li>
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
                <h1><i class="fas fa-calculator"></i> Renewable Energy Cost Estimator</h1>
                <p>Calculate the estimated cost of installing solar panels or wind turbines at your chosen location.</p>
            </div>
        </section>

        <section class="section">
            <div class="cost-container">
                <form id="cost-form" class="form-container">
                    <div class="form-group">
                        <label for="location"><i class="fas fa-map-marker-alt"></i> Location in India</label>
                        <select id="location" name="location" required>
                            <option value="">Select a location</option>
                            <?php
                            // Fetch locations from database
                            $sql = "SELECT id, city, state FROM locations ORDER BY state, city";
                            if($result = mysqli_query($conn, $sql)){
                                while($row = mysqli_fetch_array($result)){
                                    echo '<option value="' . $row['id'] . '">' . $row['city'] . ', ' . $row['state'] . '</option>';
                                }
                                mysqli_free_result($result);
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="energy-type"><i class="fas fa-bolt"></i> Energy Type</label>
                        <select id="energy-type" name="energy-type" required>
                            <option value="">Select energy type</option>
                            <option value="solar">Solar Energy</option>
                            <option value="wind">Wind Energy</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="capacity"><i class="fas fa-tachometer-alt"></i> Capacity (kW)</label>
                        <input type="number" id="capacity" name="capacity" min="1" max="1000" required>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Calculate Cost</button>
                    </div>
                </form>
                <div id="cost-results" class="results-container">
                    <h3>Cost Estimation</h3>
                    <div id="cost-details"></div>
                    <div class="chart-container">
                        <canvas id="roi-chart"></canvas>
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
            <p>&copy; 2023 EcoPower-Hub. All rights reserved.</p>
        </div>
    </footer>

    <script src="js/cost-estimator.js"></script>
    <script src="js/responsive.js"></script>
</body>
</html> 