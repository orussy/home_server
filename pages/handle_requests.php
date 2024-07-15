<?php
session_start();
$connect= new mysqli ('localhost','root','','home server'); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }
  if(isset($_SESSION['email'])){
  $user = $_SESSION["email"];
  }
  function fetchFriends($connect, $userId) {
    $query = "SELECT u.username FROM friendships f INNER JOIN users u ON f.friend_id = u.id WHERE f.user_id = '$userId' AND f.status = 'accepted'";
    $result = mysqli_query($connect, $query);
    $friends = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $friends[] = $row['username'];
        }
    }
    return $friends;
}
function isFriendRequestSent($connect, $userId, $friendId) {
    $query = "SELECT * FROM friendships WHERE (user_id = '$userId' AND friend_id = '$friendId') OR (user_id = '$friendId' AND friend_id = '$userId')";
    $result = mysqli_query($connect, $query);
    return $result && mysqli_num_rows($result) > 0;
}
function isFriend($connect, $userId, $friendId) {
    $query = "SELECT * FROM friendships WHERE (user_id = '$userId' AND friend_id = '$friendId' AND status = 'accepted') OR (user_id = '$friendId' AND friend_id = '$userId' AND status = 'accepted')";
    $result = mysqli_query($connect, $query);
    return $result && mysqli_num_rows($result) > 0;

}
if(isset($_SESSION['email'])){
$query = "SELECT * FROM accounts WHERE email != '$user'";
$result = mysqli_query($connect, $query);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../style/mainbody.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="icon" href="../img/russia logo.png">
    <link rel="stylesheet" href="../style/handreq.css">

    <title>ORDRIVE</title>
</head>
<body>
    <header>
    <div class="share"> 
        <a  href="#">Send</a>
        <a href="requests.php">Requests</a>
        <a  href="friends.php">Friends</a>
        <a class="act" href="#">Friends Requests</a>
    </div>
    <div class="nav"><?php
    if(isset($_SESSION['email'])){
     echo '<h5>'.$_SESSION['email'].'</h5>'.'<a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></div>';}
     else{
      echo '<div class="login"><a href="index.php"><i class="fa-solid fa-right-to-bracket fa-bounce"></i></a></div>';
     }
     ?>
     
      
      
      
    </header> 
      <div class="sidebar">
        <div class="imge">
        <img src="../img/russia logo.png" width="90px"></div>
        <h3>ORDRIVE</h3>
        <br>
        <br>
        <hr>
        <div class="up"><a href="main.php"> MY FILE <i class="fa-solid fa-file"></i></a></div>
        <hr>
        <div class="up"><a href="upload.php">UPLOAD<i class="fa-solid fa-cloud-arrow-up fa-bounce"></i></a></div>
        <hr>
        <div class="up1"><a href="#"> Send <i class="fa-solid fa-paper-plane"></i></a></div> 
        <hr>
        <div class="up"><a href="acc_setting.php">Account Settings <i class="fa-solid fa-gear fa-bounce"></i></a></div>
        <hr>
        <div class="storage">
          <h5>Total Storage</h5>
          <progress max="15000000000" value=<?php
          function formatSizeUnits($bytes)
          {
              
                  $bytes = $bytes . ' bytes';
          
              return $bytes;
          }
          
          $dir = '../uploads/'.$_SESSION['email'];
          $size = calcFolderSize($dir);
          echo formatSizeUnits($size);
          
          function calcFolderSize($dir)
          {
              $size = 0;
              foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
                  $size += is_file($each) ? filesize($each) : calcFolderSize($each);
              }
          
              return $size;
          }
          ?>></progress>

          </div>
          <?php echo '<div class="byt">'.$size.' Byte</div>'; ?>
      </div>
      <section class="main">
      <?php
      if(isset($_SESSION['email'])){
$user = $_SESSION["email"];

// Get the user ID of the logged-in user
$userIdQuery = "SELECT id FROM accounts WHERE email = '$user'";
$userIdResult = mysqli_query($connect, $userIdQuery);
$userIdRow = mysqli_fetch_assoc($userIdResult);
$userId = $userIdRow['id'];

// Fetch incoming friend requests
$query = "SELECT * FROM friendships WHERE friend_id = '$userId' AND status = 'pending'";
$result = mysqli_query($connect, $query);

if (!$result) {
    echo "Error fetching friend requests: " . mysqli_error($conn);
} else {
    while ($row = mysqli_fetch_assoc($result)) {
        // Get the username of the user who sent the request
        $senderId = $row['user_id'];
        $senderQuery = "SELECT email FROM accounts WHERE id = '$senderId'";
        $senderResult = mysqli_query($connect, $senderQuery);
        $senderRow = mysqli_fetch_assoc($senderResult);
        $senderUsername = $senderRow['email'];

        echo "<dev class='acca'><i class='fa-solid fa-user'></i><span>$senderUsername wants to add you as a friend</span>";
        echo "<form method='post' action='handle_request.php'>
              <input type='hidden' name='sender_id' value='$senderId'>
              <button type='submit' name='accept_request'>Accept</button>
              <input type='hidden' name='request_id' value='{$row['id']}'>
              </form>";

        echo "<form method='post' action='reject.php'>
              <input type='hidden' name='sender_id' value='$senderId'>
              <button type='submit' name='reject_request'>Reject</button>
              <input type='hidden' name='request_id' value='{$row['id']}'>
              </form></dev><hr>";
    }
}

// Close connection
mysqli_close($connect);
      }
?>

      </section>
      
</body>
</html>