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
        margin-left: 80px;
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
       .all{
       display: flex;
       margin-right: 400px;
       margin-top: -50px;
       }
       .circle-wrap {
       box-shadow: 5px 5px 10px 5px rgb(0, 0, 0, 20%);
       display: grid;
       grid-template-columns: repeat(1, 160px);
       grid-gap: 80px;
       margin-top: 100px;
       margin-left: 50px;
       width: 150px;
       height: 150px;
       background: #212121;
       border-radius: 50%;
       }

       .circle-wrap .circle .mask,
       .circle-wrap .circle .fill-1,
       .circle-wrap .circle .fill-2,
       .circle-wrap .circle .fill-3 {
          width: 150px;
          height: 150px;
          position: absolute;
          border-radius: 50%;
        }

       .circle-wrap .circle .mask {
         clip: rect(0px, 150px, 150px, 75px); 
        }

       .circle-wrap .inside-circle {
         width: 124px;
         height: 124px;
         border-radius: 50%;
         background: #313131;
         line-height: 120px;
         text-align: center;
         margin-top: 13px;
         margin-left: 13px;
         color: white;
         position: absolute;
         z-index: 100;
         font-weight: 700;
         font-size: 2em;
          }

       /* color animation */

       .mask .fill-1 {
         clip: rect(0px, 75px, 150px, 0px);
         background-color: white;
        }

       .mask.full-1,
       .circle .fill-1 {
         animation: fill-1 ease-in-out 2s;
         transform: rotate(180deg);
        }

       @keyframes fill-1 {
        0% {
            transform: rotate(0deg);
          }
        100% {
             transform: rotate(180deg);
           }
       }

        /* 2nd bar */

       .mask .fill-2 {
       clip: rect(0px, 75px, 150px, 0px);
       background-color: white;
       }

       .mask.full-2,
       .circle .fill-2 {
       animation: fill-2 ease-in-out 2s;
       transform: rotate(180deg);
       }

       @keyframes fill-2{
        0% {
             transform: rotate(0deg);
           }
        100% {
             transform: rotate(180deg);
            }
       }

       /* 3rd progress bar */
       .mask .fill-3 {
       clip: rect(0px, 75px, 150px, 0px);
       background-color: #23b9ea;
       }

       .mask.full-3,
        .circle .fill-3 {
       animation: fill-3 ease-in-out 3s;
       transform: rotate(200deg);
       }


       .stat{
       display: inline-block;
       padding-top: 10%;
       padding-left: 10%;
       }
       .bar1 h3{
        margin-right: 200px;
        color: white;
        padding-left: 40px;
        }
       .bar2 h3{
        width: 250px;
        color: white; 
       }
       .hr{
           border: solid 1px white;
           width: 2px;
           opacity: 40%;
           height: 300px;
           margin-left: 420px;
           margin-top: -230px;
          }
       .bar2{
       margin-left: 100%;
       margin-top: -300px;
       }
       .size{
       font-size: 20px;
       }
       .acco{
        padding-left: 60px;

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
            
            <?php
            if($row['priority']==1){?>
            <hr>
            <div class="up1"><a href="">Statistics <i class="fa-solid fa-chart-simple "></i></a></div>
             <hr>
            <div class="up"><a href="editacc.php"> Account control  <i class="fa-solid fa-universal-access fa-bounce"></i></a></div>
            <hr>
            <div class="up"><a href="addadmin.php">ADD ADMIN <i class="fa-solid fa-plus fa-bounce"></i></a></div>
            <hr>
            <div class="up"><a href="#">Account Settings <i class="fa-solid fa-gear fa-bounce"></i></a></div>
            <hr>
            <?php
            }?>
    </div>
              <section class="main">
                <?php
                if($row['priority']==1){?>
              <div class="stat">
                <div class="bar1">
                    <h3>TOTAL STORAGE</h3>
          <div class="all">
   <div class="circle-wrap">
    <div class="circle">
      <div class="mask full-1">
        <div class="fill-1"></div>
      </div>
      <div class="mask half">
        <div class="fill-1"></div>
      </div>
      <div class="inside-circle"> <?php
                }
      
function formatSizeUnits($bytes)
{
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes . ' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes . ' byte';
    } else {
        $bytes = '0 bytes';
    }

    return $bytes;
}

$dir = '../uploads'; // replace with your folder path
$size = calcFolderSize($dir);
echo '<p class="size">'.formatSizeUnits($size).'</p>';

function calcFolderSize($dir)
{
    $size = 0;
    foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : calcFolderSize($each);
    }

    return $size;
}

?> </div>
    </div>
  </div>
</div>
                </div>
                <div class="hr"></div>
<div class="bar2">
<h3>NUMBER OF ACCOUNTS</h3>
<div class="all">
  <div class="circle-wrap">
    <div class="circle">
      <div class="mask full-2">
        <div class="fill-2"></div>
      </div>
      <div class="mask half">
        <div class="fill-2"></div>
      </div>
      <div class="inside-circle"> 
        <?php
        $query="SELECT COUNT(*) AS total FROM accounts";
        $res=mysqli_query($connect,$query);
        $row=mysqli_fetch_assoc($res);
        $total=$row['total'];
        echo $total;
        ?>
         </div>
    </div>
  </div>
</div>
</div>
                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <div class="acco">
                  <table class="tab">
                  <?php
                  $sql="SELECT * FROM accounts ";
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
                      <th>User-Storage</th>
                      </tr>
                      </thead>
                      ';
                      
                      while($row=mysqli_fetch_assoc($result)){
     

$dir = '../uploads/'.$row['email']; // replace with your folder path
$size = calcFolderSize($dir);




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
                        <td>'.formatSizeUnits($size).'</td>
                        ';
                      }
                    }
                  }
                  ?>
                  </table>
                </div>
                
          </section>
</body>
</html>