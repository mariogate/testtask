<?php
$servername = "scandiweb.cxoysus80pjy.eu-north-1.rds.amazonaws.com";
$username = "root";
$password = "Deathisnear7";
$dbname = "newschema";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}die("Connection failed: " . $conn->connect_error);

?>