<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $user_id  = $_GET['user_id'];
        // $latitude1 = $_GET['lat'];
        // $longitude1 = $_GET['lng'];

        // $user_id  = 1001;
        // $latitude1 = 16.474379;
        // $longitude1 = 102.823119;

        function distance($lat1, $lon1, $lat2, $lon2, $unit) {
            if (($lat1 == $lat2) && ($lon1 == $lon2)) {
              return 0;
            }
            else {
              $theta = $lon1 - $lon2;
              $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
              $dist = acos($dist);
              $dist = rad2deg($dist);
              $miles = $dist * 60 * 1.1515;
              $unit = strtoupper($unit);
          
              if ($unit == "K") {
                return ($miles * 1.609344);
              } else if ($unit == "N") {
                return ($miles * 0.8684);
              } else {
                return $miles;
              }
            }
          }
        
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

        $sql1 = "SELECT lat,lng FROM user WHERE user_id = $user_id";
        $query1 = mysqli_query($con,$sql1);

        $result1 = array();

        while ($row = mysqli_fetch_array($query1)){

                $latitude1 = $row["lat"];
                $longitude1 = $row["lng"];
                $sql = "SELECT * FROM user INNER JOIN pet ON user.user_id = pet.user_id ";

                $query = mysqli_query($con,$sql);
        
                $result = array();
        
                while ($row = mysqli_fetch_array($query)){
        
                    if($row["user_id"]!=$user_id){
                        $latitude2 = $row["lat"];
                        $longitude2 = $row["lng"];
                        $distance = distance($latitude1, $longitude1, $latitude2, $longitude2, "K");
        
                        if($distance <= 5){
        
                        // echo "distance: " . $distance . "<br>";
                            array_push($result,array("lat"=> $row["lat"],
                            "lng" => $row["lng"],
                            "pet_id" => $row["pet_id"],
                            "pet_name" => $row["pet_name"],
                            "pet_kind" => $row["pet_kind"]));
                        }
                    // array_push($result,array("pet_id"=> $row["pet_id"],
                    //  "pet_id" => $row["pet_id"],
                    //  "pet_kind" => $row["pet_kind"],
                    //  "pet_breed" => $row["pet_breed"],
                    //  "pet_birthday" => $row["pet_birthday"],
                    //  "pet_gender" => $row["pet_gender"],
                    //  "pet_picture" => $row["pet_picture"],
                    //  "user_id" => $row["user_id"]));
                    }
                }
               
        }

       
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>