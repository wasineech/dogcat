<?php
   header("Content-type:text/javascript;charset=utf-8");
   define('HOST','localhost');
   define('USER','root');
   define('PASS','');
   define('DB','dogcat');

   

    $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
    mysqli_set_charset($con,"utf8");

    

    $post_comment = $_POST['post_comment'];
    $post_id = $_POST['post_id'];
    $pet_id = $_POST['pet_id'];

    // $post_comment = 'thanks';
    // $post_id = '1027';
    // $pet_id = '1001';
   

    
        $sql = "INSERT INTO post_comment (post_comment_content,post_id,pet_id) VALUES ('$post_comment'
        ,'$post_id'
        ,'$pet_id')";
        
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
        
                    $noti_message = $pet_from_name."ได้ทำการแสดงความคิดเห็นบนโพสต์ของคุณ";
        
                    $sql_add = "INSERT INTO notification (noti_message,noti_from,noti_to,match_id,post_id,noti_isread,noti_isclick) 
                    VALUES ('$noti_message'
                    ,'$pet_id'
                    ,'$post_pet_id'
                    ,'0'
                    ,'$post_id'
                    ,'0'
                    ,'0')";

                    mysqli_query($con,$sql_add);

                    // if(mysqli_query($con,$sql_add)){
                    //     $sql_check = "SELECT * FROM notification WHERE post_id='$post_id' and noti_to = '$post_pet_id'";
                    //     $query_check = mysqli_query($con,$sql_check);
                    //     while ($row_check = mysqli_fetch_array($sql_check)){
                    //         $pet_id_check = $row_check["pet_from"];
                    //         if($pet_id_check == $pet_id){

                    //         }
                    //         else{
                    //             $sql3x = "SELECT * FROM pet WHERE pet_id = '$pet_id_check'";
                    //             $query3x = mysqli_query($con,$sql3x);
                    //             $row3x = mysqli_fetch_array($query3x);
                    //             $pet_check_from_name = $row3x["pet_name"];
                    //             $sql4x = "SELECT * FROM pet WHERE pet_id = '$post_pet_id'";
                    //             $query4x = mysqli_query($con,$sql4x);
                    //             $row4x = mysqli_fetch_array($query4x);
                    //             $pet_post_name = $row4x["pet_name"];
                    //             $noti_message2 = $pet_check_from_name."ได้ทำการแสดงความคิดเห็นบนโพสต์ของ".$pet_post_name."เช่นเดียวกัน";
        
                    //             $sql_add = "INSERT INTO notification (noti_message,noti_from,noti_to,match_id,post_id,noti_isread,noti_isclick) 
                    //             VALUES ('$noti_message'
                    //             ,'$pet_id'
                    //             ,'$post_pet_id'
                    //             ,'0'
                    //             ,'$post_id'
                    //             ,'0'
                    //             ,'0')";
                    //         }

                    //     }


                    // }
                }
        }else{
            // echo "ไม่";
        }
    mysqli_close($con);
?>