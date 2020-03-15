<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $pet_send = $_POST['pet_send'];
    $pet_receive = $_POST['pet_receive'];
    $message = $_POST['message'];
    
        $sql = "INSERT INTO message (pet_send,pet_receive,message,message_isread) VALUES ('$pet_send'
        ,'$pet_receive'
        ,'$message'
        ,'0')";
        

        if(mysqli_query($con,$sql)){
            file_put_contents($ImagePath,base64_decode($pet_picture));
            echo "สำเร็จ";
        }else{
            echo "ไม่";
        }
    
    mysqli_close($con);
?>