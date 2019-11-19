<?php
return array(
	"create" => "CREATE TABLE IF NOT EXISTS videos(
        videoID INT AUTO_INCREMENT NOT NULL,
        userID CHAR(32) NOT NULL,
        pathToVideo VARCHAR(255) NOT NULL,
        title VARCHAR(255) NOT NULL,
        upload_date INT NOT NULL,
        thumbnail VARCHAR(255) NOT NULL,
        PRIMARY KEY(videoID))",
    "addVideo" => "INSERT INTO videos FROM VALUES(?,?,?,?,?)",
    "getAllVideos" => "SELECT videoID, title FROM videos",
    "getUserVideos" => "SELECT videoID, title FROM videos WHERE userID=?",
    "getVideo" => "SELECT * FROM videos WHERE videoID=?";
);