// OpenWeatherMap API configuration
const weatherApiKey = "1fbe640edd72ac301972be5c0499d28a";
const weatherApiUrl = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=";
const forecastApiUrl = "https://api.openweathermap.org/data/2.5/forecast?units=metric&q=";

// Cities data for location finder
const cities = [
    // Major Metropolitan Cities
    { name: 'Mumbai', state: 'Maharashtra', lat: 19.0760, lng: 72.8777 },
    { name: 'Delhi', state: 'Delhi', lat: 28.6139, lng: 77.2090 },
    { name: 'Bangalore', state: 'Karnataka', lat: 12.9716, lng: 77.5946 },
    { name: 'Chennai', state: 'Tamil Nadu', lat: 13.0827, lng: 80.2707 },
    { name: 'Kolkata', state: 'West Bengal', lat: 22.5726, lng: 88.3639 },
    { name: 'Hyderabad', state: 'Telangana', lat: 17.3850, lng: 78.4867 },
    { name: 'Pune', state: 'Maharashtra', lat: 18.5204, lng: 73.8567 },
    
    // Northern India
    { name: 'Jaipur', state: 'Rajasthan', lat: 26.9124, lng: 75.7873 },
    { name: 'Lucknow', state: 'Uttar Pradesh', lat: 26.8467, lng: 80.9462 },
    { name: 'Chandigarh', state: 'Punjab & Haryana', lat: 30.7333, lng: 76.7794 },
    { name: 'Dehradun', state: 'Uttarakhand', lat: 30.3165, lng: 78.0322 },
    { name: 'Shimla', state: 'Himachal Pradesh', lat: 31.1048, lng: 77.1734 },
    { name: 'Srinagar', state: 'Jammu & Kashmir', lat: 34.0837, lng: 74.7973 },
    { name: 'Amritsar', state: 'Punjab', lat: 31.6340, lng: 74.8723 },
    { name: 'Jammu', state: 'Jammu & Kashmir', lat: 32.7266, lng: 74.8570 },
    { name: 'Leh', state: 'Ladakh', lat: 34.1526, lng: 77.5771 },
    
    // Western India
    { name: 'Ahmedabad', state: 'Gujarat', lat: 23.0225, lng: 72.5714 },
    { name: 'Surat', state: 'Gujarat', lat: 21.1702, lng: 72.8311 },
    { name: 'Vadodara', state: 'Gujarat', lat: 22.3072, lng: 73.1812 },
    { name: 'Rajkot', state: 'Gujarat', lat: 22.3039, lng: 70.8022 },
    { name: 'Jodhpur', state: 'Rajasthan', lat: 26.2389, lng: 73.0243 },
    { name: 'Udaipur', state: 'Rajasthan', lat: 24.5854, lng: 73.7125 },
    { name: 'Kota', state: 'Rajasthan', lat: 25.2138, lng: 75.8648 },
    
    // Central India
    { name: 'Bhopal', state: 'Madhya Pradesh', lat: 23.2599, lng: 77.4126 },
    { name: 'Indore', state: 'Madhya Pradesh', lat: 22.7196, lng: 75.8577 },
    { name: 'Jabalpur', state: 'Madhya Pradesh', lat: 23.1815, lng: 79.9864 },
    { name: 'Gwalior', state: 'Madhya Pradesh', lat: 26.2183, lng: 78.1828 },
    { name: 'Raipur', state: 'Chhattisgarh', lat: 21.2514, lng: 81.6296 },
    { name: 'Nagpur', state: 'Maharashtra', lat: 21.1458, lng: 79.0882 },
    
    // Eastern India
    { name: 'Patna', state: 'Bihar', lat: 25.5941, lng: 85.1376 },
    { name: 'Ranchi', state: 'Jharkhand', lat: 23.3441, lng: 85.3096 },
    { name: 'Jamshedpur', state: 'Jharkhand', lat: 22.8046, lng: 86.2029 },
    { name: 'Bhubaneswar', state: 'Odisha', lat: 20.2961, lng: 85.8245 },
    { name: 'Cuttack', state: 'Odisha', lat: 20.4625, lng: 85.8830 },
    { name: 'Guwahati', state: 'Assam', lat: 26.1445, lng: 91.7362 },
    { name: 'Siliguri', state: 'West Bengal', lat: 26.7271, lng: 88.3953 },
    { name: 'Agartala', state: 'Tripura', lat: 23.8315, lng: 91.2868 },
    { name: 'Imphal', state: 'Manipur', lat: 24.8170, lng: 93.9368 },
    { name: 'Shillong', state: 'Meghalaya', lat: 25.5788, lng: 91.8933 },
    { name: 'Aizawl', state: 'Mizoram', lat: 23.7307, lng: 92.7173 },
    { name: 'Kohima', state: 'Nagaland', lat: 25.6751, lng: 94.1086 },
    { name: 'Itanagar', state: 'Arunachal Pradesh', lat: 27.0844, lng: 93.6053 },
    { name: 'Gangtok', state: 'Sikkim', lat: 27.3389, lng: 88.6065 },
    
    // Southern India
    { name: 'Thiruvananthapuram', state: 'Kerala', lat: 8.5241, lng: 76.9366 },
    { name: 'Kochi', state: 'Kerala', lat: 9.9312, lng: 76.2673 },
    { name: 'Kozhikode', state: 'Kerala', lat: 11.2588, lng: 75.7804 },
    { name: 'Coimbatore', state: 'Tamil Nadu', lat: 11.0168, lng: 76.9558 },
    { name: 'Madurai', state: 'Tamil Nadu', lat: 9.9252, lng: 78.1198 },
    { name: 'Tiruchirappalli', state: 'Tamil Nadu', lat: 10.7905, lng: 78.7047 },
    { name: 'Vijayawada', state: 'Andhra Pradesh', lat: 16.5062, lng: 80.6480 },
    { name: 'Visakhapatnam', state: 'Andhra Pradesh', lat: 17.6868, lng: 83.2185 },
    { name: 'Tirupati', state: 'Andhra Pradesh', lat: 13.6288, lng: 79.4192 },
    { name: 'Mangalore', state: 'Karnataka', lat: 12.9141, lng: 74.8560 },
    { name: 'Mysore', state: 'Karnataka', lat: 12.2958, lng: 76.6394 },
    { name: 'Hubli-Dharwad', state: 'Karnataka', lat: 15.3647, lng: 75.1240 },
    { name: 'Belgaum', state: 'Karnataka', lat: 15.8497, lng: 74.4977 },
    
    // Union Territories
    { name: 'Port Blair', state: 'Andaman & Nicobar Islands', lat: 11.6234, lng: 92.7265 },
    { name: 'Silvassa', state: 'Dadra & Nagar Haveli', lat: 20.2766, lng: 73.0108 },
    { name: 'Daman', state: 'Daman & Diu', lat: 20.3974, lng: 72.8328 },
    { name: 'Kavaratti', state: 'Lakshadweep', lat: 10.5593, lng: 72.6358 },
    { name: 'Pondicherry', state: 'Puducherry', lat: 11.9416, lng: 79.8083 }
];

// Function to calculate match score between user preferences and location data
function calculateMatchScore(preferredTemp, preferredWindSpeed, locationTemp, locationWindSpeed) {
    // Calculate temperature difference (lower is better)
    const tempDiff = Math.abs(preferredTemp - locationTemp);
    
    // Calculate wind speed difference (lower is better)
    const windSpeedDiff = Math.abs(preferredWindSpeed - locationWindSpeed);
    
    // Normalize differences to a 0-100 scale (inverted so higher is better)
    // Using a more accurate normalization formula with exponential decay
    // This gives higher scores to locations that are closer to the preferred values
    const tempScore = 100 * Math.exp(-0.5 * Math.pow(tempDiff / 5, 2));
    const windSpeedScore = 100 * Math.exp(-0.5 * Math.pow(windSpeedDiff / 2, 2));
    
    // Calculate weighted overall match score
    // Give more weight to the parameter that has a better match
    const tempWeight = 1 - (tempDiff / (tempDiff + windSpeedDiff + 0.001));
    const windWeight = 1 - (windSpeedDiff / (tempDiff + windSpeedDiff + 0.001));
    
    // Adjust weights to ensure they sum to 1
    const totalWeight = tempWeight + windWeight;
    const normalizedTempWeight = tempWeight / totalWeight;
    const normalizedWindWeight = windWeight / totalWeight;
    
    // Calculate weighted score
    const matchScore = (tempScore * normalizedTempWeight) + (windSpeedScore * normalizedWindWeight);
    
    return Math.max(0, Math.min(100, matchScore)); // Ensure score is between 0 and 100
}

// Function to find and display recommended locations based on user preferences
async function findRecommendedLocations(preferredTemp, preferredWindSpeed) {
    // Show loading indicator
    const locationsList = document.getElementById('locations-list');
    locationsList.innerHTML = '<div class="loading"><i class="fas fa-spinner fa-spin"></i> Fetching real-time weather data...</div>';
    document.getElementById('recommendation-results').style.display = 'block';
    
    try {
        // Fetch real-time weather data for all cities
        const weatherPromises = cities.map(city => 
            fetch(`${weatherApiUrl}${city.name},IN&appid=${weatherApiKey}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Failed to fetch data for ${city.name}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Extract and return relevant weather data
                    const temperature = data.main.temp;
                    const humidity = data.main.humidity;
                    const windSpeed = data.wind.speed;
                    const cloudiness = data.clouds ? data.clouds.all : 0;
                    
                    // Calculate solar and wind potential
                    const solarPotential = Math.round(100 - cloudiness * 0.8);
                    const windPotential = Math.round(windSpeed * 10 > 100 ? 100 : windSpeed * 10);
                    
                    return {
                        city: city.name,
                        state: city.state,
                        temperature: temperature,
                        humidity: humidity,
                        windSpeed: windSpeed,
                        solarPotential: solarPotential,
                        windPotential: windPotential,
                        lat: city.lat,
                        lng: city.lng
                    };
                })
                .catch(error => {
                    console.error(`Error fetching data for ${city.name}:`, error);
                    return null; // Return null for failed requests
                })
        );
        
        // Wait for all API calls to complete
        const weatherResults = await Promise.all(weatherPromises);
        
        // Filter out null results (failed API calls)
        const validWeatherData = weatherResults.filter(result => result !== null);
        
        // Calculate match scores for all locations with valid data
        const locationsWithScores = validWeatherData.map(location => {
            const matchScore = calculateMatchScore(preferredTemp, preferredWindSpeed, location.temperature, location.windSpeed);
            
            // Calculate individual parameter scores for display
            const tempScore = 100 * Math.exp(-0.5 * Math.pow(Math.abs(preferredTemp - location.temperature) / 5, 2));
            const windScore = 100 * Math.exp(-0.5 * Math.pow(Math.abs(preferredWindSpeed - location.windSpeed) / 2, 2));
            
            return { 
                ...location, 
                matchScore,
                tempScore,
                windScore,
                tempDiff: Math.abs(preferredTemp - location.temperature),
                windDiff: Math.abs(preferredWindSpeed - location.windSpeed)
            };
        });
        
        // Sort locations by match score (highest first)
        const sortedLocations = locationsWithScores.sort((a, b) => b.matchScore - a.matchScore);
        
        // Take top 5 locations
        const topLocations = sortedLocations.slice(0, 5);
        
        // Display recommended locations
        displayRecommendedLocations(topLocations, preferredTemp, preferredWindSpeed);
    } catch (error) {
        console.error("Error finding recommended locations:", error);
        locationsList.innerHTML = '<p>Error fetching weather data. Please try again later.</p>';
    }
}

// Function to display recommended locations in the UI
function displayRecommendedLocations(locations, preferredTemp, preferredWindSpeed) {
    const locationsList = document.getElementById('locations-list');
    locationsList.innerHTML = '';
    
    if (locations.length === 0) {
        locationsList.innerHTML = '<p>No matching locations found.</p>';
        return;
    }
    
    // Add user preferences summary
    const preferencesSummary = document.createElement('div');
    preferencesSummary.className = 'preferences-summary';
    preferencesSummary.innerHTML = `
        <h4>Your Preferences</h4>
        <p><i class="fas fa-temperature-high"></i> Temperature: ${preferredTemp} °C</p>
        <p><i class="fas fa-wind"></i> Wind Speed: ${preferredWindSpeed} m/s</p>
    `;
    locationsList.appendChild(preferencesSummary);
    
    // Add locations
    locations.forEach(location => {
        const locationCard = document.createElement('div');
        locationCard.className = 'location-card';
        
        // Create progress bars for match scores
        const overallProgressBar = createProgressBar(location.matchScore, 'overall');
        const tempProgressBar = createProgressBar(location.tempScore, 'temperature');
        const windProgressBar = createProgressBar(location.windScore, 'wind');
        
        locationCard.innerHTML = `
            <h4>${location.city}, ${location.state}</h4>
            <div class="location-details">
                <div class="location-stats">
                    <p><i class="fas fa-temperature-high"></i> Temperature: ${location.temperature} °C <span class="diff">(${location.tempDiff > 0 ? '+' : ''}${location.tempDiff.toFixed(1)} °C)</span></p>
                    <p><i class="fas fa-wind"></i> Wind Speed: ${location.windSpeed} m/s <span class="diff">(${location.windDiff > 0 ? '+' : ''}${location.windDiff.toFixed(1)} m/s)</span></p>
            <p><i class="fas fa-tint"></i> Humidity: ${location.humidity}%</p>
                </div>
                <div class="location-potentials">
            <p><i class="fas fa-sun"></i> Solar Potential: ${location.solarPotential}/100</p>
            <p><i class="fas fa-fan"></i> Wind Potential: ${location.windPotential}/100</p>
                </div>
            </div>
            <div class="match-scores">
                <div class="score-item">
                    <span>Overall Match:</span>
                    ${overallProgressBar}
                    <span class="score-value">${location.matchScore.toFixed(1)}%</span>
                </div>
                <div class="score-item">
                    <span>Temperature Match:</span>
                    ${tempProgressBar}
                    <span class="score-value">${location.tempScore.toFixed(1)}%</span>
                </div>
                <div class="score-item">
                    <span>Wind Speed Match:</span>
                    ${windProgressBar}
                    <span class="score-value">${location.windScore.toFixed(1)}%</span>
                </div>
            </div>
        `;
        
        locationsList.appendChild(locationCard);
    });
    
    // Show the results container
    document.getElementById('recommendation-results').style.display = 'block';
    
    // Animate progress bars
    setTimeout(() => {
        document.querySelectorAll('.progress-bar-fill').forEach(bar => {
            bar.style.width = bar.getAttribute('data-width');
        });
    }, 100);
    
    // Add view on map functionality
    const locationCards = document.querySelectorAll('.location-card');
    locationCards.forEach((card, index) => {
        const location = locations[index];
        const viewOnMapBtn = document.createElement('button');
        viewOnMapBtn.className = 'btn btn-secondary view-on-map-btn';
        viewOnMapBtn.innerHTML = '<i class="fas fa-map-marker-alt"></i> View on Map';
        viewOnMapBtn.addEventListener('click', () => {
            window.location.href = `weather-map.php?lat=${location.lat}&lng=${location.lng}`;
        });
        card.appendChild(viewOnMapBtn);
    });
}

// Helper function to create a progress bar
function createProgressBar(value, type) {
    const percentage = value.toFixed(1) + '%';
    let colorClass = '';
    
    switch(type) {
        case 'overall':
            colorClass = 'progress-overall';
            break;
        case 'temperature':
            colorClass = 'progress-temperature';
            break;
        case 'wind':
            colorClass = 'progress-wind';
            break;
        default:
            colorClass = '';
    }
    
    return `
        <div class="progress-bar">
            <div class="progress-bar-fill ${colorClass}" data-width="${percentage}" style="width: 0%"></div>
        </div>
    `;
}

// Event listener for the recommendation form submission
document.getElementById('recommendation-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const preferredTemp = parseFloat(document.getElementById('preferred-temperature').value);
    const preferredWindSpeed = parseFloat(document.getElementById('preferred-wind-speed').value);
    
    findRecommendedLocations(preferredTemp, preferredWindSpeed);
    
    // Scroll to results
    document.getElementById('recommendation-results').scrollIntoView({ behavior: 'smooth' });
}); 