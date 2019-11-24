<?php 
include_once("/var/www/html/core/mysql/client.php");
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
function auth(){
	return challengeSession();
}

function newSession($userid){
	$mysql = new MySqlClient("tables/session.php");
	try{
		$token = hash("sha512",gen_uuid()."-".gen_uuid()."-".gen_uuid());
		$start = time();
		$mysql->connect();
		$mysql->prepare("addSession");
		$result = $mysql->exec([$token,$userid,$userid,$start,$start]);
		if($result != false){
			return $token;
		}else{
			return false;
		}
	}catch(Exception $e){
		return $e->getMessage();
	}
}
function challengeSession($user=false){
	if($user == false){
		if(!isset($_COOKIE['session'])){
			return '{"success": false, "message": "No active Session!"}';
		}else{
			$token = $_COOKIE['session'];
			$mysql = new MySqlClient("tables/session.php");
			try{
				$mysql->connect();
				$mysql->prepare("getSession");
				$row = ($mysql->exec([$token]))->fetch();
				if($row){
					$last = $row['lastSeen'];
					if(($last+(60*60*4)) > time()){
						$mysql->prepare("refresh");
						$mysql->exec([(time()+(60*60*4)),$token]);
						setcookie("session",$token,time()+(60*60*4), "/", $_SERVER['HTTP_HOST'], true, true);
						return '{"success": true}';
					}else{
						$mysql->prepare("expired");
						$mysql->exec([$token]);
						setcookie("session",false, "/", $_SERVER['HTTP_HOST'], true, true);
						setcookie("logged-in",false, "/");
						return '{"success": false, "message": "Session Expired."}';
					}
				}else{
					return '{"success": false, "message": "No active Session!"}';
				}
			}catch(\PDOException $e){
				return $e->getMessage();
			}
		}
	}
}