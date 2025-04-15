<?php
// Include config file
require_once "includes/config.php";

// Check if the user is logged in, if not redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

// Define variables and initialize with empty values
$current_password = $new_password = $confirm_password = "";
$current_password_err = $new_password_err = $confirm_password_err = "";
$success_msg = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate current password
    if(empty(trim($_POST["current_password"]))){
        $current_password_err = "Please enter your current password.";     
    } else{
        $current_password = trim($_POST["current_password"]);
        
        // Check if the current password is correct
        $sql = "SELECT password FROM users WHERE id = ?";
        if($stmt = mysqli_prepare($conn, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["id"]);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(!password_verify($current_password, $hashed_password)){
                            $current_password_err = "The current password you entered is not correct.";
                        }
                    }
                }
            }
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have at least 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($current_password_err) && empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully, set success message
                $success_msg = "Your password has been changed successfully.";
                
                // Clear form values
                $current_password = $new_password = $confirm_password = "";
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
    <title>Change Password - EcoPower-Hub</title>
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
                        <li><a href="change_password.php" class="active"><i class="fas fa-key"></i> Change Password</a></li>
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
                <h1>Change Password</h1>
                <p>Update your account password securely.</p>
            </div>
        </section>

        <section class="password-section">
            <div class="profile-settings-container">
                <div class="form-header">
                    <i class="fas fa-key"></i>
                    <h2>Change Password</h2>
                    <p>Update your account password securely</p>
                </div>
                
                <div class="form-body">
                    <?php if(!empty($success_msg)): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?php echo $success_msg; ?>
                    </div>
                    <?php endif; ?>
                
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="password-form">
                        <div class="form-group">
                            <label for="current_password"><i class="fas fa-lock"></i> Current Password</label>
                            <div class="password-input-group">
                                <input type="password" name="current_password" id="current_password" class="form-control <?php echo (!empty($current_password_err)) ? 'is-invalid' : ''; ?>">
                                <span class="toggle-password" onclick="togglePasswordVisibility('current_password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <?php if(!empty($current_password_err)): ?>
                                <span class="invalid-feedback"><?php echo $current_password_err; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="new_password"><i class="fas fa-lock"></i> New Password</label>
                            <div class="password-input-group">
                                <input type="password" name="new_password" id="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>">
                                <span class="toggle-password" onclick="togglePasswordVisibility('new_password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <?php if(!empty($new_password_err)): ?>
                                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                            <?php else: ?>
                                <small class="form-text">Password must be at least 6 characters long.</small>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="confirm_password"><i class="fas fa-lock"></i> Confirm New Password</label>
                            <div class="password-input-group">
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                                <span class="toggle-password" onclick="togglePasswordVisibility('confirm_password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <?php if(!empty($confirm_password_err)): ?>
                                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-buttons">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                            <a href="index.php" class="btn btn-secondary">Back to Home</a>
                        </div>
                    </form>
                    
                    <div class="password-tips">
                        <h3><i class="fas fa-shield-alt"></i> Password Safety Tips</h3>
                        <ul>
                            <li>Use a mixture of letters, numbers, and special characters</li>
                            <li>Avoid using personal information in your password</li>
                            <li>Don't use the same password for multiple accounts</li>
                            <li>Change your password regularly</li>
                        </ul>
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

    <script src="js/responsive.js"></script>
    <script>
        // Toggle password visibility
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const icon = event.target.closest('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html> 