<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

include 'connectionAdmin.php';
$email = $_SESSION['email'];

$sql = "SELECT * FROM `pps`";
$result = $mysqli->query($sql);
$another = $mysqli->query($sql);

$evac=$mysqli->query("SELECT COUNT(pps_id) as JUMLAH FROM pps");
$fetch = mysqli_fetch_array($evac);
$count = $fetch['JUMLAH'];


$totalevac=0;
while($rowz = mysqli_fetch_assoc($another))
{
    $totalevac = $totalevac + $rowz['curr_cap'];
}

$mysqli->close();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IFase</title>
    <script src="https://kit.fontawesome.com/e5ee6d830b.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../assets/img/brand/favicon.svg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <!-- MY CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../assets/css/style.css">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

        <script src="https://kit.fontawesome.com/e5ee6d830b.js" crossorigin="anonymous"></script>


</head>

<body>
    <!-- Navbar section -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">
                <!-- Brand here -->
                <img src="../assets/img/image-removebg-preview.png" width="200" height="100" alt="brand"> 
                <b>IFASE - Flood Alert & Safe Evacuation</b>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link me-5" href="index.php"><i class="fa-solid fa-user fa-2xl"></i><?php echo $email?></a>
                </div>
                <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Hero section -->

    <section>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link" href="index.php">Dashboard</a>
        </li>
    </ul>
    
        <br><br><br>

        <div class="grey-bg container-fluid">
        <section id="minimal-statistics">
            <div class="row justify-content-center">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                <div class="card-content">
                    <div class="card-body">
                    <div class="media d-flex">
                        <div class="align-self-center">
                        <i class="fa-solid fa-person-shelter fa-2xl"></i>
                        </div>
                        <div class="media-body text-right">
                        <h3><?php echo $totalevac;?></h3>
                        <span>No of Evacuees</span>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                <div class="card-content">
                    <div class="card-body">
                    <div class="media d-flex">
                    <div class="align-self-center">
                    <i class="fa-solid fa-house-medical fa-2xl"></i>
                        </div>
                        <div class="media-body text-right">
                        <h3><?php echo $count;?></h3>
                        <span>No of Evacuation Center</span>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
        </div>

        <br><br><br>
        <table class="table text-center"  style="width:90% ; margin: 0 auto;">
            <thead class="thead-light">
              <tr>
                <th scope="col">PPS ID</th>
                <th scope="col">PPS NAME</th>
                <th scope="col">PPS CAPACITY</th>
                <th scope="col">CURRENT EVACUEES</th>
                <th scope="col">AVAILABLE CAPACITY</th>
              </tr>
            </thead>
            <tbody>
            <?php
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
                    $available = $rows['pps_capacity'] - $rows['curr_cap'];
             ?>
              <tr>
                <th scope="row"><?php echo $rows['pps_id'];?></th>
                <td><?php echo $rows['pps_name'];?></td>
                <td><?php echo $rows['pps_capacity'];?></td>
                <td><?php echo $rows['curr_cap'];?> </td>
                <td><?php echo $available?> </td>
              </tr>
              <?php
                }
            ?>
            </tbody>
          </table>
          <br><br><br>
          <center>
          <a href="resetpps.php"><button type="button" class="btn btn-danger" onclick="return confirm('SURE?')">Reset PPS</button></a>
          <a href="resetstation.php"><button type="button" class="btn btn-warning" onclick="return confirm('SURE?')">Reset Station</button></a>
            </center>
    </section>



    <!--Testing-->


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