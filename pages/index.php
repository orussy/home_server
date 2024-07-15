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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/all.min.css">
    
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="icon" href="../img/russia logo.png">
    <title>Login</title>
</head>

<body>
    <header class="head">
        <img src="../img/russia logo.png" width="90px">
        <h3>Welcome</h3>
        </div>
      </header>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#212121" fill-opacity="1" d="M0,160L48,160C96,160,192,160,288,138.7C384,117,480,75,576,74.7C672,75,768,117,864,117.3C960,117,1056,75,1152,80C1248,85,1344,139,1392,165.3L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path></svg>
    <div class="container">
        <div class="box">
            <h1>Login</h1>
            <div class="fc">
            <div class="face">
          <div class="eye">
            <div class="eye-blink-upper"></div>
            <div class="eye-blink-lower"></div>
          </div>
          <div class="eye">
            <div class="eye-blink-upper"></div>
            <div class="eye-blink-lower"></div>
          </div>
          <div class="mouth"></div>
        </div>
            </div>
            <form action="index.php" method="post">
                <label>Username</label>
                <div>
                    <i class="fa-solid fa-user"></i>
                    <input type="text" name="email" placeholder="Enter Email" require>
                </div>
                <label>Password</label>
                <div>
                    <i class="fa-solid fa-lock"></i>
                    <input class="Password" type="password" name="Password" placeholder="Enter password" require>
                </div>
                <input type="submit" name="submit" value="login">
            </form>
            <div class="signup"><a href="registeration.php" class="signUp">Sign up</a></div>
            <?php
            if(isset($_POST["submit"])){
                $email=$_POST["email"];
                $Password=$_POST["Password"];
                $query="SELECT * FROM accounts WHERE email  ='$email'";
                $res=mysqli_query($connect,$query);
                $row=mysqli_fetch_array($res);
                $hashpass=$row['password'];
                if(is_array($row)){
                    $_SESSION["email"]=$row['email'];
                    if(password_verify($Password,$hashpass)){
                      $name=$row['email'];
                      if(isset($_SESSION["email"]))
                {
                  
                  if($row['priority']=="1"){
                    header("location: admin/mainadmin.php");
                    }
                    else{
                        header("location: main.php");
                    }
                }
                  }else{
                      echo '<div class="wron"><p>Email or Password invalid</p></div>';
                  }
                }
                else{
                    echo '<div class="wron"><p>Email or Password invalid</p></div>';
                }
                
            }
        
       
            ?>
        </div>
    </div>
    <div class="error">
    </div>
    <script>
        const eyeBlinkUpper = document.querySelectorAll(".eye-blink-upper");
        const eyeBlinkLower = document.querySelectorAll(".eye-blink-lower");
        const passwordInput = document.querySelector(".Password");
        passwordInput.addEventListener("focus", function () {
          eyeBlinkUpper[0].style.transform = "translateY(-60%)";
          eyeBlinkUpper[1].style.transform = "translateY(-60%)";
          eyeBlinkLower[0].style.transform = "translateY(60%)";
          eyeBlinkLower[1].style.transform = "translateY(60%)";
        });
        passwordInput.addEventListener("focusout", function () {
          eyeBlinkUpper[0].style.transform = "translateY(-100%)";
          eyeBlinkUpper[1].style.transform = "translateY(-100%)";
          eyeBlinkLower[0].style.transform = "translateY(100%)";
          eyeBlinkLower[1].style.transform = "translateY(100%)";
        });
        
        </script>
</body>

</html>

