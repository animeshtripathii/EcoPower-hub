<?php
// Include config file
require_once "includes/config.php";

// Check if the user is logged in and is an admin (you can add this check if needed)
// if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
//     header("location: login.php");
//     exit;
// }

// Attempt to fetch all users
$sql = "SELECT id, username, email, created_at FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users - Clean Energy, Bright Future</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        
        h1 {
            color: #4ECDC4;
            margin-bottom: 30px;
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #4ECDC4;
            color: white;
        }
        
        tr:hover {
            background-color: #f5f5f5;
        }
        
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4ECDC4;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }
        
        .back-btn:hover {
            background-color: #2ecc71;
        }
        
        .no-data {
            text-align: center;
            padding: 20px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registered Users</h1>
        
        <?php
        if(mysqli_num_rows($result) > 0){
        ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . $row['created_at'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        } else {
            echo "<p class='no-data'>No users found in the database.</p>";
        }
        
        // Free result set
        mysqli_free_result($result);
        
        // Close connection
        mysqli_close($conn);
        ?>
        
        <a href="index.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>
</body>
</html> 