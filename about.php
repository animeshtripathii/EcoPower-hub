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
    <title>About Us - Solar & Wind Energy Availability</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
                <li><a href="about.php" class="active">About Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li class="nav-dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-solar-panel"></i> Features <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="weather-map.php"><i class="fas fa-map-marked-alt"></i> Weather Map</a></li>
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
                <h1><i class="fas fa-info-circle"></i> About Us</h1>
                <p>Learn more about our mission and vision for renewable energy in India.</p>
            </div>
        </section>

        <section class="section about-section">
            <div class="container">
                <div class="about-content" data-aos="fade-up">
                    <h2>Our Mission</h2>
                    <p>At Solar & Wind Energy Portal, our mission is to accelerate the adoption of renewable energy across India by providing accurate, accessible information about solar and wind energy potential in different regions.</p>
                    
                    <h2>Our Vision</h2>
                    <p>We envision a future where renewable energy is the primary source of power in India, reducing carbon emissions, creating sustainable jobs, and ensuring energy security for generations to come.</p>
                    
                    <h2>What We Do</h2>
                    <div class="about-features">
                        <div class="about-feature-item" data-aos="fade-up" data-aos-delay="100">
                            <i class="fas fa-map-marked-alt"></i>
                            <h3>Interactive Weather Map</h3>
                            <p>Our interactive map provides real-time weather data and renewable energy potential for locations across India, helping users identify optimal sites for solar and wind installations.</p>
                        </div>
                        
                        <div class="about-feature-item" data-aos="fade-up" data-aos-delay="200">
                            <i class="fas fa-search-location"></i>
                            <h3>Location Finder</h3>
                            <p>Our advanced algorithm matches your preferred weather conditions with locations across India, helping you find the perfect spot for your renewable energy project.</p>
                        </div>
                        
                        <div class="about-feature-item" data-aos="fade-up" data-aos-delay="300">
                            <i class="fas fa-calculator"></i>
                            <h3>Cost Estimator</h3>
                            <p>Our cost estimation tool helps you understand the financial aspects of installing solar panels or wind turbines, including initial investment, payback period, and long-term savings.</p>
                        </div>
                    </div>
                    
                    <h2>Our Team</h2>
                    <p>We are a dedicated team of students committed to making renewable energy information accessible to everyone in India.</p>
                    
                    <div class="team-members" data-aos="fade-up">
                        <div class="team-member">
                            <img src="images/animeshh.jpg" alt="Animesh Tripathi" class="animesh-image">
                            <h3>Animesh Tripathi</h3>
                            <p>Student</p>
                        </div>
                        <div class="team-member">
                            <img src="images/vipul.jpeg" alt="Vipul Raj" class="vipul-image">
                            <h3>Vipul Raj</h3>
                            <p>Student</p>
                        </div>
                        <div class="team-member">
                            <img src="images/bhanu.jpg" alt="Team Member" class="bhanu-image">
                            <h3>Bhanu Pratap</h3>
                            <p>Student</p>
                        </div>
                        <div class="team-member">
                            <img src="images/abhishek.jpg" alt="Abhishek Rangi" class="abhishek-image">
                            <h3>Abhishek Rangi</h3>
                            <p>Student</p>
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
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
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
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    <script src="js/responsive.js"></script>
</body>
</html> 