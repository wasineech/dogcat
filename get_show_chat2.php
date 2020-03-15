<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');


    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $pet_id1  = $_GET['pet_id1'];
        $pet_id2  = $_GET['pet_id2'];

        // $check = array();
        // $pet_id  = '1001';

        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

      

        $sql = "SELECT * FROM message WHERE (pet_send = $pet_id2 AND pet_receive = $pet_id1) OR (pet_send = $pet_id1 AND pet_receive = $pet_id2) ORDER BY message_timestamp ASC";

        $query = mysqli_query($con,$sql);

        $result = array();

        while ($row = mysqli_fetch_array($query)){
            $message_id = $row["message_id"];
            $message = $row["message"];
            $message_timestamp = $row["message_timestamp"];
            $message_isread = $row["message_isread"];
            $pet_send = $row["pet_send"];

            $sql2 = "SELECT * FROM pet WHERE pet_id = '$pet_send'";
           
            $query2 = mysqli_query($con,$sql2);
    
            while($row = mysqli_fetch_array($query2)){
                if($pet_send==$pet_id1){
                    $onlytime = date("H:i",strtotime($message_timestamp));
                    array_push($result,array("pet_send_id" => $row["pet_id"],
                    "pet_send_name" => $row["pet_name"],
                    "pet_send_profile" => $row["pet_picture"],
                    "message" => $message,
                    "message_timestamp" => $onlytime,
                    "message_isread" => $message_isread,
                    "pet_send" => "1")); 
                }
                else{
                    $onlytime = date("H:i",strtotime($message_timestamp));
                    array_push($result,array("pet_send_id" => $row["pet_id"],
                    "pet_send_name" => $row["pet_name"],
                    "pet_send_profile" => $row["pet_picture"],
                    "message" => $message,
                    "message_timestamp" => $onlytime,
                    "message_isread" => $message_isread,
                    "pet_send" => "0")); 
                }
               
            }
        }
        

        
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>