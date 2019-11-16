<?php
include("../mysql/client.php");


function challengePass($user,$pass){
	$mysql = new MySqlClient("tables/users.php");
	try{
		$mysql->connect();
		$mysql->prepare("getHash");
		$row = ($mysql->exec([$user,$user]))->fetch();
		if(password_verify($pass,$row["passhash"])){
			return "true";
		}else{
			return "Incorrect Login/Password!";
		}
	}catch(\PDOException $e){
		return $e;
	}
}
switch ($_POST["password"]) {
	case "":
		echo "Empty password!";
		break;
		
	case !(""):
		if(isset($_POST["username"]) && $_POST["username"] != ""){
			echo challengePass($_POST["username"], $_POST["password"]);
		}else{
			echo "Empty Username!";
		}
		break;

	default:
		echo "Cannot handle request.";
		break;
}


