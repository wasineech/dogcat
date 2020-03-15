<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){

        $pet_id  = $_GET['pet_id'];
        
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,"utf8");

        $sql = "SELECT * FROM medical WHERE pet_id= $pet_id ORDER BY med_timestamp ASC";

        $query = mysqli_query($con,$sql);

        $result = array();

        while ($row = mysqli_fetch_array($query)){

            array_push($result,array("med_id"=> $row["med_id"],
             "med_name" => $row["med_name"],
             "med_description" => $row["med_description"],
             "med_timestamp" => $row["med_timestamp"]));
        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>