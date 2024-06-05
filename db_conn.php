<?php
session_start(); // This starts the session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$conn_alarms = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($conn_alarms->connect_error) {
    die("Connection failed: " . $conn_alarms->connect_error);
}

// echo "Connected successfully";
?>
