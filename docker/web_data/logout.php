<?php
include_once("./core/mysql/client.php");

if(!isset($_COOKIE['session'])){
    echo '{"success": false,"message": "No active Session!"}';
}
$mysql = new MySqlClient("tables/session.php");
try{
    $mysql->connect();
    $mysql->prepare("expired");
    if($mysql->exec([$_COOKIE['session']])){
        setcookie("session",false, "/", $_SERVER['HTTP_HOST'], true, true);
        setcookie("logged-in",false, "/");
        echo '{"success":true}';
    }
}catch(PDOEXception $e){
    echo '{"success": false,"message": "Database Error!"}';
}