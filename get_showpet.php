<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD']  == 'GET' ){

        $user_id = $_GET['user_id'];
        $pet1_id = $_GET['pet1_id'];
        $pet_kind  = $_GET['pet_kind'];
        $pet_gender  = $_GET['pet_gender'];
        $province  = $_GET['province'];
        $pet_breed  = $_GET['pet_breed'];
        $pet_age = $_GET['pet_age'];
       
        // $pet1_id = '1001';
        // $pet_kind  = 'แมว';
        // $pet_gender  = 'เมีย';
        // $pet_breed  = 'เปอร์เซีย';
        // $province  = 'ขอนแก่น';
        // $pet_age =  'ต่ำกว่า1ปี';
    

        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');
        mysqli_set_charset($con,"utf8");

        if(($pet_breed == 'เลือกสายพันธุ์') && ($pet_age == 'เลือกอายุ')){
            $sql1 = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_kind = '$pet_kind' and pet.pet_gender = '$pet_gender' and user.province = '$province' and user.user_id <> '$user_id' ";
            //echo $sql;
            $query1 = mysqli_query($con,$sql1);
            $result = array();
    
            while($row = mysqli_fetch_array($query1)){
                $pet_birthday = $row["pet_birthday"];
                $pet2_id = $row["pet_id"];
                $bday = new DateTime($pet_birthday); // Your date of birth
                $today = new Datetime(date('y.m.d'));
                $diff = $today->diff($bday);
                $check_breed = $row["pet_breed"];
                if(stristr($check_breed,"other")) {
                    $pet_breed = substr($check_breed,5);
                  }else {
                    $pet_breed = $row["pet_breed"];
                  }

                $sqlcheck = "SELECT * FROM pet_match WHERE pet1_id = $pet1_id AND pet2_id = $pet2_id";
                $querycheck = mysqli_query($con,$sqlcheck);
                if(mysqli_fetch_array($querycheck) == null){

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
                    //"user_id" => $row["user_id"],
                    "province" => $row["province"])); 
                }
            }
        }
        elseif ($pet_breed == 'เลือกสายพันธุ์'){
            $sql2 = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_kind = '$pet_kind' and pet.pet_gender = '$pet_gender' and user.province = '$province' and user.user_id <> '$user_id'";
            //echo $sql;
            $query2 = mysqli_query($con,$sql2);
            $result = array();
    
            while($row = mysqli_fetch_array($query2)){
                $pet_birthday = $row["pet_birthday"];
                $pet2_id = $row["pet_id"];
                $bday = new DateTime($pet_birthday); // Your date of birth
                $today = new Datetime(date('y.m.d'));
                $diff = $today->diff($bday);
                $check_breed = $row["pet_breed"];
                if(stristr($check_breed,"other")) {
                    $pet_breed = substr($check_breed,5);
                  }else {
                    $pet_breed = $row["pet_breed"];
                  }

                $sqlcheck = "SELECT * FROM pet_match WHERE pet1_id = $pet1_id AND pet2_id = $pet2_id";
                $querycheck = mysqli_query($con,$sqlcheck);
                if(mysqli_fetch_array($querycheck) == null){
    
                    if ($pet_age == 'ต่ำกว่า1ปี'){
                        if ($diff->y == 0){
                            $age = $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"],
                            "pet_breed" => $pet_breed,
                            "pet_age" => $age,
                            "pet_birthday" => $row["pet_birthday"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_picture" => $row["pet_picture"],
                            //"user_id" => $row["user_id"],
                            "province" => $row["province"])); 
                        }
                    }
                    if ($pet_age == '1-3ปี'){
                        if (($diff->y >=1) && ($diff->y <=3)){
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"],
                            "pet_breed" => $row["pet_breed"],
                            "pet_age" => $age,
                            "pet_birthday" => $row["pet_birthday"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_picture" => $row["pet_picture"],
                            //"user_id" => $row["user_id"],
                            "province" => $row["province"])); 
                        }
                    }
                    if ($pet_age == '4-6ปี'){
                        if (($diff->y >=4) && ($diff->y <=6)){
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"],
                            "pet_breed" => $row["pet_breed"],
                            "pet_age" => $age,
                            "pet_birthday" => $row["pet_birthday"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_picture" => $row["pet_picture"],
                            //"user_id" => $row["user_id"],
                            "province" => $row["province"])); 
                        }
                    }
                    if ($pet_age == '7ปีขึ้นไป'){
                        if ($diff->y >=7){
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"],
                            "pet_breed" => $row["pet_breed"],
                            "pet_age" => $age,
                            "pet_birthday" => $row["pet_birthday"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_picture" => $row["pet_picture"],
                            //"user_id" => $row["user_id"],
                            "province" => $row["province"])); 
                        }
                    }
                }
            }

        }
        elseif ($pet_age == 'เลือกอายุ'){
            if($pet_breed == 'อื่นๆ'){
                $sqlx = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_kind = '$pet_kind' and pet.pet_gender = '$pet_gender' and pet.pet_breed LIKE 'other%' and user.province = '$province' and user.user_id <> '$user_id'";
                // echo $sqlx;
                $queryx = mysqli_query($con,$sqlx);
                $result = array();
        
                while($row = mysqli_fetch_array($queryx)){
                    $pet_birthday = $row["pet_birthday"];
                    $pet2_id = $row["pet_id"];
                    $bday = new DateTime($pet_birthday); // Your date of birth
                    $today = new Datetime(date('y.m.d'));
                    $diff = $today->diff($bday);

                    $sqlcheckx = "SELECT * FROM pet_match WHERE pet1_id = $pet1_id AND pet2_id = $pet2_id";
                    $querycheckx = mysqli_query($con,$sqlcheckx);
                    if(mysqli_fetch_array($querycheckx) == null){

                        $pet_breed_get = $row["pet_breed"];
                        $pet_breed = substr($pet_breed_get,5);


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
                        //"user_id" => $row["user_id"],
                        "province" => $row["province"])); 
                    }
                }

            }


            else{
                $sql3 = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_kind = '$pet_kind' and pet.pet_gender = '$pet_gender' and pet.pet_breed = '$pet_breed' and user.province = '$province' and user.user_id <> '$user_id'";
                //echo $sql;
                $query3 = mysqli_query($con,$sql3);
                $result = array();
        
                while($row = mysqli_fetch_array($query3)){
                    $pet_birthday = $row["pet_birthday"];
                    $pet2_id = $row["pet_id"];
                    $bday = new DateTime($pet_birthday); // Your date of birth
                    $today = new Datetime(date('y.m.d'));
                    $diff = $today->diff($bday);

                    $sqlcheck = "SELECT * FROM pet_match WHERE pet1_id = $pet1_id AND pet2_id = $pet2_id";
                    $querycheck = mysqli_query($con,$sqlcheck);
                    if(mysqli_fetch_array($querycheck) == null){

                        $pet_breed_get = $row["pet_breed"];
                        $pet_breed = substr($pet_breed_get,5);

                        if ($diff->y == 0){
                            $age = $diff->m ." เดือน";

                        }
                        else{
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                        }

                        array_push($result,array("pet_id" => $row["pet_id"],
                        "pet_name" => $row["pet_name"],
                        "pet_kind" => $row["pet_kind"],
                        "pet_breed" => $row["pet_breed"],
                        "pet_age" => $age,
                        "pet_birthday" => $pet_breed,
                        "pet_gender" => $row["pet_gender"],
                        "pet_picture" => $row["pet_picture"],
                        //"user_id" => $row["user_id"],
                        "province" => $row["province"])); 
                    }
                }
            }
        }
        elseif ($pet_breed == 'อื่นๆ'){
            $sql2 = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_kind = '$pet_kind' and pet.pet_gender = '$pet_gender' and pet.pet_breed LIKE 'other%' and user.province = '$province' and user.user_id <> '$user_id'";
            $query2 = mysqli_query($con,$sql2);
            $result = array();
    
            while($row = mysqli_fetch_array($query2)){
                $pet_birthday = $row["pet_birthday"];
                $pet2_id = $row["pet_id"];
                $bday = new DateTime($pet_birthday); // Your date of birth
                $today = new Datetime(date('y.m.d'));
                $diff = $today->diff($bday);

                $sqlcheck = "SELECT * FROM pet_match WHERE pet1_id = $pet1_id AND pet2_id = $pet2_id";
                $querycheck = mysqli_query($con,$sqlcheck);
                if(mysqli_fetch_array($querycheck) == null){
                    $pet_breed_get = $row["pet_breed"];
                    $pet_breed = substr($pet_breed_get,5);

                    echo $pet_breed;
    
                    if ($pet_age == 'ต่ำกว่า1ปี'){
                        if ($diff->y == 0){
                            $age = $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"],
                            "pet_breed" => $pet_breed,
                            "pet_age" => $age,
                            "pet_birthday" => $row["pet_birthday"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_picture" => $row["pet_picture"],
                            //"user_id" => $row["user_id"],
                            "province" => $row["province"])); 
                        }
                    }
                    if ($pet_age == '1-3ปี'){
                        if (($diff->y >=1) && ($diff->y <=3)){
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"],
                            "pet_breed" => $row["pet_breed"],
                            "pet_age" => $age,
                            "pet_birthday" => $row["pet_birthday"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_picture" => $row["pet_picture"],
                            //"user_id" => $row["user_id"],
                            "province" => $row["province"])); 
                        }
                    }
                    if ($pet_age == '4-6ปี'){
                        if (($diff->y >=4) && ($diff->y <=6)){
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"],
                            "pet_breed" => $row["pet_breed"],
                            "pet_age" => $age,
                            "pet_birthday" => $row["pet_birthday"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_picture" => $row["pet_picture"],
                            //"user_id" => $row["user_id"],
                            "province" => $row["province"])); 
                        }
                    }
                    if ($pet_age == '7ปีขึ้นไป'){
                        if ($diff->y >=7){
                            $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                            array_push($result,array("pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"],
                            "pet_breed" => $row["pet_breed"],
                            "pet_age" => $age,
                            "pet_birthday" => $row["pet_birthday"],
                            "pet_gender" => $row["pet_gender"],
                            "pet_picture" => $row["pet_picture"],
                            //"user_id" => $row["user_id"],
                            "province" => $row["province"])); 
                        }
                    }
                }
            }

        }
        else{

        $sql = "SELECT * FROM pet INNER JOIN user ON pet.user_id=user.user_id WHERE pet.pet_kind = '$pet_kind' and pet.pet_gender = '$pet_gender' and pet.pet_breed = '$pet_breed' and user.province = '$province' and user.user_id <> '$user_id'";
        //echo $sql;
        $query = mysqli_query($con,$sql);
        $result = array();

        while($row = mysqli_fetch_array($query)){
            $pet_birthday = $row["pet_birthday"];
            $pet2_id = $row["pet_id"];
            $bday = new DateTime($pet_birthday); // Your date of birth
            $today = new Datetime(date('y.m.d'));
            $diff = $today->diff($bday);

            $sqlcheck = "SELECT * FROM pet_match WHERE pet1_id = $pet1_id AND pet2_id = $pet2_id";
            $querycheck = mysqli_query($con,$sqlcheck);
            if(mysqli_fetch_array($querycheck) == null){

                if ($pet_age == 'ต่ำกว่า1ปี'){
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
                        //"user_id" => $row["user_id"],
                        "province" => $row["province"])); 
                    }
                }
                if ($pet_age == '1-3ปี'){
                    if (($diff->y >=1) && ($diff->y <=3)){
                        $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                        array_push($result,array("pet_id" => $row["pet_id"],
                        "pet_name" => $row["pet_name"],
                        "pet_kind" => $row["pet_kind"],
                        "pet_breed" => $row["pet_breed"],
                        "pet_age" => $age,
                        "pet_birthday" => $row["pet_birthday"],
                        "pet_gender" => $row["pet_gender"],
                        "pet_picture" => $row["pet_picture"],
                        //"user_id" => $row["user_id"],
                        "province" => $row["province"])); 
                    }
                }
                if ($pet_age == '4-6ปี'){
                    if (($diff->y >=4) && ($diff->y <=6)){
                        $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                        array_push($result,array("pet_id" => $row["pet_id"],
                        "pet_name" => $row["pet_name"],
                        "pet_kind" => $row["pet_kind"],
                        "pet_breed" => $row["pet_breed"],
                        "pet_age" => $age,
                        "pet_birthday" => $row["pet_birthday"],
                        "pet_gender" => $row["pet_gender"],
                        "pet_picture" => $row["pet_picture"],
                        //"user_id" => $row["user_id"],
                        "province" => $row["province"])); 
                    }
                }
                if ($pet_age == '7ปีขึ้นไป'){
                    if ($diff->y >=7){
                        $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
                        array_push($result,array("pet_id" => $row["pet_id"],
                        "pet_name" => $row["pet_name"],
                        "pet_kind" => $row["pet_kind"],
                        "pet_breed" => $row["pet_breed"],
                        "pet_age" => $age,
                        "pet_birthday" => $row["pet_birthday"],
                        "pet_gender" => $row["pet_gender"],
                        "pet_picture" => $row["pet_picture"],
                        //"user_id" => $row["user_id"],
                        "province" => $row["province"])); 
                    }
                }
            }
        }
    

            
            // if ($diff->y == 0){
            //     $age = $diff->m ." เดือน";

            // }
            // else{
            //     $age = $diff->y . " ปี" . " " . $diff->m ." เดือน";
            //     $calage = $diff->y;
            // }


            // array_push($result,array("pet_id" => $row["pet_id"],
            //     "pet_name" => $row["pet_name"],
            //     "pet_kind" => $row["pet_kind"],
            //     "pet_breed" => $row["pet_breed"],
            //     "pet_age" => $age,
            //     "pet_birthday" => $row["pet_birthday"],
            //     "pet_gender" => $row["pet_gender"],
            //     "pet_picture" => $row["pet_picture"],
            //     //"user_id" => $row["user_id"],
            //     "province" => $row["province"]));
        }

        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
    
?>