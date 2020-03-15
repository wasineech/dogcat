<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $pet_id = $_POST['pet_id'];
    $pet_name = $_POST['pet_name'];
    $pet_kind = $_POST['pet_kind'];
    $pet_breed = $_POST['pet_breed'];
    $pet_birthday = $_POST['pet_birthday'];
    $pet_gender = $_POST['pet_gender'];
    //$pet_picture = $_POST['pet_picture'];
    $user_id  = $_GET['user_id'];

    //$ImagePath = "upload/$pet_name.jpg";

    //$Img = "upload$pet_picture.jpg";

    //$ServerURL = "/$ImagePath";

    //move_uploaded_file($pet_picture,$ImagePath);

    // $pet_id = "1023";
    // $pet_name = "p";
    // $pet_kind = "cat";
    // $pet_breed = "p";
    // $pet_birthday = "2016-11-11";
    // $pet_gender = "male";
    // $user_id  = "1037";

    /*$pet_name = "p";
    $pet_kind = "p";
    $pet_breed = "p";
    $pet_birthday = "11/11/1111";
    $pet_gender = "male";
    $user_id = "11111";*/
    
    
        $sql = "UPDATE pet set pet_name = '$pet_name', pet_breed= '$pet_breed', pet_birthday='$pet_birthday',
        pet_gender='$pet_gender' WHERE pet_id = '$pet_id'";
        

        if(mysqli_query($con,$sql)){
            //file_put_contents($ImagePath,base64_decode($pet_picture));
            echo "สำเร็จ";
        }else{
            echo "ไม่";
        }
    
    mysqli_close($con);
?>