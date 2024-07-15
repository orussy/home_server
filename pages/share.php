<?php
session_start();
$connect= new mysqli ('localhost','root','','home server'); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
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
    
</head>
<body>
    <header>
    <div class="share"> 
        <a class="act" href="#">Send</a>
        <a href="requests.php">Requests</a>
        <a href="friends.php">Friends</a>
        <a href="handle_requests.php">Friends Requests</a>
    </div>
    <div class="nav"><?php
    if(isset($_SESSION['email'])){
     echo '<h5>'.$_SESSION['email'].'</h5>'.'<a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></a></div>';}
     else{
      echo '</div><div class="login"><a href="index.php"><i class="fa-solid fa-right-to-bracket fa-bounce"></i></a></div>';
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
        <?php if(isset($_SESSION['email'])){?>
        <div class="cont">
        <form action="share.php" method="post" enctype="multipart/form-data">
            <select name="user">
                <?php
                $qur="select * from accounts";
                $res=mysqli_query($connect, $qur);
                if($res){
                    if(mysqli_num_rows($res)>0){
                    while($row=mysqli_fetch_assoc($res)){
                echo'
                <option value="'.$row['email'].'">'.$row['email'].'</option>';
                    }
                    }
                }
                ?>
            </select>
            <input type="file" name="file">
            <button type="submit" name="sub">UPLOAD</button>
            <?php
          }
          ?>
        </form>
        </div>
        <?php
        if(isset($_POST['sub'])){
            $recever=$_POST['user'];
            $sender=$_SESSION['email'];
            $folderName = "../temp/".$recever.$sender;
            
            if (!file_exists($folderName)) {
                mkdir($folderName, 0777, true);
                
            } 
            $file=$_FILES['file'];
    $filename=$_FILES['file']['name'];
    $fileTmpName=$_FILES['file']['tmp_name'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fileType=$_FILES['file']['type'];

    $fileext=explode('.',$filename);
    $fileactual = strtolower(end($fileext));

    $allowed =array('jpg','jpeg','png','zip','rar','xps','xltx','xlt','xlsx','xls','xlm','xll','xlam','xla','wpd','wp5','wmz','wms','wmv','wmd','wma','wks','wbk','wav','vstm','vst','vssm','vss','vsdm','vsd','vob','txt','tmp','tif','tiff','sys','swf','sldx','sldm','rtf','pub','pst','psd','pptx','pptm','ppt','ppsx','ppsm','pps','ppam','potx','potm','pot','pdf','mui','msi','mpg','mpeg','mp4','mp3','mov','mid','midi','mdb','m4a','jar','iso','ini','htm','html','gif','flv','exe','eps','eml','dotx','dot','docx','docm','doc','dll','dif','csv','cda','cab','css','php','js','ova','bmp','bin','bat','avi','aspx','aif','aifc','aiff','accdt','accdr','accde','accdb','aac','adt','adts');

    if(in_array($fileactual,$allowed)){
        if($fileError===0){
                 $fileNameNew =uniqid('',true).".".$fileactual;
                 $folder = '../temp/'.$recever.$sender;
                 $files=scandir($folder);
                 $temp=rand();
                 foreach($files as $file){
                  if($file===$filename)
                  {
                    $temp+=1;
                    $fileDest = '../temp/'.$recever.$sender.'/'.$temp.$filename;
                    move_uploaded_file($fileTmpName,$fileDest);
                    exit;
                  }

                 }

                  $fileDest = '../temp/'.$recever.$sender.'/'.$filename;
                 move_uploaded_file($fileTmpName,$fileDest);
        }else{
            echo"error2";
        }
    }
    
            $qeury="insert into requests (`sender`,`reciver`,`filepath`)values('$sender','$recever','$fileDest')";
            mysqli_query($connect,$qeury);
        }
        ?>
      </section>
      
</body>
</html>