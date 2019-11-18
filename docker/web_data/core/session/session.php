<?php 
include_once("../mysql/client.php");
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
			return false;
		}else{
			$token = $_COOKIE['session'];
			$mysql = new MySqlClient("tables/session.php");
			try{
				$mysql->connect();
				$mysql->prepare("getSession");
				$row = ($mysql->exec([$token]))->fetch();
				if($row){
					return $row['lastSeen'];
				}else{
					return false;
				}
			}catch(\PDOException $e){
				return $e->getMessage();
			}
		}
	}
}