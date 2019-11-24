<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$config = include_once("./mysql/config.php");
include_once("./session/session.php");

$valid = challengeSession();
if($valid = '{"success": true}'){
    if(isset($_POST["video"])){
        $video = $_POST["video"];
        $token = $_COOKIE['session'];
        //echo $video."<br />";
        //echo "DELETE FROM videos WHERE username=
        //(SELECT userID FROM session WHERE token='".$token."') AND title=$video";
        $mysql = new MySqlClient("tables/video.php");
        $mysql->connect();
        $mysql->prepare("getVideo");
        $vid = $mysql->exec([$video])->fetch();
        //echo $vid['pathToVideo'];
        $link = mysqli_connect($config["host"],$config["username"],$config["password"],$config["db_name"]);
        //echo "<br />";
        if(mysqli_multi_query($link, "DELETE FROM videos WHERE userID=(SELECT userID FROM session WHERE token='".$token."') AND videoID=".$video)){
            echo '{"success": true}';
        }else{
            echo '{"success": false}';
        }
        try{
            unlink("../".$vid['pathToVideo']);
        }catch(Exception $e){
            echo '{"success": false}';
        }
    }else{
        echo '{"success": false}';
    }
}else{
    echo '{"success": false}';
}
