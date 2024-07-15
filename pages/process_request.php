<?php
session_start();
$connect= new mysqli ('localhost','root','','home server'); 
if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
  }
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $requestId = $_POST['request_id'];
    $action = $_POST['action'];
    $path=$_POST['filepath'];
    // Perform the desired operations based on the chosen action (accept or reject)
    if ($action === 'accept') {
        $source = $path; 
        $filename=basename($path);
        $destination = 'uploads/'.$_SESSION['email'].'/'.$filename;
        $folderpath=dirname($path);
if (file_exists($source)) {
    if (rename($source, $destination)) {
        if (file_exists($folderpath)) {
            if(count(glob($folderpath . '/*')) === 0){
            rmdir($folderpath);
            }
        }
    } else {
        echo "Error moving file.";
    }
} else {
    echo "Source file doesn't exist.";
}
$query="DELETE FROM requests WHERE id='$requestId'";
mysqli_query($connect,$query);
header("location:requests.php");

    } elseif ($action === 'reject') {
        $folderPath = dirname($path);
deleteFolder($folderPath);
$query="DELETE FROM requests WHERE id='$requestId'";
mysqli_query($connect,$query);
header("location:requests.php");
    }

    // Redirect or display appropriate messages after processing the request
}
function deleteFolder($folderPath) {
    if (!is_dir($folderPath)) {
        return; // Exit if the path is not a directory
    }

    $files = glob($folderPath . '/*'); // Get all files and folders within the directory

    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteFolder($file); // Recursively delete subfolders and their contents
        } else {
            unlink($file); // Delete the file
        }
    }

    rmdir($folderPath); // Delete the empty folder
}
?>
