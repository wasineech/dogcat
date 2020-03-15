<?php
// Create connection

header("Content-type:text/javascript;charset=utf-8");
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB','dogcat');
$conn = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
mysqli_set_charset($conn,"utf8");
 
 if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
 $DefaultId = 0;
 
 $ImageData = $_POST['image_data'];
 
 $ImageName = $_POST['image_tag'];

 $ImagePath = "upload/$ImageName.jpg";
 
 $ServerURL = "/$ImagePath";
 
 $InsertSQL = "INSERT INTO pet (picture) values('$ServerURL')";
 
 if(mysqli_query($conn, $InsertSQL)){
 file_put_contents($ImagePath,base64_decode($ImageData));
 echo "Your Image Has Been Uploaded.";
 }
 
 mysqli_close($conn);
 }else{
 echo "Please Try Again";
 }
?>
© 2019 GitHub, Inc.