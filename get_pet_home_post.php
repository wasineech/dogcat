<?php
    header("Content-type:text/javascript;charset=utf-8");
    define('HOST','localhost');
    define('USER','root');
    define('PASS','');
    define('DB','dogcat');

   if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $pet_id  = $_GET['pet_id'];
        // $pet_id  = "1001";
        // $pet_id  = "1039";

        $array_pet_id = array();
        $result = array();
        array_push($array_pet_id,$pet_id);
        $con = mysqli_connect(HOST,USER,PASS,DB) or die ('Unable t o connect');

        mysqli_set_charset($con,'utf8');

        $sql1 = "SELECT * FROM pet_match WHERE pet1_id = $pet_id AND match_status = '1'";
        $query1 = mysqli_query($con,$sql1);
        while($row1 = mysqli_fetch_array($query1)){
            $pet_id1 = $row1["pet2_id"];
            array_push($array_pet_id,$pet_id1);
        }
        $sql2 = "SELECT * FROM pet_match WHERE pet2_id = $pet_id AND match_status = '1'";
        $query2 = mysqli_query($con,$sql2);
        while($row2 = mysqli_fetch_array($query2)){
            $pet_id2 = $row2["pet1_id"];
            array_push($array_pet_id,$pet_id2);
        }

        foreach ($array_pet_id as $pet_id_value) {
            $sql = "SELECT * FROM post INNER JOIN pet ON post.pet_id = pet.pet_id WHERE post.pet_id = $pet_id_value ORDER BY post.post_timestamp DESC";

            // echo  $sql;
            $query = mysqli_query($con,$sql);

            $count_comment = 0;

            while($row = mysqli_fetch_array($query)){
                $post_id = $row["post_id"];
                $count_comment = 0;
                $count_like = 0;
                $like_status = 0;

                $sql_comment = "SELECT * FROM post_comment WHERE post_id = '$post_id'";
                $query_comment = mysqli_query($con,$sql_comment);
                while($row_comment = mysqli_fetch_array($query_comment)){
                    $count_comment++;
                }
                $sql_like = "SELECT * FROM post_like WHERE post_id = '$post_id' AND post_like_status = '1'";
                $query_like = mysqli_query($con,$sql_like);
                while($row_like = mysqli_fetch_array($query_like)){
                    $count_like++;
                    $pet_like = $row_like["pet_id"];
                    if($pet_id==$pet_like){
                        $like_status++;
                    }
                    else{

                    }
                }
                array_push($result,array("post_id" => $row["post_id"],
                    "post_content" => $row["post_content"],
                    "post_photo" => $row["post_photo"],
                    "post_time" => $row["post_timestamp"],
                    "pet_id" => $row["pet_id"],
                    "pet_name" => $row["pet_name"],
                    "pet_picture" => $row["pet_picture"],
                    "count_comment" =>  $count_comment,
                    "count_like" =>  $count_like,
                    "like_status" =>  $like_status));
            }
        }
        print json_encode(array('result' => $result));

        mysqli_close($con);
    }
?>