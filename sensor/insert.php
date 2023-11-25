<?php

// Database connection parameters
$dbhost = 'localhost';
$dbuser = 'admin';
$dbpass = 'adminpass';
$dbname = 'ifase';

// Create a new mysqli connection
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check the connection
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Get data from the POST request
$station = isset($_POST["station"]) ? $_POST["station"] : null;
$reading = isset($_POST["reading"]) ? $_POST["reading"] : null;
$level = isset($_POST["level"]) ? $_POST["level"] : null;

// Insert data into the database
$query = "INSERT INTO water (station_id, reading, level) VALUES ('$station', '$reading', '$level')";
$result = mysqli_query($mysqli, $query);

// Check if the insertion was successful
if ($result) {
    echo "Data Inserted Successfully!";
} else {
    echo "Error: " . mysqli_error($mysqli);
}

// Close the database connection
$mysqli->close();

?>
