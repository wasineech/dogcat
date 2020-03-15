<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    // header("Refresh:0");

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $pet_id  = $_GET['pet_id'];
        // $pet_id  = '1001';
        $noti_count = 0;
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

        $sql = "SELECT * FROM notification WHERE noti_to = '$pet_id' AND noti_isclick = '0'";
        $query = mysqli_query($con,$sql);
        $result = array();

        while ($row = mysqli_fetch_array($query)){
            $noti_count++;
            array_push($result,array("noti_count" => $noti_count,
            "noti_message" => $row["noti_message"],)); 
        }

     
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>