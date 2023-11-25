<?php

// REFRESH in every 3 second
header("refresh: 10");

include 'connectionIndex.php';

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

        <table class="table text-center"  style="width:90% ; margin: 0 auto;">
            <thead class="thead-light">
              <tr>
                <th scope="col">STATION ID</th>
                <th scope="col">LOCATION</th>
                <th scope="col">WATER LEVEL READING</th>
                <th scope="col">LAST UPDATE</th>
                <th scope="col">STATUS</th>
                <th scope="col">ACTION</th>
              </tr>
            </thead>
            <tbody>
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
             ?>
              <tr>
                <th scope="row"><?php echo $rows['station_id'];?></th>
                <td><?php echo $rows['area'];?></td>
                <td><?php echo $rows['reading'];?></td>
                <td><?php echo $rows['date'];?> </td>
                <?php 
                            if ($rows['level'] == 'NORMAL' )
                            {
                                $msg = '-';
                                $whatscolor = 'badge badge-success';
                            }
                            else if ($rows['level'] == 'ALERT' )
                            {
                                $whatscolor = 'badge badge-info';
                                $msg = 'Please Stay Alert!';
                            }
                            else if ($rows['level'] == 'WARNING' )
                            {
                                $whatscolor = 'badge badge-warning';
                                $msg = 'Please Stay Alert and Be Prepared!';
                            }
                            else if ($rows['level'] == 'DANGER' ||'DANGER LOW'|| 'DANGER MEDIUM' || 'DANGER HIGH')
                            {
                                $whatscolor = 'badge badge-danger';
                                $msg ='Please follow evacuation instruction. <a href="findrescue.php?station_id='.$rows['station_id'].'">Click here</a> for more information.';
                            }
                ?>
                <td><span class="<?php echo $whatscolor; ?>"><?php echo $rows['level'];?></span></td>
                <td><?php echo $msg;?></td>
              </tr>
              <?php
                }
            ?>
            </tbody>
          </table>
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