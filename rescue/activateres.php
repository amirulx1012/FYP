<?php

$dbname = 'ifase';
$dbuser = 'admin';  
$dbpass = 'adminpass'; 
$dbhost = 'localhost'; 
$mysqli = new mysqli($dbhost, $dbuser,$dbpass, $dbname);

include 'connectionRescue.php';

$station_id = $_GET['station_id'];

$sql = "select * from water w join station s ON w.station_id = s.station_id where w.date in (select MAX(w.date) FROM water w where station_id=$station_id)";
$result = $mysqli->query($sql);

$cal = mysqli_query($mysqli, "select * from transportation where ID=1"); // using mysqli_query instead
$totcal = mysqli_fetch_array($cal);

$boatz = mysqli_query($mysqli, "select * from transportation where ID=2"); // using mysqli_query instead
$totbot = mysqli_fetch_array($boatz);

// LOOP TILL END OF DATA                   
while($rows=$result->fetch_assoc())
{
    // check if water level is okay
        if ($rows['level'] == 'DANGER MEDIUM' or $rows['level']== 'DANGER LOW' )
        {
        //bus
                $resident=$rows['population'];
                $needbus= $resident/$totcal['capacity'];
                $needboat =0;
                $transport = 'BUS'; 
                $place = $rows['area'];
        }
        else if ($rows['level']=='DANGER HIGH')
        {
        //boat
                $resident=$rows['population'];
                $needboat= $resident/$totbot['capacity']; 
                $needbus=0;
                $transport = 'BOAT'; 
                $place = $rows['area'];
        }
        if($transport=='BUS' and $rows['rescue_stat']=='true')
        {
            $del= "DELETE FROM `rescue` WHERE station_id=$station_id";
            $yapi = mysqli_query($mysqli,$del);
            $count=0;
            while($count<$needbus and $rows['rescue_stat']=='true')
            {
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                    $query = "INSERT INTO rescue (station_id,rescue_place,transport,pps_name,status) VALUES ($station_id,'$place','$transport','Not Selected','Pending')";
                    $rem = mysqli_query($mysqli,$query);
                    $count++;    
            }
            $que= "UPDATE station SET rescue_stat='false' WHERE station_id=$station_id";
            $yap = mysqli_query($mysqli,$que);
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Sucessfully Activate Rescue');
            window.location.href='index.php';
            </SCRIPT>");

        }
        else if($transport=='BOAT' and $rows['rescue_stat']=='true')
        {
            $del= "DELETE FROM `rescue` WHERE station_id=$station_id";
            $yapi = mysqli_query($mysqli,$del);
            $count=0;
            while($count<$needboat and $rows['rescue_stat']=='true')
            {
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
                $query = "INSERT INTO rescue (station_id,rescue_place,transport,pps_name,status) VALUES ($station_id,'$place','$transport','Not Selected','Pending')";
                    $rem = mysqli_query($mysqli,$query);
                    $count++;    
            }            
            $que= "UPDATE station SET rescue_stat='false' WHERE station_id=$station_id";
            $yap = mysqli_query($mysqli,$que);

            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Sucessfully Activate Rescue');
            window.location.href='index.php';
            </SCRIPT>");
        }
        else{
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            echo ("<SCRIPT LANGUAGE='JavaScript'>
            window.alert('Failed to Activate Rescue!');
            window.location.href='index.php';
            </SCRIPT>");
        }
}


?>