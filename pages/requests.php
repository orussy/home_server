<?php
session_start();
$connect= new mysqli ('localhost','root','','home server'); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }
  if(isset($_SESSION['email'])){
  $reciver=$_SESSION['email'];
  $senderarray=array();
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
        <a class="act" href="#">Requests</a>
        <a href="friends.php">Friends</a>
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
        <div class="up1"><a href="#"> Send <i class="fa-solid fa-paper-plane "></i></a></div> 
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
        ?>
        <div class="contener">
        <?php
          $quer="SELECT * FROM requests where reciver='$reciver'";
          $reslut=mysqli_query($connect,$quer);
          if($reslut){
            if(mysqli_num_rows($reslut)>0){
              while($row=mysqli_fetch_assoc($reslut)){
                
                echo'
                <div class="acca">
          <i class="fa-solid fa-user"></i>
          <H3>'. $row['sender'].'</H3>
          <h3>'.basename($row['filepath']).'</h3>
          <form action="process_request.php" method="post">
            <input type="text" name="request_id" value="' . $row['id'] . '">
            <input type="hidden" name="filepath" value="' . $row['filepath'] . '";>
          <button  type="submit" name="action" value="accept">Accept</button>
          <button type="submit" name="action" value="reject">Reject</button>
          </form>
          </div>
          <hr>
                ';
                
              }
            }
          }
          
          ?>
        </div>
        <?php
        }
        ?>
      </section>
      
</body>
</html>