<?php
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reject_request'])) {
    // Get the sender ID and request ID from the form submission
    $senderId = $_POST['sender_id'];
    $requestId = $_POST['request_id'];
    
    // Update the status of the friend request to 'rejected'
    $updateQuery = "DELETE FROM friendships WHERE id = '$requestId'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        header("location:handle_requests.php");
    } else {
        echo "Error rejecting friend request: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>
