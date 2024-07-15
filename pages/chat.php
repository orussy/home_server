<?php
session_start();
$connect= new mysqli ('localhost','root','','home server'); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }
  $user = $_SESSION["email"];
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
$query = "SELECT * FROM accounts WHERE email != '$user'";
$result = mysqli_query($connect, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../style/mainbody.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="icon" href="../img/russia logo.png">
    <title>aa</title>
    <style>
      .byt{
     padding-left: 70px;
     color: white;
     }
      header{
        margin-top: -75px;
      }
      header h5{
        color: white;
        margin-right: 30px;
        font-size: 15px;
        
      }
      .nav a{
        margin-left:-20px;
        margin-top: 2px;
        
      }
      .login a{
        margin-left:150px;
        margin-top: 2px;
      }
      .nav i{
        color: white;
        font-size: 20px;
        transition: 0.3s;
      }
      .nav i:hover{
        color: black;
      }
      .nav{
        height: 30px;
       margin-right: 40px;
        display: inline-flex;
      }
      .up , .up1{
        margin-top: 20px;
        margin-bottom: 20px;
      }
      header {
        background-color: #212121;
        margin-left: 300px;
        width: 80%;
        height: 75px;
        position: fixed;
        z-index: 1000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        filter: drop-shadow(25px 5px 15px);
     }
     .up a {
        text-decoration: none;
        font-size: 20px;
        color: white;
        margin-left: 20%;
        transition: 0.4s ease;
     }
     .up i,.up1 i {
        font-size: 20px;
        padding-left: 9px;
        transition: 0.01s ease;
     }
     .up a:hover,.up i:hover{
        color: black;
     }
     .sidebar{
        margin-top: -75px;
     }
     .sidebar hr{
        opacity: 20%;
     }
     .up1 a{
        text-decoration: none;
        color: black;
        margin-left: 20%;
        font-size: 20px;
        transition: 0.4s ease;
      }
      .main{
        margin-top: 75px;
        margin-left: 300px;
        padding-bottom: 315.5px;
     }
     .content{
        display: flex;
        justify-content: center;
        flex-direction: row;
        flex-wrap: wrap;
     }
     .pro{
        width: 19em;
        box-shadow: 0 2px 20px rgba(1 1 1/200);
        border-radius: 10px;
        margin: 40px;
        transition: 0.7s ease;
        background-color: #212121;;
      }
      .pro  {
        display: flex;
        justify-content: center;
        padding-bottom: 30px;
        width: 19em;
        height: 14em;
        border-radius: 10px;
      }
      .info{
        padding-top: 40px;
        text-align: center;
     }
     .pro .info h4{
        color: white;
        font-size: 1em;
        font-weight: 700;
        display:flex;
        padding-bottom:10px ;
        justify-content: center;
      }
      .pro .info a{
        color: white;
        padding-top: 50px;
        text-decoration: none;  
        padding: right 55% ;
        padding-bottom: 10px;
        transition: 0.2s ease;
        padding-right: 30px;
     }
     .info a:hover{
        color: black;
     }
     .pro:hover{
        transform: scale(1.1);
     }
     .pro .info button{
        background-color: #212121;
        border: none;
        color: white;
        transition: 0.2s ease;
     }
     .pro .info button:hover{
        cursor: pointer;
        color: black;
     }
     .storage{
      margin-top: 200px;
      margin-left: 40px;
     }
     .storage h5{
        margin-left: 30px;
        color: white;
     }
     .share a{
        color: white;
        text-decoration: none;
        padding:26px 28px 25px 20px;
        transition: 0.7s ease;
     }
     .share .act{
        color: white;
        text-decoration: none;
        padding:26px 28px 25px 20px;
        transition: 0.7s ease;
        background-color: #171717;
     }
     .share a:hover{
        background-color: #171717;
     }
     .acc{
        padding-bottom: 480px;
        margin-right: 20px;
     }
     .cont{
        padding-top: 20%;
        padding-left: 20%;
     }
     .cont form select{
        background-color: #313131;
        border: none;
        border-bottom: 1px solid gray;
        color: white;
        padding: 10px;
     }
     .cont form select option{
        color: black;
        background-color: white;
     }
     .cont form input[type="file"]{color: white;}
     .cont form input[type="file"]::file-selector-button{
        margin-left: 60px;
        margin-right: 20px;
        padding: 20px;
        color: white;
        border: none;
        border-radius: 20px;
        background-color: #171717;
        transition: 0.5s ease;
     }
     .cont form input[type="file"]::file-selector-button:hover{
        cursor: pointer;
        background-color: black;
     }
     .cont form button{
        margin-left: 50px;
        padding: 20px;
        color: white;
        background-color: #171717;
        border: none;
        border-radius: 20px;
        transition: 0.5s ease;
     }
     .cont form button:hover{
        cursor: pointer;
        background-color: black;
     }
     #chat-box {
            width: 700px;
            box-shadow: rgba(0, 0, 0, 0.3) 0px 0px 0px 3px; 
            height: 500px;
            overflow-y: auto;
            border: none;
        }
        ::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
        .contain{
         
         
         padding-top: 30px;
         padding-left: 90px;
        }
        .contain form input{
         border: none;
         outline: none;
         margin-top: 30px;
         width: 700px;
         height: 50px;
         border-radius: 15px;
         margin-left: -10px;
         background-color: #171717;
         color: white;
        }
        .contain form button{
         padding: 13px;
         border: none;
         border-radius: 30px;
         transition: 0.3s ease;
        }
        .contain form button i{
         font-size: 15px;
         transition: 0.2s ease;
        }
        .contain form button:hover{
         background-color: black;
         color: white;
        }
    </style>
</head>
<body>
    <header>
    <div class="share"> 
        <a  href="#">Send</a>
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
         <div class="contain">
      <div id="chat-box"></div>
      <form id="message-form">
        <?php


        // Echo the session username into a JavaScript variable
        echo '<input type="hidden" id="username" value="' . $_SESSION["email"] . '">';
        echo '<input type="hidden" id="reciver" value="' . $_GET['user']. '">';



        ?>
        <input type="text" id="message-input" placeholder="Type your message...">
        <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
    </form>
    </div>
      </section>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to fetch messages
            function fetchMessages() {
    var username = $('#username').val().trim();
    var receiver = $('#reciver').val().trim(); // Get the recipient's username

    $.ajax({
        url: 'get_messages.php',
        type: 'GET',
        data: { sender: username, receiver: receiver }, // Pass sender and receiver usernames
        success: function(response) {
            $('#chat-box').html(response); // Update chat-box with new messages
            // Scroll to bottom
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}


            // Call fetchMessages every 2 seconds
            setInterval(fetchMessages, 2000);

            // Handle form submission (sending messages)
            $('#message-form').submit(function(event) {
                event.preventDefault(); // Prevent default form submission

                var username = $('#username').val().trim();
                var reciver=$('#reciver').val().trim();
                var message = $('#message-input').val().trim();

                // Check if username and message are not empty
                if (username !== '' && message !== '') {
                    $.ajax({
                        url: 'send_message.php',
                        type: 'POST',
                        data: { username: username,reciver: reciver ,message: message },
                        success: function(response) {
                            // Optionally, do something after successfully sending message
                            $('#message-input').val(''); // Clear input field
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>