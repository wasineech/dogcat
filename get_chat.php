<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    date_default_timezone_set("Asia/Bangkok");

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $pet_id  = $_GET['pet_id'];

        // $check = array();
        // $pet_id  = '1001';

        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

      

        $sql = "SELECT * FROM message WHERE pet_receive = $pet_id GROUP BY pet_send ORDER BY message_timestamp DESC";
        // $sqlz = "SELECT * FROM message WHERE pet_receive = $pet_id IN (GROUP BY pet_send ORDER BY message_timestamp ASC) ORDER BY message_timestamp DESC";
        // echo $sql  . "\n";
        // echo $sqlz . "\n";
        

        // $sqlx = "SELECT * FROM message WHERE pet_receive = $pet_id OR pet_send = $pet_id ORDER BY message_timestamp DESC";
        // echo $sqlx . "\n";

        // $sqlxx = "SELECT * FROM message WHERE pet_receive = $pet_id GROUP BY pet_receive UNION SELECT * FROM message WHERE pet_send = $pet_id
        //  GROUP BY pet_send ORDER BY message_timestamp DESC";
        // echo $sqlxx . "\n";

        $query = mysqli_query($con,$sql);

        $result = array();

        while ($row = mysqli_fetch_array($query)){
         
            $pet_send = $row["pet_send"];

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // $sql_edit = "SELECT * FROM message WHERE pet_send = '$pet_send' AND pet_receive = '$pet_id' AND message_isclick = '0'";
        // $query_edit = mysqli_query($con,$sql_edit);

        // while ($row_edit = mysqli_fetch_array($query_edit)){
        //     $edit_message_id =  $row_edit["message_id"];
        //     $edit_message_isclick =  $row_edit["message_isclick"];
        //     if($edit_message_isclick == "0"){
        //         $sql_update = "UPDATE message set message_isclick = '1' WHERE message_id = '$edit_message_id'";
        //         mysqli_query($con,$sql_update);
        //     }
        // }          


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $sqlxx = "SELECT * FROM message WHERE pet_send = '$pet_send' AND pet_receive = '$pet_id'  ORDER BY message_timestamp DESC LIMIT 1";
            $queryxx = mysqli_query($con,$sqlxx);


            
            $row = mysqli_fetch_array($queryxx);
                $pet2_time =  $row["message_timestamp"];
                $pet2_message =  $row["message"];
                $pet2_message_isread =  $row["message_isread"];
                $pet2_send =  $row["pet_send"];

            
        
            $sqlzz = "SELECT * FROM message WHERE pet_send = '$pet_id' AND pet_receive = '$pet_send'  ORDER BY message_timestamp DESC LIMIT 1";
            $queryzz = mysqli_query($con,$sqlzz);
            $i2 = 0;

            $row2 = mysqli_fetch_array($queryzz);
                $pet1_time =  $row2["message_timestamp"];
                $pet1_message =  $row2["message"];
                $pet1_send =  $row2["pet_send"];
                $pet1_message_isread =  $row2["message_isread"];
                // echo "pet1_time: " .  $pet1_time . "\n";
                if($pet2_time > $pet1_time){
                    // echo "2" . "\n" . $pet2_message;
                      $sql2x = "SELECT * FROM pet WHERE pet_id = '$pet_send'";
                    
                        $query2x = mysqli_query($con,$sql2x);
                
                        while($row2x = mysqli_fetch_array($query2x)){

                            // $tm=date("Y-m-d H:i:s",strtotime('now'));
                            // echo $tm;
                            // echo $message_timestamp;
                            // $time = $tm-$message_timestamp;

                            $now_timestamp = (date("Y-m-d H:i:s"));

                            $datetime_pet2_time = new DateTime($pet2_time);//start time
                            $datetime_now_timestamp = new DateTime($now_timestamp);//end time
    
                            $interval = $datetime_now_timestamp->diff($datetime_pet2_time);
    
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
                                            $onlytime = date("H:i",strtotime($pet2_time));
                                              $message_time = $onlytime;
                                         }
                                         else{
                                            $onlytime = date("H:i",strtotime($pet2_time));
                                          $message_time = $onlytime;
                                         }
                                     }
                                     else{
                                        $onlytime = date("H:i",strtotime($pet2_time));
                                      $message_time = $onlytime;
                                     }
                                 }
                                 else{
                                    if($diff_d == "1"){
                                        $onlytime = date("H:i",strtotime($pet2_time));
                                        $message_time = "เมื่อวาน ".$onlytime;
                                     }else{
                                        $onlytime = date("d/m/y H:i",strtotime($pet2_time));
                                        $message_time = $onlytime;
                                     }
                                 }
                                }
                                else{
                                 $onlytime = date("d/m/y H:i",strtotime($pet2_time));
                                 $message_time = $onlytime;
                                }
                             }
                             else{
                                 $onlytime = date("d/m/y H:i",strtotime($pet2_time));
                                 $message_time = $onlytime;
                             }

                            $onlytime = date("H:i",strtotime($pet2_time));
                            array_push($result,array("pet_send_id" => $row2x["pet_id"],
                            "pet_send_name" => $row2x["pet_name"],
                            "pet_send_profile" => $row2x["pet_picture"],
                            "message" => $pet2_message,
                            "message_timestamp" => $message_time,
                            "message_isread" => $pet2_message_isread)); 
                        }
                }
                else{
                    // echo "1"  . "\n" . $pet1_message;
                    $sql2x = "SELECT * FROM pet WHERE pet_id = '$pet_send'";
                    
                    $query2x = mysqli_query($con,$sql2x);
            
                    while($row2x = mysqli_fetch_array($query2x)){

                        // $tm=date("Y-m-d H:i:s",strtotime('now'));
                        // echo $tm;
                        // echo $message_timestamp;
                        // $time = $tm-$message_timestamp;
                        
                        $now_timestamp = (date("Y-m-d H:i:s"));

                        $datetime_pet1_time = new DateTime($pet1_time);//start time
                        $datetime_now_timestamp = new DateTime($now_timestamp);//end time

                        $interval = $datetime_now_timestamp->diff($datetime_pet1_time);

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
                                        $onlytime = date("H:i",strtotime($pet1_time));
                                          $message_time = $onlytime;
                                     }
                                     else{
                                        $onlytime = date("H:i",strtotime($pet1_time));
                                      $message_time = $onlytime;
                                     }
                                 }
                                 else{
                                    $onlytime = date("H:i",strtotime($pet1_time));
                                  $message_time = $onlytime;
                                 }
                             }
                             else{
                                 if($diff_d == "1"){
                                    $onlytime = date("H:i",strtotime($pet1_time));
                                    $message_time = "เมื่อวาน ".$onlytime;
                                 }else{
                                    $onlytime = date("d/m/y H:i",strtotime($pet1_time));
                                    $message_time = $onlytime;
                                 }
                          
                             }
                            }
                            else{
                             $onlytime = date("d/m/y H:i",strtotime($pet1_time));
                             $message_time = $onlytime;
                            }
                         }
                         else{
                             $onlytime = date("d/m/y H:i",strtotime($pet1_time));
                             $message_time = $onlytime;
                         }


                        $onlytime = date("H:i",strtotime($pet1_time));
                        array_push($result,array("pet_send_id" => $row2x["pet_id"],
                        "pet_send_name" => $row2x["pet_name"],
                        "pet_send_profile" => $row2x["pet_picture"],
                        "message" => "คุณ: " . $pet1_message,
                        "message_timestamp" => $message_time,
                        "message_isread" => $pet1_message_isread)); 
                    }
                }
            }
        

            // echo "while1" . "\n";

        // $sqlxx = "SELECT * FROM message WHERE pet_send = '$pet_send' AND pet_receive = '$pet_id'  ORDER BY message_timestamp DESC LIMIT 1";
        // echo $sqlxx . "\n";
        // $queryxx = mysqli_query($con,$sqlxx);
    
        // while($row = mysqli_fetch_array($queryxx)){
        //     $pet2_time =  $row["message_timestamp"];
        //     $pet2_message =  $row["message"];
        //     echo "while2" . "\n";

        //     $sqlzz = "SELECT * FROM message WHERE pet_send = '$pet_id' AND pet_receive = '$pet_send'  ORDER BY message_timestamp DESC LIMIT 1";
        //     $queryzz = mysqli_query($con,$sqlzz);

        //         while($row = mysqli_fetch_array($queryzz)){
        //             echo "while3" . "\n";
        //             $pet1_time =  $row["message_timestamp"];
        //             $pet1_message =  $row["message"];
        //             if($pet2_time > $pet1_time){
        //                 echo "2" . "\n" . $pet2_message;
        //             }
        //             else{
        //                 echo "1"  . "\n" . $pet1_message;;
        //             }

        //         }
        //     }

            // $sql2 = "SELECT * FROM pet WHERE pet_id = '$pet_send'";
           
            // $query2 = mysqli_query($con,$sql2);
    
            // while($row = mysqli_fetch_array($query2)){

            //     // $tm=date("Y-m-d H:i:s",strtotime('now'));
            //     // echo $tm;
            //     // echo $message_timestamp;
            //     // $time = $tm-$message_timestamp;
            //     $onlytime = date("H:i",strtotime($message_timestamp));
            //     array_push($result,array("pet_send_id" => $row["pet_id"],
            //     "pet_send_name" => $row["pet_name"],
            //     "pet_send_profile" => $row["pet_picture"],
            //     "message" => $message,
            //     "message_timestamp" => $onlytime)); 
        //     }
        
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>