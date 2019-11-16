<?php
return array(
	//Queries associated with the "testTable"
	"create" => "CREATE TABLE IF NOT EXISTS testTable(
				id INT AUTO_INCREMENT NOT NULL, 
				name VARCHAR(250) NOT NULL,
				birthday DATE,
				PRIMARY KEY (id)
				)",//create the table
	"idToName" => "SELECT name FROM testTable WHERE id=?",//Get the name given an ID
	"idToBirthday" => "SELECT birthday FROM testTable WHERE id=?",//Get the birthday givem and ID
	"getRowByID" => "SELECT * FROM testTable WHERE id=?",//Get an entire row given an ID
	"getRowByName" => "SELECT * FROM testTable WHERE name=?",//Get an entire row given a Name
	"add" => "INSERT INTO testTable VALUES(?,?,?)"//Add a new row.
);