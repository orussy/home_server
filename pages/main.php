<?php
session_start();
if(isset($_SESSION['email'])){
$folder = '../uploads/'.$_SESSION['email'];
$files = scandir($folder);
}
  error_reporting(E_ERROR | E_PARSE);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../style/mainbody.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="icon" href="../img/russia logo.png">
    <title>ORDRIVE</title>
    
</head>
<body>
    <header>
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
        <div class="up1"><a href="#"> MY FILE <i class="fa-solid fa-file"></i></a></div>
        <hr>
        <div class="up"><a href="upload.php">UPLOAD<i class="fa-solid fa-cloud-arrow-up fa-bounce"></i></a></div>
        <hr>
        <div class="up"><a href="share.php"> Send <i class="fa-solid fa-paper-plane fa-bounce"></i></a></div> 
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
      <div class="content">
<?php
if(isset($_SESSION['email'])){
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
      $path = realpath($folder . '/' . $file);
      $type = is_dir($path) ? 'Folder' : pathinfo($path, PATHINFO_EXTENSION) . ' File';
      $size = is_dir($path) ? '-' : round(filesize($path) / 1024, 2) . ' KB';
       $folder."/".$file;
      echo'<div class="pro">
      <div class="info">
          <h4>Name: '.$file.'</h4>
          <h4>Type: '.$type.'</h4>
          <h4>Size: '.$size.'</h4>
          <form action=" main.php" method="post">
          <a href="'.$folder."/".$file.'"><i class="fa-solid fa-download"></i></a>
          
          <button name="del" value="'.$file.'"><i class="fa-solid fa-trash"></i></button>
          </form>
      </div>
      </div>';
      
    }
  }
  if(isset($_POST['del'])){
    $file_path = $folder."/".$_POST['del'];

if (file_exists($file_path)) {
if (unlink($file_path)) {
  echo'<script>location.reload();</script>';
}
else {
    echo "Error deleting file.";
}

}
  }
  
}
else{
}
?>

    </div>
      </section>
      
</body>
</html>