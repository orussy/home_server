<?php
session_start();
$connect= new mysqli ('localhost','root','','home server'); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
    
  }
  $email=$_SESSION['email'];
  $qur="select * from accounts where email='$email'";
  $res=mysqli_query($connect,$qur);
  $row=mysqli_fetch_array($res);
  if($row['priority']!=1){
    header("Location : ../main.php");
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="../style/mainbody.css">
    <link rel="stylesheet" href="../style/addadmin.css  ">
    <link rel="icon" href="../img/russia logo.png">
    <title>ADD NEW USER</title>
</head>
<style>
      .wron{
    width: 500px;
    margin-top: 40px;
    margin-left: 240px;
    border-radius: 10px;
    background-color: red ;
    opacity: 0.7;
    text-align: center;
    color: white;
    }
   .done{
    width: 500px;
    margin-top: 40px;
    margin-left: 240px;
    border-radius: 10px;
    background-color: green ;
    opacity: 0.7;
    text-align: center;
    color: white;
    }
</style>
<body>
    <header>
 
        <div class="nav"><?php echo '<h5>'.$_SESSION['email'].'</h5>'.'<a href="../logout.php"><i class="fa-solid fa-right-from-bracket" ></i></a>';?></div>
          
          
          
     </header> 
  <div class="sidebar">
         <div class="imge"><img src="../img/russia logo.png" ></div>
            <h3>ORDRIVE</h3>
            <br>
            <br>
            <hr>
            <div class="up"><a href="mainadmin.php">Statistics <i class="fa-solid fa-chart-simple fa-bounce"></i></a></div>
            <hr>
            <div class="up"><a href="editacc.php"> Account control  <i class="fa-solid fa-universal-access fa-bounce"></i></a></div>
            <hr>
            <div class="up1"><a href="#">ADD ADMIN <i class="fa-solid fa-plus "></i></a></div>
            <hr>
            <div class="up"><a href="#">Account Settings <i class="fa-solid fa-gear fa-bounce"></i></a></div>
            <hr>
    </div>
              <section class="main">
              <div class="gfq">
            <h1>ADD NEW USER </h1>
        <form action="addadmin.php" method="post">
            <span class="row">
                <label>first Name</label>
                <input type="text" name="FirstName" placeholder="ENTER YOUR FIRST NAME" require>
                <label for="">Last Name</label>
                <input type="text" name="lastname" placeholder="ENTER YOUR LAST NAME" require>
            </span>
            <br>
            <br>
            <br>
            <span class="row">
                <label>Gender</label>
                <span class="typ"><input type="radio" value="male" name="gender"><label>Male</label></span>
                <span class="typ"><input type="radio" value="female" name="gender"> <label>Female</label></span>
                <label>Phone-Number</label>
                <input type="text" name="phonenumber" placeholder="ENTER YOUR PHONE-NUMBER" require>
            </span>
            <br>
            <br>
            <br>
            <span class="row">
                <label class="email">Email</label>
                <input type="email" name="email" placeholder="ENTER YOUR EMAIL" require>
                <label class="email">BirthDate</label>
                <input type="date" name="dateofbirth" placeholder="ENTER YOUR BIRTHDATE" require>
            </span>
            <br>
            <br>
            <br>
            <span class="row">
                <label>Password</label>
                <input type="password" name="password" placeholder="ENTER YOUR PASSWORD" require>
                <label class="pass">RE-Type Password</label>
                <input type="password" name="repass" placeholder="RE-TYPE PASSWORD"require>
            </span>
            <br>
            <br>
            <br>
            <span class="row">
                <label>USER Priority</label>
                <select name="priority">
                    <option value="0">user</option>
                    <option value="1">admin</option>
                </select>
            </span>
                    <div class="signUp">
                        <button type="submit" name="upload">submit</button>
                    </div>
                    <?php
                       
                     if (isset($_POST["upload"])) {
                        $fname=$_POST["FirstName"];
                        $lname=$_POST["lastname"];
                        $gender=$_POST["gender"];
                        $phone=$_POST["phonenumber"];
                        $email=$_POST["email"];
                        $password=$_POST["password"];
                        $birthdate=$_POST["dateofbirth"];
                        $repass=$_POST["repass"];
                        $prior=$_POST["priority"];
                        $hashpass=password_hash($password,PASSWORD_DEFAULT);
                        $directory='../uploads/'.$email;
                        if($repass==$password){
                        $stmt= "insert into accounts(`fname`, `lname`,`gender`,`phonenum`, `email`, `password`,`birthdate`,`priority`,`folder path`) 
                        VALUES ('$fname','$lname','$gender','$phone','$email','$hashpass','$birthdate','$prior','$directory')";
                        
                        $folderName = "../uploads/".$email;

                        if (!file_exists($folderName)) {
                            mkdir($folderName, 0777, true);
                            
                        } 

                        
                        try{
                        mysqli_query($connect,$stmt);
                        echo'<div class=" done"><H3>Done</H3></div>';
                        }
                        catch (Exception $e){
                            echo'<div class="wron"><h3>account is exisiting</h3></div>';
                            exit();
                           
                        }
                    }
                    else{
                        echo'<div class="wron"><h3>password do not match</h3></div>';
                    }
                }
                    ?>
    </form>
</div>
              </section>
</body>
</html>