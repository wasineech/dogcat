<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $pet_id  = $_GET['pet_id'];

        // $check = array();
        // $pet_id  = '1001';

        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
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

        $count = 0;

        while ($row = mysqli_fetch_array($query)){

            $pet_send = $row["pet_send"];

            $sqlxx = "SELECT * FROM message WHERE pet_send = '$pet_send' AND pet_receive = '$pet_id' AND message_isread = '0' GROUP BY pet_send ORDER BY message_timestamp DESC";
            $queryxx = mysqli_query($con,$sqlxx);

            while ($rowxx = mysqli_fetch_array($queryxx)){
                $count++;

                $sqlzz = "SELECT * FROM message WHERE pet_send = '$pet_send' AND pet_receive = '$pet_id' AND message_isread = '0' ORDER BY message_timestamp DESC";
                $queryzz = mysqli_query($con,$sqlzz);
    
                while ($rowzz = mysqli_fetch_array($queryzz)){

                $get_time =  $rowzz["message_timestamp"];
                $get_message =  $rowzz["message"];
                $get_send =  $rowzz["pet_send"];
                $onlytime = date("H:i",strtotime($get_time));

                
                   $sql2x = "SELECT * FROM pet WHERE pet_id = '$pet_send'";
                    
                   $query2x = mysqli_query($con,$sql2x);
           
                   $row2x = mysqli_fetch_array($query2x);

                    array_push($result,array("pet_send_id" => $get_send,
                    "pet_send_name" => $row2x["pet_name"],
                    "noti_count" => $count,
                    "message" => $get_message,
                    "message_timestamp" => $onlytime));
            }            
        }
    }
        

        // $pet_id  = $_GET['pet_id'];
        // $pet_id  = '1001';
        // $noti_count = 0;
        // $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        // mysqli_set_charset($con,"utf8");

        // $sql = "SELECT * FROM message WHERE pet_receive = '$pet_id' AND message_isclick = '0'";
        // $query = mysqli_query($con,$sql);
        // $result = array();

        // while ($row = mysqli_fetch_array($query)){
        //     $noti_count++;
        //     array_push($result,array("noti_count" => $noti_count,
        //     "pet_send" => $row["pet_send"],
        //     "message" => $row["message"])); 
        // }





        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>