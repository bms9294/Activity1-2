CREATE DATABASE IF NOT EXISTS videos4u_web;

USE videos4u_web;

CREATE TABLE IF NOT EXISTS session(
        sessionID INT AUTO_INCREMENT NOT NULL, 
        token CHAR(128) NOT NULL, 
        userID CHAR(32), 
        start INT, 
        lastSeen INT, 
        PRIMARY KEY(sessionID));

CREATE TABLE IF NOT EXISTS videos(
        videoID INT UNIQUE AUTO_INCREMENT,
        userID CHAR(32) NOT NULL,
        pathToVideo VARCHAR(255) NOT NULL,
        title VARCHAR(255),
        upload_date INT NOT NULL,
        thumbnail VARCHAR(255) NOT NULL,
        PRIMARY KEY(videoID));

CREATE TABLE IF NOT EXISTS users(
		userid CHAR(32) UNIQUE NOT NULL,
		username VARCHAR(64) UNIQUE NOT NULL,
		passhash VARCHAR(90) NOT NULL,
		email VARCHAR(255) UNIQUE,
		firstname VARCHAR(64),
		surname VARCHAR(64),
		registered INT NOT NULL,
		PRIMARY KEY(userid));