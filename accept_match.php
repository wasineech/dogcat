<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    // $pet_id1 = $_POST['pet_id1'];
    // $pet_id2 = $_POST['pet_id2'];

    $pet_id1 ='1039';
    $pet_id2 = '1001';
    
    $sql_update = "UPDATE pet_match SET match_status = '1' WHERE pet1_id='$pet_id1' AND pet2_id = '$pet_id2'";

    if(mysqli_query($con,$sql_update)){
        $sql_query = "SELECT * FROM pet_match WHERE pet1_id='$pet_id1' AND pet2_id = '$pet_id2'";
        // echo $sql_query;
        $query = mysqli_query($con,$sql_query);
        while ($row = mysqli_fetch_array($query)){
            $match_id = $row["match_id"];
            $sql2x = "SELECT * FROM pet WHERE pet_id = '$pet_id2'";
            $query2x = mysqli_query($con,$sql2x);
            $row2x = mysqli_fetch_array($query2x);
            $pet_from_name = $row2x["pet_name"];

            $noti_message = $pet_from_name."ตอบรับการแมทซ์ของคุณแล้ว เริ่มแชทได้เลย";

            $sql_add = "INSERT INTO notification (noti_message,noti_from,noti_to,match_id,post_id,noti_isread,noti_isclick) 
            VALUES ('$noti_message'
            ,'$pet_id2'
            ,'$pet_id1'
            ,'$match_id'
            ,'0'
            ,'0'
            ,'0')";

            mysqli_query($con,$sql_add);

            // echo $sql_add;

            $sql_message = "INSERT INTO message (message,pet_send,pet_receive,message_isread) 
            VALUES ('admin00000000'
            ,'$pet_id2'
            ,'$pet_id1'
            ,'0')";

// echo $sql_add;

            mysqli_query($con,$sql_message);
        
        }    
    }else{
        
    }


    
    
    mysqli_close($con);
?>