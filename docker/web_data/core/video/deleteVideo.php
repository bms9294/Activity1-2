<?php
include_once("../mysql/client.php");


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$videoID = $_POST['videoID'];

$mysql = new MySqlClient("tables/video.php");
try
{
    $mysql->connect();
    $mysql->prepare("getVideoPath");
    $path = ($mysql->exec([$videoID]))->fetch();
    $path = $path['pathToVideo'];

    unlink("../../".$path);

    $mysql->prepare("deleteVideo");
    if($mysql->exec([$videoID]))
    {
        echo '{"success": true}';
    }
    else
    {
        echo '{"success": false}';
    }

} 
catch (PDOException $e)
{
    echo $e->getMessage();
}



