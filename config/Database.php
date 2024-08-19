<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "fdb1028.awardspace.net";
$username = "4517663_scandiweb";
$password = "marwan25.";
$dbname = "4517663_scandiweb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

// Connection successful
// No need to die() after a successful connection
?>
