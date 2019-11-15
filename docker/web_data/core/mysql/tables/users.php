<?php
return array(
	"create" => "CREATE TABLE IF NOT EXISTS users(
		userid INT AUTO_INCREMENT,
		username VARCHAR(64) NOT NULL,
		passhash VARCHAR(90) NOT NULL,
		email VARCHAR(255),
		firstname VARCHAR(64),
		surname VARCHAR(64),
		registered INT NOT NULL,
		PRIMARY KEY(userid))",
	"addUser" => "INSERT INTO users VALUES(?,?,?,?,?,?,?)",
	"getHash" => "SELECT passhash FROM users WHERE email=? OR username=?",
	"idFromEmail" => "SELECT userid FROM users WHERE email=?",
	"idFromUsername" => "SELECT userid FROM users WHERE username=?"
);