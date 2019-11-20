<?php
include_once("../mysql/client.php");

$title  = $_POST['title'];
$path  = $_POST['path'];
$description = $_POST['description'];

$mysql = new MySqlClient("tables/video.php");
try 
{
    $mysql->connect();
    $mysql->prepare("updateTitleSummary");
    if($mysql->exec([$title, $description, $path]))
    {
        echo '{"success": true}';
    }
    else
    {
        echo '{"success": false}';
    }

} catch (PDOException $e)
{
    echo $e->getMessage();
}

