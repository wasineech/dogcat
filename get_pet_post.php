<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

   if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $pet_id  = $_GET['pet_id'];
        // $count_comment = 0;
        // $pet_id  = "1001";
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,'utf8');

        // $sqlx = "SELECT * FROM post_comment INNER JOIN pet ON post_comment.pet_id = pet.pet_id INNER JOIN post ON post_comment.post_id = post.post_id  WHERE post_comment.post_id = $post_id";

        // $queryx = mysqli_query($con,$sql);
        // while($rowx = mysqli_fetch_array($queryx)){
        //     $count_comment= $count_comment+1;
        // }

        $sql = "SELECT * FROM post INNER JOIN pet ON post.pet_id = pet.pet_id WHERE post.pet_id = $pet_id ORDER BY post.post_timestamp DESC";

        $query = mysqli_query($con,$sql);

        $result = array();
        while($row = mysqli_fetch_array($query)){
            array_push($result,array("post_id" => $row["post_id"],
                "post_content" => $row["post_content"],
                "post_photo" => $row["post_photo"],
                "post_time" => $row["post_timestamp"],
                "pet_id" => $row["pet_id"],
                "pet_name" => $row["pet_name"],
                "pet_picture" => $row["pet_picture"]));
        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>