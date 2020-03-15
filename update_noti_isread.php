<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $noti_id = $_GET['noti_id'];
    
    $sql_update = "UPDATE notification SET noti_isread = '1' WHERE noti_id='$noti_id'";

    mysqli_query($con,$sql_update);
     


       
  
    mysqli_close($con);
?>