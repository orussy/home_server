<?php
include 'db_config.php'; // Include database configuration
$user=$_SESSION["email"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['send_request'])) {

    $stt="SELECT * FROM accounts WHERE email='$user'";
    $res=mysqli_query($conn,$stt);
    $row=mysqli_fetch_array($res);
    if(is_array($row)){
    $userId =$row['id']; 
    }
    // Get the friend ID from the form submission
    $friendId = $_POST['friend_id'];

    function sendFriendRequest($conn, $userId, $friendId) {
        $query = "INSERT INTO friendships (user_id, friend_id, status) VALUES ('$userId', '$friendId', 'pending')";
        if (mysqli_query($conn, $query)) {
            return true;
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
            return false;
        }
    }



    if (sendFriendRequest($conn, $userId, $friendId)) {
        echo "Friend request sent successfully!";
        header("location:friends.php");
    } else {
        echo "Failed to send friend request. Please check if the user ID exists and try again.";
    }
    
    
}

// Close connection
mysqli_close($conn);
?>
