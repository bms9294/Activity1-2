<?php
include("session.php");
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$last = challengeSession();
if($last == false){
	echo "{success: false, message: \"No active Session!\"}";
}else{
	if($last < (time()+(60*60*4))){
		echo "{success: true}";
	}else{
		echo "{success: false, message: \"Session Expired.\"}";
	}
}

