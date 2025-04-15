<?php
// Include config file
require_once "includes/config.php";

// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$password = "";
$password_err = "";
$delete_confirm_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Check if confirmation checkbox is checked
    if(!isset($_POST["confirm_delete"]) || $_POST["confirm_delete"] != "on"){
        $delete_confirm_err = "You must confirm that you want to delete your account.";
    }
    
    // Validate credentials
    if(empty($password_err) && empty($delete_confirm_err)){
        // Prepare a select statement
        $sql = "SELECT id, password FROM users WHERE id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, proceed with account deletion
                            
                            // Delete user preferences
                            $sql_delete_prefs = "DELETE FROM user_preferences WHERE user_id = ?";
                            if($stmt_prefs = mysqli_prepare($conn, $sql_delete_prefs)){
                                mysqli_stmt_bind_param($stmt_prefs, "i", $param_id);
                                mysqli_stmt_execute($stmt_prefs);
                                mysqli_stmt_close($stmt_prefs);
                            }
                            
                            // Delete user account
                            $sql_delete_user = "DELETE FROM users WHERE id = ?";
                            if($stmt_user = mysqli_prepare($conn, $sql_delete_user)){
                                mysqli_stmt_bind_param($stmt_user, "i", $param_id);
                                
                                if(mysqli_stmt_execute($stmt_user)){
                                    // Account deleted successfully, destroy the session and redirect to login page
                                    session_destroy();
                                    header("location: login.php");
                                    exit();
                                } else{
                                    echo "Oops! Something went wrong. Please try again later.";
                                }
                                
                                mysqli_stmt_close($stmt_user);
                            }
                        } else{
                            // Password is not valid
                            $password_err = "The password you entered is not valid.";
                        }
                    }
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account - EcoPower-Hub</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
                        <li><a href="cost-estimator.php"><i class="fas fa-calculator"></i> Cost Estimator</a></li>
                    </ul>
                </li>
                <li class="nav-dropdown">
                    <a href="#" class="dropdown-toggle">
                        <i class="fas fa-user-circle"></i> Account <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="delete_account.php" class="active"><i class="fas fa-user-times"></i> Delete Account</a></li>
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
                <h1>Delete Account</h1>
                <p>We're sorry to see you go. Please confirm your account deletion below.</p>
            </div>
        </section>

        <section class="delete-account-section">
            <div class="delete-account-container">
                <h2><i class="fas fa-exclamation-triangle"></i> Delete Your Account</h2>
                
                <div class="warning-box">
                    <h3><i class="fas fa-exclamation-circle"></i> Warning</h3>
                    <p>This action cannot be undone. Once you delete your account, all of your data will be permanently removed from our system.</p>
                    <p>This includes your profile information, preferences, and any other data associated with your account.</p>
                </div>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="delete-account-form">
                    <div class="form-group">
                        <label for="password">Enter your password to confirm</label>
                        <input type="password" name="password" id="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <label class="checkbox-container">
                            <input type="checkbox" name="confirm_delete" <?php echo (!empty($delete_confirm_err)) ? 'class="is-invalid"' : ''; ?>>
                            <span class="checkmark"></span>
                            I understand that this action cannot be undone
                        </label>
                        <span class="invalid-feedback"><?php echo $delete_confirm_err; ?></span>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger">Delete My Account</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>We provide comprehensive information and tools for solar and wind energy solutions across India.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p><i class="fas fa-map-marker-alt"></i> Lovely Professional University, Phagwara, Punjab 144411, India</p>
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
        // Add event listeners for form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.delete-account-form');
            const passwordInput = document.getElementById('password');
            const confirmCheckbox = document.querySelector('input[name="confirm_delete"]');
            
            form.addEventListener('submit', function(event) {
                let isValid = true;
                
                // Validate password
                if (passwordInput.value.trim() === '') {
                    showError(passwordInput, 'Please enter your password.');
                    isValid = false;
                } else {
                    clearError(passwordInput);
                }
                
                // Validate checkbox
                if (!confirmCheckbox.checked) {
                    showError(confirmCheckbox, 'You must confirm that you want to delete your account.');
                    isValid = false;
                } else {
                    clearError(confirmCheckbox);
                }
                
                if (!isValid) {
                    event.preventDefault();
                }
            });
            
            function showError(input, message) {
                const formGroup = input.closest('.form-group');
                const errorElement = formGroup.querySelector('.invalid-feedback') || document.createElement('span');
                
                if (!formGroup.querySelector('.invalid-feedback')) {
                    errorElement.className = 'invalid-feedback';
                    formGroup.appendChild(errorElement);
                }
                
                errorElement.textContent = message;
                input.classList.add('is-invalid');
            }
            
            function clearError(input) {
                const formGroup = input.closest('.form-group');
                const errorElement = formGroup.querySelector('.invalid-feedback');
                
                if (errorElement) {
                    errorElement.textContent = '';
                }
                
                input.classList.remove('is-invalid');
            }
        });
    </script>
    <script src="js/responsive.js"></script>
</body>
</html> 