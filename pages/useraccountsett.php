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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <link rel="stylesheet" href="style/mainbody.css">
    <link rel="icon" href="img/russia logo.png">
    <title>Document</title>
    <style>
        header{
        margin-top: -75px;
       }
        .sidebar{
        margin-top: -75px;
       }
        .sidebar .imge img{
            
            width: 100px;
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
       .up a,.up1 a {
  
       text-decoration: none;
       font-size: 20px;
       color: white;
       margin-left: 20%;
       transition: 0.4s ease;
       }
       .up1 a{
        text-decoration: none;
        color: black;
        margin-left: 20%;
        font-size: 20px;
        transition: 0.4s ease;
  
       }
       .up , .up1{
       margin-top: 20px;
       margin-bottom: 20px;
       }
        .up a:hover,.up i:hover{
       color: black;
       }
       .main{
        margin-top: 75px;
       margin-left: 300px;

       }
      
      </style>
</head>
<body>
    <header>
        <div class="nav"><?php echo '<h5>'.$_SESSION['email'].'</h5>'.'<a href="logout.php"><i class="fa-solid fa-right-from-bracket" ></i></a>';?></div>
          
          
          
     </header> 
  <div class="sidebar">
         <div class="imge"><img src="img/russia logo.png" ></div>
            <h3>ORDRIVE</h3>
            <br>
            <br>
            <hr>
            <div class="up"><a href="upload.php">UPLOAD<i class="fa-solid fa-cloud-arrow-up fa-bounce"></i></a></div>
        <hr>
        <div class="up"><a href="#"> MY FILE <i class="fa-solid fa-file fa-bounce"></i></a></div>
        <hr>
        <div class="up1"><a href="#">Account Settings <i class="fa-solid fa-gear"></i></a></div>
        <hr>
    </div>
              <section class="main">
                
              </section>
</body>
</html>