var map = L.map('map').setView([51.505, -0.09], 13); // Creates a map instance

// Gets the map layout
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// Sets and shwos a marker on the map
var greenIcon = new L.Icon({
    iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

var blueIcon = new L.Icon({
    iconUrl: 'https://unpkg.com/leaflet@1.8.0/dist/images/marker-icon.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowSize: [41, 41]
});

L.marker([61.49481, 21.84636]).addTo(map)
    .bindPopup('Kanahaukantie 12, 28220 Pori (Isojoenranta)')
    .openPopup();

function signup(title) {
    window.location = "?page=signup";
}

function addMarker(lat, lng, imgPath, title, startdate, enddate, text, pdfName) {

    var d = new Date(enddate);
    today = new Date();
    var past = today <= d;

    L.marker([Number(lat), Number(lng)], { icon: (past) ? greenIcon : blueIcon }).addTo(map)
        .bindPopup(`<div class='popup'>
    <div class='headerDiv'>
    <img class='Image' alt='Kuva' src='${imgPath}'>
    <div class='TitleDiv'>
    <h3 class='Title'>${title}</h3>
    <p class='Date'>${startdate} - ${enddate}</p>
    </div>
    </div>
    <p class='Text'>${text}</p>
    <div class='ButtonDiv'>
    <a onClick="window.open('${pdfName}','_blank','location=yes,scrollbars=yes,status=yes');">Lataa Esite</a>
    <a onClick="togglePopup('${title}',${past});">Ilmoittaudu</a>
    </div>
    </div>`, { maxWidth: 560 })


}
