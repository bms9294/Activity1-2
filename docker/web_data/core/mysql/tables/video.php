<?php
return array(
	"create" => "CREATE TABLE IF NOT EXISTS videos(
        videoID INT UNIQUE AUTO_INCREMENT,
        userID CHAR(32) NOT NULL,
        pathToVideo VARCHAR(255) NOT NULL,
        title VARCHAR(255),
        summary VARCHAR(1000),
        upload_date INT NOT NULL,
        thumbnail VARCHAR(255) NOT NULL,
        PRIMARY KEY(videoID))",
    "addVideo" => "INSERT INTO videos VALUES(?,?,?,?,?,?,?)",
    "deleteVideo" => "DELETE FROM videos WHERE videoID=?",
    "getVideoPath" => "SELECT pathToVideo FROM videos WHERE videoID=?",
    "updateTitleSummary" => "UPDATE videos SET title=?, summary=? WHERE pathToVideo=?",
    "getAllVideos" => "SELECT videoID, title FROM videos",
    "getUserVideos" => "SELECT videoID, title FROM videos WHERE userID=?",
    "getAllVideos" => "SELECT videoID,thumbnail,title FROM videos",
    "getVideo" => "SELECT videos.title, videos.pathToVideo, videos.upload_date, users.username 
    FROM videos INNER JOIN users ON videos.userID=users.userID AND videos.videoID=?",
    "getVideoList" => "SELECT * FROM videos limit ?,?",
    "getVideosOfUser" => "SELECT * FROM videos WHERE userID=(SELECT userID FROM session WHERE token=?) limit ?,?"
    
);