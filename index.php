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
    <title>EcoPower-Hub</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
                <!-- <div class="mobile-menu-toggle">
                    <i class="fas fa-bars"></i>
                </div> -->
            </div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="about.php">About Us</a></li>
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
        <section class="hero-section">
            <div class="hero-content" data-aos="fade-up">
                <h1>Discover Renewable Energy Potential</h1>
                <p>Explore solar and wind energy availability across India and find the perfect location for your renewable energy projects.</p>
                <a href="#features-section" class="btn btn-primary">Explore Features</a>
            </div>
        </section>

        <!-- Features Section with Clickable Boxes -->
        <section id="features-section" class="section">
            <div class="section-header" data-aos="fade-up">
                <h2><i class="fas fa-solar-panel"></i> Our Features</h2>
                <p>Explore our tools to help you make informed decisions about renewable energy.</p>
            </div>
            <div class="features-container" data-aos="fade-up">
                <div class="feature-box" onclick="window.location.href='weather-map.php'">
                    <div class="feature-icon">
                        <img src="images/location-icon.png" alt="Weather Map">
                        </div>
                    <h3>Weather Map</h3>
                    <p>Interactive map showing weather conditions and renewable energy potential across India.</p>
                    <a href="weather-map.php" class="btn btn-primary">Explore</a>
                        </div>
                
                <div class="feature-box" onclick="window.location.href='location-finder.php'">
                    <div class="feature-icon">
                        <img src="images/location-icon.png" alt="Location Finder">
                        </div>
                    <h3>Location Finder</h3>
                    <p>Find ideal locations based on your preferred weather conditions.</p>
                    <a href="location-finder.php" class="btn btn-primary">Find Locations</a>
                        </div>
                
                <div class="feature-box" onclick="window.location.href='cost-estimator.php'">
                    <div class="feature-icon">
                        <img src="images/cost-icon.png" alt="Cost Estimator">
                    </div>
                    <h3>Cost Estimator</h3>
                    <p>Calculate the estimated cost of installing solar panels or wind turbines.</p>
                    <a href="cost-estimator.php" class="btn btn-primary">Calculate</a>
                </div>
            </div>
        </section>

        <!-- Solar Energy Information Section -->
        <section id="solar-section" class="section" data-aos="fade-up">
            <div class="section-header" data-aos="fade-up" data-aos-delay="100">
                <h2><i class="fas fa-sun"></i> Solar Energy</h2>
                <p>Learn about solar energy, its benefits, and applications.</p>
            </div>
            <div class="energy-info-container">
                <div class="energy-info-content" data-aos="fade-right" data-aos-delay="200">
                    <h3>What is Solar Energy?</h3>
                    <p>Solar energy is radiant light and heat from the Sun that is harnessed using a range of technologies such as solar heating, photovoltaics, solar thermal energy, solar architecture, molten salt power plants and artificial photosynthesis.</p>
                    
                    <h3>Benefits of Solar Energy</h3>
                    <ul class="benefits-list">
                        <li><i class="fas fa-check-circle"></i> Renewable and sustainable source of energy</li>
                        <li><i class="fas fa-check-circle"></i> Reduces electricity bills</li>
                        <li><i class="fas fa-check-circle"></i> Low maintenance costs</li>
                        <li><i class="fas fa-check-circle"></i> Diverse applications</li>
                        <li><i class="fas fa-check-circle"></i> Technology development</li>
                        <li><i class="fas fa-check-circle"></i> Environmentally friendly - reduces carbon footprint</li>
                    </ul>
                    
                    <h3>Applications of Solar Energy</h3>
                    <p>Solar energy can be used for various applications including:</p>
                    <ul class="applications-list">
                        <li><i class="fas fa-home"></i> <strong>Residential:</strong> Rooftop solar panels for homes</li>
                        <li><i class="fas fa-industry"></i> <strong>Commercial:</strong> Solar power for businesses</li>
                        <li><i class="fas fa-lightbulb"></i> <strong>Lighting:</strong> Solar-powered street lights</li>
                        <li><i class="fas fa-tint"></i> <strong>Heating:</strong> Solar water heaters</li>
                        <li><i class="fas fa-car-battery"></i> <strong>Transportation:</strong> Solar-powered vehicles</li>
                    </ul>
                    </div>
                <div class="energy-info-images" data-aos="fade-left" data-aos-delay="200">
                    <div class="image-slider">
                        <img src="images/solar/solar_panel_field.jpg" alt="Solar Panel Field">
                        <img src="images/solar/solar_panel_closeup.jpg" alt="Solar Panel Closeup">
                        <img src="images/solar/solar_house.jpg" alt="Solar House">
                        <img src="images/solar/solar_farm.jpg" alt="Solar Farm">
                    </div>
                </div>
            </div>
        </section>

        <!-- Wind Energy Information Section -->
        <section id="wind-section" class="section" data-aos="fade-up">
            <div class="section-header" data-aos="fade-up" data-aos-delay="100">
                <h2><i class="fas fa-wind"></i> Wind Energy</h2>
                <p>Learn about wind energy, its benefits, and applications.</p>
            </div>
            <div class="energy-info-container reverse">
                <div class="energy-info-images" data-aos="fade-right" data-aos-delay="200">
                    <div class="image-slider">
                        <img src="images/wind/wind_turbines.jpg" alt="Wind Turbines">
                        <img src="images/wind/wind_farm.jpg" alt="Wind Farm">
                        <img src="images/wind/wind_turbine_closeup.jpg" alt="Wind Turbine Closeup">
                        
                    </div>
                </div>
                <div class="energy-info-content" data-aos="fade-left" data-aos-delay="200">
                    <h3>What is Wind Energy?</h3>
                    <p>Wind energy is a form of solar energy. Wind energy (or wind power) describes the process by which wind is used to generate electricity. Wind turbines convert the kinetic energy in the wind into mechanical power.</p>
                    
                    <h3>Benefits of Wind Energy</h3>
                    <ul class="benefits-list">
                        <li><i class="fas fa-check-circle"></i> Clean and renewable source of energy</li>
                        <li><i class="fas fa-check-circle"></i> Cost-effective</li>
                        <li><i class="fas fa-check-circle"></i> Creates jobs</li>
                        <li><i class="fas fa-check-circle"></i> Reduces dependence on fossil fuels</li>
                        <li><i class="fas fa-check-circle"></i> Space-efficient - land can be used for multiple purposes</li>
                        <li><i class="fas fa-check-circle"></i> Low operating costs once installed</li>
                    </ul>
                    
                    <h3>Applications of Wind Energy</h3>
                    <p>Wind energy can be used for various applications including:</p>
                    <ul class="applications-list">
                        <li><i class="fas fa-plug"></i> <strong>Electricity Generation:</strong> Wind farms for power grids</li>
                        <li><i class="fas fa-water"></i> <strong>Water Pumping:</strong> Wind-powered water pumps</li>
                        <li><i class="fas fa-ship"></i> <strong>Transportation:</strong> Wind-powered boats and ships</li>
                        <li><i class="fas fa-warehouse"></i> <strong>Off-grid Systems:</strong> Remote locations power</li>
                        <li><i class="fas fa-industry"></i> <strong>Industrial:</strong> Mechanical power for industrial processes</li>
                    </ul>
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

    <script src="js/responsive.js"></script>
    <script>
        // Initialize AOS (Animate On Scroll) with better settings
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: false,
            mirror: true,
            offset: 100
        });
        
        // Image slider functionality
        $(document).ready(function() {
            $('.image-slider img:first-child').addClass('active');
            
            setInterval(function() {
                $('.image-slider').each(function() {
                    let $slider = $(this);
                    let $activeImg = $slider.find('img.active');
                    let $nextImg = $activeImg.next('img').length ? $activeImg.next('img') : $slider.find('img:first');
                    
                    $activeImg.removeClass('active').fadeOut(1000);
                    $nextImg.addClass('active').fadeIn(1000);
                });
            }, 5000);
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Existing index.js functionality
            setTimeout(function() {
                document.querySelector('.hero-content').classList.add('show');
            }, 300);
            
            // Automatic image slider
            const images = document.querySelectorAll('.image-slider img');
            let currentImage = 0;
            
            function changeImage() {
                images.forEach(img => img.classList.remove('active'));
                currentImage = (currentImage + 1) % images.length;
                images[currentImage].classList.add('active');
            }
            
            setInterval(changeImage, 5000);
        });
    </script>
</body>
</html> 