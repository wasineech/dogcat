<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    $post_id = $_GET['post_id'];
    $pet_id = $_POST['pet_id'];

    // $post_id = '1036';
    // $pet_id = '1001';

    $sql_like = "SELECT * FROM post_like WHERE post_id = '$post_id' AND pet_id = '$pet_id'";
    echo $sql_like;
    $query_like = mysqli_query($con,$sql_like);
    if (mysqli_num_rows($query_like)==0) {
          $sql = "INSERT INTO post_like (post_id,pet_id,post_like_status) VALUES ('$post_id'
        ,'$pet_id','1')";
        
        echo $sql;

        if(mysqli_query($con,$sql)){
            $sql_query = "SELECT pet_id FROM post WHERE post_id='$post_id'";
            $query = mysqli_query($con,$sql_query);
            $row = mysqli_fetch_array($sql_query);
                $post_pet_id = $row["pet_id"];
                if($post_pet_id == $pet_id ){

                }
                else{
                    $sql2x = "SELECT * FROM pet WHERE pet_id = '$pet_id'";
                    $query2x = mysqli_query($con,$sql2x);
                    $row2x = mysqli_fetch_array($query2x);
                    $pet_from_name = $row2x["pet_name"];
        
                    $noti_message = $pet_from_name."ได้ทำการกดถูกใจโพสต์ของคุณ";
        
                    $sql_add = "INSERT INTO notification (noti_message,noti_from,noti_to,match_id,post_id,noti_isread,noti_isclick) 
                    VALUES ('$noti_message'
                    ,'$pet_id'
                    ,'$post_pet_id'
                    ,'0'
                    ,'$post_id'
                    ,'0'
                    ,'0')";

                   mysqli_query($con,$sql_add);
                }
        }else{
            // echo "ไม่";
        }
    }
    else{
        $sql_edit = "UPDATE post_like set post_like_status= '1' WHERE post_id = '$post_id'";
        
        echo $sql_edit;

        mysqli_query($con,$sql_edit);
    }
    // while($row_like = mysqli_fetch_array($query_like)){
    //     if($row_like==null){
    //       echo "row is null";
    //     }
    //     else{
    //         echo "row is not null";
    //     }
    // }
   


    mysqli_close($con);
?>