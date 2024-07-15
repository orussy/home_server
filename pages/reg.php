<?php
session_start();
$connect= new mysqli ('localhost','root','','home server'); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }
if (isset($_POST["upload"])) {
    $fname=$_POST["FirstName"];
    $lname=$_POST["lastname"];
    $gender=$_POST["gender"];
    $phone=$_POST["phonenumber"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $birthdate=$_POST["dateofbirth"];
    $hashpass=password_hash($password,PASSWORD_DEFAULT);
    $directory='uploads/'.$email;
    
    $stmt= "insert into accounts(`fname`, `lname`,`gender`,`phonenum`, `email`, `password`,`birthdate`,`folder path`) 
    VALUES ('$fname','$lname','$gender','$phone','$email','$hashpass','$birthdate','$directory')";
    
    $folderName = "uploads/".$email;

    if (!file_exists($folderName)) {
        mkdir($folderName, 0777, true);
        
    } 

    
    try{
    mysqli_query($connect,$stmt);
    header("location: index.php");
    }
    catch (Exception $e){
        header("location:wrongreg.php");
        
        exit();
       
    }
}


?>