<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    $sql1 = "SELECT post_id FROM post WHERE post_id= (SELECT MAX(post_id) FROM post)";
    $query1 = mysqli_query($con,$sql1);

    $result1 = array();

    while ($row1 = mysqli_fetch_array($query1)){
        $max_id = $row1["post_id"];
        $max_id = $max_id+1;
    }


    

    $post_content = $_POST['post_content'];
    $pet_id = $_POST['pet_id'];
    $post_photo =  $_POST['post_picture'];
    $path = $pet_id."_post_".$max_id;
    $ImagePath = "upload/$path.jpg";

    echo $path;

    
        $sql = "INSERT INTO post (post_content,post_photo,pet_id) VALUES ('$post_content'
        ,'$ImagePath'
        ,'$pet_id')";
        

        if(mysqli_query($con,$sql)){
            file_put_contents($ImagePath,base64_decode($post_photo));
            echo "สำเร็จ";
        }else{
            echo "ไม่";
        }
    
    mysqli_close($con);
?>