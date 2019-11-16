<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../mysql/client.php");
$user = array(
	NULL
);



checkValue($_POST["username"],"username");
switch ($_POST["password"]) {
		case "":
			http_response_code(400);
			echo "Empty password.";
			break;
		
		case !(""):
			array_push($user,password_hash($_POST["password"],PASSWORD_BCRYPT));
			break;

		default:
			http_response_code(500);
			echo "Cannot handle request.";
			break;
}
checkValue($_POST["email"],"email");
checkValue($_POST["firstname"],"first name");
checkValue($_POST["surname"],"surname");

function checkValue($val,$desc,$checkdupe=false){
	global $user;
	switch ($val) {
		case "":
			http_response_code(400);
			echo "Empty {$desc}.";
			break;
		
		case !(""):
			array_push($user,$val);
			break;

		default:
			http_response_code(500);
			echo "Cannot handle request.";
			break;
	}
}

array_push($user,time());
//echo "Length: ".count($user);
//
$mysql = new MySqlClient("tables/users.php");
try{
	$mysql->connect();
	$mysql->prepare("addUser");
	$mysql->exec($user);
}catch(\PDOException $e){
	echo $e;
}