<?php
include_once("../mysql/client.php");
$config = include("../mysql/config.php");

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$title  = $_POST['title'];
$path  = $_POST['path'];
$description = str_replace("'","\'", $_POST['description']);


$link = mysqli_connect($config['host'], $config['username'], $config['password'],$config['db_name']);
if (mysqli_query($link,"UPDATE videos SET title=$title, summary='".$description."' WHERE pathToVideo='".$path."'"))
{
    echo '{"success": true}';
}
else
{
    echo '{"success": false}';
}


// $mysql = new MySqlClient("tables/video.php");
// try 
// {
//     $mysql->connect();
//     $mysql->prepare("updateTitleSummary");
//     if($mysql->exec([$title, $description, $path]))
//     {
//         echo '{"success": true}';
//     }
//     else
//     {
//         echo '{"success": false}';
//     }

// } catch (PDOException $e)
// {
//     echo $e->getMessage();
// }

