<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    date_default_timezone_set("Asia/Bangkok");

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $pet_id  = $_GET['pet_id'];

        // $pet_id  = '1001';

        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

        $sql = "SELECT * FROM notification WHERE noti_to = '$pet_id' ORDER BY noti_timestamp DESC LIMIT 50";

        $query = mysqli_query($con,$sql);

        $result = array();

        while ($row = mysqli_fetch_array($query)){
            $noti_id = $row["noti_id"];
            $noti_message = $row["noti_message"];
            $noti_from  = $row["noti_from"];
            $match_id = $row["match_id"];
            $post_id = $row["post_id"];
            $noti_isread = $row["noti_isread"];
            $noti_isclick = $row["noti_isclick"];
            $noti_timestamp = $row["noti_timestamp"];

            $now_timestamp = (date("Y-m-d H:i:s"));

            $datetime_noti_timestamp = new DateTime($noti_timestamp);//start time
            $datetime_now_timestamp = new DateTime($now_timestamp);//end time

            $interval = $datetime_now_timestamp->diff($datetime_noti_timestamp);

            $diff_Y = $interval->format($interval->format('%y'));
            $diff_m = $interval->format($interval->format('%m'));
            $diff_d = $interval->format($interval->format('%d'));
            $diff_h = $interval->format($interval->format('%h'));
            $diff_i = $interval->format($interval->format('%i'));
            $diff_s = $interval->format($interval->format('%s'));

            if($noti_isclick == "0"){
                $sql_update = "UPDATE notification set noti_isclick = '1' WHERE noti_id = '$noti_id'";
                mysqli_query($con,$sql_update);
            }
           

            if($diff_Y == "0"){
               if($diff_m == "0"){
                if($diff_d == "0"){
                    if($diff_h == "0"){
                        if($diff_i == "0"){
                             $noti_time = $diff_s."วินาทีที่แล้ว";
                        }
                        else{
                         $noti_time = $diff_i."นาทีที่แล้ว";
                        }
                    }
                    else{
                     $noti_time = $diff_h."ชั่วโมงที่แล้ว";
                    }
                }
                else{
                 $noti_time = $diff_d."วันที่แล้ว";
                }
               }
               else{
                $noti_time = $diff_m."เดือนที่แล้ว";
               }
            }
            else{
                $noti_time = $diff_Y."ปีที่แล้ว";
            }

            // echo "\n"."now_timestamp: " . $now_timestamp ."\n";
            // echo "timestamp: " . $noti_timestamp ."\n";
            // echo "time: " . $noti_time ."\n";

            
           

                $sql2 = "SELECT * FROM pet WHERE pet_id = '$noti_from'";
            
                $query2 = mysqli_query($con,$sql2);
        
                while($row = mysqli_fetch_array($query2)){
                    $pet_birthday = $row["pet_birthday"];
                    $bday = new DateTime($pet_birthday); // Your date of birth
                    $today = new Datetime(date('y.m.d'));
                    $diff = $today->diff($bday);

                    $pet_birthday = $row["pet_birthday"];
                    $bday = new DateTime($pet_birthday); // Your date of birth
                    $today = new Datetime(date('y.m.d'));
                    $diff = $today->diff($bday);

                    if($match_id != 0){
                        $sql_match = "SELECT * FROM pet_match WHERE match_id = $match_id";
            
                        $query_match = mysqli_query($con,$sql_match);
                
                        $row_match = mysqli_fetch_array($query_match);
    
                        $match_status = $row_match["match_status"];
                        
                        if ($diff->y == 0){
                            $age = $diff->m ." เดือน";
                            
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_age" => $age,
                            "pet_breed" => $row["pet_breed"],
                            "pet_picture" => $row["pet_picture"],
                            "noti_message" =>$noti_message,
                            "noti_time" => $noti_time,
                            "noti_isread" =>$noti_isread,
                            "noti_id" =>$noti_id,
                            "match_id" =>$match_id,
                            "match_status" =>$match_status,
                            "post_id" =>$post_id)); 
    
                        }
                        else{
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                                "pet_name" => $row["pet_name"],
                                "pet_gender" => $row["pet_gender"],
                                "pet_age" => $age,
                                "pet_breed" => $row["pet_breed"],
                                "pet_picture" => $row["pet_picture"],
                                "noti_message" =>$noti_message,
                                "noti_time" => $noti_time,
                                "noti_isread" =>$noti_isread,
                                "noti_id" =>$noti_id,
                                "match_id" =>$match_id,
                                "match_status" =>$match_status,
                                "post_id" =>$post_id)); 
                        }
                    }
                    else{
                        if ($diff->y == 0){
                            $age = $diff->m ." เดือน";
                            
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_age" => $age,
                            "pet_breed" => $row["pet_breed"],
                            "pet_picture" => $row["pet_picture"],
                            "noti_message" =>$noti_message,
                            "noti_time" => $noti_time,
                            "noti_isread" =>$noti_isread,
                            "noti_id" =>$noti_id,
                            "match_id" =>$match_id,
                            "match_status" =>"nothave",
                            "post_id" =>$post_id)); 
    
                        }
                        else{
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                                "pet_name" => $row["pet_name"],
                                "pet_gender" => $row["pet_gender"],
                                "pet_age" => $age,
                                "pet_breed" => $row["pet_breed"],
                                "pet_picture" => $row["pet_picture"],
                                "noti_message" =>$noti_message,
                                "noti_time" => $noti_time,
                                "noti_isread" =>$noti_isread,
                                "noti_id" =>$noti_id,
                                "match_id" =>$match_id,
                                "match_status" =>"nothave",
                                "post_id" =>$post_id)); 
                        }
                    }

                   
                
                }
            }
        

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // $sql = "SELECT * FROM pet_match WHERE pet2_id= $pet_id ORDER BY match_timestamp DESC";

        // $query = mysqli_query($con,$sql);

        // $result = array();

        // while ($row = mysqli_fetch_array($query)){
        //     $pet1_id = $row["pet1_id"];
        //     $match_status = $row["match_status"];
        //     $match_timestamp = $row["match_timestamp"];
           
        //     $sql2 = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_id = '$pet1_id'";
           
        //     $query2 = mysqli_query($con,$sql2);
    
        //     while($row = mysqli_fetch_array($query2)){
        //         $pet_birthday = $row["pet_birthday"];
        //         $bday = new DateTime($pet_birthday); // Your date of birth
        //         $today = new Datetime(date('y.m.d'));
        //         $diff = $today->diff($bday);

        //         $pet_birthday = $row["pet_birthday"];
        //         $bday = new DateTime($pet_birthday); // Your date of birth
        //         $today = new Datetime(date('y.m.d'));
        //         $diff = $today->diff($bday);
                
        //         if ($diff->y == 0){
        //             $age = $diff->m ." เดือน";
                    
        //             array_push($result,array("pet_id" => $row["pet_id"],
        //             "pet_name" => $row["pet_name"],
        //             "pet_kind" => $row["pet_kind"],
        //             "pet_breed" => $row["pet_breed"],
        //             "pet_age" => $age,
        //             "pet_birthday" => $row["pet_birthday"],
        //             "pet_gender" => $row["pet_gender"],
        //             "pet_picture" => $row["pet_picture"],
        //             "match_timestamp" => $match_timestamp,
        //             "noti_status" =>$match_status,
        //             //"user_id" => $row["user_id"],
        //             "province" => $row["province"])); 
        //         }
        //         else{
        //             $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
        //                 array_push($result,array("pet_id" => $row["pet_id"],
        //                 "pet_name" => $row["pet_name"],
        //                 "pet_kind" => $row["pet_kind"],
        //                 "pet_breed" => $row["pet_breed"],
        //                 "pet_age" => $age,
        //                 "pet_birthday" => $row["pet_birthday"],
        //                 "pet_gender" => $row["pet_gender"],
        //                 "pet_picture" => $row["pet_picture"],
        //                 "match_timestamp" => $match_timestamp,
        //                 "noti_status" => $match_status,
        //                 //"user_id" => $row["user_id"],
        //                 "province" => $row["province"])); 
        //         }
              
        //     }
        // }

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // $sql3 = "SELECT * FROM pet_match WHERE pet1_id= $pet_id AND match_status ='1' ORDER BY match_timestamp ASC";

        // $query3 = mysqli_query($con,$sql3);

        // while ($row = mysqli_fetch_array($query3)){
        //     $pet2_id = $row["pet2_id"];
        //     $match_timestamp = $row["match_timestamp"];

        //     $sql4 = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_id = '$pet2_id'";
           
        //     $query4 = mysqli_query($con,$sql4);
    
        //     while($row = mysqli_fetch_array($query4)){
        //         $pet_birthday = $row["pet_birthday"];
        //         $bday = new DateTime($pet_birthday); // Your date of birth
        //         $today = new Datetime(date('y.m.d'));
        //         $diff = $today->diff($bday);

        //         $pet_birthday = $row["pet_birthday"];
        //         $bday = new DateTime($pet_birthday); // Your date of birth
        //         $today = new Datetime(date('y.m.d'));
        //         $diff = $today->diff($bday);
                
        //         if ($diff->y == 0){
        //             $age = $diff->m ." เดือน";
                    
        //             array_push($result,array("pet_id" => $row["pet_id"],
        //             "pet_name" => $row["pet_name"],
        //             "pet_kind" => $row["pet_kind"],
        //             "pet_breed" => $row["pet_breed"],
        //             "pet_age" => $age,
        //             "pet_birthday" => $row["pet_birthday"],
        //             "pet_gender" => $row["pet_gender"],
        //             "pet_picture" => $row["pet_picture"],
        //             "match_timestamp" => $match_timestamp,
        //             "noti_status" => '1',
        //             //"user_id" => $row["user_id"],
        //             "province" => $row["province"])); 
        //         }
        //         else{
        //             $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
        //                 array_push($result,array("pet_id" => $row["pet_id"],
        //                 "pet_name" => $row["pet_name"],
        //                 "pet_kind" => $row["pet_kind"],
        //                 "pet_breed" => $row["pet_breed"],
        //                 "pet_age" => $age,
        //                 "pet_birthday" => $row["pet_birthday"],
        //                 "pet_gender" => $row["pet_gender"],
        //                 "pet_picture" => $row["pet_picture"],
        //                 "match_timestamp" => $match_timestamp,
        //                 "noti_status" => '1',
        //                 //"user_id" => $row["user_id"],
        //                 "province" => $row["province"])); 
        //         }
              
        //     }
        // }

            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>