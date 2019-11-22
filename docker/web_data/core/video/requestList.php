<?php
include_once("../mysql/client.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$whitelist = array(
    '127.0.0.1',
    '::1'
);
//if(in_array($_SERVER['HTTP_HOST'], $whitelist)){
    if(isset($_POST['start']) && isset($_POST['count'])){
        $mysql = new MySqlClient("tables/video.php");
        try{
            $mysql->connect();
            if(isset($_POST['user'])){
                $mysql->prepare("getVideosOfUser");
                $args = [$_COOKIE['session'], $_POST['start'],$_POST['count']];
            }else{
                $mysql->prepare("getVideoList");
                $args = [$_POST['start'],$_POST['count']];
            }
            
            $rows = $mysql->exec($args)->fetchAll();
            if($rows){
                echo json_encode($rows);
            }
        }catch(PDOException $e){
            echo $e-getMessage();
        }
//    }
}