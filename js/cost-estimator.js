// Sample data for energy cost estimates
const energyCostData = [
    // Major Metropolitan Cities
    { locationId: 1, solarCostPerKw: 30000, windCostPerKw: 34000 },  // Mumbai
    { locationId: 2, solarCostPerKw: 29000, windCostPerKw: 33000 },  // Delhi
    { locationId: 3, solarCostPerKw: 31000, windCostPerKw: 35000 },  // Bangalore
    { locationId: 4, solarCostPerKw: 30000, windCostPerKw: 34000 },  // Chennai
    { locationId: 5, solarCostPerKw: 30000, windCostPerKw: 34000 },  // Kolkata
    { locationId: 6, solarCostPerKw: 29000, windCostPerKw: 33000 },  // Hyderabad
    { locationId: 7, solarCostPerKw: 31000, windCostPerKw: 35000 },  // Pune
    
    // Northern India
    { locationId: 8, solarCostPerKw: 28000, windCostPerKw: 32000 },  // Jaipur
    { locationId: 9, solarCostPerKw: 29000, windCostPerKw: 33000 },  // Lucknow
    { locationId: 10, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Chandigarh
    { locationId: 11, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Dehradun
    { locationId: 12, solarCostPerKw: 31000, windCostPerKw: 35000 }, // Shimla
    { locationId: 13, solarCostPerKw: 32000, windCostPerKw: 36000 }, // Srinagar
    { locationId: 14, solarCostPerKw: 29000, windCostPerKw: 33000 }, // Amritsar
    { locationId: 15, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Jammu
    { locationId: 16, solarCostPerKw: 33000, windCostPerKw: 37000 }, // Leh
    
    // Western India
    { locationId: 17, solarCostPerKw: 28000, windCostPerKw: 32000 }, // Ahmedabad
    { locationId: 18, solarCostPerKw: 29000, windCostPerKw: 33000 }, // Surat
    { locationId: 19, solarCostPerKw: 29000, windCostPerKw: 33000 }, // Vadodara
    { locationId: 20, solarCostPerKw: 28000, windCostPerKw: 32000 }, // Rajkot
    { locationId: 21, solarCostPerKw: 28000, windCostPerKw: 32000 }, // Jodhpur
    { locationId: 22, solarCostPerKw: 28000, windCostPerKw: 32000 }, // Udaipur
    { locationId: 23, solarCostPerKw: 28000, windCostPerKw: 32000 }, // Kota
    
    // Central India
    { locationId: 24, solarCostPerKw: 29000, windCostPerKw: 33000 }, // Bhopal
    { locationId: 25, solarCostPerKw: 29000, windCostPerKw: 33000 }, // Indore
    { locationId: 26, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Jabalpur
    { locationId: 27, solarCostPerKw: 29000, windCostPerKw: 33000 }, // Gwalior
    { locationId: 28, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Raipur
    { locationId: 29, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Nagpur
    
    // Eastern India
    { locationId: 30, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Patna
    { locationId: 31, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Ranchi
    { locationId: 32, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Jamshedpur
    { locationId: 33, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Bhubaneswar
    { locationId: 34, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Cuttack
    { locationId: 35, solarCostPerKw: 31000, windCostPerKw: 35000 }, // Guwahati
    { locationId: 36, solarCostPerKw: 31000, windCostPerKw: 35000 }, // Siliguri
    { locationId: 37, solarCostPerKw: 31000, windCostPerKw: 35000 }, // Agartala
    { locationId: 38, solarCostPerKw: 32000, windCostPerKw: 36000 }, // Imphal
    { locationId: 39, solarCostPerKw: 32000, windCostPerKw: 36000 }, // Shillong
    { locationId: 40, solarCostPerKw: 32000, windCostPerKw: 36000 }, // Aizawl
    { locationId: 41, solarCostPerKw: 32000, windCostPerKw: 36000 }, // Kohima
    { locationId: 42, solarCostPerKw: 32000, windCostPerKw: 36000 }, // Itanagar
    { locationId: 43, solarCostPerKw: 32000, windCostPerKw: 36000 }, // Gangtok
    
    // Southern India
    { locationId: 44, solarCostPerKw: 31000, windCostPerKw: 35000 }, // Thiruvananthapuram
    { locationId: 45, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Kochi
    { locationId: 46, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Kozhikode
    { locationId: 47, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Coimbatore
    { locationId: 48, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Madurai
    { locationId: 49, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Tiruchirappalli
    { locationId: 50, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Vijayawada
    { locationId: 51, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Visakhapatnam
    { locationId: 52, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Tirupati
    { locationId: 53, solarCostPerKw: 31000, windCostPerKw: 35000 }, // Mangalore
    { locationId: 54, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Mysore
    { locationId: 55, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Hubli-Dharwad
    { locationId: 56, solarCostPerKw: 31000, windCostPerKw: 35000 }, // Belgaum
    
    // Union Territories
    { locationId: 57, solarCostPerKw: 32000, windCostPerKw: 36000 }, // Port Blair
    { locationId: 58, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Silvassa
    { locationId: 59, solarCostPerKw: 30000, windCostPerKw: 34000 }, // Daman
    { locationId: 60, solarCostPerKw: 33000, windCostPerKw: 37000 }, // Kavaratti
    { locationId: 61, solarCostPerKw: 30000, windCostPerKw: 34000 }  // Pondicherry
];

// Sample data for locations
const locationNames = [
    // Major Metropolitan Cities
    { id: 1, name: 'Mumbai, Maharashtra' },
    { id: 2, name: 'Delhi, Delhi' },
    { id: 3, name: 'Bangalore, Karnataka' },
    { id: 4, name: 'Chennai, Tamil Nadu' },
    { id: 5, name: 'Kolkata, West Bengal' },
    { id: 6, name: 'Hyderabad, Telangana' },
    { id: 7, name: 'Pune, Maharashtra' },
    
    // Northern India
    { id: 8, name: 'Jaipur, Rajasthan' },
    { id: 9, name: 'Lucknow, Uttar Pradesh' },
    { id: 10, name: 'Chandigarh, Punjab & Haryana' },
    { id: 11, name: 'Dehradun, Uttarakhand' },
    { id: 12, name: 'Shimla, Himachal Pradesh' },
    { id: 13, name: 'Srinagar, Jammu & Kashmir' },
    { id: 14, name: 'Amritsar, Punjab' },
    { id: 15, name: 'Jammu, Jammu & Kashmir' },
    { id: 16, name: 'Leh, Ladakh' },
    
    // Western India
    { id: 17, name: 'Ahmedabad, Gujarat' },
    { id: 18, name: 'Surat, Gujarat' },
    { id: 19, name: 'Vadodara, Gujarat' },
    { id: 20, name: 'Rajkot, Gujarat' },
    { id: 21, name: 'Jodhpur, Rajasthan' },
    { id: 22, name: 'Udaipur, Rajasthan' },
    { id: 23, name: 'Kota, Rajasthan' },
    
    // Central India
    { id: 24, name: 'Bhopal, Madhya Pradesh' },
    { id: 25, name: 'Indore, Madhya Pradesh' },
    { id: 26, name: 'Jabalpur, Madhya Pradesh' },
    { id: 27, name: 'Gwalior, Madhya Pradesh' },
    { id: 28, name: 'Raipur, Chhattisgarh' },
    { id: 29, name: 'Nagpur, Maharashtra' },
    
    // Eastern India
    { id: 30, name: 'Patna, Bihar' },
    { id: 31, name: 'Ranchi, Jharkhand' },
    { id: 32, name: 'Jamshedpur, Jharkhand' },
    { id: 33, name: 'Bhubaneswar, Odisha' },
    { id: 34, name: 'Cuttack, Odisha' },
    { id: 35, name: 'Guwahati, Assam' },
    { id: 36, name: 'Siliguri, West Bengal' },
    { id: 37, name: 'Agartala, Tripura' },
    { id: 38, name: 'Imphal, Manipur' },
    { id: 39, name: 'Shillong, Meghalaya' },
    { id: 40, name: 'Aizawl, Mizoram' },
    { id: 41, name: 'Kohima, Nagaland' },
    { id: 42, name: 'Itanagar, Arunachal Pradesh' },
    { id: 43, name: 'Gangtok, Sikkim' },
    
    // Southern India
    { id: 44, name: 'Thiruvananthapuram, Kerala' },
    { id: 45, name: 'Kochi, Kerala' },
    { id: 46, name: 'Kozhikode, Kerala' },
    { id: 47, name: 'Coimbatore, Tamil Nadu' },
    { id: 48, name: 'Madurai, Tamil Nadu' },
    { id: 49, name: 'Tiruchirappalli, Tamil Nadu' },
    { id: 50, name: 'Vijayawada, Andhra Pradesh' },
    { id: 51, name: 'Visakhapatnam, Andhra Pradesh' },
    { id: 52, name: 'Tirupati, Andhra Pradesh' },
    { id: 53, name: 'Mangalore, Karnataka' },
    { id: 54, name: 'Mysore, Karnataka' },
    { id: 55, name: 'Hubli-Dharwad, Karnataka' },
    { id: 56, name: 'Belgaum, Karnataka' },
    
    // Union Territories
    { id: 57, name: 'Port Blair, Andaman & Nicobar Islands' },
    { id: 58, name: 'Silvassa, Dadra & Nagar Haveli' },
    { id: 59, name: 'Daman, Daman & Diu' },
    { id: 60, name: 'Kavaratti, Lakshadweep' },
    { id: 61, name: 'Pondicherry, Puducherry' }
];

// Function to calculate installation cost
function calculateInstallationCost(locationId, energyType, capacity) {
    // Find the cost data for the selected location
    const costData = energyCostData.find(data => data.locationId === parseInt(locationId));
    
    if (!costData) {
        return null;
    }
    
    // Calculate the installation cost based on energy type and capacity
    let installationCost = 0;
    if (energyType === 'solar') {
        installationCost = costData.solarCostPerKw * capacity;
    } else if (energyType === 'wind') {
        installationCost = costData.windCostPerKw * capacity;
    }
    
    // Calculate additional costs
    const equipmentCost = installationCost * 0.7; // 70% of installation cost
    const laborCost = installationCost * 0.15; // 15% of installation cost
    const permitsCost = installationCost * 0.05; // 5% of installation cost
    const maintenanceCost = installationCost * 0.1; // 10% of installation cost per year
    
    // Calculate ROI data
    const annualEnergySavings = calculateAnnualEnergySavings(energyType, capacity);
    const paybackPeriod = installationCost / annualEnergySavings;
    
    return {
        installationCost,
        equipmentCost,
        laborCost,
        permitsCost,
        maintenanceCost,
        annualEnergySavings,
        paybackPeriod
    };
}

// Function to calculate annual energy savings
function calculateAnnualEnergySavings(energyType, capacity) {
    // Average electricity rate in India (Rs. per kWh)
    const electricityRate = 8;
    
    // Estimated annual energy production (kWh) per kW of capacity
    let annualEnergyProduction = 0;
    if (energyType === 'solar') {
        // Solar panels produce about 1,500 kWh per kW of capacity per year in India
        annualEnergyProduction = 1500 * capacity;
    } else if (energyType === 'wind') {
        // Wind turbines produce about 2,200 kWh per kW of capacity per year in India
        annualEnergyProduction = 2200 * capacity;
    }
    
    // Calculate annual savings
    const annualSavings = annualEnergyProduction * electricityRate;
    
    return annualSavings;
}

// Function to display cost estimation results
function displayCostEstimation(costData, locationId, energyType, capacity) {
    const costDetails = document.getElementById('cost-details');
    const locationName = locationNames.find(loc => loc.id === parseInt(locationId))?.name || 'Unknown Location';
    
    if (!costData) {
        costDetails.innerHTML = '<p>Error: Could not calculate cost estimation for the selected location.</p>';
        return;
    }
    
    // Format currency
    const formatCurrency = (amount) => {
        return '₹' + amount.toLocaleString('en-IN');
    };
    
    // Create HTML content
    let html = `
        <div class="cost-item">
            <span class="cost-label">Location:</span>
            <span class="cost-value">${locationName}</span>
        </div>
        <div class="cost-item">
            <span class="cost-label">Energy Type:</span>
            <span class="cost-value">${energyType === 'solar' ? 'Solar Energy' : 'Wind Energy'}</span>
        </div>
        <div class="cost-item">
            <span class="cost-label">Capacity:</span>
            <span class="cost-value">${capacity} kW</span>
        </div>
        <div class="cost-item">
            <span class="cost-label">Equipment Cost:</span>
            <span class="cost-value">${formatCurrency(costData.equipmentCost)}</span>
        </div>
        <div class="cost-item">
            <span class="cost-label">Labor Cost:</span>
            <span class="cost-value">${formatCurrency(costData.laborCost)}</span>
        </div>
        <div class="cost-item">
            <span class="cost-label">Permits & Inspections:</span>
            <span class="cost-value">${formatCurrency(costData.permitsCost)}</span>
        </div>
        <div class="cost-item">
            <span class="cost-label">Annual Maintenance:</span>
            <span class="cost-value">${formatCurrency(costData.maintenanceCost)}</span>
        </div>
        <div class="cost-item total-cost">
            <span class="cost-label">Total Installation Cost:</span>
            <span class="cost-value">${formatCurrency(costData.installationCost)}</span>
        </div>
        <div class="cost-item">
            <span class="cost-label">Annual Energy Savings:</span>
            <span class="cost-value">${formatCurrency(costData.annualEnergySavings)}</span>
        </div>
        <div class="cost-item">
            <span class="cost-label">Estimated Payback Period:</span>
            <span class="cost-value">${costData.paybackPeriod.toFixed(1)} years</span>
        </div>
    `;
    
    costDetails.innerHTML = html;
    
    // Create ROI chart
    createROIChart(costData, energyType);
}

// Function to create ROI chart
function createROIChart(costData, energyType) {
    const ctx = document.getElementById('roi-chart').getContext('2d');
    
    // Calculate cumulative savings over 25 years
    const years = Array.from({ length: 25 }, (_, i) => i + 1);
    const cumulativeSavings = years.map(year => costData.annualEnergySavings * year);
    
    // Calculate net savings (cumulative savings - installation cost)
    const netSavings = cumulativeSavings.map(saving => saving - costData.installationCost);
    
    // Destroy existing chart if it exists
    if (window.roiChart) {
        window.roiChart.destroy();
    }
    
    // Create new chart
    window.roiChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [
                {
                    label: 'Cumulative Savings',
                    data: cumulativeSavings,
                    borderColor: '#2ecc71',
                    backgroundColor: 'rgba(46, 204, 113, 0.1)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Net Savings',
                    data: netSavings,
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.1)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Installation Cost',
                    data: Array(25).fill(costData.installationCost),
                    borderColor: '#e74c3c',
                    borderWidth: 2,
                    borderDash: [5, 5],
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                title: {
                    display: true,
                    text: `Return on Investment - ${energyType === 'solar' ? 'Solar' : 'Wind'} Energy (25 Years)`,
                    font: {
                        size: 16
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ₹' + context.raw.toLocaleString('en-IN');
                        }
                    }
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Years'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Amount (₹)'
                    },
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) {
                                return '₹' + (value / 1000000).toFixed(1) + 'M';
                            } else if (value >= 1000) {
                                return '₹' + (value / 1000).toFixed(1) + 'K';
                            }
                            return '₹' + value;
                        }
                    }
                }
            }
        }
    });
}

// Event listener for the cost form submission
document.getElementById('cost-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const locationId = document.getElementById('location').value;
    const energyType = document.getElementById('energy-type').value;
    const capacity = parseFloat(document.getElementById('capacity').value);
    
    if (!locationId || !energyType || isNaN(capacity)) {
        alert('Please fill all fields with valid values.');
        return;
    }
    
    const costData = calculateInstallationCost(locationId, energyType, capacity);
    displayCostEstimation(costData, locationId, energyType, capacity);
}); 