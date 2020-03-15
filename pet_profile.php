<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

   if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $pet_id  = $_GET['pet_id'];
        // $pet_id  = "1001";
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,'utf8');

        $sql = "SELECT * FROM pet WHERE pet_id ='".$pet_id."'";

        $query = mysqli_query($con,$sql);

        $result = array();
        while($row = mysqli_fetch_array($query)){
            $pet_birthday = $row["pet_birthday"];
            $bday = new DateTime($pet_birthday);
            $today = new Datetime(date('y.m.d'));
            $diff = $today->diff($bday);
            $check_breed = $row["pet_breed"];
            if(stristr($check_breed,"other")) {
                $pet_breed = substr($check_breed,5);
              }else {
                $pet_breed = $row["pet_breed"];
              }

            if ($diff->y == 0){
                $age = $diff->m ." เดือน";

            }
            else{
                $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
            }
          
            array_push($result,array("pet_id" => $row["pet_id"],
                "pet_name" => $row["pet_name"],
                "pet_kind" => $row["pet_kind"],
                "pet_breed" => $pet_breed,
                "pet_age" => $age,
                "pet_birthday" => $row["pet_birthday"],
                "pet_gender" => $row["pet_gender"],
                "pet_picture" => $row["pet_picture"],
                "user_id" => $row["user_id"]));
        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>