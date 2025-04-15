<?php
// Include config file
require_once "includes/config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = $login_err = "";

// Processing login form data when form is submitted
if(isset($_POST["login"])){
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Session is already started in config.php, no need to start it again
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}

// Processing registration form data when form is submitted
if(isset($_POST["register"])){
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(strlen(trim($_POST["username"])) < 8){
        $username_err = "Username must have at least 8 characters.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                    // Set a flag to indicate we should redirect to login
                    $_SESSION['existing_user'] = true;
                    $_SESSION['error_message'] = "This username is already registered. Please login instead.";
                    // Redirect to login page
                    header("location: login.php");
                    exit;
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)){
        $email_err = "Please enter a valid email address.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already registered.";
                    // Set a flag to indicate we should redirect to login
                    $_SESSION['existing_user'] = true;
                    $_SESSION['error_message'] = "This email is already registered. Please login instead.";
                    // Redirect to login page
                    header("location: login.php");
                    exit;
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Registration successful - set a success message
                $_SESSION['registration_success'] = true;
                $_SESSION['registered_username'] = $username;
                $_SESSION['success_message'] = "Account created successfully! Please login with your credentials.";
                
                // Redirect to login page after successful signup
                header("location: login.php");
                exit;
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}

// Check if user is already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Determine which form to show initially
$register_mode = false;
if(isset($_GET["action"]) && $_GET["action"] === "register") {
    $register_mode = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solar & Wind Energy - Authentication</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/auth.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="auth-container <?php echo $register_mode ? 'register-mode' : ''; ?>">
        <div class="forms-container">
            <!-- Login Form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form login-form">
                <h2 class="form-title">Login</h2>
                
                <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> ' . $login_err . '</div>';
                }
                
                // Display message if redirected from registration due to existing user
                if(isset($_SESSION['existing_user']) && $_SESSION['existing_user'] === true){
                    echo '<div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> ' . $_SESSION['error_message'] . '</div>';
                    // Clear the session variables
                    unset($_SESSION['existing_user']);
                    unset($_SESSION['error_message']);
                }
                
                // Display success message after registration
                if(isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true){
                    echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> ' . $_SESSION['success_message'] . '</div>';
                    // Pre-fill the username field with the registered username
                    $username = $_SESSION['registered_username'];
                    // Clear the session variables
                    unset($_SESSION['registration_success']);
                    unset($_SESSION['registered_username']);
                    unset($_SESSION['success_message']);
                }
                
                if(isset($_GET["account_deleted"]) && $_GET["account_deleted"] === "true"){
                    echo '<div class="alert alert-success"><i class="fas fa-check-circle"></i> Your account has been successfully deleted.</div>';
                }
                ?>

                <div class="input-field">
                    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                    <i class="fas fa-user"></i>
                    <?php if(!empty($username_err) && isset($_POST["login"])): ?>
                        <div class="form-text error"><i class="fas fa-exclamation-circle"></i> <?php echo $username_err; ?></div>
                    <?php endif; ?>
                </div>
                
                <div class="input-field">
                    <input type="password" name="password" id="login-password" placeholder="Password" required>
                    <i class="fas fa-lock"></i>
                    <span class="toggle-password" onclick="togglePasswordVisibility('login-password')">
                        <i class="fas fa-eye"></i>
                    </span>
                    <?php if(!empty($password_err) && isset($_POST["login"])): ?>
                        <div class="form-text error"><i class="fas fa-exclamation-circle"></i> <?php echo $password_err; ?></div>
                    <?php endif; ?>
                </div>
                
                <button type="submit" name="login" class="btn">LOGIN</button>
                
                <div class="social-login">
                    <a href="https://www.facebook.com/" target="_blank" class="social-icon facebook" title="Login with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://accounts.google.com/" target="_blank" class="social-icon google" title="Login with Google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="https://twitter.com/i/flow/login" target="_blank" class="social-icon twitter" title="Login with Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/login" target="_blank" class="social-icon linkedin" title="Login with LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                
                <div class="toggle-container">
                    <p>Don't have an account? <span class="toggle-link" id="register-toggle">Sign up</span></p>
                </div>
            </form>
            
            <!-- Register Form -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form register-form">
                <h2 class="form-title">Create Account</h2>
                
                <div class="back-to-login">
                    <a href="#" class="back-link" id="back-to-login-link"><i class="fas fa-arrow-left"></i> Back to Login</a>
                </div>
                
                <?php 
                if(isset($_POST["register"]) && (!empty($username_err) || !empty($email_err))):
                    if(!empty($username_err) && strpos($username_err, "already taken") !== false): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> This username is already registered. <a href="#" class="toggle-link" id="login-link">Login here</a> instead.
                        </div>
                    <?php elseif(!empty($email_err) && strpos($email_err, "already registered") !== false): ?>
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i> This email is already registered. <a href="#" class="toggle-link" id="login-link">Login here</a> instead.
                        </div>
                    <?php endif;
                endif; ?>
                
                <div class="input-field">
                    <input type="text" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
                    <i class="fas fa-user"></i>
                    <?php if(!empty($username_err) && isset($_POST["register"]) && strpos($username_err, "already taken") === false): ?>
                        <div class="form-text error"><i class="fas fa-exclamation-circle"></i> <?php echo $username_err; ?></div>
                    <?php else: ?>
                        <div class="form-text">Username must be at least 8 characters long.</div>
                    <?php endif; ?>
                </div>
                
                <div class="input-field">
                    <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
                    <i class="fas fa-envelope"></i>
                    <?php if(!empty($email_err) && isset($_POST["register"]) && strpos($email_err, "already registered") === false): ?>
                        <div class="form-text error"><i class="fas fa-exclamation-circle"></i> <?php echo $email_err; ?></div>
                    <?php else: ?>
                        <div class="form-text">Enter a valid email address.</div>
                    <?php endif; ?>
                </div>
                
                <div class="input-field">
                    <input type="password" name="password" id="register-password" placeholder="Password" required>
                    <i class="fas fa-lock"></i>
                    <span class="toggle-password" onclick="togglePasswordVisibility('register-password')">
                        <i class="fas fa-eye"></i>
                    </span>
                    <?php if(!empty($password_err) && isset($_POST["register"])): ?>
                        <div class="form-text error"><i class="fas fa-exclamation-circle"></i> <?php echo $password_err; ?></div>
                    <?php else: ?>
                        <div class="form-text">Password must be at least 6 characters long.</div>
                    <?php endif; ?>
                </div>
                
                <div class="input-field">
                    <input type="password" name="confirm_password" id="confirm-password" placeholder="Confirm Password" required>
                    <i class="fas fa-lock"></i>
                    <span class="toggle-password" onclick="togglePasswordVisibility('confirm-password')">
                        <i class="fas fa-eye"></i>
                    </span>
                    <?php if(!empty($confirm_password_err) && isset($_POST["register"])): ?>
                        <div class="form-text error"><i class="fas fa-exclamation-circle"></i> <?php echo $confirm_password_err; ?></div>
                    <?php else: ?>
                        <div class="form-text">Re-enter your password to confirm.</div>
                    <?php endif; ?>
                </div>
                
                <button type="submit" name="register" class="btn">SIGN UP</button>
                
                <div class="social-login">
                    <a href="https://www.facebook.com/" target="_blank" class="social-icon facebook" title="Sign up with Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://accounts.google.com/" target="_blank" class="social-icon google" title="Sign up with Google">
                        <i class="fab fa-google"></i>
                    </a>
                    <a href="https://twitter.com/i/flow/signup" target="_blank" class="social-icon twitter" title="Sign up with Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.linkedin.com/signup" target="_blank" class="social-icon linkedin" title="Sign up with LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
                
                <div class="toggle-container">
                    <p>Already have an account? <span class="toggle-link" id="login-toggle">Login</span></p>
                </div>
            </form>
        </div>
        
        <div class="image-container">
            <div class="image-content">
                <h2 class="login-title">Welcome Back!</h2>
                <h2 class="register-title" style="display: none;">Join Our Community!</h2>
                <p class="login-text">Access your account to explore solar and wind energy solutions tailored for your location.</p>
                <p class="register-text" style="display: none;">Create an account to discover the best renewable energy options for your needs.</p>
            </div>
        </div>
    </div>
    
    <script>
        // Toggle password visibility
        function togglePasswordVisibility(inputId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = passwordInput.nextElementSibling.nextElementSibling.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        
        // Toggle between login and register forms
        document.getElementById('register-toggle').addEventListener('click', function() {
            document.querySelector('.auth-container').classList.add('register-mode');
        });
        
        document.getElementById('login-toggle').addEventListener('click', function() {
            document.querySelector('.auth-container').classList.remove('register-mode');
        });
        
        // Handle login link in warning messages
        const loginLinks = document.querySelectorAll('#login-link');
        loginLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector('.auth-container').classList.remove('register-mode');
            });
        });
        
        // Handle back to login link
        document.getElementById('back-to-login-link').addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelector('.auth-container').classList.remove('register-mode');
        });
    </script>
</body>
</html> 