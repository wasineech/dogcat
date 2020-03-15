<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

   if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $post_id  = $_GET['post_id'];
        // $pet_id  = "1001";
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,'utf8');

        $sql = "SELECT * FROM post INNER JOIN pet ON post.pet_id = pet.pet_id WHERE post.post_id = $post_id";

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

        $sql2 = "SELECT * FROM post INNER JOIN pet ON post.pet_id = pet.pet_id INNER JOIN post_comment ON post.post_id = post_comment.post_id WHERE post.post_id = $post_id";

        $query2 = mysqli_query($con,$sql2);

        $result2 = array();
        while($row2 = mysqli_fetch_array($query2)){
            array_push($result2,array("post_id" => $row2["post_id"],
                "post_comment_content" => $row2["post_comment_content"],
                "pet_id" => $row2["pet_id"],
                "pet_name" => $row2["pet_name"],
                "pet_picture" => $row2["pet_picture"]));
        }
        print json_encode(array('result2' => $result2));

        mysqli_close($con);
    }
?>