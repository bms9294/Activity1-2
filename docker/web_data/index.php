<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("./core/mysql/client.php");
//include("./core/head/header.php");




//using optional array loaded from "core/mysql/tables""
$mysql = new MySqlClient("tables/testTable.php");

try{
	$mysql->connect(); //Connect to the default database.

	$mysql->prepare("create");//Select statement from loaded query table.
	$mysql->exec();//No values are required for input for this statement.
	$mysql->prepare("add");
	$mysql->exec([NULL,"dan",date("Y-m-d H:i:s")]);//array Values positions cooresponding to the "?" in the query statement.
	$mysql->exec([NULL,"stephen",date("Y-m-d H:i:s")]);//Multiple executions using one prepare.
	$mysql->exec([NULL,"jerry",date("Y-m-d H:i:s")]);
	$mysql->exec([NULL,"larry",date("Y-m-d H:i:s")]);

	$mysql->prepare("getRowByID");
	$test = $mysql->exec([3]); //All arguments must be in an array "[]"


	echo "Single Row, <br />";
	if($test != false){//check to make sure the query succeeded.
		foreach($test->fetch() as $k => $v){//This gets the values of the returned row.
			echo "{$k}: ".$v."<br />";//Print out the row values.
		}
	}
	echo "<br /><br /><br />";

	echo "All Rows: <br />";
	$mysql->prepare("SELECT * FROM testTable;");
	$rows = $mysql->exec();//Gets all the 
	foreach($rows->fetchAll() as $row){//For each row
		echo "ID: {$row['id']}, Name: ".$row['name']."<br />";//Print the ID and name.
	}
	
}catch(\PDOException $e){
	if($e->getCode() == 1049){//Error code for the default database not existsing. Set in the config.php for mysql.
		$mysql->connect("");//Connect without a database.
		$mysql->createDB();//Create the database specified in the config.
	}
	
}
?>
<!DOCTYPE html>
<html lang=en >
	<head>
	<link rel=stylesheet href="core/style.css" />
		<title>Videos4U</title>
	</head>
	<body>

	</body>

</html>