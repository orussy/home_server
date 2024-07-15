<?php
// Include database configuration
include 'db_config.php';
function generateSecretKey() {
    return bin2hex(openssl_random_pseudo_bytes(16)); // 16 bytes for AES-128
}
// Get username and message from POST request
$username = $_POST['username'];
$reciver=$_POST['reciver'];
$message = $_POST['message'];
$secretKey = generateSecretKey();
$encryptedMessage = openssl_encrypt($message, 'AES-128-CBC', $secretKey, 0, $secretKey);

// Insert message into database
$query = "INSERT INTO messages (username,reciver,message,secret_key) VALUES ('$username','$reciver','$encryptedMessage','$secretKey')";
$result = mysqli_query($conn, $query);

// Close database connection
mysqli_close($conn);
?>
