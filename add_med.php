<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $med_name = $_POST['med_name'];
    $med_description = $_POST['med_description'];
    $med_time = $_POST['med_time'];
    $pet_id  = $_POST['pet_id'];
    // $med_name = $_GET['med_name'];
    // $med_description = $_GET['med_description'];
    // $med_time = $_GET['med_time'];
    // $pet_id = $_GET['pet_id'];
    
        $sql = "INSERT INTO medical (med_name,med_description,med_timestamp,pet_id) VALUES ('$med_name'
        ,'$med_description'
        ,'$med_time'
        ,'$pet_id')";
        

        if(mysqli_query($con,$sql)){
            // file_put_contents($ImagePath,base64_decode($pet_picture));
            echo "สำเร็จ";
        }else{
            // echo "ไม่";
        }
    
    mysqli_close($con);
?>