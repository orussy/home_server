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
        margin-left: 75%;
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
    </style>
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
        <div class="up"><a href="main.php"> MY FILE <i class="fa-solid fa-file fa-bounce"></i></a></div>
        <hr>
        <div class="up"><a href="upload.php">UPLOAD<i class="fa-solid fa-cloud-arrow-up fa-bounce"></i></a></div>
        <hr>
        <div class="up"><a href="share.php"> Send <i class="fa-solid fa-paper-plane fa-bounce"></i></a></div> 
        <hr>
        <div class="up1"><a href="#">Account Settings <i class="fa-solid fa-gear"></i></a></div>
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
      
      </section>
      
</body>
</html>