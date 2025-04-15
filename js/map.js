// Initialize the map centered on India
const map = L.map('india-map').setView([20.5937, 78.9629], 5);

// Add OpenStreetMap tile layer
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    maxZoom: 18
}).addTo(map);

// OpenWeatherMap API configuration
const weatherApiKey = "1fbe640edd72ac301972be5c0499d28a";
const weatherApiUrl = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=";
const forecastApiUrl = "https://api.openweathermap.org/data/2.5/forecast?units=metric&q=";

// Add India boundary
fetch('https://raw.githubusercontent.com/geohacker/india/master/india-states.geojson')
    .then(response => response.json())
    .then(data => {
        L.geoJSON(data, {
            style: {
                color: '#27ae60',
                weight: 2,
                fillColor: '#2ecc71',
                fillOpacity: 0.1
            }
        }).addTo(map);
    })
    .catch(error => console.error('Error loading India GeoJSON:', error));

// Sample data for major cities in India with weather information
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

// Add markers for major cities
cities.forEach(city => {
    const marker = L.marker([city.lat, city.lng])
        .addTo(map)
        .bindPopup(`<b>${city.name}, ${city.state}</b><br>Click for weather details`);
    
    marker.on('click', () => {
        fetchWeatherData(city);
    });
});

// Handle map click to get weather data for any location
map.on('click', (e) => {
    const lat = e.latlng.lat.toFixed(4);
    const lng = e.latlng.lng.toFixed(4);
    
    // Check if the click is within India's approximate boundaries
    if (lat >= 8.4 && lat <= 37.6 && lng >= 68.7 && lng <= 97.25) {
        fetchWeatherDataByCoordinates(lat, lng);
    }
});

// Function to fetch weather data for a city
function fetchWeatherData(city) {
    // Show loading state
    document.getElementById('weather-details').style.display = 'block';
    document.getElementById('location-name').textContent = `${city.name}, ${city.state}`;
    document.getElementById('temperature').textContent = 'Loading...';
    document.getElementById('humidity').textContent = 'Loading...';
    document.getElementById('wind-speed').textContent = 'Loading...';
    document.getElementById('solar-potential').textContent = 'Loading...';
    document.getElementById('wind-potential').textContent = 'Loading...';
    
    // Make API call to OpenWeatherMap using city name
    fetch(`${weatherApiUrl}${city.name},IN&appid=${weatherApiKey}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Weather data not available');
            }
            return response.json();
        })
        .then(data => {
            // Extract weather data from API response
            const temperature = data.main.temp.toFixed(1);
            const humidity = data.main.humidity;
            const windSpeed = data.wind.speed.toFixed(1);
            
            // Calculate solar and wind potential based on weather conditions
            // This is a simplified estimation
            const cloudiness = data.clouds ? data.clouds.all : 0;
            const solarPotential = Math.round(100 - cloudiness * 0.8);
            const windPotential = Math.round(windSpeed * 10 > 100 ? 100 : windSpeed * 10);
            
            // Update the weather information display
            document.getElementById('temperature').textContent = `Temperature: ${temperature} °C`;
            document.getElementById('humidity').textContent = `Humidity: ${humidity} %`;
            document.getElementById('wind-speed').textContent = `Wind Speed: ${windSpeed} m/s`;
            document.getElementById('solar-potential').textContent = `Solar Potential: ${solarPotential}/100`;
            document.getElementById('wind-potential').textContent = `Wind Potential: ${windPotential}/100`;
        })
        .catch(error => {
            console.error('Error fetching weather data:', error);
            document.getElementById('temperature').textContent = 'Weather data unavailable';
            document.getElementById('humidity').textContent = 'Weather data unavailable';
            document.getElementById('wind-speed').textContent = 'Weather data unavailable';
            document.getElementById('solar-potential').textContent = 'Data unavailable';
            document.getElementById('wind-potential').textContent = 'Data unavailable';
        });
}

// Function to fetch weather data for coordinates
function fetchWeatherDataByCoordinates(lat, lng) {
    // Show loading state
    document.getElementById('weather-details').style.display = 'block';
    document.getElementById('location-name').textContent = `Lat: ${lat}, Lng: ${lng}`;
    document.getElementById('temperature').textContent = 'Loading...';
    document.getElementById('humidity').textContent = 'Loading...';
    document.getElementById('wind-speed').textContent = 'Loading...';
    document.getElementById('solar-potential').textContent = 'Loading...';
    document.getElementById('wind-potential').textContent = 'Loading...';
    
    // Make API call to OpenWeatherMap using coordinates
    fetch(`https://api.openweathermap.org/data/2.5/weather?units=metric&lat=${lat}&lon=${lng}&appid=${weatherApiKey}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Weather data not available');
            }
            return response.json();
        })
        .then(data => {
            // Extract weather data from API response
            const temperature = data.main.temp.toFixed(1);
            const humidity = data.main.humidity;
            const windSpeed = data.wind.speed.toFixed(1);
            
            // Get location name from API response
            const locationName = data.name ? `${data.name}${data.sys.country ? ', ' + data.sys.country : ''}` : `Location at ${lat}, ${lng}`;
            
            // Calculate solar and wind potential based on weather conditions
            const cloudiness = data.clouds ? data.clouds.all : 0;
            const solarPotential = Math.round(100 - cloudiness * 0.8);
            const windPotential = Math.round(windSpeed * 10 > 100 ? 100 : windSpeed * 10);
            
            // Update the weather information display
            document.getElementById('location-name').textContent = locationName;
            document.getElementById('temperature').textContent = `Temperature: ${temperature} °C`;
            document.getElementById('humidity').textContent = `Humidity: ${humidity} %`;
            document.getElementById('wind-speed').textContent = `Wind Speed: ${windSpeed} m/s`;
            document.getElementById('solar-potential').textContent = `Solar Potential: ${solarPotential}/100`;
            document.getElementById('wind-potential').textContent = `Wind Potential: ${windPotential}/100`;
        })
        .catch(error => {
            console.error('Error fetching weather data:', error);
            document.getElementById('location-name').textContent = `Location at ${lat}, ${lng}`;
            document.getElementById('temperature').textContent = 'Weather data unavailable';
            document.getElementById('humidity').textContent = 'Weather data unavailable';
            document.getElementById('wind-speed').textContent = 'Weather data unavailable';
            document.getElementById('solar-potential').textContent = 'Data unavailable';
            document.getElementById('wind-potential').textContent = 'Data unavailable';
        });
} 