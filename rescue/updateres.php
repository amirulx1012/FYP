<?php

	include ('connectionRescue.php');

 $rescue_id = $_GET['rescue_id'];

  $query2 = mysqli_query($link, "SELECT * FROM rescue WHERE rescue_id = '$rescue_id'");

	$row = mysqli_fetch_array($query2);   

  $sql = "SELECT * FROM `pps`";
  $pps = mysqli_query($link,$sql);

    
	if (isset($_POST['submit']))
	{
    //Terima DATA
		$rescue_location = $_POST['rescue_location'];
		$time = $_POST['time'];
		$status = $_POST['status'];
		$pps_id = $_POST['pps_id'];
		$no_victim = $_POST['no_victim'];

    //if status received= completed


    //Kena check cukup ke tak and if status received=rescue coming
    $query2= mysqli_query($link, "SELECT curr_cap FROM pps WHERE pps_id = '$pps_id'");
    $fetch = mysqli_fetch_array($query2);
  	$cap = $fetch['curr_cap'];

    $query4= mysqli_query($link, "SELECT pps_capacity FROM pps WHERE pps_id = '$pps_id'");
    $fetch4 = mysqli_fetch_array($query4);
  	$sedia = $fetch4['pps_capacity'];

    $available = $sedia - $cap;

    if($no_victim <= $available)
    {
    $victim = $cap + $no_victim;
    $query2= "UPDATE `pps` SET `curr_cap`='$victim' WHERE pps_id=$pps_id";
    $yap = mysqli_query($link,$query2);    

    //Kalau Semua PASS
    $query1= mysqli_query($link, "SELECT pps_name FROM pps WHERE pps_id = '$pps_id'");
    $fetch1 = mysqli_fetch_array($query1);
  	$namapps= $fetch1['pps_name'];
		$query3 = mysqli_query($link, "UPDATE `rescue` SET `rescue_location`='$rescue_location',`status`='$status',`time`='$time',`pps_id`='$pps_id',`pps_name`='$namapps',`no_victim`='$no_victim' WHERE rescue_id=$rescue_id");
    
    
    echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Update Sucessfully');
    window.location.href='updateres.php?rescue_id=$rescue_id';
     </SCRIPT>");
    }

    else if($no_victim > $available){
      echo ("<SCRIPT LANGUAGE='JavaScript'>
      window.alert('Please Choose Other PPS');
      window.location.href='updateres.php?rescue_id=$rescue_id';
       </SCRIPT>");
    }


	}

?>
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

        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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
</body>

<section>
<center>
<form class="w-50" method="post">
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">ID</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="rescue_id" placeholder="<?php echo $row['rescue_id']; ?>" disabled>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Area</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="rescue_area" placeholder="<?php echo $row['rescue_place']; ?>" disabled>
    </div>
  </div>  
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Transport</label>
    <div class="col-sm-3">
      <input type="text" class="form-control" name="transport" placeholder="<?php echo $row['transport']; ?>" disabled>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Pickup Location</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="rescue_location" value="<?php echo $row['rescue_location']; ?>" placeholder="<?php echo $row['rescue_location']; ?>">
    </div>
  </div>

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label" >Status</label>
    <div class="col-sm-10">
    <select class="form-select" aria-label="Default select example" name="status">
        <option selected><?php echo $row['status']; ?></option>
        <option value="Rescue Coming">Rescue Coming</option>
        <option value="Completed">Completed</option>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Estimated Time</label>
    <div class="col-sm-10">
    <input type="time" name="time" value="<?php echo $row['time']; ?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">PPS</label>
    <div class="col-sm-10">
    <select class="form-select" aria-label="Default select example" name="pps_id">
    <?php
                // use a while loop to fetch data
                // from the $all_categories variable
                // and individually display as an option
                while ($category = mysqli_fetch_array(
                        $pps,MYSQLI_ASSOC)):;

                $available = $category['pps_capacity'] - $category['curr_cap'];
            ?>
                <option value="<?php echo $category["pps_id"];?>">
                    <?php echo $category['pps_name']?>  (Capacity: <?php echo $available?>)
                </option>
            <?php
                endwhile;
                // While loop must be terminated
            ?>
        </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">No of Victim</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="no_victim" value="<?php echo $row['no_victim']; ?>" placeholder="<?php echo $row['no_victim']; ?>">
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-10">
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
<center>
</section>