-- Create database
CREATE DATABASE IF NOT EXISTS solar_project;
USE solar_project;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create locations table for storing weather data
CREATE TABLE IF NOT EXISTS locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    latitude DECIMAL(10, 8) NOT NULL,
    longitude DECIMAL(11, 8) NOT NULL,
    avg_temperature DECIMAL(5, 2),
    avg_humidity DECIMAL(5, 2),
    avg_wind_speed DECIMAL(5, 2),
    solar_potential INT,
    wind_potential INT
);

-- Create user_preferences table
CREATE TABLE IF NOT EXISTS user_preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    preferred_temperature DECIMAL(5, 2),
    preferred_wind_speed DECIMAL(5, 2),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create energy_cost_estimates table
CREATE TABLE IF NOT EXISTS energy_cost_estimates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_id INT NOT NULL,
    solar_installation_cost_per_kw DECIMAL(10, 2) NOT NULL,
    wind_installation_cost_per_kw DECIMAL(10, 2) NOT NULL,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (location_id) REFERENCES locations(id) ON DELETE CASCADE
);

-- Insert sample data for locations
INSERT INTO locations (city, state, latitude, longitude, avg_temperature, avg_humidity, avg_wind_speed, solar_potential, wind_potential) VALUES
('Mumbai', 'Maharashtra', 19.0760, 72.8777, 27.5, 75.0, 3.2, 85, 45),
('Delhi', 'Delhi', 28.6139, 77.2090, 25.0, 60.0, 3.8, 80, 50),
('Bangalore', 'Karnataka', 12.9716, 77.5946, 24.0, 65.0, 2.9, 90, 40),
('Chennai', 'Tamil Nadu', 13.0827, 80.2707, 28.5, 70.0, 4.1, 95, 55),
('Kolkata', 'West Bengal', 22.5726, 88.3639, 26.5, 80.0, 3.5, 75, 60),
('Jaipur', 'Rajasthan', 26.9124, 75.7873, 25.5, 45.0, 5.2, 95, 70),
('Ahmedabad', 'Gujarat', 23.0225, 72.5714, 27.0, 55.0, 4.8, 90, 65),
('Hyderabad', 'Telangana', 17.3850, 78.4867, 26.0, 60.0, 3.7, 85, 50),
('Pune', 'Maharashtra', 18.5204, 73.8567, 24.5, 65.0, 3.0, 80, 45),
('Surat', 'Gujarat', 21.1702, 72.8311, 27.5, 70.0, 4.5, 85, 60);

-- Insert sample data for energy cost estimates
INSERT INTO energy_cost_estimates (location_id, solar_installation_cost_per_kw, wind_installation_cost_per_kw) VALUES
(1, 75000, 85000),
(2, 72000, 82000),
(3, 78000, 88000),
(4, 76000, 86000),
(5, 74000, 84000),
(6, 70000, 80000),
(7, 71000, 81000),
(8, 73000, 83000),
(9, 77000, 87000),
(10, 72000, 82000); 