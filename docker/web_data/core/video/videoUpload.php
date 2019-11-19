<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
$file = $_FILES['file'];
$path = "./";
foreach($file as $k=>$v){
    echo "Key {$k}: {$v}<br />";
}
move_uploaded_file($file['tmp_name'], $path."test.txt");


?>