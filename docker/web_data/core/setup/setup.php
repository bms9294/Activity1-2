<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../mysql/client.php");
$tables = array(//Cooresponds to the php files in /core/mysql/tables
	"testTable",
	"users"
);

$mysql = new MySqlClient();
try{
	$mysql->connect(); //Connect to the default database.	
}catch(\PDOException $e){
	if($e->getCode() == 1049){//Error code for the default database not existsing. Set in the config.php for mysql.
		$mysql->connect("");//Connect without a database.
		$mysql->createDB();//Create the database specified in the config.
	}
	
}
$mysql = new MySqlClient();

try{
	$mysql->connect(); //Connect to the default database.	
	foreach($tables as $t){
		//echo "tables/".$t.".php<br />";
		$mysql->withArray("tables/".$t.".php");
		$mysql->prepare("create");
		$mysql->exec();
		echo "{$t}: true<br />";
	}
}catch(\PDOException $e){
	if($e->getCode() == 1049){//Error code for the default database not existsing. Set in the config.php for mysql.
		$mysql->connect("");//Connect without a database.
		$mysql->createDB();//Create the database specified in the config.
	}else{
		echo "false";
	}
	
}

