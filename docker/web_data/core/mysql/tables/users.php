<?php
return array(
	"create" => "CREATE TABLE IF NOT EXISTS users(
		userid CHAR(32) UNIQUE NOT NULL,
		username VARCHAR(64) UNIQUE NOT NULL,
		passhash VARCHAR(90) NOT NULL,
		email VARCHAR(255) UNIQUE,
		firstname VARCHAR(64),
		surname VARCHAR(64),
		registered INT NOT NULL,
		PRIMARY KEY(userid))",
	"addUser" => "INSERT INTO users VALUES(?,?,?,?,?,?,?)",
	"getHash" => "SELECT passhash FROM users WHERE email=? OR username=?",
	"getUser" => "SELECT userid FROM users WHERE email=? OR username=?",
	"idFromEmail" => "SELECT userid FROM users WHERE email=?",
	"idFromUsername" => "SELECT userid FROM users WHERE username=?"
);