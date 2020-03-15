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
        

        if(mysqli_query($con,$sql)){
            //file_put_contents($ImagePath,base64_decode($pet_picture));
            echo "สำเร็จ";
        }else{
            echo "ไม่";
        }
    
    mysqli_close($con);
?>