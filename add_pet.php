<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    $sql1 = "SELECT pet_id FROM pet WHERE pet_id= (SELECT MAX(pet_id) FROM pet)";
    $query1 = mysqli_query($con,$sql1);

    $result1 = array();

    while ($row1 = mysqli_fetch_array($query1)){
        $max_id = $row1["pet_id"];
        $max_id = $max_id+1;
    }

    

    $pet_name = $_POST['pet_name'];
    $pet_kind = $_POST['pet_kind'];
    $pet_breed = $_POST['pet_breed'];
    $pet_birthday = $_POST['pet_birthday'];
    $pet_gender = $_POST['pet_gender'];
    $pet_picture = $_POST['pet_picture'];
    $user_id  = $_POST['user_id'];
    $path = $user_id."_PET_".$max_id;

    $ImagePath = "upload/$path.jpg";

    //$Img = "upload$pet_picture.jpg";

    //$ServerURL = "/$ImagePath";

    //move_uploaded_file($pet_picture,$ImagePath);

    /*$pet_name = "p";
    $pet_kind = "p";
    $pet_breed = "p";
    $pet_birthday = "11/11/1111";
    $pet_gender = "male";
    $user_id = "11111";*/
    
    
        $sql = "INSERT INTO pet (pet_name,pet_kind,pet_breed,pet_birthday,
        pet_gender,pet_picture,user_id) VALUES ('$pet_name'
        ,'$pet_kind'
        ,'$pet_breed'
        ,'$pet_birthday'
		,'$pet_gender'
        ,'$ImagePath'
        ,'$user_id')";
        

        if(mysqli_query($con,$sql)){
            file_put_contents($ImagePath,base64_decode($pet_picture));
            echo "สำเร็จ";
        }else{
            echo "ไม่";
        }
    
    mysqli_close($con);
?>