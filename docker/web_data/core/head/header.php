<?php

if(isset($_COOKIE['adm'])){
	include("../mysql/client.php");
	$mysql = new MySqlClient();
	$mysql->connect();
}


?>


<div id="header" >
<link rel=stylesheet href="/core/head/header.css" />
		<div onclick=location.href="/index.php"; class=nameplate >
			<h2  >Videos4U</h2>
			<div class=separator ></div>
		</div>
		<div class=menu >
			<a href="/index.php" >Home</a>
			<a>Videos</a>
		</div>
		<a class=login >Login</a>
</div>