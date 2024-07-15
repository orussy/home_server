<?php
// Include database configuration
include 'db_config.php';

// Get sender and receiver usernames from GET request
$sender = $_GET['sender'];
$receiver = $_GET['receiver'];

// Fetch messages between sender and receiver from the database
$query = "SELECT * FROM messages WHERE (username = '$sender' AND reciver = '$receiver') OR (username = '$receiver' AND reciver = '$sender') ORDER BY timestamp ASC";
$result = mysqli_query($conn, $query);
function decryptMessage($encryptedMessage, $secretKey) {
    $ivLength = openssl_cipher_iv_length('AES-128-CBC');
    $iv = substr($secretKey, 0, $ivLength); // Use the first 16 bytes of the secret key as the IV
    return openssl_decrypt($encryptedMessage, 'AES-128-CBC', $secretKey, 0, $iv);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
       .sender {
        padding-right: 10px;
        width: auto;
        background-color:#171717;
        border-radius: 20px 20px 0px 20px ;
        max-width: 355px;
        margin-left: 309px;
        text-align: right; /* Position sender's messages on the right */
        display: block;
        margin-bottom: 10px;
        color: white;
    }

    .receiver {
        padding-left: 10px;
        padding-right: 10px;
        
        width: auto;
        max-width: 355px;
        background-color:#4682b4;
        border-radius: 20px 20px 20px 0px ;
        margin-bottom: 10px;
        margin-left: 20px;
        text-align:left;
         /* Position receiver's messages on the left */
    }

    .time {
        font-size: 10px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .message {
        
        
        height: auto; /* Adjust height automatically based on content */
        
        overflow-wrap: break-word; /* Wrap long words within the message box */
        padding: 5px; /* Add padding to the message box */
    }
    </style>
</head>
<body>

    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        $decryptedMessage = decryptMessage($row['message'], $row['secret_key']);
        $class = ($row['username'] === $sender) ? 'sender' : 'receiver';

        // Output the message with the appropriate class
        echo '<div class="' . $class . '"><strong>' . '</strong> <div class="message">' . $decryptedMessage . '</div><span class="time"> ' . $row['timestamp'] . '</span></div>';
    }

    // Close database connection
    mysqli_close($conn);
    ?>
<!-- Empty div to fix scrollbar position -->

</body>
</html>
