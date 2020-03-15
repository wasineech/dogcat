<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $post_id = $_GET['post_id'];
    
        $sql = "DELETE FROM post WHERE post_id = '$post_id'";
        

        if(mysqli_query($con,$sql)){
            //file_put_contents($ImagePath,base64_decode($pet_picture));
            echo "สำเร็จ";
        }else{
            echo "ไม่";
        }
    
    mysqli_close($con);
?>