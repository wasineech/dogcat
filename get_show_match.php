<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD']  == 'GET' ){

    
        $pet_id  = $_GET['pet_id'];
 
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');

        mysqli_set_charset($con,"utf8");

        $sql = "SELECT * FROM pet_match WHERE pet1_id = '$pet_id' AND match_status = '1' ";
        $query = mysqli_query($con,$sql);
        $result = array();


        while($row_s = mysqli_fetch_array($query)){
            $q_pet_id = $row_s["pet2_id"];
            $match_timestamp = $row_s["match_timestamp"];

            $now_timestamp = (date("Y-m-d H:i:s"));

            $datetime_match_timestamp = new DateTime($match_timestamp);//start time
            $datetime_now_timestamp = new DateTime($now_timestamp);//end time

            $interval = $datetime_now_timestamp->diff($datetime_match_timestamp);

            $diff_Y = $interval->format($interval->format('%y'));
            $diff_m = $interval->format($interval->format('%m'));
            $diff_d = $interval->format($interval->format('%d'));
            $diff_h = $interval->format($interval->format('%h'));
            $diff_i = $interval->format($interval->format('%i'));
            $diff_s = $interval->format($interval->format('%s'));

            if($diff_Y == "0"){
                if($diff_m == "0"){
                 if($diff_d == "0"){
                     if($diff_h == "0"){
                         if($diff_i == "0"){
                              $match_time = $diff_s."วินาทีที่แล้ว";
                         }
                         else{
                          $match_time = $diff_i."นาทีที่แล้ว";
                         }
                     }
                     else{
                      $match_time = $diff_h."ชั่วโมงที่แล้ว";
                     }
                 }
                 else{
                  $match_time = $diff_d."วันที่แล้ว";
                 }
                }
                else{
                 $match_time = $diff_m."เดือนที่แล้ว";
                }
             }
             else{
                 $match_time = $diff_Y."ปีที่แล้ว";
             }

            $sql_get_pet = "SELECT * FROM pet WHERE pet_id = '$q_pet_id'";
            $query_get_pet = mysqli_query($con,$sql_get_pet);

            $row = mysqli_fetch_array($query_get_pet);
    
        
            array_push($result,array("pet_id" => $row["pet_id"],
            "pet_name" => $row["pet_name"],
            "match_time" => $match_time,
            // "pet_breed" => $row["pet_breed"],
            // "pet_age" => $age,
            // "pet_birthday" => $row["pet_birthday"],
            // "pet_gender" => $row["pet_gender"],
            "pet_picture" => $row["pet_picture"],
           ));
        }

           
        $sql2 = "SELECT * FROM pet_match WHERE pet2_id = '$pet_id' AND match_status = '1' ";
     
        $query2 = mysqli_query($con,$sql2);

        while($row_ss = mysqli_fetch_array($query2)){
            $q_pet_id = $row_ss["pet1_id"];

            $match_timestamp = $row_ss["match_timestamp"];

            $now_timestamp = (date("Y-m-d H:i:s"));

            $datetime_match_timestamp = new DateTime($match_timestamp);//start time
            $datetime_now_timestamp = new DateTime($now_timestamp);//end time

            $interval = $datetime_now_timestamp->diff($datetime_match_timestamp);

            $diff_Y = $interval->format($interval->format('%y'));
            $diff_m = $interval->format($interval->format('%m'));
            $diff_d = $interval->format($interval->format('%d'));
            $diff_h = $interval->format($interval->format('%h'));
            $diff_i = $interval->format($interval->format('%i'));
            $diff_s = $interval->format($interval->format('%s'));

            if($diff_Y == "0"){
                if($diff_m == "0"){
                 if($diff_d == "0"){
                     if($diff_h == "0"){
                         if($diff_i == "0"){
                              $match_time = $diff_s."วินาทีที่แล้ว";
                         }
                         else{
                          $match_time = $diff_i."นาทีที่แล้ว";
                         }
                     }
                     else{
                      $match_time = $diff_h."ชั่วโมงที่แล้ว";
                     }
                 }
                 else{
                  $match_time = $diff_d."วันที่แล้ว";
                 }
                }
                else{
                 $match_time = $diff_m."เดือนที่แล้ว";
                }
             }
             else{
                 $match_time = $diff_Y."ปีที่แล้ว";
             }
         

            $sql_get_pet = "SELECT * FROM pet WHERE pet_id = '$q_pet_id'";
            $query_get_pet = mysqli_query($con,$sql_get_pet);

        

            $row = mysqli_fetch_array($query_get_pet);
    
        
            array_push($result,array("pet_id" => $row["pet_id"],
            "pet_name" => $row["pet_name"],
            "match_time" => $match_time,
            // "pet_breed" => $row["pet_breed"],
            // "pet_age" => $age,
            // "pet_birthday" => $row["pet_birthday"],
            // "pet_gender" => $row["pet_gender"],
            "pet_picture" => $row["pet_picture"],
           ));

        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
    
?>