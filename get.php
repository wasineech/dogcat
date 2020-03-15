<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD']  == 'GET' ){

        //$email  = $_GET['email'];
        //$password  = $_GET['password'];
        $user_id  = $_GET['user_id'];
        //$user_id  = '1036';

        //$email  = "jessi@gmail.com";
        //$password  = "1234";


        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');

        mysqli_set_charset($con,"utf8");

        $sql = "SELECT * FROM pet WHERE user_id ='".$user_id."'";
        $query = mysqli_query($con,$sql);
        $result = array();


        while($row = mysqli_fetch_array($query)){

            $noti_count = 0;
            $pet_id = $row["pet_id"];

            $sql_noti_count = "SELECT * FROM notification WHERE noti_to = '$pet_id' AND noti_isclick = '0'";
            $query_noti_count = mysqli_query($con,$sql_noti_count);
    
            while ($row_noti_count = mysqli_fetch_array($query_noti_count)){
                $noti_count++;

                // $noti_message = $row_noti_count["noti_message"]
                // array_push($result,array("noti_count" => $noti_count,
                // "noti_message" => $row["noti_message"],)); 
        

                    // $pet_birthday = $row["pet_birthday"];
                    // $bday = new DateTime($pet_birthday); // Your date of birth
                    // $today = new Datetime(date('y.m.d'));
                    // $diff = $today->diff($bday);
                    // $age = $diff->y . "ปี" . $diff->m ."เดือน";
                   

            }
            array_push($result,array("pet_id" => $row["pet_id"],
            "pet_name" => $row["pet_name"],
            // "pet_kind" => $row["pet_kind"],
            // "pet_breed" => $row["pet_breed"],
            // "pet_age" => $age,
            // "pet_birthday" => $row["pet_birthday"],
            // "pet_gender" => $row["pet_gender"],
            "pet_picture" => $row["pet_picture"],
            "user_id" => $row["user_id"],
            "noti_count" => $noti_count));

        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
    
?>