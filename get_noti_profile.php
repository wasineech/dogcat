<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $pet_id  = $_GET['pet_id'];

        // $pet_id  = '1001';

        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

        $sql = "SELECT * FROM pet_match WHERE pet2_id= $pet_id ORDER BY match_timestamp ASC";

        $query = mysqli_query($con,$sql);

        $result = array();

        while ($row = mysqli_fetch_array($query)){
            $pet1_id = $row["pet1_id"];
            $match_status = $row["match_status"];
            $match_timestamp = $row["match_timestamp"];
           
            $sql2 = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_id = '$pet1_id'";
           
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
                
                if ($diff->y == 0){
                    $age = $diff->m ." เดือน";
                    
                    array_push($result,array("pet_id" => $row["pet_id"],
                    "pet_name" => $row["pet_name"],
                    "pet_kind" => $row["pet_kind"],
                    "pet_breed" => $row["pet_breed"],
                    "pet_age" => $age,
                    "pet_birthday" => $row["pet_birthday"],
                    "pet_gender" => $row["pet_gender"],
                    "pet_picture" => $row["pet_picture"],
                    "match_timestamp" => $match_timestamp,
                    "noti_status" =>$match_status,
                    //"user_id" => $row["user_id"],
                    "province" => $row["province"])); 
                }
                else{
                    $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                        array_push($result,array("pet_id" => $row["pet_id"],
                        "pet_name" => $row["pet_name"],
                        "pet_kind" => $row["pet_kind"],
                        "pet_breed" => $row["pet_breed"],
                        "pet_age" => $age,
                        "pet_birthday" => $row["pet_birthday"],
                        "pet_gender" => $row["pet_gender"],
                        "pet_picture" => $row["pet_picture"],
                        "match_timestamp" => $match_timestamp,
                        "noti_status" => $match_status,
                        //"user_id" => $row["user_id"],
                        "province" => $row["province"])); 
                }
              
            }
        }
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



        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>