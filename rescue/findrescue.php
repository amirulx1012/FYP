<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

$station_id = $_GET['station_id'];

$sql = "select * from water w join station s ON w.station_id = s.station_id where w.date in (select MAX(w.date) FROM water w where station_id=$station_id)";
$result = $mysqli->query($sql);

$s = "select * from rescue where station_id=$station_id";
$second = $mysqli->query($s);
$another = $mysqli->query($s);

$needboat=0;
$needbus=0;

while($rowz = mysqli_fetch_assoc($another))
{
  if($rowz['transport']=='BUS')
  {
    $needbus++;
  }
  else if($rowz['transport']=='BOAT')
  {
    $needboat++;
  }
}

$cal = mysqli_query($mysqli, "select * from transportation where ID=1"); // using mysqli_query instead
$totcal = mysqli_fetch_array($cal);

$boatz = mysqli_query($mysqli, "select * from transportation where ID=2"); // using mysqli_query instead
$totbot = mysqli_fetch_array($boatz);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IFase</title>
    <link rel="shortcut icon" href="../assets/img/brand/favicon.svg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <!-- MY CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <!-- Navbar section -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
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
                </div>
                <a href="logout.php" class="btn btn-primary">Logout</a>
            </div>
        </div>
    </nav>
    <!-- Hero section -->
    <center>
    <section>
    <!-- Hero section -->
 
            <?php
                // LOOP TILL END OF DATA                   
                while($rows=$result->fetch_assoc())
                {
             ?>
                             <?php 
                            if ($rows['level'] == 'NORMAL' )
                                $whatscolor = 'badge badge-success';
                            else if ($rows['level'] == 'ALERT' )
                                $whatscolor = 'badge badge-info';
                            else if ($rows['level'] == 'WARNING' )
                                $whatscolor = 'badge badge-warning';
                            else if ($rows['level'] == 'DANGER' ||'DANGER LOW'|| 'DANGER MEDIUM' || 'DANGER HIGH')
                                $whatscolor = 'badge badge-danger';
                ?>
<center>
<div class="card w-75">
  <div class="card-header">
    <b><?php echo $rows['area']?></b>&nbsp;&nbsp;&nbsp;<button type="button" class="<?php echo $whatscolor; ?>"><?php echo $rows['level'];?></button>
  </div>
  <div class="card-body">
    <div class="card" style="width: 18rem;">
  <div class="card-header">
    Population : <?php echo $rows['population'];?>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">BUS : <td><?php echo $needbus?> (Capacity: <?php echo $totcal['capacity'];?>) </td></li>
    <li class="list-group-item">BOAT : <td><?php echo $needboat?>(Capacity: <?php echo $totbot['capacity'];?>) </td></li>
  </ul>
</div>
  </div>
</div>
</center>
<?php
                }
      ?>


<table class="table w-75">
  <thead class="thead-light">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Date</th>
      <th scope="col">Station Name</th>
      <th scope="col">Transport</th>
      <th scope="col">Pickup Location</th>
      <th scope="col">Estimated Time</th>
      <th scope="col">PPS Location</th>
      <th scope="col">Status</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
                // LOOP TILL END OF DATA
                while($row = mysqli_fetch_assoc($second))
                {
             ?>
    <tr>
      <th scope="row"><?php echo $row['rescue_id']?></th>
      <td><?php echo $row['date']?></td>
      <td><?php echo $row['rescue_place']?></td>
      <td><?php echo $row['transport']?></td>
      <td><?php echo $row['rescue_location']?></td>
      <td><?php echo $row['time']?></td>
      <td><?php echo $row['pps_name']?></td>
      <td><?php echo $row['status']?></td>
      <td><a href="updateres.php?rescue_id=<?php echo $row["rescue_id"];?>"><button type="button" class="btn btn-info">Edit</button></a></td>
    </tr>
    <?php
                }
            ?>
  </tbody>

</table>
</section>

<!-- TRIP  -->
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

<!--Testing-->



</html>