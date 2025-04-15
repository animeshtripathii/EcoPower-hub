# 🌞🌬️ Solar & Wind Energy Availability Portal

A modern, user-friendly web application that helps explore solar and wind energy availability across India, recommends ideal locations based on user preferences, and estimates renewable energy installation costs.

---

## 🚀 Features

### 🗺️ Interactive Weather Map

- Real-time weather and renewable energy potential for any Indian location
- Clickable map with insights on temperature, humidity, wind speed, and energy scores

### 📍 Smart Location Recommendations

- Input your ideal temperature and wind speed
- Get AI-powered suggestions of matching locations
- Dive into location-specific insights

### 💰 Cost Estimator & ROI Calculator

- Estimate installation costs for solar panels or wind turbines
- Detailed breakdown: equipment, labor, permits, maintenance
- ROI analysis with payback period and future savings

---

## ⚙️ Setup Instructions

### ✅ Prerequisites

- PHP 7.4+
- MySQL 5.7+
- Apache or Nginx web server

### 🧩 Installation

1. **Clone the Repository**

```bash
git clone https://github.com/yourusername/solar-wind-energy.git
cd solar-wind-energy
```

2. **Database Setup**

- Create a MySQL database
- Import the schema and sample data

```bash
mysql -u username -p database_name < database.sql
```

3. **Configure DB Connection** Edit `includes/config.php`:

```php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'your_username');
define('DB_PASSWORD', 'your_password');
define('DB_NAME', 'solar_wind_energy');
```

4. **Web Server Setup**

- Point the server root to the project directory
- Ensure PHP is enabled and configured properly

5. **Assets Directory**

```bash
mkdir -p images
chmod 755 images
```

6. **Launch the App**

- Visit the configured URL in your browser
- Register or log in to explore the platform

---

## 🧪 Usage Guide

### 🔐 Authentication

- Register or log in to access features

### 🌐 Weather Map

- Click anywhere on the Indian map to view local weather and energy stats

### 📊 Location Finder

- Input temperature and wind preferences
- Get a list of matching areas with energy potential

### 🧮 Cost Estimator

- Choose location, energy type (solar/wind), and capacity
- View cost summary and ROI timeline

---

## 🛠️ Tech Stack

| Frontend         | Backend | APIs & Tools        |
| ---------------- | ------- | ------------------- |
| HTML, CSS        | PHP     | OpenStreetMap (map) |
| JavaScript       | MySQL   | Leaflet.js (maps)   |
| jQuery, Chart.js |         | Chart.js (graphs)   |

---


## 🙏 Acknowledgements

- 🌍 [OpenStreetMap](https://www.openstreetmap.org/) – Map data provider
- 📊 [Chart.js](https://www.chartjs.org/) – Elegant data visualizations
- 🗺️ [Leaflet.js](https://leafletjs.com/) – Interactive maps made simple

---


> Made with ❤️ for a greener and sustainable India 🇮🇳
EOF

echo "✅ README.md has been created successfully."
