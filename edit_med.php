<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $med_id = $_POST['med_id'];
    $med_name = $_POST['med_name'];
    $med_description = $_POST['med_description'];
    $med_time = $_POST['med_time'];

    
    // $med_id = "1005";
    // $med_name = "sexx";
    // $med_description = "ss";
    // $med_time = "2020-03-02";

    
    $sql = "UPDATE medical set med_name = '$med_name', med_description= '$med_description', med_timestamp='$med_time' WHERE med_id = '$med_id'";
        
    
    if(mysqli_query($con,$sql)){
        echo "สำเร็จ";
    }else{
        echo $sql;
    }
    
    mysqli_close($con);
?>