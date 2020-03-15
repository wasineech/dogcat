<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $user_id  = $_GET['user_id'];
        
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

        $sql = "SELECT * FROM pet WHERE user_id= $user_id";

        $query = mysqli_query($con,$sql);

        $result = array();

        while ($row = mysqli_fetch_array($query)){

            array_push($result,array("pet_id"=> $row["pet_id"],
             "pet_id" => $row["pet_id"],
             "pet_kind" => $row["pet_kind"],
             "pet_breed" => $row["pet_breed"],
             "pet_birthday" => $row["pet_birthday"],
             "pet_gender" => $row["pet_gender"],
             "pet_picture" => $row["pet_picture"],
             "user_id" => $row["user_id"]));
        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>