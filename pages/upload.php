<?php
session_start();
$connect= new mysqli ('localhost','root','','home server'); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
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
    <link rel="stylesheet" href="../style/upload.css">
    <title>ORDRIVE</title>
    <style>
       
    </style>
</head>
<body>
    <header>
    <div class="nav">
      <?php 
      if(isset($_SESSION['email'])){
    echo '<h5>'.$_SESSION['email'].'</h5>'.'<a href="logout.php"><i class="fa-solid fa-right-from-bracket" ></i></a></div>';}
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
        <div class="up"><a href="main.php"> MY FILE <i class="fa-solid fa-file fa-bounce" ></i></a></div>
        
        <hr>
        <div class="up1"><a href="#">UPLOAD<i class="fa-solid fa-cloud-arrow-up" ></i></a></div>
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
        <?php
        if(isset($_SESSION['email'])){?>
        <form id="uploadForm" enctype="multipart/form-data">
          <input type="file" name="file" id="fileInput">
          <button type="submit" name="submit" >UPLOAD</button>
          <div class="qw"><div id="myProgressBar"><h3 id="done">Done</h3></div></div>
        </form>
        <?php
        }
        ?>
        <?php
         error_reporting(0);
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
                 $folder = '../uploads/'.$_SESSION['email'];
                 $files=scandir($folder);
                 $temp=rand();
                 foreach($files as $file){
                  if($file===$filename)
                  {
                    $temp+=1;
                    $fileDest = '../uploads/'.$_SESSION['email'].'/'.$temp.$filename;
                    move_uploaded_file($fileTmpName,$fileDest);
                    exit;
                  }

                 }

                  $fileDest = '../uploads/'.$_SESSION['email'].'/'.$filename;
                 move_uploaded_file($fileTmpName,$fileDest);
        }else{
            echo"error2";
        }
    }
    
?>
        <script>
          // Get references to the necessary elements
  const progressBar = document.getElementById('myProgressBar');
  const uploadForm = document.getElementById('uploadForm');
  const done=document.getElementById('done')
  // Listen for the form submission event
  uploadForm.addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Create a new FormData object to store the file data
    const formData = new FormData(uploadForm);
    
    // Create a new XMLHttpRequest object
    const xhr = new XMLHttpRequest();
    
    // Set up the progress event listener
    xhr.upload.addEventListener('progress', function(event) {
      if (event.lengthComputable) {
        // Calculate and update the progress percentage
        const progressPercentage = Math.round((event.loaded / event.total) * 100);
        progressBar.style.width = progressPercentage + '%';
      }
    });
    
    // Set up the load event listener
    xhr.addEventListener('load', function() {
      progressBar.style.width = '100%';
      done.style.display='block';
    });
    
    // Set up the error event listener
    xhr.addEventListener('error', function() {
      console.log('An error occurred during the file upload.');
    });
    
    // Set up the abort event listener
    xhr.addEventListener('abort', function() {
      console.log('The file upload was aborted.');
    });
    
    // Open and send the AJAX request
    xhr.open('POST', 'upload.php'); // Replace 'upload.php' with the actual URL to your server-side upload script
    xhr.send(formData);

  });
 

        </script>
        
      </section>
</body>
</html>