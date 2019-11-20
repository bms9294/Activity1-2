<?php
include("../mysql/client.php");
include("../session/session.php");

//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

function challengePass($user,$pass){
	$mysql = new MySqlClient("tables/users.php");
	try{
		$mysql->connect();
		$mysql->prepare("getHash");
		$row = ($mysql->exec([$user,$user]))->fetch();
		if(password_verify($pass,$row["passhash"])){
			$token = newSession($user);
			if($token != false){
				ob_start();
				setcookie("session",$token,time()+(60*60*4), "/", $_SERVER['HTTP_HOST'], false, true);
				return '{"success": true}';
			}else {
				$code = newSession($user);
				return '{"success": false, "message": "Error Creating Session!"}';
			}
		}else{
			return '{"success": false, "message": "Incorrect Login/Password!"}';
		}
	}catch(\PDOException $e){
		return $e;
	}
}
switch ($_POST["password"]) {
	case "":
		echo '{"success": false, "message": "Empty Password!"}';
		break;
		
	case !(""):
		if(isset($_POST["username"]) && $_POST["username"] != ""){
			echo challengePass($_POST["username"], $_POST["password"]);
		}else{
			echo '{"success": false, "message": "Empty Username!"}';
		}
		break;

	default:
		echo '{"success": false, "message": "Error Handling Request!"}';
		break;
}