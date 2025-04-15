<?php
// Start the session
require_once "includes/config.php";

// Check if the user is logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

// Initialize variables
$name = $email = $subject = $message = "";
$success_message = "";
$error_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $subject = htmlspecialchars(trim($_POST["subject"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    // Check required fields
    if (!empty($name) && !empty($email) && !empty($subject) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $to = "tripathianimesh38@gmail.com";
            $email_subject = "New Contact Us Message from $name: $subject";
            $email_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
            $headers = "From: tripathianimesh890@gmail.com\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            if (mail($to, $email_subject, $email_body, $headers)) {
                $success_message = "Your message has been sent successfully! We will get back to you soon.";
                $name = $email = $subject = $message = ""; // Clear fields
            } else {
                $error_message = "Failed to send the message. Please try again later.";
            }
        } else {
            $error_message = "Please enter a valid email address.";
        }
    } else {
        $error_message = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Solar & Wind Energy Availability</title>
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
                <!-- <div class="mobile-menu-toggle">
                    <i class="fas fa-bars"></i>
                </div> -->
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php" class="active">Contact Us</a></li>
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
                <h1><i class="fas fa-envelope"></i> Contact Us</h1>
                <p>Get in touch with our team for any questions or feedback.</p>
            </div>
        </section>

        <section class="section contact-section">
            <div class="container">
                <div class="contact-container" data-aos="fade-up">
                    <div class="contact-info">
                        <h2>Get In Touch</h2>
                        <p>Have questions about renewable energy or need assistance with our tools? Our team is here to help!</p>
                        
                        <div class="contact-details">
                            <div class="contact-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <h3>Address</h3>
                                    <p>Lovely Professional University<br>Phagwara, Punjab 144411<br>India</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <i class="fas fa-phone"></i>
                                <div>
                                    <h3>Phone</h3>
                                    <p>+91 123 456 7890</p>
                                </div>
                            </div>
                            
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <div>
                                    <h3>Email</h3>
                                    <p>info@solarwindenergy.com</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="social-media">
                            <h3>Follow Us</h3>
                            <div class="social-icons">
                                <a href="https://www.facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://www.twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
                                <a href="https://www.linkedin.com" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="contact-form-container">
                        <h2>Send Us A Message</h2>
                        
                        <?php if(!empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="contact-form">
                            <div class="form-group">
                                <label for="name"><i class="fas fa-user"></i> Your Name</label>
                                <input type="text" id="name" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                <span class="invalid-feedback"><?php echo $name_err; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="email"><i class="fas fa-envelope"></i> Your Email</label>
                                <input type="email" id="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="subject"><i class="fas fa-heading"></i> Subject</label>
                                <input type="text" id="subject" name="subject" class="form-control <?php echo (!empty($subject_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $subject; ?>">
                                <span class="invalid-feedback"><?php echo $subject_err; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label for="message"><i class="fas fa-comment"></i> Message</label>
                                <textarea id="message" name="message" rows="5" class="form-control <?php echo (!empty($message_err)) ? 'is-invalid' : ''; ?>"><?php echo $message; ?></textarea>
                                <span class="invalid-feedback"><?php echo $message_err; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="map-container" data-aos="fade-up">
                    <h2>Current Location</h2>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3406.9244035088!2d75.70256577619196!3d31.37659997409354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391a5a5747a9eb91%3A0xc74b34c05aa5b4b8!2sLovely%20Professional%20University!5e0!3m2!1sen!2sin!4v1709908144399!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
            <p>&copy; 2025 EcoPower-Hub. All rights reserved.</p>
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