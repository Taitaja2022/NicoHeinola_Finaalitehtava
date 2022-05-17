var map = L.map('map').setView([51.505, -0.09], 13); // Creates a map instance

// Gets the map layout
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Sets and shwos a marker on the map
L.marker([61.49481, 21.84636]).addTo(map)
    .bindPopup('Kanahaukantie 12, 28220 Pori (Isojoenranta)')
    .openPopup();