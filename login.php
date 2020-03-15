<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

    if($_SERVER['REQUEST_METHOD']  == 'GET' ){

        $email  = $_GET['email'];
        $password  = $_GET['password'];

        // $email  = "jessixxxx@gmail.com";
        // $password  = "1234";


        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable to connect');

        mysqli_set_charset($con,'UTF-8');

        $sql = "SELECT * FROM user WHERE email ='".$email."' AND password='".$password."' " ;
        $query = mysqli_query($con,$sql);
        $result = array();

        while($row = mysqli_fetch_array($query)){
            array_push($result,array("user_id" => $row["user_id"],
                "email" => $row["email"],
                                    "password" => $row["password"]));
        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
    
?>