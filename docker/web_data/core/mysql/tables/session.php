<?php
return array(
	"create" => "CREATE TABLE IF NOT EXISTS session(
					sessionID INT AUTO_INCREMENT NOT NULL, 
					token CHAR(128) NOT NULL, 
					userID INT, 
					start INT, 
					lastSeen INT, 
					PRIMARY KEY(sessionID))",
	"addSession" => "INSERT INTO session VALUES(NULL, ?,(SELECT userid FROM users WHERE email=? OR username=?),?,?)",
	"getSession" => "SELECT lastSeen FROM session WHERE token=?",
	"refresh" => "UPDATE TABLE session SET lastSeen=? WHERE token=?"
);