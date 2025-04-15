<?php
// Include database configuration
require_once "config.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the preferred temperature and wind speed from the request
    $preferred_temp = isset($_POST['temperature']) ? floatval($_POST['temperature']) : 0;
    $preferred_wind_speed = isset($_POST['wind_speed']) ? floatval($_POST['wind_speed']) : 0;
    
    // Validate input
    if ($preferred_temp <= 0 || $preferred_wind_speed <= 0) {
        echo json_encode(["error" => "Invalid input parameters"]);
        exit;
    }
    
    // Query to find locations with similar temperature and wind speed
    $sql = "SELECT l.id, l.city, l.state, l.avg_temperature, l.avg_humidity, l.avg_wind_speed, l.solar_potential, l.wind_potential,
            (1 - (ABS(l.avg_temperature - ?) / 15)) * 50 + (1 - (ABS(l.avg_wind_speed - ?) / 5)) * 50 AS match_score
            FROM locations l
            ORDER BY match_score DESC
            LIMIT 5";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "dd", $preferred_temp, $preferred_wind_speed);
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            
            $locations = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $locations[] = [
                    'id' => $row['id'],
                    'city' => $row['city'],
                    'state' => $row['state'],
                    'temperature' => $row['avg_temperature'],
                    'humidity' => $row['avg_humidity'],
                    'windSpeed' => $row['avg_wind_speed'],
                    'solarPotential' => $row['solar_potential'],
                    'windPotential' => $row['wind_potential'],
                    'matchScore' => round($row['match_score'], 1)
                ];
            }
            
            // Return the results as JSON
            echo json_encode(['success' => true, 'locations' => $locations]);
        } else {
            echo json_encode(['error' => 'Failed to execute query']);
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['error' => 'Failed to prepare statement']);
    }
    
    // Close connection
    mysqli_close($conn);
} else {
    // Not a POST request
    echo json_encode(['error' => 'Invalid request method']);
}
?> 