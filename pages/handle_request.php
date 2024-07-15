<?php
include 'db_config.php';

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['accept_request'])) {
    $senderId = $_POST['sender_id'];
    $requestId = $_POST['request_id'];

    // Update the status in the database from "pending" to "accepted"
    $updateQuery = "UPDATE friendships SET status = 'accepted' WHERE id = '$requestId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header("location:handle_requests.php");
    } else {
        echo "Error accepting friend request: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request!";
}

// Close connection
mysqli_close($conn);
?>
