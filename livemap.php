<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

$sql = "select * from water w join station s ON w.station_id = s.station_id where w.date in (select MAX(w.date) FROM water w GROUP by w.station_id)";
$result = $mysqli->query($sql);

$mysqli->close();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IFase</title>
    <link rel="shortcut icon" href="assets/img/brand/favicon.svg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- MY CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/style.css">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v2.9.2/mapbox-gl.css' rel='stylesheet' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>

<style>
      #map-container {
        position: relative;
        height:800px;
        width:1200px;
      }

      #map {
        position: relative;
        height: inherit; 
        width: inherit;
      }
            .marker {
        background-image: url('assets/img/mapbox-icon.png');
        background-size: cover;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        }
        .mapboxgl-popup {
        max-width: 200px;
        }

        .mapboxgl-popup-content {
        text-align: center;
        font-family: 'Open Sans', sans-serif;
        }
</style>

<body>
    <!-- Navbar section -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <!-- Brand here -->
                <img src="assets/img/image-removebg-preview.png" width="200" height="100" alt="brand"> 
                <b>IFASE - Flood Alert & Safe Evacuation</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                </div>
                <a href="login.php" class="btn btn-primary">Login</a>
            </div>
        </div>
    </nav>
    <!-- Hero section -->
    <center>
    <section>
    <ul class="nav justify-content-center">
    <li class="nav-item">
            <a class="nav-link" href="index.php">Water Level Status</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="safety.php">Flood Safety Tips</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="livemap.php">Evacuation Center Information</a>
        </li>
        </ul>
    
        <br><br><br>
<div id="map-container">
       <div id='map'>
       </div>
    </div>
<script>

mapboxgl.accessToken = 'pk.eyJ1IjoibWJvdWxkbyIsImEiOiJjanc3NWc4cWQxaWlwNDlubms3cTRkZDAwIn0.hRPJTjbBufd9HVTTpXW4zg';

const map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [102.40528280, 5.83285600],
      zoom: 11
    });
// Add geolocate control to the map.
map.addControl(
new mapboxgl.GeolocateControl({
positionOptions: {
enableHighAccuracy: true
},
// When active the map will receive updates to the device's location as it changes.
trackUserLocation: true,
// Draw an arrow next to the location dot to indicate which direction the device is heading.
showUserHeading: true
})
);

// Adding markers below >>>
</script>
<?php

        $dbhost = 'localhost';
         $dbuser = 'admin';
         $dbpass = 'adminpass';
         $dbname = 'ifase';
         $mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
         
         if($mysqli->connect_errno ) {
            printf("Connect failed: %s<br />", $mysqli->connect_error);
            exit();
         }
         printf('');
         $sql = "SELECT * FROM pps";
         
         $result = $mysqli->query($sql);
           
         if ($result->num_rows > 0) {
         } else {
            printf('Unexpected Error. DB did not return enough values for a successful export.<br />');
         }

?>
<script>
const geojson = {
  type: 'FeatureCollection',
  features: [
      <?php
       while ($row = mysqli_fetch_assoc($result)) {
           $displayName = $row['pps_name'];
           $displayDescription = $row['pps_capacity'];
           ?>
        {
            type: "Feature",
            geometry: {
                type: "Point",
                coordinates: [<?php echo $row['pps_lng']; ?>, <?php echo $row['pps_lat']; ?>]
            },
            properties: {
                title: "<?php echo $displayName; ?>",
                description: "Pusat Pemindahan Sementara"
            }
        },
        <?php
    
}

mysqli_free_result($result);
$mysqli->close();
?>
  ]
};

// add markers to map
// Popups and Display Details
for (const feature of geojson.features) {
// create a HTML element for each feature
const el = document.createElement('div');
el.className = 'marker';
// make a marker for each feature and add it to the map
new mapboxgl.Marker(el)
.setLngLat(feature.geometry.coordinates)
.setPopup(
new mapboxgl.Popup({ offset: 25 }) // add popups
.setHTML(
`<h6>${feature.properties.title}</h6><p>${feature.properties.description}</p>`
)
)
.addTo(map);
}
</script>
    </section>
    </center>
    <!-- Footer section -->
    <footer>
        <div class="container">
                <div class="copy">
                    &copy; 2022 Ifase
                </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>
</html>