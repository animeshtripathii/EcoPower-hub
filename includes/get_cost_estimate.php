<?php
// Include database configuration
require_once "config.php";

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the location ID, energy type, and capacity from the request
    $location_id = isset($_POST['location_id']) ? intval($_POST['location_id']) : 0;
    $energy_type = isset($_POST['energy_type']) ? $_POST['energy_type'] : '';
    $capacity = isset($_POST['capacity']) ? floatval($_POST['capacity']) : 0;
    
    // Validate input
    if ($location_id <= 0 || ($energy_type !== 'solar' && $energy_type !== 'wind') || $capacity <= 0) {
        echo json_encode(["error" => "Invalid input parameters"]);
        exit;
    }
    
    // Query to get the cost data for the selected location
    $sql = "SELECT l.city, l.state, 
            " . ($energy_type === 'solar' ? 'e.solar_installation_cost_per_kw' : 'e.wind_installation_cost_per_kw') . " AS cost_per_kw
            FROM locations l
            JOIN energy_cost_estimates e ON l.id = e.location_id
            WHERE l.id = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $location_id);
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_assoc($result)) {
                // Calculate costs
                $installation_cost = $row['cost_per_kw'] * $capacity;
                $equipment_cost = $installation_cost * 0.7; // 70% of installation cost
                $labor_cost = $installation_cost * 0.15; // 15% of installation cost
                $permits_cost = $installation_cost * 0.05; // 5% of installation cost
                $maintenance_cost = $installation_cost * 0.1; // 10% of installation cost per year
                
                // Calculate ROI data
                $electricity_rate = 8; // Average electricity rate in India (Rs. per kWh)
                $annual_energy_production = $energy_type === 'solar' ? 1500 * $capacity : 2200 * $capacity;
                $annual_savings = $annual_energy_production * $electricity_rate;
                $payback_period = $installation_cost / $annual_savings;
                
                // Prepare response
                $response = [
                    'success' => true,
                    'location' => $row['city'] . ', ' . $row['state'],
                    'energy_type' => $energy_type,
                    'capacity' => $capacity,
                    'installation_cost' => $installation_cost,
                    'equipment_cost' => $equipment_cost,
                    'labor_cost' => $labor_cost,
                    'permits_cost' => $permits_cost,
                    'maintenance_cost' => $maintenance_cost,
                    'annual_energy_production' => $annual_energy_production,
                    'annual_savings' => $annual_savings,
                    'payback_period' => $payback_period
                ];
                
                echo json_encode($response);
            } else {
                echo json_encode(['error' => 'Location not found']);
            }
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