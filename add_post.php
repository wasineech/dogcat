<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $post_content = $_POST['post_content'];
    $pet_id = $_POST['pet_id'];
    $post_photo = "no_photo";

    
        $sql = "INSERT INTO post (post_content,post_photo,pet_id) VALUES ('$post_content'
        ,'$post_photo'
        ,'$pet_id')";
        

        if(mysqli_query($con,$sql)){
            file_put_contents($ImagePath,base64_decode($pet_picture));
            echo "สำเร็จ";
        }else{
            echo "ไม่";
        }
    
    mysqli_close($con);
?>