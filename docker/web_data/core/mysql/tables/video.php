<?php
return array(
	"create" => "CREATE TABLE IF NOT EXISTS videos(
        videoID INT UNIQUE AUTO_INCREMENT,
        userID CHAR(32) NOT NULL,
        pathToVideo VARCHAR(255) NOT NULL,
        title VARCHAR(255),
        upload_date INT NOT NULL,
        thumbnail VARCHAR(255) NOT NULL,
        PRIMARY KEY(videoID))",
    "addVideo" => "INSERT INTO videos VALUES(?,?,?,?,?,?)",
    "deleteVideo" => "DELETE FROM videos WHERE videoID=?",
    "getAllVideos" => "SELECT videoID, title FROM videos",
    "getUserVideos" => "SELECT videoID, title FROM videos WHERE userID=?",
    
    "getVideo" => "SELECT videos.title, videos.pathToVideo, videos.upload_date, users.username 
    FROM videos INNER JOIN users ON videos.userID=users.userID AND videos.videoID=?"
    
);