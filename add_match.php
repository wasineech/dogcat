<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $pet_id1 = $_POST['pet_id1'];
    $pet_id2 = $_GET['pet_id2'];
    
        $sql = "INSERT INTO pet_match (match_status,pet1_id,pet2_id) VALUES ('0'
        ,'$pet_id1'
        ,'$pet_id2')";
        

        if(mysqli_query($con,$sql)){
            $sql_query = "SELECT * FROM pet_match WHERE pet1_id='$pet_id1' AND pet2_id = '$pet_id2'";
            $query = mysqli_query($con,$sql_query);
            $row = mysqli_fetch_array($sql_query);
                $match_id = $row["match_id"];
                $sql2x = "SELECT * FROM pet WHERE pet_id = '$pet_id1'";
                $query2x = mysqli_query($con,$sql2x);
                $row2x = mysqli_fetch_array($query2x);
                $pet_from_name = $row2x["pet_name"];
    
                $noti_message = $pet_from_name."ได้ทำการกดแมทซ์คุณ กดตอบรับหรือไม่?";
    
                $sql_add = "INSERT INTO notification (noti_message,noti_from,noti_to,match_id,post_id,noti_isread,noti_isclick) 
                VALUES ('$noti_message'
                ,'$pet_id1'
                ,'$pet_id2'
                ,'$match_id'
                ,'0'
                ,'0'
                ,'0')";

                mysqli_query($con,$sql_add);
        }else{
            // echo "ไม่";
        }
    
    mysqli_close($con);
?>