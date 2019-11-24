<?php
//
//  For the love of all that is good, don't do this in production!
//
if (isset($_GET['id'])){
    $path = $_GET['id'];
    
    $thumb = fopen("$path",'rb');

    header("Content-Type: image/jpg");

    fpassthru($thumb);
}