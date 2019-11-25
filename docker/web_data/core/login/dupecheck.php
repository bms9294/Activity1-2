<?php
include_once("../mysql/client.php");

$response = array();

if(isset($_POST["usercheck"])){
	$response["usercheck"] = checkUsername($_POST["usercheck"]);
}
if(isset($_POST["emailcheck"])){
	$response["emailcheck"] = checkEmail($_POST["emailcheck"]);
}
function checkEmail($email){
	if($email == ""){
		return '{"success": false, "message": "Email cannot be blank!"}';
	}else{
		$mysql = new MySqlClient("tables/users.php");
		try{
			$mysql->connect();
			$mysql->prepare("idFromEmail");
			$row = ($mysql->exec([$email]))->fetch();
			if(! $row){
				return true;
			}else{
				return '{"success": false, "message": "Email already in use!"}';
			}
		}catch(\PDOException $e){
			return $e;
		}
	}
}
function checkUsername($user){
	if($user == ""){
		return '{"success": false, "message": "Username cannot be blank!"}';
	}else{
		$mysql = new MySqlClient("tables/users.php");
		try{
			$mysql->connect();
			$mysql->prepare("idFromUsername");
			$row = ($mysql->exec([$user]))->fetch();
			if(! $row){
				return true;
			}else{
				return '{"success": false, "message": "Username already in use!"}';
			}
		}catch(\PDOException $e){
			return $e;
		}
	}
}
if(count($response) > 0)echo json_encode($response);