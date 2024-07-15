<?php
session_start();
$host = "localhost"; // MySQL host
$username = "root"; // MySQL username
$password = ""; // MySQL password
$database = "home server"; // MySQL database name

// Create connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
