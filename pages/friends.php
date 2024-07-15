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
    <link rel="stylesheet" href="../style/share.css">
    <title>ORDRIVE</title>
    <style>
      
    
    </style>
</head>
<body>
    <header>
    <div class="share"> 
        <a  href="share.php">Send</a>
        <a href="requests.php">Requests</a>
        <a class="act" href="">Friends</a>
        <a href="handle_requests.php">Friends Requests</a>
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
        if (!$result) {
            echo "Error executing query: " . mysqli_error($conn);
        } else {
            // Display users and add button for each user
           
            while ($row = mysqli_fetch_assoc($result)) {
                $userIdQuery = "SELECT id FROM accounts WHERE email = '$user'";
                $userIdResult = mysqli_query($connect, $userIdQuery);
                $userIdRow = mysqli_fetch_assoc($userIdResult);
                $userId = $userIdRow['id'];
                $friendId = $row['id'];
        
                if (isFriendRequestSent($connect, $userId, $friendId)) {
                 
                    if (isFriend($connect, $userId, $friendId)) {
                       
                        echo "<div class='acc'><i class='fa-solid fa-user'></i><a href='chat.php?user={$row['email']}'>{$row['email']}</a> <span> Friend</span><hr></div>";
                    } else {
                        
                        echo "<div class='acc'><i class='fa-solid fa-user'></i><span c;ass='req'>{$row['email']}</span><span>Friend request already sent</span><hr></div>";
                    }
                } else {
                    
                    echo "<div class='acc'><i class='fa-solid fa-user'></i><span class='re'>{$row['email']} </span><form method='post' action='send_request.php'>
                          <input type='hidden' name='friend_id' value='{$row['id']}'>
                          <button type='submit' name='send_request'>Send Request</button>
                          </form><hr></div>";
                }
            }
        }
      }
        ?>

      </section>
      
</body>
</html>