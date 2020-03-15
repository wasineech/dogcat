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

        $sql = "SELECT * FROM post WHERE pet_id= $pet_id";

        $query = mysqli_query($con,$sql);

        $result = array();

        while ($row = mysqli_fetch_array($query)){
            if($row["post_photo"]!='no_photo'){

            array_push($result,array("post_id" => $row["post_id"],
             "post_photo" => $row["post_photo"],
             "pet_id"=> $row["pet_id"]));
            }
        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>