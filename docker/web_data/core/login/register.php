<?php
include_once("../mysql/client.php");
$user = array();
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
array_push($user,str_replace("-","",gen_uuid()));
checkValue($_POST["username"],"username");
switch ($_POST["password"]) {
		case "":
			echo '{"success":false, "message": "Empty Password!"';
			break;
		
		case !(""):
			array_push($user,password_hash($_POST["password"],PASSWORD_BCRYPT));
			break;

		default:
			echo '{"success": false, "message": "Cannot handle request."}';
			break;
}
checkValue($_POST["email"],"email");
checkValue($_POST["firstname"],"first name");
checkValue($_POST["surname"],"surname");

function checkValue($val,$desc,$checkdupe=false){
	global $user;
	switch ($val) {
		case "":
			echo '{"success":false, "message": "Empty '.$desc.'"';
			break;
		
		case !(""):
			array_push($user,$val);
			break;

		default:
			echo '{"success": false, "message": "Cannot handle request."}';
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
	if($mysql->exec($user)){
		echo '{"success": true}';
	}
}catch(\PDOException $e){
	if($e->getCode() == 1062){
	$mysql = new MySqlClient("tables/users.php");
	$user[0] = str_replace("-","",gen_uuid());
		try{
			$mysql->connect();
			$mysql->prepare("addUser");
			if($mysql->exec($user)){
				echo '{"success": true}';
			}
		}catch(\PDOException $e){
			echo '{"success": false, "message": "Database Error."}';
		}
		}
}