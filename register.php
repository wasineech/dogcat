<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $province = $_POST['province'];
    
        $sql = "INSERT INTO user (name,password,email,province) VALUES ('$name'
		,'$password'
		,'$email'
        ,'$province')";
        
        //mysql_query("SET NAMES utf8");
        if(mysqli_query($con,$sql)){
            echo "สำเร็จ";
        }else{
            echo "ไม่";
        }
    
    mysqli_close($con);
?>