<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    $user_id = $_POST['user_id'];
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
   

    $sql = "UPDATE user set lat = '$lat', lng = '$lng' WHERE user_id = '$user_id'";
        

    mysqli_query($con,$sql);
    
    mysqli_close($con);
?>