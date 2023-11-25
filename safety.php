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
</head>

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
        <div class="card-deck" style="width: 70rem;">
  <div class="card">
    <img class="card-img-top" src="assets/img/img1.jpg" alt="Card image cap" >
    <div class="card-body">
      <h5 class="card-title">Before a Flood</h5>
      <p class="card-text">
        Listen local media channels for evacuation orders.<br><br>
        Create an emergency preparedness kit with a 72-hour supply of water and food.<br><br>
        Put important documents and valuables in a water-proof container.<br><br>
        Create an emergency evacuation plan.<br>
      </p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="assets/img/img2.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">During a Flood</h5>
      <p class="card-text">
        Climb to higher grounds.<br><br>
        Be ready to evacuate.<br><br>
        Do not walk through flooded areas.<br><br>
        Use a stick to to check the firmness of the ground in front of you.<br><br>
        Do not touch electric equipment if you are wet or standing in water.<br>
      </p>
    </div>
  </div>
  <div class="card">
    <img class="card-img-top" src="assets/img/img3.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">After a Flood</h5>
      <p class="card-text">
        Stay away from flood water.<br><br>
        Stay out from any building if floodwaters remain around the building.<br><br>
        If required, seek necessary medical aid.<br><br>
        Do not drink tap water.<br><br>
        Avoid drowned power lines.<br><br>
        Do not try to drive over flooded road.<br>
      </p>
    </div>
  </div>
</div>
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