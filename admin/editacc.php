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
    header("location:../main.php");
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <link rel="stylesheet" href="../style/mainbody.css">
    <link rel="icon" href="../img/russia logo.png">
    <title>ACCOUNT CONTROL</title>
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
        padding-bottom: 272px;
        margin-top: 75px;
       margin-left: 300px;

       }
       .acco{
        padding-top: 30px;
        padding-left: 80px;

       }
       .tab{
        color: white;
       }
       .tab td,.tab th{

        padding: 10px;
       width: 100px;
       text-align: center;
       }
       .tab tr:nth-child(even){
       background-color: #f2f2f2;
       }
       .tab tr:hover{background-color: black;}
       .tab th{
        padding-top: 18px;
        padding-bottom: 18px;
        text-align: center;
        background-color: #1b1c1e;
        color: white;
       }
       .box{

        padding-top: 10%;
        margin-left: 40%;
        width: 200px;
       }
       .box h1 {
    font-size: 35px;
    font-weight: 800;
    text-align: center;
    margin-bottom: 45px;
}

.box form label {
    display: block;
    font-size: 12px;
    margin-top: 3px;
    margin-bottom: 3px;

}

.box form div {
    display: flex;
    align-items: center;
    border-bottom: 1px solid gray;
}



.box form div input {
    font-size: 12px;
    outline: none;
    border: none;
    padding: 10px;
    min-width: 0;
    flex: 1;
}
.box i{
    color: white;
}
.box form div input::placeholder {
    opacity: 1;
    color: gray;
    font-size: 12px;
}
.box form input[type="text"] {
    background-color: #303030;
    color: white;
}
.box form input[type="submit"] {
    box-shadow: 5px 5px 10px 5px rgb(0, 0, 0, 20%);
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    background-color: #212121 ;
    color: white;
    border: none;
    width: 100%;
    padding: 15px;
    margin-top: 45px;
    border-radius: 250px;
    transition: 0.5s ease;
}

.box form input[type="submit"]:hover {
    background-color: black;
    cursor: pointer;
}
.acco h3{
    padding-left: 37%;
    color: white;
}
#myBtn{
    margin-top: 40px;
    margin-left: 400px;
    border: none;
    padding: 8px;
    border-radius: 4px;
    background-color: #1b1c1e;
    color: white;
    box-shadow: 5px 5px 10px 5px rgb(0, 0, 0, 20%);
    transition: 0.4s;
}
#myBtn:hover{
    cursor: pointer;
    transform: scale(1.1);
}
.modal {
display: none; /* Hidden by default */
position: fixed; /* Stay in place */
z-index: 1; /* Sit on top */
padding-top: 100px; /* Location of the box */
padding-left: 300px;
left: 0;
top: 0;
width: 100%; /* Full width */
height: 100%; /* Full height */
overflow: auto; /* Enable scroll if needed */
background-color: rgb(0,0,0); /* Fallback color */
background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
.modal-content {
position: relative;
background-color: #fefefe;
margin: auto;
padding: 0;
border: 1px solid #888;
width: 80%;
box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
-webkit-animation-name: animatetop;
-webkit-animation-duration: 0.4s;
animation-name: animatetop;
animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
from {top:-300px; opacity:0} 
to {top:0; opacity:1}
}

@keyframes animatetop {
from {top:-300px; opacity:0}
to {top:0; opacity:1}
}

/* The Close Button */
.close {
color: white;
float: right;
font-size: 28px;
font-weight: bold;
}

.close:hover,
.close:focus {
color: #000;
text-decoration: none;
cursor: pointer;
}

.modal-header {
padding: 16px;
padding-left: 42%;
background-color: #212121;
color: white;
}

.modal-body {padding:16px;}
.modal-body form span{padding-right: 75px;}
.bex form input[type="submit"]{
font-size: 12px;
font-weight: 600;
text-transform: uppercase;
background-color: #212121 ;
color: white;
border: none;
width: 30%;
padding: 15px;
margin-top: 45px;
border-radius: 250px;
transition: 0.5s ease;
margin-left:60px;

}
.bex{
    margin-left: 30%;
}
      </style>
</head>
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
            <div class="up1"><a href=""> Account control  <i class="fa-solid fa-universal-access"></i></a></div>
            <hr>
            <div class="up"><a href="addadmin.php">ADD ADMIN <i class="fa-solid fa-plus fa-bounce"></i></a></div>
            <hr>
            <div class="up"><a href="#">Account Settings <i class="fa-solid fa-gear fa-bounce"></i></a></div>
            <hr>
    </div>
              <section class="main">
              <div class="box">
            <form action="editacc.php" method="post">
                <div>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" name="id" placeholder="Enter Any User Data">
                </div>
                <input type="submit" name="submit" value="submit">
            </form>
            </div>
            <div class="acco">
                  <table class="tab">
            <?php
            if(isset($_POST['submit'])){
                $id=$_POST['id'];
                $sql="Select * from accounts where id like '%$id%' or email like '%$id%' or fname like '%$id%' or lname like '%$id%' or phonenum like '%$id%'";
                $result=mysqli_query($connect,$sql);
                if($result){
                    if(mysqli_num_rows($result)>0){
                      echo'<thead>
                      <tr>
                      <th>ID</th>
                      <th>First-Name</th>
                      <th>Last-Name</th>
                      <th>gender</th>
                      <th>Phone-Number</th>
                      <th>Email</th>
                      <th>BirthDate</th>
                      </tr>
                      </thead>
                      ';
                      
                      while($row=mysqli_fetch_assoc($result)){
                        echo'
                        <tbody>
                        <tr>
                        <td>'.$row['id'].'</td>
                        <td>'.$row['fname'].'</td>
                        <td>'.$row['lname'].'</td>
                        <td>'.$row['gender'].'</td>
                        <td>'.$row['phonenum'].'</td>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['birthdate'].'</td>
                         
                        ';
                      }
                      echo'</table><div><button id="myBtn">Delete</button></div>';
                    }
                    else{
                        echo '<h3 >NO user FOUND</h3>';
                    }
            }
        }
            ?>
            </div>
            <div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Delete</h2>
    </div>
    <div class="modal-body">
        <div class="bex">
        <form action="editacc.php" method="post">
            <label>Email </label>
            <input type="text" name="email">
            <br>
            <input type="submit" name="del" value="delete">
            
        </form>
        </div>
        <?php
        if(isset($_POST["del"])){
            $email=$_POST["email"];
            $sqr="delete from accounts where email='$email'";
            mysqli_query($connect,$sqr);
            $folderPath = '../uploads/'.$email; 
            if (is_dir($folderPath)) {
                if (rmdir($folderPath)) {
                    echo 'Folder deleted successfully.';
                } else {
                    echo 'Unable to delete the folder.';
                }
            } else {
                echo 'Folder does not exist.';
            }
        }
        ?>
    </div>
  </div>

</div>
       
          </section>
          <script>
            var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
          </script>
</body>
</html>