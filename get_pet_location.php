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
        
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

        $sql1 = "SELECT lat,lng FROM user WHERE user_id = $user_id";
        $query1 = mysqli_query($con,$sql1);

        $result1 = array();

        while ($row = mysqli_fetch_array($query1)){
                $latitude1 = $row["lat"];
                $longitude1 = $row["lng"];
             
                array_push($result1,array("lat"=> $row["lat"],
                "lng" => $row["lng"]));
    
               
        }

       
        print json_encode(array('result' => $result1));

        mysqli_close($con);
    }
?>