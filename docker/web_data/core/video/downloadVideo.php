<?php
include_once("../mysql/client.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = $_POST['url'];
$title  = $_POST['title'];
$token = $_COOKIE['session'];

$mysql = new MySqlClient("tables/session.php");
try {

    // Obtain userID
    $mysql->connect();
    $mysql->prepare("idFromSession");
    $row = ($mysql->exec([$token]))->fetch();
    $userID = $row['userID'];

    $filename = basename($url);
    $targetDir = "./";

    $tmp = explode('.', $filename);
    $fileType = end($tmp);


    $hashedFilename = hash("sha256", time().$filename);
    $newFilePath = $targetDir.$userID."-".$hashedFilename.".".$fileType;
    $newFilePath = "../../video/".$newFilePath;

    echo "curl --insecure -o $newFilePath $url";

    exec("curl --insecure -o $newFilePath $url", $output, $return);

    if($return == 0)
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