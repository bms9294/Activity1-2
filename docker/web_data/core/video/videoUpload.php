<?php
include_once("../mysql/client.php");
#require('vendor/autoload.php');


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$filename = $_POST['filename'];
$filename = ($_FILES["file"]["name"]);
$token = $_COOKIE['session'];

//echo $filename;

$mysql = new MySqlClient("tables/session.php");
try {

    // Obtain userID
    $mysql->connect();
    $mysql->prepare("idFromSession");
    $row = ($mysql->exec([$token]))->fetch();
    $userID = $row['userID'];

    // Create Paths to target directory and new file 
    // obtain the file type and size 
    $targetDir = "/video/";
    $targetFile = $targetDir.basename($_FILES["file"]["name"]);
    $fileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
    $fileSize = filesize($_FILES["file"]["tmp_name"]);

    // hash video file with sha256 using time concatenated with filename
    $hashedFilename = hash("sha256", time().$filename);
    $newFilePath = $targetDir.$userID."-".$hashedFilename.".".$fileType;

    //Allowed file types
    $allowed_types = ["mp4","webm","ogg"];

    //Check for proper file type and file size (under 2GB);
    if (in_array($fileType, $allowed_types))
    {
        $validFileType = true;
    }
    else
    {
        $validFileType = false;
    }
    


    //If file is valid type and file size upload the file to the target directory
    if ($validFileType)
    {

        // $ffmpeg = FFMpeg\FFMpeg::create();
        // $video = $ffmpeg->open($newFilePath);
        // $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds(6));
        // $frame->save($targetDir."/".$userID."-".$hashedFilename.".jpg");
        // $thumbnailPath = ($targetDir."/".$hashedFilename.".jpg");

        if(move_uploaded_file($_FILES["file"]["tmp_name"], "../../".$newFilePath))
        {
            $mysql = new MySqlClient("tables/video.php");
            $mysql->connect();
            $mysql->prepare("addVideo");
            if ($mysql->exec([NULL, $userID, $newFilePath, NULL, NULL, time(), "/"]))
            {
                echo '{"success": true, "path": "'.$newFilePath.'"}';
            }
            else
            {
                echo '{"success": false}';
            }

        } 
        else
        {
            echo '{"success": false}';
        }

    }
    else
    {
        echo '{"success": false}';
    }



} catch (PDOException $e) {
    echo $e->getMessage();
}





?>
