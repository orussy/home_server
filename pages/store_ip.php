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


if(isset($_POST['ip'])) {
    $email=$_SESSION['email'];
    $userIP = $_POST['ip'];
    $query="insert into log(`ip-address`,user name)VALUES('$userIP','$email')";
    mysqli_query($conn,$query);
    // Process the IP address (e.g., store it in a database)

    // Send confirmation message back to JavaScript
    
} else {
    // Handle case where "ip" key is not set
    
}
?>
