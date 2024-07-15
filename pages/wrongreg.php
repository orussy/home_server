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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/costumerlog.css">
    <link rel="stylesheet" href="../style/all.min.css">
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="icon" href="../img/russia logo.png">


    <title>Registration</title>
  
</head>
<body>
    
<section class="main">
    <div class="gfq">
            <h1>Registration </h1>
        <form action="reg.php" method="post">
                    <div class="row">
                    <div class="col-sm-6">
                    <div class="form-group">
                    <span class="form-label" style="color: white;">First Name</span>
                    <input class="form-control" type="text" name="FirstName"id="FirstName" placeholder="Enter your name" required>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="form-group">
                    <span class="form-label" style="color: white;">Last Name</span>
                    <input class="form-control" type="text" name="lastname" placeholder="Enter your email" required>
                    </div>
                    </div>
                    </div>
                    <br>
                    <div class="gend">
                        <span class="form-label"  style="color:white;">Gender</span>
                        <span class="typ"><input type="radio" value="male" name="gender"><label for="">Male</label> </span>
                       <span class="typ"><input type="radio" value="female" name="gender"> <label for="">Female</label></span>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                    <span class="form-label"  style="color: white;">Phone</span>
                    <input class="form-control" name="phonenumber" type="tel" placeholder="Enter phone-num" required>
                    </div>
                </div>
                
                </div>
                <br>
                <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                    <span class="form-label"  style="color:white;">Email</span>
                    <input class="form-control" name="email" type="email" placeholder="Enter your email" required>
                    </div>
                </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                    <span class="form-label"  style="color: white;">Password</span>
                    <input class="form-control" name="password" type="password" placeholder="Enter Password" required>
                    </div>
                    <div class="col-sm-6">
                        <span class="form-label" style="color:white;">Re-Type Password</span>
                        <input class="form-control"  type="password" placeholder="Enter Password" required>
                    </div>
                </div>
                <br>
                    <div class="row">
                    <div class="col-12">
                    <div class="form-group">
                    <span class="form-label" style="color:white;"> Birthdate</span>
                    <input class="form-control" name="dateofbirth"  type="date" required>
    
                    
                    </div>
                
                    </div>
                    </div>
                    <div class="signUp">
                        <button type="submit" name="upload">submit</button>
                    </div>
    </form>
    <div class="wron"><h3>account is exisiting</h3></div>
</div>

</section>

</div>
</body>